<?php

/**
 * dump [--reset]
 *
 * Dump the current state of the schools table to XML.
 */

$reset = in_array('--reset', $argv);
$xmlDir = BASE_DIR . '/config';
$attributes = array(
    'Name',
    'ShortName',
    'Slug',
    'State',
    'Zip',
    'LocalTax',
    'AmazonTag',
    'Subdomain',
    'BId',
);

$xmls = array();

$schools = SchoolQuery::create()
    ->orderBy('Slug')
    ->find();

foreach ($schools as $school) {
    $bookstore = $school->getBookstoreType();

    $xml = ""; 
    if (!$school->getEnabled()) {
        $xml .= "<!--";
    }
    $xml .= "\t<school>\n";
    foreach ($attributes as $a) {
        if ($a == 'AmazonTag' && $school->getAmazonTag() == 'txtbks-20') {
            continue;
        }

        $xml .= "\t\t<$a>" . htmlentities(call_user_func(array($school, "get$a"))) . "</$a>\n";
    }
    $xml .= "\t</school>\n";
    if (!$school->getEnabled()) {
        $xml .= "-->";
    }

    if (!isset($xmls[$bookstore])) {
        $xmls[$bookstore] = "<schools>\n";
    }

    $xmls[$bookstore] .= $xml;
}

foreach ($xmls as $bookstore => &$xml) {
    $xml .= "</schools>";  
    file_put_contents("$xmlDir/$bookstore.xml", $xml);
}
