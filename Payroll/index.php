<?php
    session_start();
    require_once "authenticate/login.php";

    // If this page was requested for first time, username and password in html form won't be set
    if(!isset($_POST['username']) || !isset($_POST['pass'])){

    }

    else{
        $conn = mysqli_connect($hostname, $username, $password, $database);
        if(!$conn)
            die("Error while connectine. Try later. <br>".mysqli_connect_error());
        $currentUserName = trim($_POST['username']);
        $currentUserPass = trim($_POST['pass']);

        $user_query = "SELECT * FROM auth WHERE username={$currentUserName} AND pass={$currentUserPass}";
        $user_result = mysqli_query($conn, $user_query);

        if(!$user_result)
            die("Error matching credentials. Please try later");
        else if(mysqli_num_rows($user_result) == 0){
            echo "Username and password doesn't match.<br>";
        }
        else{
            $_SESSION['user'] = $currentUserName;
            $_SESSION['loggedIn'] = true;
        }

    }


?>