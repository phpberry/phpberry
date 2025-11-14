<?php

declare(strict_types=1);

if (basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)) {
    header("Location: 404");
}

// Legacy autoloader kept for backward compatibility with mysystem/ classes
// All system/ classes now use Composer PSR-4 autoloading

function loadModels($className)
{
    if (file_exists(MODELS_PATH . $className . '.php')) {
        require_once MODELS_PATH . $className . '.php';
    }
}

function loadLibs($className)
{
    if (file_exists(LIBS_PATH . $className . '.php')) {
        require_once LIBS_PATH . $className . '.php';
    }
}

spl_autoload_register("loadModels");
spl_autoload_register("loadLibs");
