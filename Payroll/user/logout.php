<?php
	session_start();
	$_SESSION['loggedIn'] = false;
	$_SESSION['isAdmin'] = false;
	$_SESSION['isHr'] = false;

	// echo "<h2 style='margin:90px; padding:10px;'>Logged out successfully.<h2><br>";
	echo '<script>alert("Logged out successfully")</script>';
    header('Refresh:01; url=../index.php');

?>