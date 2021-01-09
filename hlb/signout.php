<?php  
	session_start();
	session_destroy();
	unset($_SESSION['username']);
	$_SESSION['message'] = "You are now Log out";
	header("location: admin_login.php");



?>