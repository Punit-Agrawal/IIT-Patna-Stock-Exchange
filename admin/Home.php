<?php 
	include '../helper/verifier.php';
	verify('admin');
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link href="../css/template.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		<?php
			include '../helper/includer.php';
			echo "<a href='StockEntry/StockEntry.php'>Stock Entry</a><br/>";
			echo  "<a href ='SearchUpdate/Search.php'>Stock Wise Search	/ Update Items</a><br/>";
			echo  "<a href ='ItemWiseSearch/Search.php'>Item Wise Search</a><br/>";
			echo "<a href='AllotItems/Allot.php'>Allot Items</a><br/>";
			//echo "<a href='AllotItems/Allot_manual.php'>Allot Items Manually</a><i> (when item not available in stock)</i><br/>";
			echo "<a href='ReturnItems/ReturnForm.php'>Return Items</a><br/>";
			echo "<a href='NoDues/NoDuesForm.php'>Check No Dues</a><br/>";
			echo "<a href='RetireProduct/RetireForm.php'>Retire Product</a><br/>";
			
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