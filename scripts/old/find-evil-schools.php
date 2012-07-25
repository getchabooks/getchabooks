<?php

/** OLD BUT NOT ANCIENT **/

/**
 * Find schools that don't post ISBNs on their bookstore's website.
 */

require_once(__DIR__ . "/../base/propel.php");
require_once("Spider.php");
require_once("curl.php");

function doMinimalTest($schools) {  
    $badSchools = $goodSchools = $unsureSchools = array();
    foreach ($schools as $school) { 
        $shis = SectionHasItemQuery::create()
            ->filterBySchool($school)
            ->joinWith('SectionHasItem.Item');

        $count = $shis->keepQuery()
            ->where('Item.Isbn != ?', '')
            ->where('Item.Isbn IS NOT NULL')
            ->count();      

        $slug = $school->getSlug();
        if ($count > 0) {
            echo "$slug: found a suitable item\n";
            $goodSchools[] = $school;
        } else if ($shis->keepQuery()->count() >= 10) {
            echo "$slug: didn't find a suitable item, adding to bad schools\n";
            $badSchools[] = $school;
        } else {
            $unsureSchools[] = $school;
        }
    }   

    return array($goodSchools, $badSchools, $unsureSchools);
}

// BEGIN MAIN SCRIPT
$debug = true;

// identify schools which already have at least one section spidered with a book with an isbn
$schools = SchoolQuery::create()->orderBy('School.Slug', 'asc')->find();

list($goodSchools, $badSchools, $unsureSchools) = doMinimalTest($schools);  

// randomly spider bad schools until we've found a section with an isbn or are pretty sure that the school doesn't list isbns
$newUnsureSchools = array();
foreach ($unsureSchools as $i => $school) { 
    if (in_array($school->getSlug(), array('columbia'))) {
        $badSchools[] = $school;
        continue;
    }

    if (in_array($school->getSlug(), array('jwu', 'ohiostate', 'puc', 'spu'))) {
        $badSchools[] = $school;
        continue;
    }
    deleteCookieFile();


    echo $school->getSlug();
    $sectionClass = str_replace('School', 'Section', get_class($school));
    $sectionSpiderer = new $sectionClass;

    $goodCount = 0;
    $itemsCount = 0;
    while (!$goodCount && $itemsCount <= 10) {  
        // we should already be spidered down to the department level for all schools
        $dept = DeptQuery::create()
            ->filterBySchool($school)
            ->where('Dept.SpideredAt < ?', time() - 60)
            ->orWhere('Dept.SpideredAt IS NULL')
            ->withColumn('RAND()', 'rand')
            ->orderBy('rand')
            ->findOne();

        if (!$dept) {
            echo "WTF\n";
            break;
        }
        echo $dept->getAbbr();
        Spiderer::spider($dept, true, 0);

        $course = CourseQuery::create()
            ->filterByDept($dept)
            ->where('Course.SpideredAt < ?', time() - 60)
            ->orWhere('Course.SpideredAt IS NULL')
            ->withColumn('RAND()', 'rand')
            ->orderBy('rand')
            ->findOne();

        if (!$course) {
            echo "WTF\n";
            break;
        }
        echo $course->getNum(); 
        Spiderer::spider($course, true, 0);

        $section = SectionQuery::create()
            ->filterByCourse($course)
            ->where('Section.SpideredAt < ?', time() - 60)
            ->orWhere('Section.SpideredAt IS NULL')
            ->withColumn('RAND()', 'rand')
            ->orderBy('rand')
            ->findOne();    

        if (!$section) {
            echo "WTF\n";
            break;
        }
        echo $section->getNum();
        $sectionSpiderer->spider(array($section), 0);


        $shis = SectionHasItemQuery::create()
            ->filterBySection($section)
            ->joinWith('SectionHasItem.Item');

        $goodCount = $shis->keepQuery()
            ->where('Item.Isbn IS NOT NULL')
            ->where('Item.Isbn != ?', '')
            ->count();

        $itemsCount = $shis->count();       
    }

    if ($goodCount) {
        echo $school->getSlug() . ": found a suitable item\n";
        $goodSchools[] = $school;   
    } else if ($itemsCount) {
        echo $school->getSlug() . ": didn't find a suitable item, adding to bad schools\n";
        $badSchools[] = $school;    
    } else {
        $newUnsureSchools[] = $school;
    }


}

echo "\nFinal report:\n";

echo "\nGood schools: \n";
$slugs = array_map(function ($s) { return $s->getSlug(); }, $goodSchools);
natsort($slugs);
echo implode(", ", $slugs);

echo "\nUnsure schools (should be none): \n"; 
$slugs = array_map(function ($s) { return $s->getSlug(); }, $newUnsureSchools);
natsort($slugs);
echo implode(", ", $slugs);

echo "\nBad schools: \n";
$slugs = array_map(function ($s) { return $s->getSlug(); }, $badSchools);
natsort($slugs);
echo implode(", ", $slugs);

echo "\n";
