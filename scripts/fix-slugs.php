<?php

/**
 * fix-slugs [SCHOOL=all]
 *
 * Regenerate section slugs and full names.
 */

$sections = SectionQuery::create();

if (isset($argv[1]) && $argv[1] != 'all') {
    $sections->filterBySchoolSlug($argv[1]);
}

foreach ($sections->find() as $s) {
    $s->save();
}
