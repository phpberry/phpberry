<?php
if(basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)){header("Location: 404");}
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');