<?php
    session_start();
    require_once "authenticate/login.php";

    // If this page was requested for first time, username and password in html form won't be set
    if(!isset($_POST['username']) || !isset($_POST['pass'])){
        echo <<< _END
            <form method='POST' action='' enctype='multipart/form-data'>
                Username: <input type='text' name='username'>
                <br>
                Password: <input type='password' name='pass'>
                <input type='submit'>
            </form>
        _END;
    }

    else{
        $conn = mysqli_connect($hostname, $username, $password, $database);
        if(!$conn)
            die("Error while connectine. Try later. <br>".mysqli_connect_error());

        $currentUserName = trim($_POST['username']);
        $currentUserPass = trim($_POST['pass']);

        $user_query = "SELECT * FROM auth WHERE username='{$currentUserName}' AND pass='{$currentUserPass}'";
        $user_result = mysqli_query($conn, $user_query);

        if(!$user_result)
            die("Error matching credentials. Please try later.<br>".mysqli_error($conn));
        else if(mysqli_num_rows($user_result) == 0){
            echo "Username and password doesn't match.<br>";
        }
        else{
            $_SESSION['user'] = $currentUserName;
            $_SESSION['loggedIn'] = true;
            echo "Successfully Logged In. Redirecting to Profile.<br>";
            $isAdmin = mysqli_fetch_row($user_result)[2];
            
            if($isAdmin == "yes"){
                $_SESSION['isAdmin'] = true;
                header('Refresh:01; url=admin/adminProfile.php');
                exit();
            }
            else {
                $_SESSION['isAdmin'] = false;
                header('Refresh:01; url=user/userProfileFrontend.php');
                exit();
            }
        }

    }
?>