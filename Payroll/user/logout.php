<?php
	session_start();
	$_SESSION['loggedIn'] = false;
	$_SESSION['isAdmin'] = false;
	$_SESSION['isHr'] = false;

	echo "Logged out successfully.<br>";

    header('Refresh:01; url=../index.php');

?>