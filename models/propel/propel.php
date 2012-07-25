<?php

if (!defined('GB_DATABASE')) {
    throw new Exception("GB_DATABASE constant must be defined, but it isn't.");
}

spl_autoload_register(function ($name) {
    if ($name == 'Spiderable') {
        include __DIR__ .'/Spiderable.php';
    }
});

// Include the main Propel script
require_once('propel/Propel.php');

// Initialize Propel with the runtime configuration
Propel::init( __DIR__ . "/conf/-conf.php");

// Add the generated 'classes' directory to the include path
set_include_path( __DIR__ . "/classes" . PATH_SEPARATOR . get_include_path());


