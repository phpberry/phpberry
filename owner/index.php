<?php

declare(strict_types=1);

require '../config/bootstrap.php';
// require 'config/seo.php';
$did = 2;
/*  $bankHandle=new bank();
  $bankList=$bankHandle->check($did);
  var_dump($bankList);
  echo $bankList;*/
/*echo basename(dirname(__DIR__));
chown(basename(__FILE__),dirname(__DIR__));
*/
echo dirname(__DIR__);
echo str_replace(basename(dirname($_SERVER['SCRIPT_FILENAME'])) . '/' . basename($_SERVER['SCRIPT_FILENAME']), '', str_replace(substr('/' . $_SERVER['PATH_INFO'], 1), '', SERVER_NAME . $_SERVER['PHP_SELF']));
$table = 'helloworld';
$con = 'OR';
$fatchfield = [
    'fname',
    'lname',
];
$wherefield = [
    'fname' => 'Dipesh',
    'img' => '54545454545.jpg',
];
$dynamicHandle = new CP_Mdynamic();
$dynamicList = $dynamicHandle->select($table);
var_dump($dynamicList);
