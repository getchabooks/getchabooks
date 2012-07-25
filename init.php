<?php

/**
 * Single point of entry for both web and command-line.
 */

// base directory for includes
define('BASE_DIR', __DIR__);

// load config settings
require_once BASE_DIR . '/config/config.php';

// load utility functions
require_once BASE_DIR . '/utility.php';

// initialize session for referrer tags, cookie file, etc.
session_cache_limiter(false);
session_start();

// set flags
$flags = array(
    // determines prod/dev for assets, DB, cache prefix, application behavior
    'production',

    // use the production DB but development everything else
    'fakeprod',

    // display a temporary emergency message on index and redirect selection and results
    'emergency',
    
    // display a less temporary message about using ISBN mode if we can't get data
    'isbn'
);
foreach ($flags as $flag) {
    if (file_exists(BASE_DIR . "/$flag")) {
        define(strtoupper($flag), 1);
    }
}

// set whether to display errors on the page
if (defined('PRODUCTION')) {
    ini_set('display_errors', '0');
} else {
    ini_set('display_errors', '1');
}

// set logfile for PHP errors (Slim has its own log file)
ini_set('error_log', BASE_DIR . '/error_log');

// initialize DB
if (defined('PRODUCTION') || defined('FAKEPROD')) {
    define('GB_DATABASE', 'gbprod');
} else {
    define('GB_DATABASE', 'gbdev');
}
require_once BASE_DIR . '/models/propel/propel.php';

// initialize prefixed memcache wrapper
require_once BASE_DIR . '/vendor/php-memcached-wrapper/MemcachedWrapper.php';
$gbCache = new MemcachedWrapper(GB_DATABASE);
$gbCache->addServer('localhost', 11211);

// initialize mailer
require_once BASE_DIR . '/vendor/phpmailer/class.phpmailer.php';
$gbMailer = new PHPMailer(true);
$gbMailer->IsSMTP($mailerIsSmtp);
$gbMailer->Host = $mailerHost;
$gbMailer->SMTPAuth = $mailerSmtpAuth;
$gbMailer->Username = $mailerUsername;
$gbMailer->Password = $mailerPassword;
$gbMailer->From = $mailerFrom;


spl_autoload_register(function ($name) {
    if (strpos($name, 'Controller') !== false) {
        include BASE_DIR . "/controllers/$name.php";
        return;
    }

    switch ($name) {
    // external
    case 'Isbn':
        include BASE_DIR . '/vendor/php-isbn/Isbn.php';
        break;

    // models
    case 'BestDealPeriod':
    case 'Combo':
    case 'Price':
    case 'PriceSet';
    case 'Results':
        include BASE_DIR . "/models/$name.php";
        break;

    // vendors
    case 'BaseVendor':
        include BASE_DIR . "/models/Vendors/Vendor.php";
        break;

    case 'AbeBooks':
    case 'AmazonMarketplace':
    case 'Amazon':
    case 'Chegg':
    case 'Half':
        include BASE_DIR . "/models/Vendors/$name.php";
        break;

    // bookstores
    case 'BaseBookstore':
        include BASE_DIR . "/models/Vendors/Bookstores/Bookstore.php";
        break;
    case 'BnCollege':
    case 'Follett':
    case 'Neebo':
        include BASE_DIR . "/models/Vendors/Bookstores/$name.php";
        break;

    // courseinfo providers (individual providers are named like
    // ucfirst($schoolSlug) and manually required
    case 'BaseCourseInfoProvider':
        include BASE_DIR . "/models/CourseInfoProviders/CourseInfoProvider.php";
        break;

    // errors (only those that require autoloading, i.e. are used in files other
    // than where they are defined, before any autoload can take effect
    case 'BookstoreError':
        include BASE_DIR . "/models/Vendors/Bookstores/Bookstore.php";
    }
});

// base exception class
class GetchabooksError extends Exception {}

/**
 * Get an error message for $exception suitable for display on a debug error
 * page or in an error email.
 */
function get_error_message($exception) {
    $class = get_class($exception);
    $message = $exception->getMessage();
    $traceback = $exception->getTraceAsString();
    $url = CURRENT_URL;

    return <<<END
$class: $message
    
URL: $url

IP: {$_SERVER['REMOTE_ADDR']}

User Agent: {$_SERVER['HTTP_USER_AGENT']}

Referer: {$_SERVER['HTTP_REFERER']}

Traceback:

$traceback
END;

}

