<?php

require_once(__DIR__ . "/../functions.php");

$term = "spring2011";

$departmentFixes = array("Political Science (formerly GOVT)" => "Political Science");

$school = SchoolQuery::create()->filterBySlug('clarku')->findOne();

// update departments
$result = file_get_contents("http://www.clarku.edu/offices/src/courses/courselist$term.cfm");
preg_match_all("/anchor\"\>([A-Z]+)\s-\s(.+)\<\/a/", $result, $matches, PREG_SET_ORDER);    
foreach ($matches as $m) {
    $dept = DeptQuery::create()
        ->filterBySchool($school)
        ->filterByAbbr(trim($m[1]))
        ->findOne();
        
    if ($dept) {
        $m[2] = trim($m[2]);
        $name = in_array($m[2], array_keys($departmentFixes)) ? $departmentFixes[$m[2]] : $m[2];
        $dept->setName($name)->save();
    }
}

// update courses
$courses = CourseQuery::create()->filterBySchool($school)->find();
foreach ($courses as $c) {
    $courseString = $c->getDept()->getAbbr() . $c->getNum();
    $url = "http://www.clarku.edu/academiccatalog/courseQ.cfm?num=$courseString&lookup=1&refcode=" 
            . str_pad($c->getNum(), 3, '0', STR_PAD_LEFT);  
            
    if (preg_match("/$courseString.*?\s-\s(.+)\<\/h1/s", curl_get($url), $matches)) {
        $name = preg_replace("/\/[^\/]+$/", '', $matches[1]);
        $name = preg_replace("/Lecture|Discussion/", "", $name);
        
        $c->setName(trim($name))->save();
    }
}

// update sections
$depts = DeptQuery::create()->filterBySchool($school)->find();
foreach ($depts as $d) {
    $result = curl_get("http://www.clarku.edu/offices/src/courses/courselist$term.cfm?listsubject=" . $d->getAbbr());
    
    $regex = "/\<td\>.+?\<\/td\>.+?\<td\>.+?\<\/td\>.+?\<td\>(.+?)\<\/td\>.+?\<td\>.+?coursenum\=(.+?)&refcode=(.+?)\"\>.*?\<td\>.*?\<td\>[\d\s.]*?\<\/td\>.*?\<td\>.*?\<td\>.*?\<td\>(.+?)\<\/td\>.+?\<td\>.+?\<\/td\>.+?\<td\>.+?\<td\>.+?\<\/tr\>/s";
    preg_match_all($regex, $result, $matches, PREG_SET_ORDER);
    unset($matches[0]);
    foreach ($matches as $m) {
        $prof = trim($m[4]);
        $dept = trim($m[3]);
        $cnum = trim(substr($m[2], strpos($dept, $m[2]) + strlen($dept)));
        $snum = trim($m[1]);
        
        if (preg_match("/\<a name\=\".+\"\>(.+)\<\/a\>/", $snum, $foo)) {
            $snum = $foo[1];
        }       
        
        $section = SectionQuery::create()
            ->filterByNum($snum)
            ->useCourseQuery()
                ->filterByNum($cnum)
                ->useDeptQuery()
                    ->filterBySchool($school)
                    ->filterByAbbr($dept)
                ->endUse()
            ->endUse()
            ->findOne();
        
        if ($section && $prof != "Staff") {
            $section->setProfessor($prof)->save();
        }
    }
}
