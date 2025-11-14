<?php

declare(strict_types=1);

session_start();
require '../config/bootstrap.php';
$username = $_SESSION["username"];
$modified_access = date("d-M-Y h:i:s");
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