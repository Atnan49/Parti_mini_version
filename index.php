<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

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
/** @var Application $app */
$app = require_once $baseDir . '/bootstrap/app.php';

try {
    $app->handleRequest(Request::capture());
} catch (\Throwable $e) {
    header('HTTP/1.1 200 OK');
    echo "<div style='background:#1e1e2e; color:#f38ba8; padding:25px; font-family:Consolas,monospace; font-size:14px; line-height:1.6;'>";
    echo "<h2 style='color:#fab387; margin-top:0;'>⚠️ Laravel Exception Captured:</h2>";
    echo "<p><strong>Pesan Error:</strong> <span style='color:#f38ba8; font-weight:bold;'>" . htmlspecialchars($e->getMessage()) . "</span></p>";
    echo "<p><strong>Lokasi Berkas:</strong> <code>" . htmlspecialchars($e->getFile()) . "</code> (Baris: " . $e->getLine() . ")</p>";
    echo "<h3 style='color:#89b4fa;'>Jejak Stack Trace:</h3>";
    echo "<pre style='background:#11111b; color:#cdd6f4; padding:15px; border-radius:6px; overflow-x:auto; white-space:pre-wrap;'>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
    echo "</div>";
}
