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
			$create_user_query = "INSERT INTO auth VALUES('{$newUserName}','{$newUserPass}','no', 'no')";
			$create_user_result = mysqli_query($conn, $create_user_query);

			if(!$create_user_result)
				echo "Error creating user....!<br>".mysqli_error($conn);

			$create_user_table_query = "CREATE TABLE {$newUserName} (date_ DATE NOT NULL, latitude VARCHAR(30) NOT NULL, longitude VARCHAR(30) NOT NULL, pic VARCHAR(60) DEFAULT NULL)"; 
			$create_user_table_result = mysqli_query($conn, $create_user_table_query);

			if(!$create_user_table_result)
				echo "There was some problem creating table for {$newUserName}.<br>".mysqli_error($conn);

			if(!file_exists("../user_images/{$newUserName}")) {
				mkdir("../user_images/{$newUserName}",0777,true);
			}
			echo "Created user {$newUserName}...";
	        header('Refresh:01; url=adminProfile.php');
	        exit();
		}

        mysqli_close($conn);

	}
	else{
		echo <<< _END

				<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
				<link rel="stylesheet" href="style.css">
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

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
						<a class="nav-link" href="../user/logout.php">Logout</a>
					</li>
					<li class="nav-item">
						<a class="nav-link disabled" href="#">Disabled</a>
					</li>
					</ul>
					<form class="form-inline my-2 my-lg-0" action="https://www.google.com">
					<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
					</form>
				</div>
				</nav>

				<body style="background: linear-gradient(to bottom, #33ccff 0%, #ff99cc 100%);">
					<div class="signupSection">
					  <div class="info">
						<h2>Company Name</h2>
						<i class="icon ion-ios-ionic-outline" aria-hidden="true"></i>
						<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRNdj9-HCQSJVHKC699w0BbNRrVBIuCjfhEsaOcWnww67uucUlx&s">
						<blockquote class="blockquote">
							<p class="blockquote p-3">-Ariana Grande</p>
						</blockquote>
					  </div>
					  <form action="createUser.php" method="POST" class="signupForm" name="signupform">
						<h2>Enter New User Details</h2>
						<ul class="noBullet">
						  <li>
							<label for="username"></label>
							<input type="text" class="inputFields" id="username" name="username" placeholder="Username" value="" required/>
						  </li>
						  <li>
							<label for="password"></label>
							<input type="password" class="inputFields" id="password" name="pass" placeholder="Password" value="" required/>
						  </li>
						  <li>
							<label for="email"></label>
							<input type="email" class="inputFields" id="email" name="email" placeholder="Email" value="" required/>
						  </li>
						  <li id="center-btn">
							<input type="submit" id="join-btn" name="join" alt="Join" value="Join">
						  </li>
						</ul>
					  </form>
					</div>
				</body>
			
_END;
	}

?>