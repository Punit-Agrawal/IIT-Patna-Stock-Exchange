<?php 
	session_start();
	include('../log4php/Logger.php');
	Logger::configure('../log4phpconfig.xml');
?>
<?php 
	function success_log(){
		$log = Logger::getLogger("AccessLogger");
		$log->trace("{$_SESSION['user_name']}#Login Success#{$_SERVER['REMOTE_ADDR']}#hod");
	}
?>
<?php 
	function failiure_log(){
		$log = Logger::getLogger("AccessLogger");
		$log->trace("{$_SESSION['user_name']}#Login Failiure#{$_SERVER['REMOTE_ADDR']}#hod");
	}
?>
<?php
	function do_login(){
		// Check for false session or no session or User entered URL by its own
		if(!isset($_SESSION['user_type'])||!isset($_SESSION['user_name'])||!isset($_SESSION['password'])||!isset($_SESSION['status'])||   !($_SESSION['user_type']=='dept'||$_SESSION['user_type']=='cc')     ||$_SESSION['status']!='check')
			return false;

		// Valid Session

		include '../helper/dbconnector.php';
		include '../helper/sqlhelper.php';
		include '../helper/ldap_auth.php';
		
		$GLOBALS['user_name']=$_SESSION['user_name'];
		$GLOBALS['user_type']=$_SESSION['user_type'];

		if(!authorize($_SESSION['user_name'],$_SESSION['password']))
			return false;
		 // Successfull Ldap Authorization

		if($GLOBALS['user_type']=='cc')
			$query="select off_email from heads where personal_mail='{$_SESSION['user_name']}@iitp.ac.in' and dept='CC' LIMIT 1";
		else
			$query="select off_email from heads where personal_mail='{$_SESSION['user_name']}@iitp.ac.in' and dept!='CC' LIMIT 1";

		$result=mysqli_query($conn, $query);
		$GLOBALS['result']=mysqli_fetch_assoc($result);

		$log = Logger::getLogger("AccessLogger");
		if($GLOBALS['result']==null){
			$log->trace("{$_SESSION['user_name']}#Employee DB Entry not Found#{$_SERVER['REMOTE_ADDR']}#hod");
			return false;
		}
		$log->trace("{$_SESSION['user_name']}#Employee DB Entry Found#{$_SERVER['REMOTE_ADDR']}#hod");

		//Successfull heads entry
		return true;
	}
	if(do_login()){
		success_log();
		session_destroy();
		session_start();												//Restarting Session on Successful Login
		$_SESSION['status']='hod';
		$_SESSION['hod_id']=$GLOBALS['result']['off_email'];
		$_SESSION['hod_type']=$GLOBALS['user_type'];
		$_SESSION['user_name']=$GLOBALS['user_name'];
		
		header( "Location:Home.php");
	}
	else{
		failiure_log();
		session_destroy();
		header("Location:../errorlogin.php");
	}
?>