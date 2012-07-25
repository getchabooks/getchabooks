<?php

require_once 'functions.php';

class Tufts extends BaseCourseInfoProvider implements CourseInfoProvider {
    public $depts = array(
        'EIB'  => "Economics and International Business",
        'ILO'  => "International Organizations",
        'DHP'  => "Diplomacy, History and Politics",
        'REL'  => "Religion"
    );

    public function __construct($termName, $campusName=null) {
        parent::__construct($termName, $campusName);
        $this->termSlug = '2013F';
    }

    public function hasData() {
        return $this->termName == "FALL 2012";
    }

    public function getAllDepts() {
        $result = curl_get("https://webcenter.studentservices.tufts.edu/courses/main.asp");
        preg_match_all("/value\s\=\s\'([A-Z]+)\s*\'\>(.*)\</", $result, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $abbr = trim($match[1]);
            $name = trim(preg_replace("/\(.*\)/", "", $match[2]));

            if (!isset($this->depts[$abbr])) {
                $this->depts[$abbr] = $name;
            }
        }

        $ret = array();
        foreach ($this->depts as $abbr => $name) {
            $ret[] = array(
                'Abbr' => $abbr,
                'Name' => $name
            );
        }

        return $ret;
    }

    public function getCourse($deptAbbr, $num) {
        if (strpos($num, '/') !== false) {
            $split = split('/', $num);
            $courseNum = $split[0];
        } else {
            $courseNum = $num;
        }

        for ($i=0; $i<3; $i++) {
            $courseString = $deptAbbr . str_repeat('%20', $i)
                             . str_pad($courseNum, 4, '0', STR_PAD_LEFT);

            $baseUrl = 'https://webcenter.studentservices.tufts.edu/coursedesc/?courseid=';
            $result = htmlspecialchars_decode(curl_get($baseUrl . $courseString));

            if (preg_match("/4\"\>\<B\>(.+?)\s{2,}/", $result, $matches)) {
                break;
            }
        }

        if ($matches) {
            return array(
                'Num' => $num,
                'Name' => formatCourseName(trim($matches[1]))
            );
        } else {
            return false;
        }

    }

    public function getSectionsByDept($deptAbbr) {
        $params = array(
            'term' => $this->termSlug,
            'dept' => str_pad($deptAbbr, 4, ' '),
            'crse_time' => 'Courses Offered Any Time',
            'submit' => 'Go'
        );

        $url = "https://webcenter.studentservices.tufts.edu/courses/subject_listing.asp";
        // http_build_query ensures the right encoding for the POST
        $result = curl_post($url, http_build_query($params));

        $regex = "/450\)\"\>([A-Z]+)\s*(\d{4})([A-Z0-9\-]+)\s*?<.+?\d\.\d.+?\'\>\<b\>(.*?)\&/";
        preg_match_all($regex, $result, $matches, PREG_SET_ORDER);

        $sections = array();
        foreach ($matches as $match) {
            $sections[] = array(
                'CourseNum' => trim($match[2]),
                'Num' => trim($match[3]),
                'Professor' => formatProfessor($match[4])
            );
        }

        return $sections;

    }
}

