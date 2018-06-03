<?php 
	include('../../log4php/Logger.php');
	Logger::configure('../../log4phpconfig.xml');
	$log = Logger::getLogger("MessageLogger");
?>
<?php
	include '../../helper/verifier.php';
	verify('admin');
	
	include '../../helper/dbconnector.php';
	include '../../helper/sqlhelper.php';
	$req_id=$_GET['req_id'];
	$issuer_id=$_GET['issuer_id'];
	$issuer_name=$_GET['issuer_name'];
	$item_list=json_decode($_GET['item_list'],false);
	$remarks_list=json_decode($_GET['remarks_list'],false);
	$i=0;
	foreach($item_list as $item){
		$product=explode("/",substr($item,strpos($item,"@")+1))[0]."_alloted";

		$sql="update request set {$product}={$product}+1 where req_id='{$req_id}'";
		mysqli_query($conn,$sql);

		$log->trace("{$_SESSION['user_name']}#Query:{$sql}#{$_SERVER['REMOTE_ADDR']}#{$_SESSION['status']}");
		
		update($conn, "item",array("availablity" => "issued"), "stock_id='".substr($item,0,strpos($item,"@"))."' and item_id='".substr($item,strpos($item,"@")+1)."'");

		$array=array(
				"issuer_id"		=>	$issuer_id,
				"issuer_name"	=>	$issuer_name,
				"stock_id"		=>	substr($item,0,strpos($item,"@")),
				"item_id"		=>	substr($item,strpos($item,"@")+1),
				"admin_remarks"	=>	$remarks_list[$i],
				"req_id"		=>	$req_id,
				"issue_date"	=>	date('Y-m-d'),
		);
		insert($conn, "issue", $array);
		$i++;
	}
	$query="select printer_alloted-printer_qty as p,laptop_alloted-laptop_qty as l,desktop_alloted-desktop_qty as d,access,access_alloted from request where req_id='{$req_id}'";
	$result=mysqli_fetch_assoc(mysqli_query($conn,$query));
	if($result['p']==0&&$result['d']==0&&$result['l']==0&&($result['access']=='no'||$result['access_alloted']=='yes'))
		$array=array("status"=>"Complete");
	else
		$array=array("status"=>"Partially Complete");
	update($conn, "request", $array, "req_id='{$req_id}'");
	header("Location:GenerateReciept.php?req_id={$req_id}&issuer_id={$issuer_id}&issuer_name={$issuer_name}&item_list={$_GET['item_list']}&remarks_list={$_GET['remarks_list']}");
?>
