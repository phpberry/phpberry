<?php

declare(strict_types=1);

require 'config/bootstrap.php';
$file = $_FILES['fileToUpload']['name'];

$config = [
    'file' => $file,
    'rename' => true,
    'isimage' => true,
    'overwrite' => false,
    'minsize' => 50,
    'maxsize' => 20000,
    'format' => ['jpg', 'png', 'gif'],
    'foldername' => 'img',
];
$fileHandle = new CP_Lupload_file();
$result = $fileHandle->upload_file($config);
if (! $result['result']) {
    echo $result['error'];
} else {
    echo $result['filename'];
}

/*    $fileHandle=new CP_Lupload_file();
    $result=$fileHandle->delete_file( "14906708221490670822.jpg","img" );
    if(!$result['result']){
        echo $result['error'];
    }else {
        echo $result['filename'];
    }*/
