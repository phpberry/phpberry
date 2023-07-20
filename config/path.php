<?php

declare(strict_types=1);

if (basename($_SERVER['SCRIPT_NAME']) === basename(__FILE__)) {
    header('Location: 404');
}
const CP_VERSION = '1.0';
define('BASE_PATH', dirname(__DIR__) . '/');
define('SERVER_NAME', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME']);
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
define('BASE_URL', SERVER_NAME . '/');
/*define("BASE_URL",str_replace(ROOT,SERVER_NAME.'/',str_replace("\\","/",dirname(__DIR__).'/'))); */
/*define("BASE_URL","http://".$_SERVER['SERVER_NAME'].str_replace(str_replace('.php',"",basename($_SERVER['PHP_SELF'])),"",str_replace(basename($_SERVER['PHP_SELF']),"",$_SERVER['REQUEST_URI']))); */

define('ERROR_LOG_PATH', BASE_PATH . $path['system'] . '/CP_Temp/myerrors.log');
define('CP_MODELS_PATH', BASE_PATH . $path['system'] . '/CP_Models/');
define('CP_LIBS_PATH', BASE_PATH . $path['system'] . '/CP_Libraries/');
define('CP_HOOK_PATH', BASE_PATH . $path['system'] . '/CP_Hooks/');
define('ERROR_REDIRECT_PAGE', BASE_PATH . $path['system'] . '/CP_Temp/errorpage.php');

define('HOOKS_URL', BASE_URL . $path['mysystem'] . '/hooks/');
define('MODELS_PATH', BASE_PATH . $path['mysystem'] . '/models/');
define('LIBS_PATH', BASE_PATH . $path['mysystem'] . '/libraries/');
define('HOOKS_PATH', BASE_PATH . $path['mysystem'] . '/hooks/');

define('ASSETS_URL', BASE_URL . $path['asset'] . '/');
define('ASSETS_PATH', BASE_PATH . $path['asset'] . '/');

define('DIR_PATH', str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_FILENAME']));
define('DIR_URL', SERVER_NAME . '/' . str_replace(ROOT, '', str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_FILENAME'])));
define('SELF_URL', SERVER_NAME . basename($_SERVER['PHP_SELF'], '.php'));
