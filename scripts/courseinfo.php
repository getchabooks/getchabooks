<?php

/**
 * courseinfo SCHOOL
 *
 * CourseInfo updating happens automatically when a school is done fully 
 * spidering, but sometimes you might want to do it on its own.
 */
if (!isset($argv[1])) {
    die("No school provided.\n");
}

$school = SchoolQuery::create()
    ->filterBySlug($argv[1])
    ->findOne();

$school->updateCourseInfo();
