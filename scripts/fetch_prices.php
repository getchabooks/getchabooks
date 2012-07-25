<?php

// this is only run directly from a shell, no 'gb'

/**
 * fetch_prices VENDOR ISBN1,ISBN2,...
 *
 * Fetch prices for isbns and (incidentally) store them in memcached.
 */

if (!isset($argv[2])) {
    exit;
}

$vendor = $argv[1];
$isbns = explode(',', $argv[2]);

define('BASE_URL', null);
require_once __DIR__ . '/../init.php';

$vendor::getPrices($isbns);
