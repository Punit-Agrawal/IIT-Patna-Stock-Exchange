<?php 
	include '../../helper/verifier.php';
	verify('admin');
?>
<?php 
	include('../../log4php/Logger.php');
	Logger::configure('../../log4phpconfig.xml');
	$log = Logger::getLogger("MessageLogger");
?>
<?php
	include '../../helper/dbconnector.php';
	include '../../helper/sqlhelper.php';
	$time=time()-1498644044;
	$acceptor_id=$_GET['acceptor_id'];
	$acceptor_name=$_GET['acceptor_name'];
	$acceptor_contact=$_GET['acceptor_contact'];
	$verifier_id=$_GET['verifier_id'];
	$verifier_name=$_GET['verifier_name'];
	$verifier_contact=$_GET['verifier_contact'];
	$ben_id=$_GET['ben_id'];
	
	$item_list=json_decode($_GET['item_list'],false);
	$remarks_list=json_decode($_GET['remarks_list'],false);
	$i=0;
	foreach($item_list as $item){
		$i++;
		
		$stock_id=substr($item,0,strpos($item,"@"));
		$item_id=substr($item,strpos($item,"@")+1);
		
		mysqli_query($conn, "update item set availablity='returned' where stock_id='{$stock_id}' and item_id='{$item_id}'");
		$array=array(
				"acceptor_id"		=>	$acceptor_id,
				"acceptor_name"		=>	$acceptor_name,
				"acceptor_contact"	=>	$acceptor_contact,
				"verifier_id"		=>	$verifier_id,
				"verifier_name"		=>	$verifier_name,
				"verifier_contact"	=>	$verifier_contact,
				"stock_id"			=>	$stock_id,
				"item_id"			=>	$item_id,
				"ret_id"			=>	"{$ben_id}/{$time}/{$i}",
				"ret_remarks"		=>	$remarks_list[$i-1]
		);
		insert($conn, "returns", $array);
		
		$array=array(
				"return_id"		=>	"{$ben_id}/{$time}/{$i}"
		);
		update($conn, "issue", $array, "stock_id='{$stock_id}' and item_id='{$item_id}'");

	}
	header("Location:GenerateReciept.php?ret_id={$ben_id}/{$time}&acceptor_id={$acceptor_id}&acceptor_name={$acceptor_name}&acceptor_contact={$acceptor_contact}&verifier_id={$verifier_id}&verifier_name={$verifier_name}&verifier_contact={$verifier_contact}&item_list={$_GET['item_list']}");
?>
