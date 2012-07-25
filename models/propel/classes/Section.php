<?php

/**
 * @package propel.generator.
 */
class Section extends BaseSection {
    protected $joinedQuery = null;

    public static $identifiers = array('BId');
    public static $attributes = array('Num', 'RequiresBooks');
    public static $metadata = array('Professor');
    public $debug = 'Num';

    public function getNum($escaped = false) {
        if ($escaped) {
            return preg_replace('/[\/\,\+&]/', ';', parent::getNum());
        } else {
            return parent::getNum();
        }
    }

    protected function getJoinedQuery() {
        if (!$this->joinedQuery) {
            $this->joinedQuery = CourseQuery::create()
                ->filterById($this->getCourseId())
                ->join('Course.Dept')
                ->join('Dept.Term')
                ->join('Term.Campus')
                ->join('Campus.School')
                ->withColumn('Dept.Abbr', 'DeptAbbr')
                ->withColumn('Course.Name', 'CourseName')
                ->withColumn('Term.Slug', 'TermSlug')
                ->withColumn('Campus.Slug', 'CampusSlug')
                ->withColumn('School.Slug', 'SchoolSlug')
                ->withColumn('School.NbCampuses', 'SchoolNbCampuses')
                ->withColumn('Course.Num', 'CourseNum')
                ->withColumn('Course.NbSections', 'CourseNbSections')
                ->findOne();
        }

        return $this->joinedQuery;
    }

    public function preInsert(PropelPDO $con = null) {
        $q = $this->getJoinedQuery();
        $this->setSchoolSlug($q->getSchoolSlug());
        $this->setCampusSlug($q->getCampusSlug());
        $this->setTermSlug($q->getTermSlug());
        return true;
    }

    public function preSave(PropelPDO $con = null) {
        $this->setName($this->makeName());
        $this->setSlug($this->makeSlug());
        return true;
    }

    public function makeSlug() {
        $c = $this->getJoinedQuery();

        $deptAbbr = strtolower($c->getDeptAbbr());
        $courseNum = ltrim($c->getCourseNum(), '0');
        $sectionNum = $this->getNum();

        $slug = "$deptAbbr$courseNum-$sectionNum";

        return str_replace(' ', '', $slug);
    }

    /**
     * gets the section name formatted as 
     * <deptAbbr><courseNum>[-<sectionNum>][: <courseName>][ (<professor>)]
     * @return string
     */
    public function makeName() {
        $c = $this->getJoinedQuery();
        $name = $c->getDeptAbbr() . ltrim($c->getCourseNum(), '0');
        
        if ($c->getCourseNbSections() > 1) {
            $name .= '-' . $this->getNum();
        }
        
        if ($courseName = $c->getCourseName()) {
            $name .= ": $courseName";
        }

        if ($professor = $this->getProfessor()) {
            $name .= " ($professor)";
        }

        return $name;
    }

} 
