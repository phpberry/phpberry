<?php
if(basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)){header("Location: 404");}    
    $path = array(
        'system' => "system", 
        'mysystem' => 'mysystem',
        'asset' => 'assets',
    );
    require_once __DIR__.'/path.php';
    require_once CP_HOOk_PATH.'CP_Herrorconfig.php';
    require_once __DIR__.'/config.php';
    require_once __DIR__.'/autoload.php';    
    require_once CP_HOOk_PATH.'CP_Hurlfunction.php';    