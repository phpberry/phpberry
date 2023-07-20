<?php

declare(strict_types=1);

if (basename($_SERVER['SCRIPT_NAME']) === basename(__FILE__)) {
    header('Location: 404');
}
require_once 'database.php';
require_once 'BaseModel.php';
function CP_LoadModels($className): void
{
    if (file_exists(CP_MODELS_PATH . $className . '.php')) {
        require_once CP_MODELS_PATH . $className . '.php';
    }
}

function CP_LoadLibs($className): void
{
    if (file_exists(CP_LIBS_PATH . $className . '.php')) {
        require_once CP_LIBS_PATH . $className . '.php';
    }
}

function loadModels($className): void
{
    if (file_exists(MODELS_PATH . $className . '.php')) {
        require_once MODELS_PATH . $className . '.php';
    }
}

function loadLibs($className): void
{
    if (file_exists(LIBS_PATH . $className . '.php')) {
        require_once LIBS_PATH . $className . '.php';
    }
}

spl_autoload_register('CP_LoadModels');
spl_autoload_register('CP_LoadLibs');
spl_autoload_register('loadModels');
spl_autoload_register('loadLibs');
