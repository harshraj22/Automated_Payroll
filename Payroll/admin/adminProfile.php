<?php
    session_start();
    require_once "../authenticate/login.php";

    if($_SESSION['loggedIn'] == false || ($_SESSION['isAdmin'] == false && $_SESSION['isHr'] == false)){
        echo "Error 404. <br> The page you requested does not exists.";
        header('Refresh:01; url=../index.php');
        exit();
    }

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

    <!-- Kaam kar raha hai ab bhi. Ha sahi kaha   / -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 ">
                <?php
                    if($_SESSION['isAdmin'] == true && $_SESSION['loggedIn'] == true){
                        echo <<< _END
                            <img class="img-fluid" id="userImage" src="https://img.huffingtonpost.com/asset/5bb7247b240000310056f31c.jpeg?ops=scalefit_720_noupscale">
                            </img>
                            <form action="createUser.php">
                                <div class="row">
                                    <button type="submit" class="btn btn-primary" style="margin: 5px; margin-left:30px">Add User</button>
                                </div>
                            </form>
                            <br><hr><br>
                        _END;
                    }

                    if($_SESSION['isAdmin'] == true && $_SESSION['loggedIn'] == true){
                        echo <<< _END
                            <img class="img-fluid" id="userImage" src="https://img.huffingtonpost.com/asset/5bb7247b240000310056f31c.jpeg?ops=scalefit_720_noupscale">
                            </img>
                            <form action="createHr.php">
                                <div class="row">
                                    <button type="submit" class="btn btn-primary" style="margin: 5px; margin-left:30px">Add HR</button>
                                </div>
                            </form>
                        _END;
                    }
                ?>
            </div>

            <div class="col-md-4 ">
                <?php

                    $conn = mysqli_connect($hostname, $username, $password, $database);
                    if(!$conn){
                        die("Error connecting to server. Please try after sometime.".mysqli_connect_error());
                        header('url=../index.php');
                        exit();
                    }

                    $show_all_emp_query = "SELECT * FROM auth WHERE isAdmin='no' AND isHr='no'";
                    $show_all_emp_result = mysqli_query($conn, $show_all_emp_query);

                    $number_of_emp = mysqli_num_rows($show_all_emp_result);
                    echo "<h5>Number of employees : <span class='counter-count'>{$number_of_emp}</span> </h5><br>";

                    echo "<div class='list-group'>";
                    // add <ul> to prettify it
                    for($i=0;$i<$number_of_emp;$i+=1){
                        $cur_emp_details = mysqli_fetch_row($show_all_emp_result);
                        // $_SESSION['queriedUser'] = $cur_emp_details;
                        echo "<a class='list-group-item list-group-item-action' href='displayUserStats.php?user={$cur_emp_details[0]}' >{$cur_emp_details[0]}</a><br> ";
                    }

                    echo "</div>";

                ?>
            </div>

            <div class="col-md-6">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                  </ol>
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img class="img-fluid d-block w-100" src="https://img.huffingtonpost.com/asset/5bb7247b240000310056f31c.jpeg?ops=scalefit_720_noupscale" alt="First slide" style="max-width:100%; height: 550px;">
                    </div>
                    <div class="carousel-item">
                      <img class="img-fluid d-block w-100" src="../images/image2.jpg" alt="Second slide" style="max-width:100%; height: 550px;">
                    </div>
                    <div class="carousel-item">
                      <img class="img-fluid d-block w-100" src="../images/image3.jpg" alt="Third slide" style="max-width:100%; height: 550px;">
                    </div>
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
            </div>

        </div>
    </div>

    <footer>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
                <p><u><a href="https://www.nationaltransaction.com/">National Transaction Corporation</a></u> is a Registered MSP/ISO of Elavon, Inc. Georgia [a wholly owned subsidiary of U.S. Bancorp, Minneapolis, MN]</p>
                <p class="h6">&copy All right Reversed.<a class="text-green ml-2" href="https://www.sunlimetech.com" target="_blank">Sunlimetech</a></p>
            </div>
            </hr>
        </div>  
    </footer>
    <script>
        $('.counter-count').each(function () {
            $(this).prop('Counter',0).animate({
                Counter: $(this).text()
            }, {
                duration: 1000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });
    </script>

</body>
</html>
