<?php

class CourseInfoDelegator {
    protected $provider;

    public function __construct($class, $termName, $campusName=null) {
        $this->provider = new $class($termName, $campusName);
    }

    public function __get($name) {
        return $this->provider->{$name};

    }

    public function __set($name, $value) {
        $this->provider->{$name} = $value;
    }

    public function __call($name, $args) {
        decho("$name  in: " . print_r($args, true) . "\n");

        $result = call_user_func_array(array($this->provider, $name), $args);

        decho("$name out: " . print_r($result, true) . "\n");

        return $result;
    }
}

/**
 * An interface for providing metadata from school course catalogs:
 *    - department names
 *    - course names
 *    - professor names for sections
 *
 * CourseInfoProviders are instantiated relative to a single term name and campus 
 * name as they are defined on the school bookstore website, so if you have a 
 * multi-campus school or you can get data for multiple terms at once, the 
 * implementation has to manage the mismatch between its source and our 
 * abstraction. 
 *
 * A provider can choose any number of ways to provide data.  For example, if 
 * you can get data for all the school's sections at once, then you might as 
 * well just return a huge array of sections (with the necessary department 
 * abbreviation and course number to identify each one, of course).  You can
 * even return department names and course names in that huge array, and they 
 * will be used to set those attributes for departments and courses.
 *
 * Or, you might have to do it in a cumbersome way, and that is supported too.  
 * For example, you could first get all the department names.  Then you could 
 * get courses for each department, and sections for each course.
 *
 * School->updateMetadata uses CourseInfoProviders to update metadata after a 
 * complete spidering of a school's dropdown tree based on whatever methods you 
 * have implemented. 
 */
interface CourseInfoProvider {

    /**
     * Instantiate a new course catalog provider for the given school for term 
     * $term and, if the school has multiple campuses, campus $campusName.
     */
    public function __construct($termName, $campusName=null);

    /**
     * Whether the given school CourseInfoProvider has data for the term and 
     * campus specified at instantiation.
     */
    public function hasData();

    /**
     * @return array of arrays with keys 'Abbr', 'Name'
     */
    public function getAllDepts();

    /**
     * @return array of arrays with keys 'DeptAbbr', 'Num', 'Name' and 
     *         optionally 'DeptName'
     */
    public function getAllCourses();

    /**
     * @return array of arrays with keys 'DeptAbbr', 'CourseNum', 'Num', and 
     *         'Professor', and optionally 'DeptName' and/or 'CourseName'
     */
    public function getAllSections();

    /**
     * @param string $abbr   the department abbreviation
     * @return array with keys 'Abbr', 'Name'
     */
    public function getDept($abbr);

    /**
     * @param string $abbr   the department abbreviation
     * @return array of arrays with keys 'Num', 'Name'
     */
    public function getCoursesByDept($abbr);

    /**
     * @param string $deptAbbr  the department abbreviation
     * @param string $num       the course number
     * @return array with keys 'Num', 'Name', and optionally 'DeptAbbr', 
     *         'DeptName'
     */
    public function getCourse($deptAbbr, $num);

    /**
     * @param string $deptAbbr
     * @return array of arrays with keys 'CourseNum', 'Num', and 'Professor', 
     *         and optionally 'CourseName', 'DeptName'
     */
    public function getSectionsByDept($deptAbbr);

    /**
     * @param string $deptAbbr   the department abbreviation
     * @param string $courseNum  the course number
     * @return array of arrays with keys 'Num', 'Professor'
     */
    public function getSectionsByCourse($deptAbbr, $courseNum);

    /**
     * @param string $deptAbbr   the department abbreviation
     * @param string $courseNum  the course number
     * @param string $num        the section number
     * @return array with keys 'Num', 'Professor', and optionally 'CourseNum', 
     *         'CourseName', 'DeptAbbr', 'DeptName'
     */
    public function getSection($deptAbbr, $courseNum, $num);

}

abstract class BaseCourseInfoProvider {

    public function __construct($termName, $campusName=null) {
        $this->termName = $termName;
        $this->campusName = $campusName; 
    }

    public function getAllDepts() {
        return false;
    }

    public function getAllCourses() {
        return false;
    }

    public function getAllSections() {
        return false;
    }

    public function getDept($abbr) {
        return false;
    }
    
    public function getCoursesByDept($abbr) {
        return false;
    }

    public function getCourse($deptAbbr, $num) {
        return false;
    }

    public function getSectionsByDept($deptAbbr) {
        return false;
    }

    public function getSectionsByCourse($deptAbbr, $courseNum) {
        return false;
    }

    public function getSection($deptAbbr, $courseNum, $num) {
        return false;
    }
}
