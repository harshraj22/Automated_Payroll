<?php
    session_start();
    require_once "../authenticate/login.php";

    if(!isset($_SESSION['queriedUser']) || !isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] == false){
        die("Error 404 <br> The page you requested doesn't exist.");
        header('Refresh:01; url=../index.php');
        exit();
    }

    

?>