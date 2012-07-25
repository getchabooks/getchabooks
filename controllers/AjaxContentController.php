<?php

class AjaxError extends GetchabooksError {}

class AjaxContentController extends PageController {

    public function campuses($school) {
        $school = SchoolQuery::create()->findOneBySlug($school);
        if ($school) {
            $school->spider(2);
            echo json_encode($school->getCampusSelect());
        } else {
            throw new AjaxError("Expected item doesn't exist.");
        }
    }

    public function terms($campus) {
        $campus = CampusQuery::create()->findPk($campus);
        if ($campus) {
            $campus->spider(1);
            echo json_encode($campus->getTermSelect());
        } else {
            throw new AjaxError("Expected item doesn't exist.");
        }
    }

    public function departments($term) {
        $term = TermQuery::create()->findPk($term);
        if ($term) {
            $term->spider(0);
            echo json_encode($term->getDeptSelect());
        } else {
            throw new AjaxError("Expected item doesn't exist.");
        }
    }

    public function courses($department) {
        $dept = DeptQuery::create()->findPk($department);
        if ($dept) {
            $dept->spider(0);
            echo json_encode($dept->getCourseSelect());
        } else {
            throw new AjaxError("Expected item doesn't exist.");
        }
    }

    public function sections($course) {
        $course = CourseQuery::create()->findPk($course);
        if ($course) {
            $course->spider(0);
            echo json_encode($course->getSectionSelect());
        } else {
            throw new AjaxError("Expected item doesn't exist.");
        }
    }

    public function section_autocomplete() {
        $args = func_get_args();
        if (count($args) == 4) {
            list($school, $campus, $term, $query) = $args;
        } else {
            list($school, $term, $query) = $args;
            $campus = null;
        }

        $data = self::getAllSections($query, $school, $term, $campus);
        echo json_encode($this->filterSectionAutocomplete($data, $query));
    }

    public function section() {
        global $app;

        $args = func_get_args();
        if (count($args) == 4) {
            list($school, $campus, $term, $section) = $args;
        } else {
            list($school, $term, $section) = $args;
            $campus = null;
        }

        $s = SectionQuery::create()
            ->filterBySlug($section)
            ->filterBySchoolSlug($school)
            ->filterByTermSlug($term);

        if ($campus) {
            $s->filterByCampusSlug($campus);
        }

        $s = $s->join('Section.Course')
            ->join('Course.Dept')
            ->withColumn('Course.Num','CourseNum')
            ->withColumn('Course.Name','CourseName')
            ->withColumn('Dept.Abbr','DeptAbbr')
            ->withColumn('Dept.Name','DeptName')
            ->findOne();

        if ($s) {
            echo json_encode(array(
                'sectionNum'    => $s->getNum(),
                'courseNum'     => (int)$s->getCourseNum() == 0 ?
                                   $s->getCourseNum() : ltrim($s->getCourseNum(), '0'),
                'deptAbbr'      => $s->getDeptAbbr(),
                'deptName'      => $s->getDeptName(),
                'id'            => $s->getSlug(),
                'name'          => $s->getCourseName(),
                'displayName'   => $s->getName(),
                'professor'     => $s->getProfessor()
            ));

            $app->stop();

            // prefetch section results and prices.  todo: make more efficient 
            // (this also constructs packages that we don't care about and such)
            $foo = new Results(array(), array($section), $school, $term, $campus);
        } else {
            throw new AjaxError("Expected item doesn't exist.");
        }

    }

    /**
     * For user interface simplicity, we only support Section mode XOR ISBN
     * mode, for now.
     */
    public function results() {
        global $vendors, $results, $app;

        $args = func_get_args();
        $school = $args[0];
        if (count($args) == 1) {
            $ids = $args[0];
            $school = $term = $campus = null;
        } else if (count($args) == 4) {
            $school = $args[0];
            $campus = $args[1];
            $term = $args[2];
            $ids = isset($args[3]) ? $args[3] : '';
        } else {
            $school = $args[0];
            $term = $args[1];
            $ids = isset($args[2]) ? $args[2] : '';
            $campus = null;
        }

        $allIds = array_unique(explode(SECTION_DELIMITER, $ids));
        $isbns = array_filter($allIds, "Isbn::validate");
        $slugs = array_diff($allIds, $isbns);

        $isbnMode = ($school == null);
        $multiCampus = $campus;
        
        if ($isbnMode) {
            $pageUrl = $app->urlFor('isbn_results', array('ids' => $ids));
            $results = new Results($isbns, array());

        } else if ($multiCampus) {
            $pageUrl = $app->urlFor('multicampus_results', array(
                'ids' => $ids,
                'school' => $school,
                'campus' => $campus,
                'term' => $term
            ));
            $results = new Results($isbns, $slugs, $school, $term, $campus);

        } else {
            $pageUrl = $app->urlFor('singlecampus_results', array(
                'ids' => $ids,
                'school' => $school,
                'term' => $term
            ));
            $results = new Results($isbns, $slugs, $school, $term);

        }

        $pageUrl = $app->request()->getUrl() . $pageUrl;
        $selectionUrl = str_replace("/results/", "/selection/#?/", $pageUrl);

        $this->renderPlain('table', array(
            'isbnMode' => $isbnMode,
            'anyBooks' => $results->numItems > 0,
            'multipleBooks' => $results->numItems > 1,
            'tableClass' => 'vendor' . count($vendors),
            'multiCampus' => $multiCampus,
            'pageUrl' => $pageUrl,
            'selectionUrl' => $selectionUrl
        ));
    }

    /**
     * todo: this should be changed to use Amazon::getMultiAmazonData so only
     * one call is made if there are multiple isbns.  however, that makes it
     * difficult to keep isbn10/isbn13 distinction.
     */
    public function book($isbn) {
        global $app;

        $isbns = explode("-", $isbn);
        $ret = array();

        foreach ($isbns as $isbn) {
            if (Isbn::validate($isbn) && ($data = Amazon::getAmazonData($isbn))) {
                // Occasionally Amazon returns data for the book we want, but
                // with a different ISBN.  This preserves the original ISBN.
                if ($data['isbn'] != Isbn::to13($isbn)) {
                    $itemId = $data['isbn'];
                } else {
                    $itemId = $isbn;
                }

                $ret[] = array(
                    'itemId' => $itemId,
                    'slug' => $itemId,
                    'data' => $data
                );
            } else {
                $ret[] = array(
                    'itemId' => $isbn,
                    'slug' => $isbn,
                    'error' => true
                );
            }
        }

        echo json_encode($ret);

        $app->stop();
        Results::fetchPrices($isbns);
    }

    /* Filters an array of course data based on a search query
     * @param $rows JSON course data
     * @param $query    A search string
     * @return array    An array containing only courses whose department, name, or professor match $query
     */
    protected function filterSectionAutocomplete($rows, $query) {
        $departmentMatch = array();
        $courseMatch = array();
        $profMatch = array();

        $outputLimit = 1000;
        $departmentCount = 0;

        /*
        General Idea:
        - Loop through entire data set, adding it to the proper array, whether
          it matches the "department name" or "course name".
        - After done looping, start printing the department matches, then the
          course matches, until $outputLimit items have been printed.
         */

        // Special Case: Math5 v. Math 5 (space).
        $spaceCase = false;
        $querySpaceArray = explode(" ", $query);
        if (count($querySpaceArray) == 2) {
            if (preg_match( "/\s(\d+):*/", $query ) == 1) {
                $spaceCase = true;
                $spaceQuery = str_replace(" ", "", $query);
            }
        }

        // Set up the arrays.
        foreach ($rows as $row) {
            if ($departmentCount > $outputLimit) { //we already have the 10 entries we are going to display, so let's get out of here
                break;
            }

            $name = strtolower($row['displayName']);
            $name_pos = strpos($name, strtolower($query) );

            if ($spaceCase){
                $name_pos2 = strpos($name, strtolower($spaceQuery) );
                if ($name_pos2 !== FALSE){
                    $departmentMatch[] = $row;
                    $departmentCount++;
                }
            }
            if ($name_pos !== FALSE) {
                if ($name_pos == 0) {                    // Department Name
                    $departmentMatch[] = $row;
                    $departmentCount++;
                } else if ($name[$name_pos-1] == ' ') {   // Course Name
                    $courseMatch[] = $row;
                } else if ($name[$name_pos-1] == '(') {   // Professor Name
                    $profMatch[] = $row;
                }
            }

        }

        // Print the department matches.
        $listIndex = 1; // This must start at one. Thus spoke Ricky.
        $query = preg_quote($query);
        $query = str_replace("/","\/",$query);
        $client = array();

        // PROFESSORS
        if ($listIndex <= $outputLimit) {
            foreach ($profMatch as $item) {
                if ($listIndex > $outputLimit) {
                    break;
                }
                $client[] = $item;
                $listIndex++;
            }
        }

        // DEPARTMENTS
        if ($listIndex <= $outputLimit) {
            foreach ($departmentMatch as $item) {
                if ($listIndex > $outputLimit) {
                    break;
                }
                $client[] = $item;
                $listIndex++;
            }
        }

        // COURSES
        if ($listIndex <= $outputLimit) {
            foreach ($courseMatch as $item) {
                if ($listIndex > $outputLimit) {
                    break;
                }
                $client[] = $item;
                $listIndex++;
            }
        }

        return $client;
    }

    protected static function getAllSections($query, $schoolSlug, $termSlug, $campusSlug='') {

        $sections = SectionQuery::create()
            ->filterByName("%{$query}%")
            ->filterBySchoolSlug($schoolSlug)
            ->filterByTermSlug($termSlug);

        if ($campusSlug) {
            $sections->filterByCampusSlug($campusSlug);
        }

        $sections = $sections->join('Section.Course')
            ->join('Course.Dept')
            ->withColumn('Course.Num','CourseNum')
            ->withColumn('Course.Name','CourseName')
            ->withColumn('Dept.Abbr','DeptAbbr')
            ->withColumn('Dept.Name','DeptName')
            ->withColumn('LPAD(Course.Num, 6, "0")', 'PaddedCourseNum')
            ->orderBy('DeptAbbr', 'ASC')
            ->orderBy('PaddedCourseNum', 'ASC')
            ->find();

        $rows = array();
        foreach ($sections as $s) {
            $rows[$s->getSlug()] = array(
                'sectionNum'    => $s->getNum(),
                'courseNum'     => $s->getCourseNum(),
                'deptAbbr'      => $s->getDeptAbbr(),
                'deptName'      => $s->getDeptName(),
                'slug'          => $s->getSlug(),
                'name'          => $s->getCourseName(),
                'displayName'   => $s->getName()
            );
        }
        return $rows;
    }

}
