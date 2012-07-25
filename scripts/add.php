<?php

/**
 * add [BOOKSTORE]
 *
 * Add all the schools from the bookstore type BOOKSTORE.
 */

$bookstores = array('BnCollege', 'Follett', 'Neebo');

if (!isset($argv[1])) {
    $types = $bookstores;
} else if (in_array($argv[1], $bookstores)) {
    $types = array($argv[1]);
}

foreach ($types as $type) {
    $type::addSchools();
}
