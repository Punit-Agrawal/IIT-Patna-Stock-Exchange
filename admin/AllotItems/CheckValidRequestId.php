<?php
	include '../../helper/verifier.php';
	verify('admin');

	include '../../helper/dbconnector.php';
	
	$req_id=$_GET['req_id'];
	$check_query="select laptop_qty-laptop_alloted as l,desktop_qty-desktop_alloted as d,printer_qty-printer_alloted as p,access,access_alloted from request where req_id='{$req_id}' and cc_hod_approval='yes'";
	$result=mysqli_query($conn, $check_query);
	$row = mysqli_fetch_assoc($result);
	if($row==null)
		echo 'false';
	else
		echo "{$row['p']} {$row['d']} {$row['l']} {$row['access']} {$row['access_alloted']}";
?>