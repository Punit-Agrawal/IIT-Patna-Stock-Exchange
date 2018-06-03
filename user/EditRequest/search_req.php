<?php
	include '../../helper/verifier.php';
	verify('user');
?>
<?php
	//$req_id = $_GET['term'];
$req_id="{$_GET['id']}/{$_SESSION['emp_mail']}/{$time}";
	
	include '../../helper/dbconnector.php';
	
	$query="SELECT * FROM request WHERE req_id LIKE '%".$req_id."%' AND req_mail='{$_SESSION['emp_mail']}@iitp.ac.in' ORDER BY req_id ASC" ;
	$result=mysqli_query($conn,$query) or die ("Query to get data from be_category failed: ".mysqli_error($conn));
	while ($row = mysqli_fetch_assoc($result)) {
	    $data[] = $row['req_id'];//." ".$row['benificiary_type']." ".$row['name'];
	    
	}

	//return json data
	echo json_encode($data);
?>