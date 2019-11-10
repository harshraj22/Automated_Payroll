<?php
	session_start();
	require_once "../authenticate/login.php";

	// print_r($_POST);

	$pref_longitude = 74.92356459999999;
	$pref_latitude = 15.5251559;

	$conn = mysqli_connect($hostname, $username, $password, $database);
	if(!$conn){
		die("Error connecting to server. Please try after sometime.".mysqli_connect_error());
		header('url=../index.php');
		exit();
	}

    if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false){
        echo "Error 404. The page you requested doesn't exists. ".isset($_SESSION['loggedIn'])." and {$_SESSION['loggedIn']}";
        header("Refresh:02; url=../index.php");
        exit();
	}
	
	$salary_per_hour = 10;

	if(!isset($_SESSION['isHr']) || $_SESSION['isHr'] == true){
		$query_for_rate = "SELECT rate FROM hr_table WHERE username='{$_SESSION['user']}'";
		$result_for_rate = mysqli_query($conn, $query_for_rate);

		$cur_row = mysqli_fetch_row($result_for_rate);
		$salary_per_hour = (int)($cur_row[0]);
		
		// echo $salary_per_hour.' inside <br>'.$query_for_rate."<br>";
		// print_r($cur_row);

	}
	else 
		$salary_per_hour = 10;
					
	// echo $salary_per_hour.'<br>';

	$today = date('Y-m');
	$today = (string)$today.'%';
	if(isset($_GET['date']))
		$today = $_GET['date'];
	
	$userQuery = "SELECT COUNT(*) FROM {$_POST['user']} WHERE date_ LIKE '{$today}' AND latitude!='NA' AND ABS(latitude-{$pref_latitude}) < 0.1 AND ABS(longitude - {$pref_longitude}) < 0.1";
	$userResult = mysqli_query($conn, $userQuery);

	// echo $userQuery." ".$salary_per_hour.'<br>';

	if(!$userResult)
		die("Error fetching user deatils<br>".mysqli_error($conn));
	$row = mysqli_fetch_row($userResult);

	mysqli_close($conn);

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <title>Employee Salary</title>
  </head>
  <body>
  	<div class="container">
  		<div class="row p-3 m-10 border success">
  			<h3 class="m-10">The Salary for this month is : 
				<?php
					$salary = (int)$row[0]*$salary_per_hour;
					echo <<< _END
						<span class="counter-count">$salary</span>
_END
				?>
			</h3>
  		</div>
	</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script>
        $('.counter-count').each(function () {
            $(this).prop('Counter',0).animate({
                Counter: $(this).text()
            }, {
                duration: 5000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });
    </script>
</body>
</html>



