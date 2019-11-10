<?php
	session_start();
	require_once "authenticate/login.php";

	// If this page was requested for first time, username and password in html form won't be set
	if(!isset($_POST['username']) || !isset($_POST['pass'])){
		// session_destroy();
		echo <<< _END
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
			<link rel="stylesheet" href="index.css">

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
			        <a class="nav-link" href="#">Link</a>
			      </li>
			      <li class="nav-item">
			        
			      </li>
			    </ul>
			    <form method = 'get' class="form-inline my-2 my-lg-0" action="https://www.google.com/search">
			      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name='q'>
			      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			    </form>
			  </div>
			</nav>

			<!-- =====================input form================== -->
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-2">
						<form method='POST' action='' enctype='multipart/form-data'>
							<div class="form-group row-md-2">    
								Username: <input type='text' name='username' class="form-control" placeholder="username" required>
								<br>
								Password: <input type='password' name='pass' class="form-control" placeholder="password" required>
							</div>
								<input type='submit' class="btn btn-primary">
						</form>
					</div>
					<div class="col-md-3">
						<div class="thecard">
							<div class="thecard__side thecard__side--front">
								<img class="img-fluid" src="https://img.huffingtonpost.com/asset/5bb7247b240000310056f31c.jpeg?ops=scalefit_720_noupscale"></img>
							</div>
							<div class="thecard__side thecard__side--back">
								<img class="img-fluid" src="images/image1.jpg">
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="thecard">
							<div class="thecard__side thecard__side--front">
								<img class="img-fluid" src="https://img.huffingtonpost.com/asset/5bb7247b240000310056f31c.jpeg?ops=scalefit_720_noupscale"></img>
							</div>
							<div class="thecard__side thecard__side--back">
								<img class="img-fluid" src="images/image1.jpg">
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="thecard">
							<div class="thecard__side thecard__side--front">
								<img class="img-fluid" src="https://img.huffingtonpost.com/asset/5bb7247b240000310056f31c.jpeg?ops=scalefit_720_noupscale"></img>
							</div>
							<div class="thecard__side thecard__side--back">
								<img class="img-fluid" src="images/image1.jpg">
							</div>
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
			$_SESSION['isAdmin'] = false;
			$_SESSION['isHr'] = false;
			echo "Successfully Logged In. Redirecting to Profile.<br>";
			$data = mysqli_fetch_row($user_result);
			$isAdmin = $data[2];
			// print_r($data);
			$isHr = $data[3];
			
			if($isAdmin == "yes"){
				$_SESSION['isAdmin'] = true;
				header('Refresh:01; url=admin/adminProfile.php');
				exit();
			}
			else if($isHr == "yes"){
				$_SESSION['isHr'] = true;
				header('Refresh:01; url=admin/adminProfile.php');
				exit();
			}
			else {
				$_SESSION['isAdmin'] = false;
				$_SESSION['isHr'] = false;
				header('Refresh:01; url=user/userLoginImage.php');
				exit();
			}
		}
	}
?>