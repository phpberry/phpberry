<?php
    session_start();
    if(!$_SESSION['ra_logged_in']){
        header("Location: ./");  
         exit();
    }
?>