<?php

require_once("../functions.php");

$departments = array(
    "AR"    => "Art History/Architecture/Essentials of Art",
    "AS"    => "Air Science",
    "BCB"   => "Bioinformatics and Computational Biology",
    "BB"    => "Biology",
    "CHE"   => "Chemical Engineering",
    "CH"    => "Chemistry",
    "CE"    => "Civil Engineering",
    "CS"    => "Computer Science",
    "ECE"   => "Electrical and Computer Engineering",
    "EN"    => "English",
    "GN"    => "German",
    "HI"    => "History",
    "HU"    => "Humanities & Arts",
    "MU"    => "Music",
    "PY"    => "Philosophy",
    "RE"    => "Religion",
    "WR"    => "Writing",
    "SP"    => "Spanish",
    "BUS"   => "Business",
    "CPE"   => "Corporate & Professional Education",
    "ECON"  => "Economics",
    "ENV"   => "Environmental Studies",
    "ES"    => "Engineering Science",
    "ETR"   => "Entrepreneurship",
    "EX"    => "Exchange Program",
    "FIN"   => "Finance",
    "FP"    => "Fire Protection Engineering",
    "FY"    => "First Year",
    "GE"    => "Geology",
    "GOV"   => "Political Science, Government and Law",
    "IMGD"  => "Interactive Media and Game Development",
    "ISE"   => "International Students (English)",
    "ID"    => "Interdisciplinary",
    "MFE"   => "Manufacturing Engineering",
    "MIS"   => "Management Information Systems",
    "MKT"   => "Marketing",
    "MTE"   => "Material Science & Engineering",
    "MA"    => "Mathematical Sciences",
    "ME"    => "Mechanical Engineering",    
    "MG"    => "Management Communication",
    "ML"    => "Military Leadership",
    "MME"   => "Mathematics for Educators",
    "OBC"   => "Organizational Behavior and Change",
    "OIE"   => "Operations and Industrial Engineering",
    "PE"    => "Physical Education",
    "PH"    => "Physics",
    "RBE"   => "Robotics Engineering",
    "SS"    => "Social Science",
    "PSY"   => "Psychology",
    "RH"    => "Rhetoric",
    "SD"    => "System Dynamics",
    "SOC"   => "Sociology",
    "STS"   => "Society & Technology Studies",
    "SP"    => "Spanish",
    "SYS"   => "Systems Engineering"
);

$school = SchoolQuery::create()->filterByBnSubdomain('wpi')->findOne();

// update departments

$url = "http://rewww.wpi.edu/academics/catalogs/ugrad/programdesc.html";
$url2 = "http://rewww.wpi.edu/academics/catalogs/grad/academ44.html";

$result = curl_get($url) . curl_get($url2);

preg_match_all("/title\=\"(.+?)\" href\=\".+\/(.+)(dept)?\.html\"/", $result, $matches, PREG_SET_ORDER);

foreach ($matches as $m) {
    $abbr = str_replace("dept", "", $m[2]);
    $dept = DeptQuery::create()->filterBySchool($school)
        ->filterByAbbr($abbr)
        ->findOne();
    if ($dept) {
        $dept->setName(trim($m[1]))->save();
    }   
}
foreach ($departments as $abbr => $name) {
    $dept = DeptQuery::create()->filterBySchool($school)
        ->filterByAbbr($abbr)
        ->findOne();
    if ($dept) {
        $dept->setName($name)->save();
    }
}


// update courses

$term = '201101';
$url = "https://banner-as1.admin.wpi.edu/pls/prod/hwwkrnbw.P_GetDepts?sel_term=$term&sel_ptrm=S&sel_level=01&sel_campus=x";

$result = curl_get($url) . curl_get(str_replace("level=01", "level=05", $url));

preg_match_all("/(\/pls.+dept\=([A-Z]+).+x)\"\>(.+?)\<\/A\>/", $result, $matches, PREG_SET_ORDER);

echo "<pre>";
print_r($matches);

foreach ($matches as $m) {
    $dept = DeptQuery::create()->filterBySchool($school)->filterByAbbr($m[2])->findOne();
    if ($dept) {
        $dept->setName($m[3])->save();
    }

    $url = "https://banner-as1.admin.wpi.edu" . $m[1];

    $result = curl_get($url);

    /*
    <TD><A HREF="http://www.wpi.edu/Pubs/Catalogs/Ugrad/Current/ascourses.html#as1001">AS 1001</A> A01</TD> 
<TD>FOUNDATIONS OF US AIR FORCE I</TD> 
<TD>    1/9</TD> 
<TD>Lec</TD> 
<TD>--W--</TD> 
<TD>2:00-2:50</TD> 
<TD>HL202</TD> 
<TD><A HREF="http://www.wpi.edu/Pubs/Faculty/brk.html">Kaanta, Bryan R.</A></TD>
* 
     */

    preg_match_all("/#.+?\"\>([A-Z]+)\s(\d+)\<\/A\>(.+?)\<\/TD\>\n\<TD\>(.+?)\<\/TD\>\n.+\n.+\n.+\n.+\n.+\n\<TD\>(.*)\<\/TD/", $result, $matches2, PREG_SET_ORDER);

    print_r($matches2);

    foreach ($matches2 as $n) {
        $section = SectionQuery::create()->filterBySchool($school)
            ->filterByNum($n[3])
            ->useCourseQuery()
            ->filterByNum($n[2])
            ->useDeptQuery()
            ->filterByAbbr($n[1])
            ->endUse()
            ->endUse()
            ->findOne();
        if ($section) {
            $section->setName(formatCourseName($n[4]));
            if (preg_match("/\>(.+),/", $n[5], $mat)) {
                $section->setProfessor($mat[1]);
            }
            $section->save();
        }
    }


}





//"<A HREF="/pls/prod/hwwkrnbw.P_DisplayDept?sel_term=201101&sel_ptrm=A&sel_dept=AS&sel_desc=Aerospace+Studies++(AFROTC)&sel_level=01&sel_campus=x">Aerospace Studies  (AFROTC)</A>

