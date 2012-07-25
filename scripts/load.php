<?php

/**
 * load
 *
 * Overwrite database school metadata with data in the XML files.
 */

echo "Schools removed from XML files will be set to disabled in the database.\n";

SchoolQuery::create()->update(array('Touched' => 0));

$xmlDir = BASE_DIR . '/config';

foreach (scandir($xmlDir) as $file) {
    if (!preg_match("/(.+)\.xml/", $file, $matches)) {
        continue;
    }

    $bookstoreType = $matches[1];
    $schools = simplexml_load_file("$xmlDir/$file");
    if (libxml_get_errors()) {
        echo "Errors in $abbr-schools.xml, skipping.\n";
        continue;
    }
    foreach ($schools->school as $school) {
        if ($obj = SchoolQuery::create()->filterBySlug($school->Slug)->findOne()) {
            if ($bookstoreType != $obj->getBookstoreType()) {
                echo "Tried to add a school for a slug that already exists, skipping: {$school->Slug}\n";
                continue;
            } else {
                $obj->setTouched(true)->save();
            }
        }
        $query = SchoolQuery::create()->filterByBookstoreType($bookstoreType);
        $obj = $query->filterBySlug($school->Slug)->findOne();
        if (!$obj) {
            $obj = new School();
            $obj->setSlug($school->Slug)->setBookstoreType($bookstoreType);
            echo "Adding new school: {$school->Slug}\n";
        }
        $obj->setName(html_entity_decode($school->Name))
            ->setShortName(html_entity_decode($school->ShortName))
            ->setSlug($school->Slug)
            ->setState($school->State)
            ->setZip($school->Zip)
            ->setLocalTax($school->LocalTax)
            ->setAmazonTag($school->AmazonTag ?: 'txtbks-20')       
            ->setSubdomain($school->Subdomain)
            ->setBId($school->BId)
            ->setTouched(1)
            ->setEnabled(1)
            ->save();
    }
}

$untouchedSchools = SchoolQuery::create()->filterByTouched(false)->find();

foreach ($untouchedSchools as $school) {
    if ($school->getEnabled()) {
        echo "Disabling " . $school->getSlug() . "\n";
        $school->setEnabled(0)->save();
    }
}

require_once( __DIR__ . '/json.php');
