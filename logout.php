<?php 
	include('log4php/Logger.php');
	Logger::configure('log4phpconfig.xml');
	$log = Logger::getLogger("AccessLogger");
?>
<?php
	session_start();
	$log->trace("{$_SESSION['user_name']}#Log out#{$_SERVER['REMOTE_ADDR']}#{$_SESSION['status']}");
	session_destroy();
	header("Location:index.php");
?>