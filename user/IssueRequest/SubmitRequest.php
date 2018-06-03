<?php 
	include('../../log4php/Logger.php');
	Logger::configure('../../log4phpconfig.xml');
	$log = Logger::getLogger("AccessLogger");
?>
<?php
	include '../../helper/verifier.php';
	verify('user');
?>
<?php
	include '../../helper/dbconnector.php';
	include '../../helper/sqlhelper.php';
	$time=time()-1498644044;
	$req_id="{$_GET['id']}/{$_SESSION['emp_mail']}/{$time}";
	if($_SESSION['dept']=='CC'){
		$dept_hod_approval="na";
		$status="Forwarded to HOD, CC";
	}
	else{
		$dept_hod_approval="pending";
		$status="Forwarded to Department HOD";
	}
	$array=array(
			"req_id"			=>	$req_id,
			"req_name"			=>	$_SESSION['emp_name'],
			"req_mail"			=>	"{$_SESSION['emp_mail']}@iitp.ac.in",
			"req_dept"			=>	$_SESSION['dept'],
			"req_date"			=>	date('Y-m-d'),
			"benificiary_type"	=>	$_GET['benificiary_type'],
			"id"				=>	$_GET['id'],
			"department"		=>	$_GET['department'],
			"name"				=>	$_GET['name'],
			"block"				=>	$_GET['block'],
			"floor"				=>	$_GET['floor'],
			"room_no"			=>	$_GET['room_no'],
			"mail_id"			=>	$_GET['mail_id'],
			"mobile"			=>	$_GET['mobile'],
			"alt_mail_id"		=>	$_GET['alt_mail_id'],
			"PhD_category"		=>	$_GET['PhD_category'],
			"alt_mobile"		=>	$_GET['alt_mobile'],
			"laptop_qty"		=>	$_GET['laptop_qty'],
			"laptop_make"		=>	$_GET['laptop_make'],
			"laptop_model"		=>	$_GET['laptop_model'],
			"desktop_qty"		=>	$_GET['desktop_qty'],
			"desktop_make"		=>	$_GET['desktop_make'],
			"desktop_model"		=>	$_GET['desktop_model'],
			"printer_qty"		=>	$_GET['printer_qty'],
			"printer_make"		=>	$_GET['printer_make'],
			"printer_model"		=>	$_GET['printer_model'],
			"access"			=>	$_GET['access'],
			"dept_hod_approval"	=>	$dept_hod_approval,
			"cc_hod_approval"	=>	"pending",
			"status"			=>	$status
	);
	
	insert($conn, "request", $array);
	header("Location:ShowReciept.php?req_id={$req_id}");
?>
