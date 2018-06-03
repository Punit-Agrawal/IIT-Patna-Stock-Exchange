<?php
	include '../../helper/verifier.php';
	verify('user');
	include '../../helper/includer.php';
?>
<?php 
	include '../../helper/dbconnector.php';
	$query="SELECT * FROM request WHERE req_id='{$_GET['req_id']}' and req_mail='{$_SESSION['emp_mail']}@iitp.ac.in'";
	$result=mysqli_fetch_assoc(mysqli_query($conn, $query));
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link href="../../css/template.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	</head>
	
	
	<body style="float: left;margin-left: 50px;margin-top: 20px">
		<h1 align="center"><?php echo $result['benificiary_type']?> REQUEST</h1>
		<h2 style="float:left;margin-left: 10px">Request ID:
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php echo $result['req_id']?></h2>
		<br/>
		<br/>
		<br/>
		<br/>
		<div align="center">
		<table align="center" style="border-spacing: 15px">
			<tr>
				<th colspan="4" style="font-size:30px;">
					Requester Details
				</th>
			</tr>
			<tr>
				<td style="font-size:20px;width:180px;float:left">
					Name
				</td>
				<td style="font-size:20px;width:200px">
					<?php echo $result['req_name']?>
				</td>
				<td style="font-size:20px;width:180px;float:left">
					Email
				</td>
				<td style="font-size:20px;width:200px">
					<?php echo $result['req_mail']?>
				</td>
			</tr>
			<tr>
				<td style="font-size:20px;width:180px;float:left">
					Department
				</td>
				<td style="font-size:20px;width:200px">
				<?php echo $result['req_dept']?>
				</td>
				<td style="font-size:20px;width:180px;float:left">
					Date
				</td>
				<td style="font-size:20px;width:200px">
					<?php echo $result['req_date']?>
				</td>
			</tr>
		</table>
			<table style="border-spacing: 15px">
			<tr>
				<th colspan="6" style="font-size:30px;">
					Beneficiary Details
				</th>
			</tr>
			<tr>
				<td style="font-size:20px;width:180px;float:left">
					<?php echo $result['benificiary_type']?> ID
				</td>
				<td style="font-size:20px;width:200px">
					<?php echo $result['id']?>
				</td>
				<td style="font-size:20px;width:180px;float:left">
					<?php echo $result['benificiary_type']?> Name
				</td>
				<td style="font-size:20px;width:200px">
					<?php echo $result['name']?>
				</td>
			</tr>
			<tr>
				<td style="font-size:20px;width:180px;float:left">
					Department
				</td>
				<td style="font-size:20px;width:200px">
					<?php echo $result['department']?>
				</td>
				<td style="font-size:20px;width:180px;float:left">
					Room Number
				</td>
				<td style="font-size:20px;width:200px">
						<?php echo $result['room_no']?>
				</td>
			</tr>
			<tr>
				<td style="font-size:20px;width:180px;float:left">
					Block
				</td>
				<td style="font-size:20px;width:200px">
					<?php echo $result['block']?>
				</td>
				<td style="font-size:20px;width:180px;float:left">
					Floor
				</td>
					<td style="font-size:20px;width:200px">
						<?php echo $result['floor']?>
				</td>
			</tr>
			<tr>
				<td style="font-size:20px;width:180px;float:left">
					Mobile
				</td>
				<td style="font-size:20px;width:200px">
					<?php echo $result['mobile']?>
				</td>
				<td style="font-size:20px;width:180px;float:left">
					Mobile
				</td>
				<td style="font-size:20px;width:200px">
					<?php echo $result['alt_mobile']?>
				</td>
			</tr>
			<tr>
				<td style="font-size:20px;width:180px;float:left">
					Email-ID
				</td>
				<td style="font-size:20px;width:200px">
					<?php echo $result['mail_id']?>
				</td>
				<td style="font-size:20px;width:180px;float:left">
					Alternative Email-ID
				</td>
				<td style="font-size:20px;width:200px">
					<?php echo $result['alt_mail_id']?>
				</td>
			</tr>
			<?php 
				if($result['benificiary_type']=='STUDENT')
			//		var_dump($result['benificiary_type']);
				{
					?>
					<tr>
					<td style="font-size:20px;width:180px;float:left">
					PhD category
				</td>
				<td style="font-size:20px;width:200px">
					<?php echo $result['PhD_category']?>
				</td>
				</tr>
				<?php }
			?>
		</table>
		<br/>
		<table  align="center" style="border:1px solid;border-spacing: 15px;">
			<tr>
				<td style="font-size:20px;width:100px;margin-left:50px;float:left;">
					Items
				</td>
				<td style="font-size:20px;width:40px;">
					Qty
				</td>
				<td style="font-size:20px;width:180px;">
					Model
				</td>
				<td style="font-size:20px;width:180px;">
					Make
				</td>
			</tr>
			<tr>
				<td style="font-size:20px;width:100px;margin-left:50px;float:left">
					Laptop
				</td>
				<td style="font-size:20px;width:40px;">
					<?php echo $result['laptop_qty']?>
				</td>
				<td style="font-size:20px;width:180px;">
					<?php echo $result['laptop_model']?>
				</td>
				<td style="font-size:20px;width:180px;">
					<?php echo $result['laptop_make']?>
				</td>
			</tr>
			<tr>
				<td style="font-size:20px;width:100px;margin-left:50px;float:left">
					Desktop
				</td>
				<td style="font-size:20px;width:40px;">
					<?php echo $result['desktop_qty']?>
				</td>
				<td style="font-size:20px;width:180px;">
					<?php echo $result['desktop_model']?>
				</td>
				<td style="font-size:20px;width:180px;">
					<?php echo $result['desktop_make']?>
				</td>
			</tr>
			<tr>
				<td style="font-size:20px;width:100px;margin-left:50px;float:left">
					Printer
				</td>
				<td style="font-size:20px;width:40px;">
					<?php echo $result['printer_qty']?>
				</td>
				<td style="font-size:20px;width:180px;">
					<?php echo $result['printer_model']?>
				</td>
				<td style="font-size:20px;width:180px;">
					<?php echo $result['printer_make']?>
				</td>
			</tr>
		</table></div>
		<br/>
		<b>Facilities Required</b>
		<br/>
		<br/>
		<?php echo $result['access']?>
		<br/>
		<br/>
		<b style="float:left">Beneficiary Signature:____________</b>
		<b style="margin-right: 10%;float:right">Requester Signature:____________</b>
		<br/>
		<br/>
		<br/>
		<br/>
		<b style="float:left">Department HOD Signature:____________</b>
		<b style="margin-right: 10%;float:right">HOD, CC Signature:____________</b>
		<script>
			print();
		</script>
	</body>
</html>