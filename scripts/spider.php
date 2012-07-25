<?php

/**
 * spider [SCHOOL] [DEPTH=4] [--disabled]
 *
 * Depths: 4 = section-aware, 3 = course-aware, etc.
 *
 * If SCHOOL is not provided, all schools will be spidered, down to
 * a depth of 2 (department-aware).
 *
 * If SCHOOL is the exact name of a bookstore type, then the department-aware 
 * spidering will be limited to schools of that bookstore type.
 *
 * If --disabled, even disabled schools will be spidered.
 */

$bookstore = @file_exists(BASE_DIR . "/models/Vendors/Bookstores/{$argv[1]}.php");

if (isset($argv[1]) && !$bookstore) {
    $school = SchoolQuery::create()
        ->filterBySlug($argv[1])
        ->findOne();

    if ($school) {
        $school->spider(4);
        $school->setTouched(1)->setEnabled(1)->save();
        $school->updateCourseInfo();
    } else {
        echo "Unknown school: {$argv[1]}\n";
    }
} else {
    $schools = SchoolQuery::create();

    if ($bookstore) {
        $schools->filterByBookstoreType($argv[1]);
    }

    if (!in_array('--disabled', $argv)) {
        $schools->filterByEnabled(1);
    }

    foreach ($schools->find() as $school) {
        $school->setTouched(0)->save();
        $school->spider(2);
        $school->setTouched(1)->save();
    }
}

