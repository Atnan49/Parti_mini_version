<?php

define('LARAVEL_START', microtime(true));

// Auto detect Laravel base directory
$baseDir = file_exists(__DIR__ . '/vendor/autoload.php') ? __DIR__ : __DIR__ . '/parti2026';

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = $baseDir . '/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require $baseDir . '/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Illuminate\Foundation\Application $app */
$app = require_once $baseDir . '/bootstrap/app.php';

$app->handleRequest(Illuminate\Http\Request::capture());
