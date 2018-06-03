<?php 
	session_start();
	include('../log4php/Logger.php');
	Logger::configure('../log4phpconfig.xml');
?>
<?php 
	function success_log(){
		$log = Logger::getLogger("AccessLogger");
		$log->trace("{$_SESSION['user_name']}#Login Success#{$_SERVER['REMOTE_ADDR']}#admin");
	}
?>
<?php 
	function failiure_log(){
		$log = Logger::getLogger("AccessLogger");
		$log->trace("{$_SESSION['user_name']}#Login Failiure#{$_SERVER['REMOTE_ADDR']}#admin");
	}
?>
<?php
	function do_login(){

		// Check for false session or no session or User entered URL by its own

		if(!isset($_SESSION['user_type'])||!isset($_SESSION['user_name'])||!isset($_SESSION['password'])||!isset($_SESSION['status'])||$_SESSION['user_type']!='admin'||$_SESSION['status']!='check')
			return false;

		// Valid Session

		include '../helper/dbconnector.php';
		include '../helper/sqlhelper.php';
		
		$query="select * from admin";
		$result=mysqli_query($conn, $query);
		$result=mysqli_fetch_assoc($result);
		if(!($result['user_name']==$_SESSION['user_name']&&$result['password']==$_SESSION['password']))
			return false;
		
		//Match from Admin is Successfull
		return true;
	}
	if(do_login()){
		success_log();
		session_destroy();
		session_start();												//Restarting Session on Successful Login
		$_SESSION['status']='admin';
		$_SESSION['user_name']='admin';
		header( "Location:Home.php");
	}
	else{
		failiure_log();
		session_destroy();
		header("Location:../errorlogin.php");
	}
?>