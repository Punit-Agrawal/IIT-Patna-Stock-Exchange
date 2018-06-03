<?php 
	session_start();
	include('../log4php/Logger.php');
	Logger::configure('../log4phpconfig.xml');
?>
<?php 
	function success_log(){
		$log = Logger::getLogger("AccessLogger");
		$log->trace("{$_SESSION['user_name']}#Login Success#{$_SERVER['REMOTE_ADDR']}#user");
	}
?>
<?php 
	function failiure_log(){
		$log = Logger::getLogger("AccessLogger");
		$log->trace("{$_SESSION['user_name']}#Login Failiure#{$_SERVER['REMOTE_ADDR']}#user");
	}
?>
<?php
	function do_login(){
		
		// Check for false session or no session or User entered URL by its own
		
		if(!isset($_SESSION['user_type'])||!isset($_SESSION['user_name'])||!isset($_SESSION['password'])||!isset($_SESSION['status'])||$_SESSION['user_type']!='user'||$_SESSION['status']!='check')
			return false;
				
		// Valid Session
		
		$GLOBALS['user_name']=$_SESSION['user_name'];
			
		include '../helper/dbconnector.php';
		include '../helper/sqlhelper.php';
		include '../helper/ldap_auth.php';
	
		if(!authorize($_SESSION['user_name'],$_SESSION['password']))
			return false;
		
		// Successfull Ldap Authorization
		
		$emp_db_query="select emp_id from contact where emp_cntct_type='Official Email' and emp_contct_val='{$_SESSION['user_name']}@iitp.ac.in'";
		$result=mysqli_query($conn, $emp_db_query);

		$log = Logger::getLogger("AccessLogger");
		if($result==null){
			$log->trace("{$_SESSION['user_name']}#Employee DB Entry not Found#{$_SERVER['REMOTE_ADDR']}#user");
			return false;
		}
		$log->trace("{$_SESSION['user_name']}#Employee DB Entry Found#{$_SERVER['REMOTE_ADDR']}#user");
		
		// User is a valid employee

		$GLOBALS['emp_id']=mysqli_fetch_assoc($result)['emp_id'];

		
		$emp_db_query="select * from employee where emp_id='{$GLOBALS['emp_id']}'";
		$result=mysqli_query($conn, $emp_db_query);
		$GLOBALS['result']=mysqli_fetch_assoc($result);

		$dept_id=$GLOBALS['result']['emp_dept'];
		
		$emp_db_query="select * from dept where dept_id='{$dept_id}'";
		$dept=mysqli_query($conn, $emp_db_query);
		$GLOBALS['dept']=mysqli_fetch_assoc($dept);
		

		//Set any session you want from result and dept which would be used afterwards
		return true;
	}

	if(do_login()){
		success_log();
		session_destroy();
		session_start();												//Restarting Session after All Successfull Checks
		$_SESSION['status']='user';
		$_SESSION['emp_id']=$GLOBALS['emp_id'];
		$_SESSION['emp_mail']=$GLOBALS['user_name'];
		$_SESSION['user_name']=$GLOBALS['user_name'];
		$_SESSION['emp_name']=$GLOBALS['result']['emp_name'];
		$_SESSION['dept']=$dept['dept_name'];
		header( "Location:Home.php");
	}
	else{
		failiure_log();
		session_destroy();
		header("Location:../errorlogin.php");
	}
?>