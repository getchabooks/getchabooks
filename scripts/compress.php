<?php

/*
 * compress
 *
 * Compress and bundle CSS and JS assets
 */

$classes = array(
    'IndexController',
    'SelectionController',
    'ResultsController',
    'RedirectController',
    'StaticPageController',
    'ErrorController'
);

foreach ($classes as $class) {
    echo "Minifying assets for $class...\n";
    require_once BASE_DIR . "/controllers/$class.php";
    $obj = new $class;
    $obj->minifyJs();
    $obj->minifyCss();
}

echo "\nDone.\n\n";
