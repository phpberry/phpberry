<?php

require '../config/bootstrap.php';

$table = 'helloworld';
$dynamicHandle = new dynamic();
$dynamicList = $dynamicHandle->select($table);
var_dump($dynamicList);