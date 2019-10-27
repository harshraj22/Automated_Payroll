<?php
	session_start();
	require_once "../authenticate/login.php";

	// print_r($_POST);
	$salary_per_hour = 10;

	$conn = mysqli_connect($hostname, $username, $password, $database);
	if(!$conn){
		die("Error connecting to server. Please try after sometime.".mysqli_connect_error());
		header('url=../index.php');
		exit();
	}
					
					
	$today = date('Y-m');
	$today = (string)$today.'%';
	
	$userQuery = "SELECT COUNT(*) FROM {$_POST['user']} WHERE date_ LIKE '{$today}'";
	$userResult = mysqli_query($conn, $userQuery);
	// echo $userQuery;

	if(!$userResult)
		die("Error fetching user deatils<br>".mysqli_error($conn));
	$row = mysqli_fetch_row($userResult);

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Employee Salary</title>
  </head>
  <body>
  	<div class="container">
  		<div class="row p-3 m-10 border success">
  			<h3 class="m-10">The Salary for this month is : 
				<?php
					echo (int)$row[0]*$salary_per_hour;
				?>
			</h3>
  		</div>
	</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>



