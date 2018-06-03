<?php
	include '../../helper/verifier.php';
	verify('admin');

	$req_id = $_GET['term'];

	include '../../helper/dbconnector.php';
	
	$query="SELECT * FROM request WHERE req_id LIKE '%".$req_id."%' and cc_hod_approval='yes' and status!='Complete' ORDER BY req_id ASC" ;
	$result=mysqli_query($conn,$query) or die ("Query to get data from be_category failed: ".mysqli_error($conn));
	while ($row = mysqli_fetch_assoc($result)) {
	    $data[] = $row['req_id'];
	}

	//return json data
	echo json_encode($data);
?>