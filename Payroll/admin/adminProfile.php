<?php
    session_start();
    require_once "../authenticate/login.php";

    if($_SESSION['loggedIn'] == false || $_SESSION['isAdmin'] == false){
        echo "Error 404. <br> The page you requested does not exists.";
        header('Refresh:01; url=../index.php');
        exit();
    }

    echo <<< _END
        <form action="createUser.php">
            <button type="submit">Add User</button>
        </form>

    _END;

    $conn = mysqli_connect($hostname, $username, $password, $database);
    if(!$conn){
        die("Error connecting to server. Please try after sometime.".mysqli_connect_error());
        header('url=../index.php');
        exit();
    }

    $show_all_emp_query = "SELECT * FROM auth WHERE isAdmin='no'";
    $show_all_emp_result = mysqli_query($conn, $show_all_emp_query);

    $number_of_emp = mysqli_num_rows($show_all_emp_result);
    echo "Number of employees : {$number_of_emp} <br>";

    // add <ul> to prettify it
    for($i=0;$i<$number_of_emp;$i+=1){
        $cur_emp_details = mysqli_fetch_row($show_all_emp_result);
        $_SESSION['queriedUser'] = $cur_emp_details;
        echo "<a href='displayUserStats.php' >{$cur_emp_details[0]}</a> ";
    }

?>