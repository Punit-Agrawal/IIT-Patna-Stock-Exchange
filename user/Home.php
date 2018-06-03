<?php
	include '../helper/verifier.php';
	verify('user');
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link href="../css/template.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		<?php
			include '../helper/includer.php';
			echo "<a href='IssueRequest/IssueForm.php'>Issue Request<br/></a>";
			echo "<a href='RequestTracker/TrackingForm.php'>Track Request<br/></a>";
			echo "<a href='EditRequest/EditRequestForm.php'>Edit Request<br/></a>";
			?>
	</body>
</html>