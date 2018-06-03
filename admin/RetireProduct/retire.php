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
	$stock_id=$_GET['stock_id'];
	$item_id=$_GET['item_id'];
	$remarks=$_GET['remarks'];
	$array=array(
			"health"			=>	"bad",
			"retire_remarks"	=>	$remarks
	);
	update($conn, "item", $array,"stock_id='{$stock_id}' and item_id='{$item_id}'");
?>