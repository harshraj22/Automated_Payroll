<?php
	session_start();
	require_once '../authenticate/login.php';

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

	$rate_extract_query = "SELECT rate FROM hr_table WHERE username='{$_SESSION['user']}'";
	$rate_extract_res = mysqli_query($conn, $rate_extract_query);
	$rate = mysqli_fetch_row($rate_extract_res)[0];

	$extract_user_query = "SELECT username FROM auth WHERE isAdmin='no' AND isHr='no'";
	$extract_user_res = mysqli_query($conn, $extract_user_query);
	$extract_user_num = mysqli_num_rows($extract_user_res);

	$file = "EmpSalary.txt";
	$txt = fopen($file, "w") or die("Unable to open file!");

	for($i=0;$i<$extract_user_num;$i++){
		$user = mysqli_fetch_row($extract_user_res)[0];

		$user_query = "SELECT COUNT(*) FROM {$user}";
		$user_res = mysqli_query($conn, $user_query);

		$user_salary = mysqli_num_rows($user_res)*$rate;

		// echo $user."__________".$user_salary."<br>";

		fwrite($txt, $user."  :  ".$user_salary);
	}


	fclose($txt);

	header('Content-Description: File Transfer');
	header('Content-Disposition: attachment; filename='.basename($file));
	// header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($file));
	header("Content-Type: application/force-download"); 
	// header("Refresh:01; url='adminProfile.php'");
	ob_clean();
	flush();
	readfile($file);
	exit();

?>