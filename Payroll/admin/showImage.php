<?php

    session_start();

    require_once "../authenticate/login.php";
    $conn = mysqli_connect($hostname, $username, $password, $database);
    if(!$conn)
        die("Error while connectine. Try later. <br>".mysqli_connect_error());

    $date = trim($_GET['date']);
    $employee = trim($_GET['emp']);
    
    $imageQuery = "SELECT * FROM {$employee} WHERE date_='{$date}' AND latitude='NA'";
    $result = mysqli_query($conn, $imageQuery);

    if(!$result) {
        die("Error fetching user images<br>".mysqli_error($conn));
    }
    $number_of_rows = mysqli_num_rows($result);
?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Admin Homepage</title>
    </head>
    <body>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="../index.html">Home</a>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="https://github.com/harshraj22/Automated_Payroll">Git <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <?php
                    if($_SESSION['loggedIn'] == true)
                        echo '<a class="nav-link" href="../user/logout.php">Logout</a>';
                    else
                        echo '<a class="nav-link" href="../index.php">Logout</a>';
                ?>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="../filter.php">
            <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Filter</button>
            </form>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <table class="table">
                <thead>
                    <tr>
                        <th scope="col" style='text-align: center;'>Login Image</th>
                        <th scope="col" style='text-align: center;'>Logout Image</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                            for($i=0;$i<$number_of_rows;$i++){
                                $row = mysqli_fetch_row($result);
                                echo <<< _END
                                    <th><img src='{$row[3]}'></img></th>
                                _END;
                            }
                        ?>
                    </tr>
                </table>
                </tbody>
            </div>
        </div>
                
    </body>
    </html>
