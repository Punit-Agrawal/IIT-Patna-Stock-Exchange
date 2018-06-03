<?php 
	include('../../log4php/Logger.php');
	Logger::configure('../../log4phpconfig.xml');
	$log = Logger::getLogger("MessageLogger");
?>
<?php 
	include '../../helper/verifier.php';
	verify('hod');
?>
<?php
	include '../../helper/dbconnector.php';
	include '../../helper/sqlhelper.php';
	
	$req_id=$_GET['req_id'];
	$hod_id=$_SESSION['hod_id'];
	$remarks=$_GET['remarks'];
	$hod_query="select dept from heads where off_email='{$hod_id}'";
	$result=mysqli_query($conn, $hod_query);
	$row = mysqli_fetch_assoc($result);
	$branch = $row['dept'];
	
	if($branch=='CC'){
		$status="Approved by HOD, CC";
		$cc_hod_approval="yes";
		$array=array(
				"status"			=>	$status,
				"cc_hod_approval"	=>	$cc_hod_approval,
				"cc_hod_remarks"	=>	$remarks
		);
	}
	else{
		$status="Forwarded to CC";
		$dept_hod_approval="yes";
		$array=array(
				"status"			=>	$status,
				"dept_hod_approval"	=>	$dept_hod_approval,
				"dept_hod_remarks"	=>	$remarks
		);
	}
	update($conn, "request",$array, "req_id='{$req_id}'");
?>