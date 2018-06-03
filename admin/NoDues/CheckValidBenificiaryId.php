<?php 
	include '../../helper/verifier.php';
	verify('admin');
?>
<?php
	include '../../helper/dbconnector.php';
	
	$ben_id=$_GET['ben_id'];
	$check_query="select * from issue where SUBSTRING_INDEX(req_id,'/',1)='{$ben_id}' and item_id != 'internet' and item_id!='email-id'";
	$result=mysqli_query($conn, $check_query);
	$row = mysqli_fetch_assoc($result);
	if($row==null)
		echo 'false';
	else
		echo 'true';
?>