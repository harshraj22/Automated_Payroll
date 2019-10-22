<?php
    session_start();
    require_once "../authenticate/login.php";

    if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false){
        echo "Error 404. The page you requested doesn't exists. ".isset($_SESSION['loggedIn'])." and {$_SESSION['loggedIn']}";
        header("Refresh:02; url=../index.php");
        exit();
    }

    echo "Latitude : {$_GET['latitude']}<br> Longitude : {$_GET['longitude']}<br>";

    $latitude = trim($_GET['latitude']);
    $longitude = trim($_GET['longitude']);

    $date = date('Y-n-d');
    echo $date;

    $conn = mysqli_connect($hostname, $username, $password, $database);
    if(!$conn)
        echo "Connection error. Details can't be updated.";
    else{
        $curUserName = trim($_SESSION['user']);
        $user_update_query = "INSERT INTO {$curUserName} VALUES('{$date}','{$latitude}','{$longitude}','NULL')";
        $user_update_result = mysqli_query($conn, $user_update_query);

        if(!$user_update_result)
            echo "Error updating the user details.";
        else 
            echo "Successfully updated the user details.";
    }

    header('Refresh:10; url=userProfileFrontend.php');
    // echo "asldfja asdlf";
    exit();
?>