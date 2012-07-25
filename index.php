<?php

// Initialize flags, config, models, cache, etc.
require_once 'init.php';

require_once BASE_DIR . '/vendor/Slim/Slim/Slim.php';
require_once BASE_DIR . '/vendor/Slim-Extras/Log Writers/TimestampLogFileWriter.php';

$app = new Slim(array(
    'mode' => defined('PRODUCTION') ? 'production' : 'development',
    'debug' => false,
    'log.enabled' => true,
    'log.writer' => new TimestampLogFileWriter(array(
        'path' => BASE_DIR,
        'name_format' => '\s\l\i\m\_\l\o\g'
    )),
));

$app->configureMode('development', function () use ($app) {
    $app->config(array(
        'debug' => true,
    ));
});

$app->configureMode('production', function () use ($app) {
    error_reporting(0);

    $app->notFound(function () use ($app) {
        $page = new ErrorController(404);
        $page->render();
    });

    $app->error(function (Exception $e) use ($app) {
        $app->response()->status(500);

        if (!$app->request()->isAjax()) {
            $page = new ErrorController(500);
            $page->render();
        }

        $app->stop();

        if (file_exists(BASE_DIR . '/.gbemail')) {
            foreach (explode('\n', file_get_contents(BASE_DIR . '/.gbemail')) as $email) {
                mail(trim($email), "GetchaBooks Error", get_error_message($e));
            }
        }
    });
});

$app->hook('slim.before', function () use ($app) {
    global $referrers;

    $request = $app->request();
    define('BASE_URL', $request->getUrl() . $request->getRootUri() . '/');
    define('CURRENT_URL', $request->getUrl() . $request->getPath());
    define('MOBILE_DEVICE', strpos(strtolower($request->getUserAgent()), 'mobile') !== false);

    // remove extra slashes
    $path = $app->request()->getPath();
    $newPath = preg_replace("#/{2,}#", '/', $path);

    if ($path != $newPath) {
        $app->redirect($newPath, 300);
    }

    // remove subdomains
    $host = $app->request()->getHost();
    preg_match("/[^.]+\.[^.]+$/", $host, $match);
    if ($match[0] != $host) {
        $app->redirect(str_replace($host, $match[1], $app->request()->getUrl() . $path), 300);
    }

    // process referrer tag
    if (isset($_GET['ref']) && isset($referrers[$_GET['ref']])) {
        $_SESSION['ref'] = $_GET['ref'];
        $_SESSION['tag'] = $referrers[$_GET['ref']];
    } else {
        $_SESSION['ref'] = null;
    }
});

$routes = include 'routes.php';

// Use Slim with Class#method style routes
foreach ($routes as $name => $details) {
    $fn = function () use ($details) {
        list($class, $method) = explode('.', $details[1]);
        $class = "{$class}Controller";
        call_user_func_array(array(new $class, $method), func_get_args());
    };

    $route = $app->map($details[0], $fn)->name($name);

    if (isset($details['method'])) {
        if (!is_array($details['method'])) {
            $details['method'] = array($details['method']);
        }
        call_user_func_array(array($route, 'via'), $details['method']);
    } else {
        $route->via('GET');
    }

    if (isset($details['conditions'])) {
        $route->conditions($details['conditions']);
    }
}

$app->run();
