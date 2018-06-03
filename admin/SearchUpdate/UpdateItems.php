<?php 
	include('../../log4php/Logger.php');
	Logger::configure('../../log4phpconfig.xml');
	$log = Logger::getLogger("MessageLogger");
?>
<?php
	include '../../helper/verifier.php';
	include '../../helper/sqlhelper.php';
	verify('admin');
	
	$stockid=$_GET['stockid'];
	$id=$_GET['id'];
	$prod=$_GET['product'];
	$serial=$_GET['serial'];

	include '../../helper/dbconnector.php';
	
	$array=array(
			"serial_number"		=>	$serial,
			"product_number"	=>	$prod
	);
	echo update($conn, "item", $array, "stock_id='{$stockid}' AND item_id = '{$id}'");	
?>