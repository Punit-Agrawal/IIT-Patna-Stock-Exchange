<?php 
	include '../../helper/verifier.php';
	verify('admin');
?>
<?php
	$id = $_GET['term'];

	include '../../helper/dbconnector.php';
	
	$query="SELECT * FROM stocking WHERE stock_id LIKE '%".$id."%' ORDER BY stock_id ASC" ;
	$result=mysqli_query($conn,$query) or die ("Query to get data from be_category failed: ".mysqli_error($conn));
	while ($row = mysqli_fetch_assoc($result)) {
	    $data[] = $row['stock_id'];
	}

	//return json data
	echo json_encode($data);
?>