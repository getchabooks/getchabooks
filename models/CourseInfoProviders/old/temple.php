<?php

require_once(__DIR__ . '/../functions.php');

$term = '1103';

$school = SchoolQuery::create()->filterBySlug('temple')->findOne();
$school->setDeptsToIgnore("CANCL TEXT")->save();

// temporarily, let's reset all the courses and sections' names and professors

//CourseQuery::create()->filterBySchool($school)->update(array('Name' => null));
//SectionQuery::create()->filterBySchool($school)->update(array('Professor' => null));

/**
 * key is the department abbreviation as it appears on bncollege.  Value is the name as it appears 
 * on the temple course catalog.  Value can be an array if the second value should be substituted
 * for the first value in our database.  But, 'And' => 'and' and 'Of' => 'of' happen automatically.
 */
$deptNames = array(
    'ACCT'      => 'Accounting',
    'ACT SCI'   => 'Actuarial Science',
    'ADVERTISIN'=> 'Advertising',
    'AFR-AMER S'=> 'African American Studies',
    'AMER ST'   => 'American Studies',
    'ANTHRO'    => 'Anthropology',
    'AOD'       => 'Adult And Organizational Development',
    'ARABIC'    => 'Arabic',
    'ARCH'      => 'Architecture',
    'ART'       => 'Art',
    'ART ED'    => 'Art Education',
    'ART H'     => 'Art History',
    'ASIA ST'   => 'Asian Studies',
    'BIOLOGY'   => 'Biology',
    'BTMM'      => 'Broadcast Telecom Mass Media',
    'BUS'       => 'Business',
    'BUS ADM'   => 'Business Administration',
    'C+IN SC'   => 'Computer + Information Science',
    'C+R PLN'   => 'Community & Regional Planning',
    'CCET'      => 'Civil + Construction Eng Tech',
    'CHEM'      => 'Chemistry',
    'CHINESE'   => 'Chinese',
    'CIVIL ENG' => 'Civil Engineering',
    'CN PSY'    => 'Counseling Psychology',
    'COMM SCI'  => 'Comm Sciences + Disorders',
    'COMM+TH'   => 'Communications And Theater',
    'CR LANG'   => 'Critical Languages Center',
    'CRIM JUSTI'=> 'Criminal Justice',
    'DANCE'     => 'Dance',
    'DISABILITY'=> 'Disability Studies',
    'EARTH/ENVI'=> 'Earth & Environmental Science',
    'ECH ED'    => 'Early Childhood Education',
    'ECON'      => 'Economics',
    'ED ADM'    => 'Educational Administration',
    'ED PSY'    => 'Educational Psychology',
    'EDUCATION' => 'Education',
    'ELECTR ENG'=> 'Electrical Engineering',
    'ELEM ED'   => 'Elementary Education',
    'EN ED-E'   => 'English Education, Elementary',
    'EN ED-S'   => 'English Education, Sec Ed',
    'ENGLISH'   => 'English',
    'ENGRG'     => 'Engineering',
    'ENVIRO STD'=> 'Environmental Studies',     // ???????
    'ENVT'      => '',      // ??????
    'ET'        => 'Engineering Technology',
    'FINANCE'   => 'Finance',
    'FL ED-S'   => 'Foreign Lang Ed, Secondary Ed',
    'FMA'       => 'Film And Media Arts',
    'FOUNDATION'=> 'Foundations',
    'FRENCH'    => 'French',
    'GEN/STRA M'=> '',          // ??????
    'GEOG'      => 'Geography And Urban Studies',
    'GERMAN'    => 'German',
    'GK+ROM CL' => 'Greek And Roman Classics',      
    'GREEK'     => 'Greek', //??????????                    // started here
    'GREEK,ANC' => 'Greek Ancient',
    'GREEK,MODE'=> 'Greek, Modern',
    'HEBREW'    => 'Hebrew',
    'HINDI'     => 'Hindi',
    'HISTORY'   => 'History',
    'HLTH INF M'=> 'Health Information Management',
    'HLTH RL PR'=> 'Health Related Professions',
    'HLTHCARE M'=> 'Healthcare Management',
    'HORT'      => 'Horticulture',
    'HUM RES MG'=> 'Human Resource Management',
    'IBA'       => 'International Business Admin',
    'IELP'      => '', //????
    'IH'        => 'Intellectual Heritage',
    'ITALIAN'   => 'Italian',
    'JAPANESE'  => 'Japanese',
    'JEWISH ST' => 'Jewish Studies',
    'JOURNALISM'=> 'Journalism',
    'KINESIOLOG'=> 'Kinesiology',
    'KOREAN'    => 'Korean',
    'LANDSC'    => 'Landscape Architecture',
    'LATIN'     => 'Latin',
    'LATIN AM S'=> 'Latin American Studies',
    'LAW SBM'   => 'Law S.B.M.',
    'LESBIAN GB'=> 'Lesbian Gay Bi & Tg St',
    'LIB ARTS'  => 'Liberal Arts',
    'M ED-E'    => 'Math Education, Elementary Ed',
    'M ED-S'    => 'Math Education, Secondary Ed',
    'M L A'     => 'Master Of Liberal Arts',
    'MASSMEDIAC'=> 'Mass Media And Communication',
    'MATH'      => 'Mathematics',
    'MECH ENG'  => 'Mechanical Engineering',
    'MESSIAH'   => '', //????
    'MET'       => 'Mechanical Engineering Technol',
    'MGT INFO S'=> 'Management Information Systems',
    'MIL SCI'   => 'Military Science',
    'MKTG'      => 'Marketing',
    'MSOM'      => 'Management Science/Oper Mgt',
    'MUS ED'    => 'Music Education',
    'MUS ST'    => 'Music Studies',
    'MUSIC'     => 'Music',
    'NEUROSCI C'=> 'Neuroscience - Cla',
    'NURSING'   => 'Nursing',
    'OC THER'   => 'Occupational Therapy',
    'PHETE'     => 'Phete',
    'PHILOS'    => 'Philosophy',
    'PHYSICS'   => 'Physics',
    'POL SCI'   => 'Political Science',
    'PSYCH'     => 'Psychology',
    'PUBLIC HLT'=> 'Public Health',
    'REL'       => 'Religion',
    'RL EST'    => 'Real Estate',
    'RSK MGT +' => 'Risk Management And Insurance',
    'RUSSIAN'   => 'Russian',
    'SC ED-E'   => 'Science Education, Elementary',
    'SC ED-S'   => 'Science Education, Secondary E',
    'SCH PSY'   => 'School Psychology',
    'SEC ED'    => 'Secondary Education',
    'SOC'       => 'Sociology',
    'SOC WRK GR'=> 'Social Work Graduate',
    'SOCWRK UND'=> 'Social Work Undergrad',
    'SPANISH'   => 'Spanish',
    'SPEC ED'   => 'Special Education',
    'SPEC ORD'  => '', //????
    'SS ED-E'   => 'Social Studies Education, Elem',
    'SS ED-S'   => 'Social Studies Ed, Sec Ed',
    'STAT'      => 'Statistics',
    'STRAT COMM'=> 'Strategic Communications',
    'STRATGIC M'=> 'Strategic Management',
    'TESOL'     => 'Teach Engl Speakr Of Othr Lang',
    'THEATER'   => 'Theater',
    'THERAP REC'=> 'Therapeutic Recreation',
    'TOUR HOS M'=> 'Tourism & Hospitality Mgmt',
    'UNIV SEMI' => 'Univ Seminar',
    'URB ED'    => 'Urban Education',
    'VIETNAMESE'=> 'Vietnamese',
    'WOM STD'   => 'Womens Studies'
);

function getDeptName($abbr, $fixed = false) {
    global $deptNames;

    if ($deptNames[$abbr]) {
        if (is_array($deptNames[$abbr])) {
            return $fixed && isset($deptNames[$abbr][1]) ? $deptNames[$abbr][1] : str_pad($deptNames[$abbr][0], 31);
        } else {
            return str_pad($deptNames[$abbr], 31);
        }
    } else {
        return false;
    }

}

// update departments

$depts = DeptQuery::create()->filterBySchool($school)->find();
foreach ($depts as $dept) {
    $abbr = $dept->getAbbr();
    if ($name = getDeptName($dept->getAbbr(), true)) {
        $dept->setName(trim($name))->save();
    }
}

// update courses

// sets term cookie
curl_post("http://voyager.adminsvc.temple.edu/tucourses/tu_courses.asp", 
    http_build_query(array('radSemester' => '1103', 'radCrseType' => 'All')));

foreach ($depts as $dept) {
    if ($name = getDeptName($dept->getAbbr())) {

        $params = http_build_query(array(
            'lstCrsLevel'   => 'All',
            'radCampus'     => 'All',
            'lstDept'       => $name,
            'lstCredHrs'    => 'All',
            'radDivn'       => 'All',
            'radStatus'     => 'All',
            'lstReq'        => 'All',
        )) . "&Day1=&Day2=&Day3=&Day4=&Day5=&Day6=&Day7=&PrevCourse1B=&PrevTextCourse1B=&PrevCourse2B="
        . "&PrevTextCourse2B=&PrevCourse3B=&PrevTextCourse3B=&PrevCourse4B=&PrevTextCourse4B="
        . "&PrevCourse5B=&PrevTextCourse5B=&PrevCourse4B=&PrevTextCourse4B=&PrevCourse5B=&"
        . "PrevTextCourse5B=&browser=&host=";

        $result = curl_post("http://voyager.adminsvc.temple.edu/tucourses/tu_courseslist.asp", 
            $params,
            array(CURLOPT_HTTPHEADER => array("Origin: http://voyager.adminsvc.temple.edu")));

        //var_dump($result);
        //die();
        preg_match_all("/header\"\>(.+?)\</", $result, $matches);
        $matches = $matches[1];
        print_r($matches);

        for ($i=0; $i<count($matches); $i += 11) {
            $num = substr($matches[$i], strpos($matches[$i], '0'), 6);
            $section = curl_get("http://voyager.adminsvc.temple.edu/tucourses/tu_coursesdescrip.asp?name=$num&Clear=Yes");
            if (preg_match("/Instructor.+?descripNobold\"\>([^<]+?),([^<]+?)\</s", $section, $m)) {
                $prof = trim(preg_replace("/\s+/", ' ', $m[2] . $m[1]));
            } else {
                $prof = null;
            }

            $cnum = ltrim($matches[$i+1], '0');
            $snum = $matches[$i+3];
            $cname = formatCourseName($matches[$i+4]);

            $course = CourseQuery::create()
                ->filterByDept($dept)
                ->filterByNum($cnum)
                ->findOne();
            if ($course) {
                echo "setting $cname\n";
                $course->setName($cname)->save();

                if ($prof) {
                    $section = SectionQuery::create()
                        ->filterByCourse($course)
                        ->filterByNum($snum)
                        ->findOne();
                    if ($section) {
                        echo $prof."\n";
                        $section->setProfessor($prof)->save();
                    }
                }
            }
        }
    }
}





