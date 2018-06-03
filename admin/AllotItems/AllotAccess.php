<?php 
	include('../../log4php/Logger.php');
	Logger::configure('../../log4phpconfig.xml');
	$log = Logger::getLogger("MessageLogger");
?>
<?php
	include '../../helper/verifier.php';
	verify('admin');
?>
<?php
	include '../../helper/dbconnector.php';
	include '../../helper/sqlhelper.php';
	$req_id=$_GET['req_id'];
	$access=$_GET['id'];
	if($access!=''){
		$id_query="select access from request where req_id='{$req_id}'";
		$result=mysqli_query($conn, $id_query);
		$id=mysqli_fetch_assoc($result)['access'];
		$array=array(
				"stock_id"	=>	$access,
				"item_id"	=>	$id,
				"req_id"	=>	$req_id
		);
		
		insert($conn, "issue", $array);
		
		$array=array(
				"access_alloted"	=>	"yes"
		);
		
		update($conn, "request", $array, "req_id='{$req_id}'");
		
		$query="select printer_alloted-printer_qty as p,laptop_alloted-laptop_qty as l,desktop_alloted-desktop_qty as d from request where req_id='{$req_id}'";
		$result=mysqli_fetch_assoc(mysqli_query($conn,$query));
		if($result['p']==0&&$result['d']==0&&$result['l']==0)
			$array=array("status"=>"Complete");
		else
			$array=array("status"=>"Partially Complete");

		update($conn, "request", $array, "req_id='{$req_id}'");
		
	}
?>