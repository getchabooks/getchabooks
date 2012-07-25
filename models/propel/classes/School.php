<?php

class School extends BaseSchool {

    /**
     * The minimal fields that, in combination with its parent, uniquely identify a
     * Spiderable of this class.
     */
    public static $identifiers = array('BId');

    /**
     * Extraneous fields for a Spiderable of this class.  In all likelihood,
     * they are also unique among children of one item, but not necessarily.
     */
    public static $attributes = array('Name');

    /**
     * Metadata fields for a Spiderable of this class found in a
     * <spiderable>_metadata table.
     */
    public static $metadata = array();

    /**
     * The field to use to identify Spiderables of this class in e.g. debug
     * output to be read by a human.
     */
    public $debug = 'Slug';

    public static function findOneBySlug($slug) {
        if (!$slug) {
            return false;
        }

        $query = SchoolQuery::create();

        if (defined('PRODUCTION') && !defined('FAKEPROD')) {
            $query->filterByEnabled(1);
        }

        return $query->filterBySlug($slug)
            ->findOne();
    }

    public function getAmazonTag() {
        if (isset($_SESSION) && isset($_SESSION['tag'])) {
            return $_SESSION['tag'];
        } else if ($tag = parent::getAmazonTag()) {
            return $tag;
        } else {
            return 'txtbks-20';
        }
    }

    public function getLocalTax() {
        if ($tax = parent::getLocalTax()) {
            return $tax;
        } else if ($state = $this->getState()) {
            return taxRate($state);
        } else {
            return 6.25;        // Massachusetts
        }
    }

    /**
     * Sets the slug, checking for duplicates and appending a number to make it unique if they exist.
     */
    public function setSlug($slug, $i = 0) {
        $preExisting = SchoolQuery::create();
        if ($this->getId()) {
            $preExisting->where('School.Id != ?', $this->getId());
        }
        $preExisting->filterBySlug($i ? ($slug . $i) : ($slug));

        if ($preExisting->findOne()) {
            $this->setSlug($slug, $i+1);
        } else {
            parent::setSlug($i ? ($slug . $i) : ($slug))
                ->save();
        }

        return $this;
    }

    public function getShortName($override=false) {
        if ($override) {
            return ($name = parent::getShortName()) ? $name : $this->getName();
        } else {
            return parent::getShortName();
        }
    }

    public function getCampusSelect() {
        $this->ensureConsistency();

        if ($this->getNbCampuses() == 1) {
            return false;
        } else {
            $campuses = CampusQuery::create()
                ->filterBySchool($this)
                ->find();

            $ret = array();
            foreach ($campuses as $campus) {
                $ret[] = array(
                    'name' => $campus->getName(),
                    'id' => (string)$campus->getId(),
                    'slug' => $campus->getSlug()
                );
            }

            return $ret;
        }
    }

    /**
     * @param string $name  the full name of the school
     * @param string $slug  the subdomain/slug of the school
     */
    public static function guessShortName($name, $slug) {
        if (preg_match("/^(.+)cc$/", $slug, $matches) && (strlen($slug) == 5 || strlen($slug) == 6)) {
            //echo "Guessed first part of cc slug.\n";
            return strtoupper($matches[1]);
        }

        if (preg_match("/^(.+State)/", $name, $matches)) {
            //echo "Guess Something State.\n";
            return $matches[1];
        }

        if (preg_match("/^(?:The)?(.+)\s(University|College|Community College)/i", $name, $matches)
            || preg_match("/^(?:The)?(?:College|University)\sof(.+)/i", $name, $matches))
        {
            if ($slug == strtolower($matches[1])) {
                //echo "Guessed first part of name.\n";
                return $matches[1];
            } else if (strlen($slug) <= 4) {
                //echo "Guessed slug is an acronym.\n";
                return strtoupper($slug);
            }
        }

        return $name;

    }

    /**
     * @return boolean   false if there is no metadata, true if metadata update
     *                   succeeded
     */
    public function updateCourseInfo() {
        $class = ucfirst($this->getSlug());
        if (file_exists(BASE_DIR . "/models/CourseInfoProviders/$class.php")) {
            require_once BASE_DIR . "/models/CourseInfoProviders/$class.php";
        } else {
            return false;
        }

        if (!class_exists($class)) {
            error_log("Class not found: $class");
            return false;
        }

        foreach ($this->getCampuss() as $campus) {
            foreach ($campus->getTerms() as $term) {
                $catalog = new CourseInfoDelegator($class, $term->getName(), $campus->getName());

                if ($term->getStatus() == -1 || !$catalog->hasData()) {
                    continue;
                }
                
                decho("Updating course info for " . $term->getName() 
                        . " - " . $campus->getName() . "...\n");

                $this->updateDepts($catalog);
                $this->updateCourses($catalog);
                $this->updateSections($catalog);

                $term->setHasCourseInfo(1)->save();
            }
        }

        return true;
    }

    protected function filterByCatalog($deptQuery, $catalog) {
        return $deptQuery
            ->useTermQuery()
                ->filterByName($catalog->termName)
                ->useCampusQuery()
                    ->filterByName($catalog->campusName)
                    ->filterBySchool($this)
                ->endUse()
            ->endUse();

    }

    public function updateDepts($catalog, $depts=null) {
        global $indent;
        $indent = 0;
        decho("Updating departments...\n");

        if (!$depts) {
            $depts = $catalog->getAllDepts();
        }

        // if metadata provider doesn't do mass department lookup
        if (!$depts) {
            $query = $this->filterByCatalog(new DeptQuery(), $catalog);
            $depts = array();
            foreach ($query->find() as $dept) {
                if ($data = $catalog->getDept($dept->getAbbr())) {
                    $depts[] = $data;
                }
            }
        }

        // if metadata provider doesn't do single department lookup either
        if (!$depts) {
            decho("fail\n");
        } else {
            // update the database
            foreach ($depts as $dept) {
                $d = $this->filterByCatalog(new DeptQuery(), $catalog)
                    ->filterByAbbr($dept['Abbr'])
                    ->findOne();

                if (!$d) {
                    decho("Unknown dept: {$dept['Abbr']}\n");
                } else {
                    $d->setName($dept['Name'])->save();
                }
            }
            decho("success\n");
        }
    }

    public function updateCourses($catalog, $courses=null) {
        decho("Updating courses...");
        if (!$courses) {
            $courses = $catalog->getAllCourses();
        }

        // if metadata provider doesn't do mass course lookup
        if (!$courses) {
            $query = $this->filterByCatalog(new DeptQuery(), $catalog);
            $courses = array();
            foreach ($query->find() as $dept) {
                if ($data = $catalog->getCoursesByDept($dept->getAbbr())) {
                    $foo = array();
                    foreach ($data as $course) {
                        $course['DeptAbbr'] = $dept->getAbbr();
                        $foo[] = $course;
                    }
                    $courses = array_merge($courses, $foo);
                }
            }
        }

        // if metadata provider doesn't do per-department course lookup either
        if (!$courses) {
            $query = CourseQuery::create()
                ->join('Course.Dept')
                ->withColumn('Dept.Abbr', 'DeptAbbr')
                ->useDeptQuery();
            $query = $this->filterByCatalog($query, $catalog)
                ->endUse();

            $courses = array();
            foreach ($query->find() as $course) {
                if ($data = $catalog->getCourse($course->getDeptAbbr(), $course->getNum())) {
                    $data['DeptAbbr'] = $course->getDeptAbbr();
                    $courses[] = $data;
                }
            }
        }

        // if metadata provider doesn't do single course lookup either
        if (!$courses) {
            decho("fail\n");
        } else {
            $depts = array();
            foreach ($courses as $course) {
                $c = CourseQuery::create()
                    ->filterByNum($course['Num'])
                        ->useDeptQuery()
                            ->filterByAbbr($course['DeptAbbr']);
                $c = $this->filterByCatalog($c, $catalog)
                        ->endUse()
                        ->findOne();

                if (!$c) {
                    decho("Unknown course: {$course['DeptAbbr']}: {$course['Num']}\n");
                } else {
                    $c->setName($course['Name'])->save();
                }

                if (isset($course['DeptName']) && $course['DeptName']) {
                    $depts[] = array(
                        'Abbr' => $course['DeptAbbr'],
                        'Name' => $course['DeptName']
                    );
                }
            }

            decho("success\n");
            if ($depts) {
                $this->updateDepts($catalog, array_unique($depts));
            }

        }
    }

    public function updateSections($catalog, $sections=null) {
        decho("Updating sections... ");
        if (!$sections) {
            $sections = $catalog->getAllSections();
        }

        // if metadata provider doesn't do mass section lookup
        if (!$sections) {
            $query = $this->filterByCatalog(new DeptQuery(), $catalog);

            $sections = array();
            foreach ($query->find() as $dept) {
                if ($data = $catalog->getSectionsByDept($dept->getAbbr())) {
                    $foo = array();
                    foreach ($data as $section) {
                        $section['DeptAbbr'] = $dept->getAbbr();
                        $foo[] = $section;
                    }
                    $sections = array_merge($sections, $foo);
                }
            }
        }

        // if metadata provider doesn't do per-department section lookup either
        if (!$sections) {
            $query = CourseQuery::create()
                ->join('Course.Dept')
                ->withColumn('Dept.Abbr', 'DeptAbbr')
                ->useDeptQuery();
            $query = $this->filterByCatalog($query, $catalog)
                ->endUse();

            $sections = array();
            foreach ($query->find() as $c) {
                if ($data = $catalog->getSectionsByCourse($c->getDeptAbbr(), $c->getNum())) {
                    $foo = array();
                    foreach ($data as $section) {
                        $section['DeptAbbr'] = $c->getDeptAbbr();
                        $section['CourseNum'] = $c->getNum();
                        $foo[] = $section;
                    }
                    $sections = array_merge($sections, $foo);
                }
            }
        }

        // if metadata provider doesn't do per-course section lookup either
        if (!$sections) {
            $query = SectionQuery::create()
                ->join('Section.Course')
                ->join('Course.Dept')
                ->withColumn('Course.Num', 'CourseNum')
                ->withColumn('Dept.Abbr', 'DeptAbbr')
                ->useCourseQuery()
                    ->useDeptQuery();
            $query = $this->filterByCatalog($query, $catalog)
                    ->endUse()
                ->endUse();

            $sections = array();
            foreach ($query->find() as $s) {
                if ($data = $catalog->getSection($s->getDeptAbbr(),
                                                 $s->getCourseNum(), $s->getNum()))
                {
                    $data['DeptAbbr'] = $s->getDeptAbbr();
                    $data['CourseNum'] = $s->getCourseNum();
                    $sections[] = $data;
                }
            }
        }

        // if metadata provider doesn't do single section lookup either
        if (!$sections) {
            decho("fail\n");
        } else {
            $depts = array();
            $courses = array();
            foreach ($sections as $section) {
                $s = SectionQuery::create()
                    ->filterByNum($section['Num'])
                        ->useCourseQuery()
                            ->filterByNum($section['CourseNum'])
                            ->useDeptQuery()
                                ->filterByAbbr($section['DeptAbbr']);
                $s = $this->filterByCatalog($s, $catalog)
                            ->endUse()
                        ->endUse()
                    ->findOne();

                if (!$s) {
                    decho("Unknown section: {$section['DeptAbbr']}:"
                              . "{$section['CourseNum']}: {$section['Num']}\n");
                } else {
                    $s->setProfessor($section['Professor'])->save();
                }

                if (isset($section['DeptName']) && $section['DeptName']) {
                    $depts[] = array(
                        'Abbr' => $section['DeptAbbr'],
                        'Name' => $section['DeptName']
                    );
                }
                if (isset($section['CourseName']) && $section['CourseName']) {
                    $courses[] = array(
                        'DeptAbbr' => $section['DeptAbbr'],
                        'Num' => $section['CourseNum'],
                        'Name' => $section['CourseName']
                    );
                }
            }
            decho("success\n");
            if ($depts) {
                $this->updateDepts($catalog, $depts);
            }
            if ($courses) {
                $this->updateCourses($catalog, $courses);
            }

        }
    }

}
