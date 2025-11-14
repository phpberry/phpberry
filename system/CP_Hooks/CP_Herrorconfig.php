<?php

declare(strict_types=1);

if (basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)) {
    header("Location: 404");
}
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('log_errors', '1');
ini_set('error_log', ERROR_LOG_PATH);
set_error_handler(function ($errCode, $errMessage, $errFile, $errLine) {
    $date = date("d-M-Y h:i:s");
    $description = "";
    $description .= "ERROR IN FILE: $errFile on $date\n";
    $description .= "LINE: $errLine\n";
    $description .= "ERROR CODE: $errCode\n";
    $description .= "ERROR MESSAGE: $errMessage\n";
    error_log($description);
});