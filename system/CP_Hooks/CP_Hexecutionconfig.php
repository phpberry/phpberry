<?php
if(basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)){header("Location: 404");}
    ini_set('max_execution_time', $second * 1000);
    ini_set('memory_limit', '-1');