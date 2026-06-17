<?php

// -------------------------------------------------------
// Vercel Serverless Environment Bootstrap
// -------------------------------------------------------
// Vercel's filesystem is read-only except for /tmp.
// Laravel needs writable directories for cache, views,
// sessions, and logs. We create them in /tmp and set
// environment variables so Laravel uses them instead
// of the default paths inside the project directory.
// -------------------------------------------------------

if (getenv('VERCEL')) {
    // Create writable directories in /tmp
    $tmpDirs = [
        '/tmp/storage/framework/views',
        '/tmp/storage/framework/cache',
        '/tmp/storage/framework/sessions',
        '/tmp/storage/logs',
        '/tmp/bootstrap/cache',
    ];

    foreach ($tmpDirs as $dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
    }

    // Redirect Laravel's cache paths to /tmp
    putenv('APP_SERVICES_CACHE=/tmp/bootstrap/cache/services.php');
    putenv('APP_PACKAGES_CACHE=/tmp/bootstrap/cache/packages.php');
    putenv('APP_CONFIG_CACHE=/tmp/bootstrap/cache/config.php');
    putenv('APP_ROUTES_CACHE=/tmp/bootstrap/cache/routes-v7.php');
    putenv('APP_EVENTS_CACHE=/tmp/bootstrap/cache/events.php');
    putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');

    $_ENV['APP_SERVICES_CACHE'] = '/tmp/bootstrap/cache/services.php';
    $_ENV['APP_PACKAGES_CACHE'] = '/tmp/bootstrap/cache/packages.php';
    $_ENV['APP_CONFIG_CACHE'] = '/tmp/bootstrap/cache/config.php';
    $_ENV['APP_ROUTES_CACHE'] = '/tmp/bootstrap/cache/routes-v7.php';
    $_ENV['APP_EVENTS_CACHE'] = '/tmp/bootstrap/cache/events.php';
    $_ENV['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';

    $_SERVER['APP_SERVICES_CACHE'] = '/tmp/bootstrap/cache/services.php';
    $_SERVER['APP_PACKAGES_CACHE'] = '/tmp/bootstrap/cache/packages.php';
    $_SERVER['APP_CONFIG_CACHE'] = '/tmp/bootstrap/cache/config.php';
    $_SERVER['APP_ROUTES_CACHE'] = '/tmp/bootstrap/cache/routes-v7.php';
    $_SERVER['APP_EVENTS_CACHE'] = '/tmp/bootstrap/cache/events.php';
    $_SERVER['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';
}

require __DIR__ . '/../public/index.php';