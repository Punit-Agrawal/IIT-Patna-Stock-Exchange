<?php 
	include '../helper/verifier.php';
	verify('hod');
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link href="../css/template.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		<?php
			include '../helper/includer.php';
			echo "<a href='RequestProcess/ViewRequest.php'>Process Requests</a><br/>";
			echo "<a href='RequestArchive/ViewRequest.php'>Archive Requests</a><br/>";
			?>
			<br><br>
			<th><b>Reports</b></th>
			<br>
		<?php
			echo "<a href='../emp_report.php'>View Employee Report</a><br/>";
			echo "<a href='../stud_report.php'>View Student Report</a><br/>";
		?>
	</body>
</html>