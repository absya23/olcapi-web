<?php

/**
 * Vercel environment values
 */
putenv("APP_CONFIG_CACHE=/tmp/config.php");
putenv("APP_EVENTS_CACHE=/tmp/events.php");
putenv("APP_PACKAGES_CACHE=/tmp/packages.php");
putenv("APP_ROUTES_CACHE=/tmp/routes.php");
putenv("APP_SERVICES_CACHE=/tmp/services.php");
putenv("VIEW_COMPILED_PATH=/tmp/views");

if (!getenv('CACHE_DRIVER')) {
    putenv("CACHE_DRIVER=array");
}

if (!getenv('LOG_CHANNEL')) {
    putenv("LOG_CHANNEL=stderr");
}

if (!getenv('SESSION_DRIVER')) {
    putenv("SESSION_DRIVER=array");
}

/**
 * Here is the serverless function entry for deployment with Vercel.
 */
// require __DIR__ . '/../public/index.php';

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Handle API routes
$app->group(['namespace' => 'App\Http\Controllers'], function ($app) {
    require __DIR__ . '/../routes/api.php';
});

$app->run();


?>
