<?php 
	include '../../helper/verifier.php';
	verify('admin');
?>
<?php
	$id = $_GET['term'];

	include '../../helper/dbconnector.php';
	$query="SELECT DISTINCT serial_number as id FROM item WHERE serial_number LIKE '%{$id}%' and health='good' and (availablity='fresh' or availablity='returned') ORDER BY id";
	$result=mysqli_query($conn,$query);
	while ($row = mysqli_fetch_assoc($result))
		$data[] = $row['id'];
	
	$query="SELECT DISTINCT product_number as id FROM item WHERE product_number LIKE '%{$id}%' and health='good' and (availablity='fresh' or availablity='returned') ORDER BY id";
	$result=mysqli_query($conn,$query);
	while ($row = mysqli_fetch_assoc($result))
		$data[] = $row['id'];
	//return json data
	echo json_encode($data);
?>