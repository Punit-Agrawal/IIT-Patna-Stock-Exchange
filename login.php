<?php 
	include('log4php/Logger.php');
	Logger::configure('log4phpconfig.xml');
	$log = Logger::getLogger("AccessLogger");
?>
<?php
	session_start();
	session_destroy();
	session_start();
	if(!isset($_POST['user_type'])||!isset($_POST['user_name'])||!isset($_POST['password']))		//==>Checking if page is opened by URL
		header("Location:.");
	else{

		$_SESSION['user_type']=$_POST['user_type'];
		$_SESSION['user_name']=$_POST['user_name'];
		$_SESSION['password']=$_POST['password'];
		$_SESSION['status']="check";
		switch($_POST['user_type']){
			case 'user':
				$log->trace("{$_POST['user_name']}#trying authentication#{$_SERVER['REMOTE_ADDR']}#user");
				header("Location:user/User.php");
				break;
			case 'dept':
				$log->trace("{$_POST['user_name']}#trying authentication#{$_SERVER['REMOTE_ADDR']}#hod");
				header("Location:hod/Hod.php");
				break;
			case 'cc':
				$log->trace("{$_POST['user_name']}#trying authentication#{$_SERVER['REMOTE_ADDR']}#hod");
				header("Location:hod/Hod.php");
				break;
			case 'admin':
				$log->trace("{$_POST['user_name']}#trying authentication#{$_SERVER['REMOTE_ADDR']}#admin");
				header("Location:admin/Admin.php");
				break;
		}
	}
?>