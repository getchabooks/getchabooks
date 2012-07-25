<?php

/**
 * sections SCHOOL [--force]
 *
 * Spider all the sections for SCHOOL.  If --force, spider even sections
 * that have been spidered recently.
 */

if (!isset($argv[1])) {
    echo "You must provide a school.";
    exit();
}

$s = SectionQuery::create()
    ->filterByRequiresBooks(1)
    ->orderBySpideredAt('ASC')
    ->filterBySchoolSlug($argv[1])
    ->withColumn('RAND()', 'rand')
    ->orderBy('rand')
    ->find();

$sections = array();
foreach ($s as $section) {
    if ($section->needsSpidering() || in_array('--force', $argv)) {
        if (!$section->getSpideredAt()) {
            //continue;
        }

        $sections[] = $section;
    }
}

if ($sections) {    

    $sectionsPerRequest = 5;

    $bookstore = $sections[0]->getBookstoreType();
    $bookstore = new $bookstore;

    $force = in_array('--force', $argv);

    for ($i=0; $i < count($sections);) {
        $rand = rand(4, $sectionsPerRequest);
        echo "Spidering: ";
        $sects = array_slice($sections, $i, $rand);
        foreach ($sects as $s) {
            echo $s->getSlug() . ', ';
        }
        echo "\n";
        $bookstore->spiderSections($sects, $force);

        $i += $rand;
    }

}
