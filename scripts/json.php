<?php

/**
 * json
 *
 * Regenerate schools.json
 */

$schools = SchoolQuery::create()
    ->filterByEnabled(1)
    ->orderBy('School.Name', 'asc')
    ->find();

$rows = array();
foreach ($schools as $school) {     
    $rows[] = array(
        'name'      => $school->getName(),
        'nickname'  => $school->getShortName(),
        'slug'      => $school->getSlug()
    );  
}

$json = json_encode($rows);
file_put_contents( BASE_DIR . '/config/schools.json', $json);
$gbCache->set('schooljson', $json);

