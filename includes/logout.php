<?php
session_start();
require '../config/bootstrap.php';
$username = $_SESSION["username"];
date_default_timezone_set('Asia/Kolkata');
$date = new DateTime();
$modified_access = $date->format('Y-m-d H:i:s');
try {
    $profileHandle = new profile();
    $b = $profileHandle->updateUser($modified_access, $username);
} catch (PDOException $e) {
    echo $e->getMessage();
}
session_destroy();
header("Location: ../");
exit();
?>