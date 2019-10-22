<?php
    session_start();
    require_once "../authenticate/login.php";

    if(isset($_POST['username']) && isset($_POST['pass'])){
        // create user table

        echo "Creating user table<br>";

        $conn = mysqli_connect($hostname, $username, $password, $database);
        if(!$conn){
            die("Error creating user. Please try later.");
            exit();
        }

        $newUserName = trim($_POST['username']);  
        $newUserPass = trim($_POST['pass']);   

        $check_user_exists_query = "SELECT * FROM auth WHERE username='{$newUserName}'";
        $check_user_exists_result = mysqli_query($conn, $check_user_exists_query);

        if(mysqli_num_rows($check_user_exists_result) > 0){
            die("The username already exists.");
            exit();
        }
        else{
            $create_user_query = "INSERT INTO auth VALUES('{$newUserName}','{$newUserPass}','no')";
            $create_user_result = mysqli_query($conn, $create_user_query);

            if(!$create_user_result)
                echo "Error creating user....!<br>".mysqli_error($conn);

            $create_user_table_query = "CREATE TABLE {$newUserName} (date_ DATE NOT NULL, latitude VARCHAR(30) NOT NULL, longitude VARCHAR(30) NOT NULL, pic VARCHAR(30) DEFAULT NULL)";
            $create_user_table_result = mysqli_query($conn, $create_user_table_query);

            if(!$create_user_table_result)
                echo "There was some problem creating table for {$newUserName}.<br>".mysqli_error($conn);

            echo "Created user {$newUserName}...";
        }


        // echo "Creating table<br>";
    }
    else{
        echo <<< _END
            <form action='createUser.php' method='post' enctype='multipart/form-data'>
                Username :  <input type='text' name='username' required>
                Password :  <input type='password' name='pass'  required>
                <button type='submit'>Add user</button>
            </form>
        _END;
    }

?>