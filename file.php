<?php

declare(strict_types=1);

// session_start();
// if(!isset($_SESSION['admin']))
// {
//  header("Location: ./hii");
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require 'config/bootstrap.php';
require 'config/meta.php';
?>
    <title>phpberry</title>
</head>
<body>
<form action="upload" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
</body>
</html>