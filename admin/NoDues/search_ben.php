<?php 
	include '../../helper/verifier.php';
	verify('admin');
?>
<?php
	$ben_id = $_GET['term'];

	include '../../helper/dbconnector.php';
	$query="SELECT DISTINCT SUBSTRING_INDEX(req_id,'/',1) as ben_id FROM issue WHERE SUBSTRING_INDEX(req_id,'/',1) LIKE '%{$ben_id}%' ORDER BY ben_id";
	$result=mysqli_query($conn,$query) or die ("Query to get data from be_category failed: ".mysqli_error($conn));
	while ($row = mysqli_fetch_assoc($result))
	    $data[] = $row['ben_id'];

	//return json data
	echo json_encode($data);
?>