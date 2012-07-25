<?php

require_once(__DIR__ . "/../functions.php");

$departments = array(
    "ACC" => "Accounting",
    "AHF" => "Arts & Humanities Foundation",
    "AMS" => "American Studies",
    "ART" => "Art",
    "ASM" => "Advanced Strategic Management",
    "BPR" => "Business Practicum Program",
    "BRC" => "BRIC",
    "CGE" => "Cross-Registration Courses",
    "CHN" => "Chinese",
    "COM" => "Communications",
    "CVA" => "Culture and Values",
    "CXD" => "Offshore Course",
    "ECN" => "Economics",
    "ENG" => "English",
    "EPS" => "Entrepreneurship",
    "EXC" => "Babson Study Abroad",
    "FIN" => "Finance",
    "FLM" => "Film",
    "FME" => "Foundation of Management & Entrepreneurship (FME)",
    "FRN" => "French",
    "FYS" => "First-Year Seminar",
    "GDR" => "Gender Studies",
    "HIS" => "History",
    "HSF" => "History & Society Foundation",
    "HSS" => "History & Society",
    "IMH" => "Honors Seminar",
    "IND" => "Independent Research",
    "JPN" => "Japanese",
    "LAW" => "Law",
    "LIB" => "Liberal Arts",
    "LIT" => "Literature",
    "LVA" => "Literature & Visual Arts",
    "MBA" => "MBA",
    "MCE" => "Managing in a Competitive Environment (MCE)",
    "MDS" => "Media Studies",
    "MFE" => "Management Consulting Field Experience (MCFE)",
    "MIS" => "Management Information Systems",
    "MKT" => "Marketing",
    "MOB" => "Management",
    "OEM" => "Organizing for Effective Management (OEM)",
    "OLIN" => "Olin College of Engineering Cross Registration",
    "OPS" => "Operations",
    "PHL" => "Philosophy",
    "PHO" => "Photography",
    "POL" => "Politics",
    "PRF" => "Performing Arts",
    "PSA" => "Petition Study Abroad",
    "PSY" => "Psychology",
    "QTM" => "Quantitative Methods",
    "RHT" => "Rhetoric",
    "SCN" => "Science",
    "SPN" => "Spanish",
    "TAX" => "Taxes",
    "VSA" => "Visual Arts",
    "WRT" => "Writing"
);

$school = SchoolQuery::create()->findOneBySlug('babson');

// update departments
$depts = DeptQuery::create()->filterBySchool($school)->find();
foreach ($depts as $d) {
    if (isset($departments[$d->getAbbr()])) {
        $d->setName($departments[$d->getAbbr()])->save();
    }       
}

// update courses
$term = "Spring+2011";
$url1 = "http://fusionmx.babson.edu/CourseListing/index.cfm?fuseaction=CourseListing.DisplayCourseListing&blnShowHeader=false&program=Graduate&semester=$term&sort_by=course_number&btnSubmit=Display+Courses";
$url2 = "http://fusionmx.babson.edu/CourseListing/index.cfm?fuseaction=CourseListing.DisplayCourseListing&blnShowHeader=false&program=Undergraduate&semester=$term&sort_by=course_number&btnSubmit=Display+Courses";
$result =  curl_get($url2) . curl_get($url1);

preg_match_all("/85\"\>([A-Z]+)(\d+)\-([A-Z\d]+)\<\/td\>.+?400\);\"\>(.+?)\<\/a.+?nowrap\"\>(.+?),.+?\<\/span/s", $result, $matches, PREG_SET_ORDER);

foreach ($matches as $m) {
    unset($m[0]);
    print_r($m);
    $dept = DeptQuery::create()->filterBySchool($school)->filterByAbbr($m[1])->findOne();
    if (!$dept) continue;

    $course = CourseQuery::create()->filterByDept($dept)->filterByNum(ltrim($m[2], '0'))->findOne();
    if (!$course) continue;
    $name = preg_replace("/\(.+\)$/", "", $m[4]);
    $course->setName(formatCourseName($name))->save();

    $section = SectionQuery::create()->filterByCourse($course)->filterByNum($m[3])->findOne();
    if (!$section) continue;

    $section->setProfessor(trim($m[5]))->save();
}
