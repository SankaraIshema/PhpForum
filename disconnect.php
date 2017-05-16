<?php 

	session_start();

	$_SESSION = array();
	session_destroy();

	setcookie('username', '');
	setcookie('password', '');

	header('Location:connect.php');

?>