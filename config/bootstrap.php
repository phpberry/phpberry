<?php

declare(strict_types=1);

if (basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)) {
    header("Location: 404");
}

// Load Composer autoloader for PSR-4 classes
require_once __DIR__ . '/../vendor/autoload.php';

// Load path configuration
$path = array(
    'system' => "system",
    'mysystem' => 'mysystem',
    'asset' => 'assets',
);
require_once __DIR__ . '/path.php';

// Initialize error handling
\App\Hooks\ErrorConfig::init();

// Load legacy config files
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/autoload.php';

// Load URL functions
require_once __DIR__ . '/../src/Hooks/UrlFunctions.php';
