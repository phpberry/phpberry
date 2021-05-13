<?php
require 'config/bootstrap.php';
// require 'config/seo.php'; 
session_start();
echo $_SESSION['captcha'];
?>