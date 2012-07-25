<?php

abstract class Spiderable extends BaseObject implements ArrayAccess {

    public function offsetExists($offset) {
        try {
            call_user_func(array($this, "get$offset"));
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function offsetGet($offset) {
        try {
            return call_user_func(array($this, "get$offset"));
        } catch (Exception $e) {
            return null;
        }
    }

    public function offsetSet($offset, $value) {
        return false;
    }

    public function offsetUnset($offset) {
        return false;
    }

    /**
     * keys: hierarchy of Spiderable objects.  $this->types is generated from
     * the keys
     *
     * values: array of fields for each type of object that should be joined in
     * for queries for building spider URLs.
     */
    protected $hierarchy = array(
        'School'  => array('BId', 'Subdomain', 'Slug'),
        'Campus'  => array('BId', 'Name'),
        'Term'    => array('BId', 'Name'),
        'Dept'    => array('BId', 'Abbr'),
        'Course'  => array('BId', 'Num'),
        'Section' => array('BId', 'Num')
    );

    public function __construct() {
        $this->types = array_keys($this->hierarchy);
        $this->class = get_class($this);
        $this->childClass = @$this->types[1 + array_search($this->class, $this->types)];
        $this->debug = isset($this->debug) ? $this->debug : 'BId';

        $this->isQueryResult = false;

        parent::__construct();
    }

    public function getBookstore() {
        $class = $this->getBookstoreType();
        return new $class;
    }

    public function getChildren() {
        $get = $this->childClass == 'Campus' ? 'Campuses' : "{$this->childClass}s";
        return call_user_func($this->getBookstoreType() . "::get{$get}", $this);
        
    }

    public function getChild() {
        $class = $this->childClass;
        $obj = new $class;
        $obj->setBookstoreType($this->getBookstoreType());
        call_user_func(array($obj, "set{$this->class}"), $this);
        return $obj;
    }

    public function getChildQuery() {
        $class = "{$this->childClass}Query";
        $query = new $class;
        $query->filterBy("{$this->class}Id", $this->getId());
        $query->filterByBookstoreType($this->getBookstoreType());
        return $query;
    }

    /**
     * Called when a magic method that is normally only accessible from a specially
     * constructed join query is called, e.g. $course->getSchoolBId()
     */
    public function __call($name, $args) {
        // query results are also Spiderable objects
        if ($this->isQueryResult) {
            return parent::__call($name, $args);
        } else {
            try {
                return parent::__call($name, $args);
            } catch (PropelException $e) {
                $includeMetadata = ($name == 'Name' || $name == 'Professor' ||
                                    $name == 'NbCampuses' || $name == 'IsCurrentTerm');

                return call_user_func_array(array($this->getJoinedQueryResult($includeMetadata), $name), $args);
            }
        }
    }

    /**
     * In the course of spidering, when we need to spider, for example, a Course
     * object, we need to get a bunch of information (namely IDs) for the Dept,
     * Term, Campus, and School.  Rather than doing this with
     * $course->getDept()->getTerm() and the like, which would use many queries,
     * we construct a query like this:
     *
     * $courseQuery->join('Course.Dept')
     *     ->withColumn('Dept.BId', 'DeptBId')
     *     ->join('Dept.Term')
     *     ->withColumn('Term.BId', 'TermBId')
     *     ...
     *     ->join('School')
     *     ->withColumn('School.Subdomain', 'SchoolSubdomain')
     *     ...
     *     ->find()
     *
     * which allows us to do $course->getDeptBId(),
     * $course->getSchoolSubdomain(), etc., and only use one query.
     *
     * This function automates this process for all classes in the
     * School->Section hierarchy using identifiers and attributes defined in
     * member arrays of their classes.
     */
    public function getJoinedQueryResult($includeMetadata=false) {
        if (isset($this->joinedQueryResult)) {
            return $this->joinedQueryResult;
        }

        $class = "{$this->class}Query";
        $query = new $class;
        $query->filterById($this->getId());

        for ($i = array_search($this->class, $this->types); $i >= 0; $i--) {
            $currentClass = $this->types[$i];

            if ($i - 1 >= 0) {
                $parentClass = $this->types[$i-1];
                $query->join("$currentClass.$parentClass");
            }

            foreach ($this->hierarchy[$this->types[$i]] as $att) {
                $query->withColumn("$currentClass.$att", "$currentClass$att");
            }

            if ($includeMetadata && $currentClass::$metadata) {
                foreach ($currentClass::$metadata as $att) {
                    $query->withColumn("$currentClass.$att", "$currentClass$att");
                }
            }
        }

        $this->joinedQueryResult = $query->findOne();
        $this->joinedQueryResult->isQueryResult = true;
        return $this->joinedQueryResult;
    }

    public function needsSpidering($time=false) {
        global $maxBookstoreDataAge;

        if ($time === false) {
            $time = $this->getSpideredAt();
        }

        if ($time && strtotime($time) >= time() - $maxBookstoreDataAge
            || ($this instanceof Section && !$this->getRequiresBooks()))
        {
            return false;
        } else {
            return true;
        }
    }

    public function disable($message='') {
        if ($message) {
            decho("$message\n");
        }

        if ($this instanceof School) {
            decho( "(disabling {$this->class})\n" );
            $this->setEnabled(0)->save();
        } else {
            decho ("(deleting {$this->class})\n" );
            $this->delete();
        }
    }

    /**
     * @return array   an array of two values:
     *                 1. Whether all descendants of this item were spidered
     *                 2. Whether this item has or may have valid descendants
     *                    - used to delete things that have no valid descendants
     */
    public function spider($recursionDepth=0) {
        // don't spider a Term in batch mode if it's an old term
        if ($this instanceof Term && php_sapi_name() == 'cli' && $this->getStatus() == -1) {
            return array(true, true);
        }

        $shallowSpidering = (($this instanceof School && $recursionDepth == 2) ||
                             ($this instanceof Campus && $recursionDepth == 1) ||
                             ($this instanceof Term && $recursionDepth == 0));

        if (!$shallowSpidering && !$this->needsSpidering()) {
            return array(true, true);
        }

        if ($shallowSpidering && !$this->needsSpidering($this->getShallowSpideredAt())) {
            return array(false, true);
        }

        if ($this instanceof Section) {
            return $this->getBookstore()->spiderSections(array($this));
        }

        decho("Spidering {$this->class} " .
                call_user_func(array($this, "get{$this->debug}")) . "\n");

        // mark all children in the database as untouched
        $this->getChildQuery()->update(array('Touched' => false));

        try {
            $children = $this->getChildren();
        } catch (BookstoreError $e) {
            // retry once
            $children = $this->getChildren();
        }

        // update the database with the spidered data
        list($allChildren, $skipped) = $this->updateDb($children);
        $recursionDepth -= (int)$skipped;

        // if we were in the middle of spidering, pick up where we left off
        $children = array_filter($allChildren, function ($c) {
            return $c->needsSpidering();
        });

        $partial = (count($children) < count($allChildren));
        $complete = false;

        if ($recursionDepth > 0) {
            if ($this instanceof Course) {   // spider multiple sections at once
                list($complete, $foo) = $this->getBookstore()->spiderSections($children);
                $partial = $partial || $foo;
            } else {
                $complete = true;
                foreach ($children as $child) {
                    $result = $child->spider($recursionDepth - 1);
                    $complete = $complete && $result[0];
                    $partial = $partial || $result[1];
                }
            }
        } else {
            $complete = $this instanceof Course;
            $partial = true;
        }
        
        if ($complete) {
            $this->setSpidered()->save();
        }

        if ($partial && $shallowSpidering) {
            $this->setShallowSpideredAt(time())->save();
        }

        if (!$partial) {
            $this->disable("No children!");
            return array(true, true);
        }

        return array($complete, $partial);
    }

    /**
     * todo: (low priority)  switch to a batch insert (propel doesn't support it,
     * have to use raw SQL)
     *
     * @param  array $childData  the array of child data
     * @return array(array of child -- or potentially grandchild -- objects,
     *               whether it's grandchild objects (skipped a step))
     */
    protected function updateDb($childData) {
        if (!$childData) {
            return array(array(), 0);
        }

        $skipped = false;
        $children = array();
        foreach ($childData as $data) {
            // find a child instance
            $query = $this->getChildQuery();
            $childClass = $this->childClass;

            foreach ($childClass::$identifiers as $field) {
                $query->filterBy($field, $data[$field]);
            }

            // or create one if it doesn't exist
            if (!($child = $query->findOne())) {
                $child = $this->getChild();
                foreach ($childClass::$identifiers as $field) {
                    call_user_func(array($child, "set$field"), $data[$field]);
                }
            }

            foreach ($childClass::$attributes as $field) {
                call_user_func(array($child, "set$field"), $data[$field]);
            }

            $child->setTouched(true)->save();

            if (isset($data['Sections'])) {
                $skipped = true;
                list($grandchildren, ) = $child->updateDb($data['Sections']);
                $children = array_merge($children, $grandchildren);
            } else {
                $children[] = $child;
            }
        }

        // delete children that no longer exist
        $this->getChildQuery()->filterByTouched(false)->delete();

        // ensure terms have statuses so the right one gets spidered first
        if ($this instanceof Campus) {
            $this->save();
            $children = array();
            foreach ($this->getTerms() as $term) {
                $children[] = $term;
            }
        }

        usort($children, function ($a, $b) {
            if ($a instanceof Term) {
                if ($a->getStatus() == 0) {
                    return -1;
                } else if ($b->getStatus() == 0) {
                    return 1;
                } else {
                    return $b->getStatus() - $a->getStatus();
                }
            } else {
                // If it's not a department, randomize for great stealth.  PHP
                // uses quicksort so this is ok.
                if ($a instanceof Dept) {
                    return strcmp($a->getAbbr(), $b->getAbbr());
                } else {
                    return rand(-1, 1);
                }
            }
        });

        return array($children, $skipped);
    }

}

