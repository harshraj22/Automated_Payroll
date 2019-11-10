<?php
    session_start();
    require_once "authenticate/login.php";
    if($_SESSION['loggedIn'] == true && ($_SESSION['isAdmin'] == true || $_SESSION['isHr'] == true)){
        // do nothing
    }
    else{
        echo "<h2> You need to login First </h2>.";
        header('Refresh:01; url=index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UserDetails</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="index.html">Home</a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="https://github.com/harshraj22/Automated_Payroll">Git <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <?php
                        if($_SESSION['loggedIn'] == true)
                            echo '<a class="nav-link" href="user/logout.php">Logout</a>';
                        else
                            echo '<a class="nav-link" href="index.php">Logout</a>';
                    ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin/adminProfile.php">Profile</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="filter.php">
                <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <?php
        $conn = mysqli_connect($hostname, $username, $password, $database);
        if(!$conn){
            die("Error connecting to server. Please try after sometime.".mysqli_connect_error());
            header('url=filter.php');
            exit();
        }
        else{
            echo <<< _END
                <form action="filter.php" method="POST" >
                    <input type="text" name="queriedUser">
                    <input type="date" name="queriedDate">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Search</button>
                </form>
            _END;

            if(isset($_POST['queriedUser']) && isset($_POST['queriedDate']) && !empty($_POST['queriedDate']) && !empty($_POST['queriedUser'])){
                $show_all_emp_query = "SELECT username FROM auth WHERE isAdmin='no' AND isHr='no' AND username='{$_POST['queriedUser']}'";
                $show_all_emp_result = mysqli_query($conn, $show_all_emp_query);

                $number_of_emp = mysqli_num_rows($show_all_emp_result);
                echo "<div class='col-md-4'>";
                echo "<h5>Date: <span class='counter-count'>{$_POST['queriedDate']}</span></h5><br>";

                echo "<div class='list-group'>";
                // add <ul> to prettify it
                $cur_emp_details = mysqli_fetch_row($show_all_emp_result);
                $present_or_not = "SELECT * FROM {$cur_emp_details[0]} WHERE date_='{$_POST['queriedDate']}'";
                $result = mysqli_query($conn, $present_or_not);
                if($result)
                    $number = mysqli_num_rows($result);
                // $_SESSION['queriedUser'] = $cur_emp_details;
                if($number_of_emp==0)
                    echo "<h6> No employee exists with name {$_POST['queriedUser']}";
                else if($number > 0)
                    echo "<a class='list-group-item list-group-item-action' href='admin/displayUserStats.php?user={$cur_emp_details[0]}' >{$cur_emp_details[0]}</a><br> ";
                else echo "<h6> {$cur_emp_details[0]} was not present that day </h6><br>";

                echo "</div></div>";
            }
            else if(isset($_POST['queriedDate']) && !empty($_POST['queriedDate'])){
                $select_user_tables = "SELECT username FROM auth WHERE isAdmin='no' AND isHr='no'";
                $selected_user_tables = mysqli_query($conn, $select_user_tables);

                $number_of_emps = mysqli_num_rows($selected_user_tables);
                echo "<div class='col-md-4'>";
                echo "<h5>Date: <span class='counter-count'>{$_POST['queriedDate']}</span></h5><br>";

                echo "<div class='list-group'>";

                for($i=0; $i<$number_of_emps; $i++) {
                    $curr_emp = mysqli_fetch_row($selected_user_tables);
                    $present_emp = "SELECT * FROM {$curr_emp[0]} WHERE date_='{$_POST['queriedDate']}'";
                    $result_emp = mysqli_query($conn, $present_emp);
                    $present_or_not = mysqli_num_rows($result_emp);
                    if($present_or_not > 0){
                        echo "<a class='list-group-item list-group-item-action' href='admin/displayUserStats.php?user={$curr_emp[0]}' >{$curr_emp[0]}</a><br> ";
                    }
                }

                echo "</div></div>";
            }
            else if(isset($_POST['queriedUser']) && isset($_POST['queriedDate'])) {
                $show_all_emp_query = "SELECT * FROM auth WHERE isAdmin='no' AND isHr='no' AND username LIKE '%{$_POST['queriedUser']}%'";
                $show_all_emp_result = mysqli_query($conn, $show_all_emp_query);

                $number_of_emp = mysqli_num_rows($show_all_emp_result);
                echo "<div class='col-md-4'>";
                echo "<h5>Number of employees : <span class='counter-count'>{$number_of_emp}</span> </h5><br>";

                echo "<div class='list-group'>";
                // add <ul> to prettify it
                for($i=0;$i<$number_of_emp;$i+=1){
                    $cur_emp_details = mysqli_fetch_row($show_all_emp_result);
                    // $_SESSION['queriedUser'] = $cur_emp_details;
                    echo "<a class='list-group-item list-group-item-action' href='admin/displayUserStats.php?user={$cur_emp_details[0]}' >{$cur_emp_details[0]}</a><br> ";
                }

                echo "</div></div>";
            }
        }
    ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    
</body>
</html>