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

// Create a new Router instance
$router = $app->make('router');

// Handle API routes
$router->group(['namespace' => 'App\Http\Controllers'], function ($router) {
    require __DIR__ . '/../routes/api.php';
});

// Dispatch the request
$response = $app->dispatch(app('request'));

// Send the response
$app->make('Illuminate\Contracts\Http\Kernel')->terminate($app['request'], $response);


?>
