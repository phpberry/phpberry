<?php   
   session_start();
    if(!empty($_SESSION["ra_logged_in"])){
        if($_SESSION['ra_logged_in']){
            header("Location: dashboard"); 
            exit();
        }
    }
?>