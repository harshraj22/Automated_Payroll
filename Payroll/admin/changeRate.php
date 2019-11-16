<?php
    session_start();
    require_once "../authenticate/login.php";

    $conn = mysqli_connect($hostname, $username, $password, $database);
    if(!$conn){
        die("Error connecting to server. Please try after sometime.".mysqli_connect_error());
        // mysqli_close($conn);
        header('url=../index.php');
        exit();
    }

    $newRate = $_POST['rate'];
    $update_rate_query = "UPDATE hr_table SET rate={$newRate} WHERE username='{$_SESSION['user']}'";
    $result_rate_query = mysqli_query($conn, $update_rate_query);

    if(!$result_rate_query)
        die("Error updating salary rate".mysqli_connect_error());
    else
        echo "<script>alert('Succesfully Updated')</script>";
        // echo "Successfully Updated";

    // mysqli_close($conn);
    header("Refresh:01; url='adminProfile.php'");

?>