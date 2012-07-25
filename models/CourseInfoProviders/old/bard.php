<?php

require_once(__DIR__ . '/../functions.php');


$courses = array(
    /* 'SCI123' => 'Paints and Examination of Paintings',*/
    'FYSFSEM' => 'First-Year Seminar II',
    'FYSADD ON' => 'First-Year Seminar II (Additional Reading)'
);

function updateCoursesAndSectionsNew() {    
    global $courses;
    
    
    //need the dot instead of a more specific dash because there's a unicode dash occasionally
    $time = "/\s*\d{1,2}\:\d{1,2}\s*.?\s*\d{1,2}\:\d{1,2}\s*[paPA][mM]\s*/";
    //echo preg_match($time, "10:10 – 11:30 am");
    
    $base = "http://inside.bard.edu/academic/courses/current/";
    $pages = array("anthropology", "lit2courses","music",  "physics", "barc", "arthistory", "dance", "film", "photography", "studioart", "theater", "sequence", "writers",  "lit3courses", "arabic", "chinese", "classic", "greek", "latin", "sanskrit", "french", "german", "hebrew", "italian", "japanese",                "russian", "spanish", "biology", "chemistry", "computer", "mathematics", "hpsscience", "economics", "bgia", "history", "philosophy", "politicalstudies", "psychology", "religion", "socialstudies", "sociology", "amstudies", "asian_studies", "classic", "fstudies", "gstudies", "hrp", "istudies", "restudies", "sts", "sstudies", "africana", "cogsci", "envstudies", "gss", "gis", "hrp", "ics", "js", "lais", "meds", "middleeast.htm", "spolicy", "socialstudies", "sre", "theology", "vs");
    
    foreach ($pages as $p) {
        $result = file_get_contents($base.$p.(preg_match("/\.htm/", $p) ? "": ".html"));
        
        $dom = new DOMDocument();
        @$dom->loadHTML($result);
        $xpath = new DOMXPath($dom);
        $trs = $xpath->query('//tr');

        foreach ($trs as $tr) {
            var_dump($tr);
            $professor = (string)current($xpath->query('/td[2]/p/b[0]', $tr));
            echo $professor;

            $course = (string)current($xpath->query('/td[1]/p[0]/b/span', $tr));
            $courseParts = explode(" ", $course);
            $name = (string)current($xpath->query('/td[1]/p[0]/b/span/span[1]', $tr));
            $name .= (string)current($xpath->query('/td[1]/p[1]/b/span', $tr));

            $course = CourseQuery::create()
                ->filterByNum($courseParts[1])
                ->useDeptQuery()
                    ->filterByAbbr($courseParts[0])
                    ->useTermQuery()
                        ->useCampusQuery()
                            ->useSchoolQuery()
                                ->filterBySlug('bard')
                            ->endUse()
                        ->endUse()
                    ->endUse()
                ->endUse()
                ->findOne();

            if ($course) {
                $course->setName($name)->save();

                $sections = SectionQuery::create()
                    ->filterByCourseId($course->getId());

                if ($professor && $sections->keepQuery()->count() > 1) {
                    foreach ($sections->find() as $s) {
                        $s->reload()->setProfessor($professor)->save();
                    }
                }    
            }
                   
        }

        return;
        //////

        $rows = explode("<tr", $result);
        unset($rows[0]);
        
        foreach ($rows as $r) {
            preg_match_all("/\>\s*([^\>\<]*[A-Za-z]+[^\>\<]*)\s*\</", $r, $matches, PREG_SET_ORDER);
            foreach ($matches as &$m) {
                $m = $m[1];
            }
            reset($matches);
            
            preg_match("/\s([A-Z]+)\s*(\d+)/", " ".$matches[0], $details);
            $deptAbbr = $details[1];
            $courseNum = $details[2];
            
            $hasSection = preg_match("/^[A-Z]+$/", $matches[1], $sectionMatches);
            $sectionNum = $hasSection? $sectionMatches[0] : "1";
            $timeIndex = false;
            $timeCount = 0;
            foreach ($matches as $i => $m) {
                if (preg_match($time, $m)) {
                    //echo "<b>$m</b>";
                    if (!$timeIndex) $timeIndex = $i;
                    $timeCount++;
                } else if (preg_match("/Lab\s[A-Z]|\(Lecture|Burton\sBrody/", $m)) {
                    echo "aa";
                    $timeCount++;
                }
            }
            echo $timeIndex;
            echo $timeCount;
            $professor = $matches[2+(int)$hasSection]/*$timeIndex-2 - ($timeCount-1)]*/;
            $courseName = $hasSection? $matches[2] : $matches[1];
            if ($timeIndex > 4+(int)$hasSection+($timeCount-1)) {
                $courseName .= " ".$matches[2+(int)$hasSection];
            } 
            $courseName = trim(preg_replace("/\s+/", " ", $courseName));
            $professor = preg_replace("/\s+/", " ", $professor);
            if ($professor)
                $courseName = str_replace(trim($professor), "", $courseName);
                
            $courseName = trim(preg_replace("/:\s*$/", "", $courseName));
            
            $course = CourseQuery::create()
                ->filterByNum($courseNum)
                ->useDeptQuery()
                    ->filterByAbbr($deptAbbr)
                    ->useTermQuery()
                        ->useCampusQuery()
                            ->useSchoolQuery()
                                ->filterBySlug('bard')
                            ->endUse()
                        ->endUse()
                    ->endUse()
                ->endUse()
                ->findOne();
            if ($course) {
                $course->setName($courseName)->save();
                $section = SectionQuery::create()
                        ->filterByCourse($course)
                        ->findOne();
                    
                if ($section && $professor) {                   
                    $section->setProfessor($professor)->save();
                }
                
                $sections = SectionQuery::create()
                    ->filterByCourse($course)
                    ->find();
                foreach ($sections as $section) {
                    $section->setName($section->makeName())->save();
                }
            }
            
            
            

            
            
        }
        //die();
    }
    
    foreach ($courses as $key => $name) {
        preg_match("/([^\d]+)(.+)/", $key, $matches);
        print_r($matches);
        if ($key == 'FYSFSEM') {
            $matches[1] = 'FYS';
            $matches[2] = 'FSEM';
        }
        if ($key == 'FYSADD ON') {
            $matches[1] = 'FYS';
            $matches[2] = 'ADD ON';
        }
        $course = CourseQuery::create()
                ->filterByNum($matches[2])
                ->useDeptQuery()
                    ->filterByAbbr($matches[1])
                    ->useTermQuery()
                        ->useCampusQuery()
                            ->useSchoolQuery()
                                ->filterBySlug('bard')
                            ->endUse()
                        ->endUse()
                    ->endUse()
                ->endUse()
                ->findOne();
        if ($course) {
            $course->setName($name)->save();
        }
    }   
}

function updateDepartments() {
    global $school;
    
    //depts
    $depts = array('AFR' => "Africana Studies",
                    'ANTH' => "Anthropology",
                   'ARAB' => "Arabic",
                   'ARC' => "Academic Resource Center",
                   'ART' => "Studio Art",
                   'ARTH' => "Art History",
                   'AS' =>  "American Studies",
                   'BIO' => "Biology",
                   'BPI' => "Bard Prison Initiative",
                   'CHEM' => "Chemistry",
                   'CHI' => "Chinese",
                   'CLAS' => "Classical Studies",
                   'CMSC' => "Computer Science",
                   'DAN'    => "Dance",
                   'ECON' => "Economics",
                   'EUS' => "Environmental and Urban Studies",
                   'FILM' => "Film and Electronic Arts",
                   'FIN' => "Finance",
                   'FREN' => "French",
                   'FYS' => "First-Year Seminar",
                   'GER' => "German",
                   'GRE' => "Greek",
                   'HEB'    => "Hebrew",
                   'HIST' => "Historical Studies",
                   'HR' => "Human Rights",
                   'ITAL' => "Italian",
                   'JAPN'   => "Japanese",
                   'JS' => "Jewish Studies",
                   'LAIS' => "Latin American and Iberian Studies",
                   'LAT' => "Latin",
                   'LIT' => "Literature",
                   'MATH' => "Mathematics",
                   'MUS' => "Music",
                   'PHIL' => "Philosophy",
                   'PHOT' => "Photography",
                   'PHYS' => "Physics",
                   'PS' => "Political Studies",
                   'PSY' => "Psychology",
                   'REL' => "Religion",
                   'RUS' => "Russian",
                   'SCI' => "Science",
                   'SOC' => "Sociology",
                   'SPAN' => "Spanish",
                   'SST' => "Social Studies",
                   'THEO' => "Theology",
                   'THTR' => "Theater");
    
    foreach ($depts as $abbr => $name) {
        $dept = DeptQuery::create()
            ->filterByAbbr($abbr)
            ->useTermQuery()
                ->useCampusQuery()
                    ->useSchoolQuery()
                        ->filterBySlug('bard')
                    ->endUse()
                ->endUse()
            ->endUse()
            ->findOne();
            
        if ($dept) {
            $dept->setName($name)->save();
        }
    }
}

//updateDepartments();
updateCoursesAndSectionsNew();
           
               
               
               
               
               
               
               
               
               
               
               
