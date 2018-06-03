<?php
	include '../../helper/verifier.php';
	verify('user');
?>
<?php
	include '../../helper/dbconnector.php';
	$req_id="{$_GET['id']}/{$_SESSION['emp_mail']}/{$time}";
	
	$req_id=$_GET['req_id'];
	$check_query="select * from request where req_id='{$req_id}' and req_mail='{$_SESSION['emp_mail']}@iitp.ac.in'";
	$result=mysqli_query($conn, $check_query);
	$row = mysqli_fetch_assoc($result);
	if($row==null)
		echo 'false';
	else{
		$table=
"<table style='border:1px solid;font-size: 25px;text-align: center;'>
	<tr>
		<td style='border:1px solid;'></td>
		<td style='border:1px solid;'>Request ID</td>
		<td style='border:1px solid;'>Requesting Department</td>
		<td style='border:1px solid;'>Request For</td>
		<td style='border:1px solid;'>Dept HOD Approval</td>
		<td style='border:1px solid;'>CC HOD Approval</td>
		<td style='border:1px solid;'>Status</td>
	</tr>
	<tr style='border: 1px solid' id='main_row_1'>
		<td><button type='button' id='exp_1' onclick='expand(1,1)'>+</button></td>
		<td id='req_id_1' style='border:1px solid'>{$row['req_id']}</td>
		<td style='border:1px solid'>{$row['req_dept']}</td>
		<td style='border:1px solid'>{$row['benificiary_type']}</td>
		<td style='border:1px solid'>{$row['dept_hod_approval']}</td>
		<td style='border:1px solid'>{$row['cc_hod_approval']}</td>
		<td style='border:1px solid'>{$row['status']}</td>
	</tr>
	<tr style='display:none;' id='adv_row_1'>
		<td style='border:1px solid' colspan='7'>
			<table align='center'>
				<tr>
					<th colspan='4' style='font-size:30px;'>
					Requester Details
					</th>
				</tr>
				<tr>
					<td style='font-size:20px;width:180px;float:left'>
						Name
					</td>
					<td style='font-size:20px;width:200px'>
						{$row['req_name']}
					</td>
					<td style='font-size:20px;width:180px;float:left'>
						Email
					</td>
					<td style='font-size:20px;width:200px'>
						{$row['req_mail']}
					</td>
				</tr>
				<tr>
					<td style='font-size:20px;width:180px;float:left'>
						Department
					</td>
					<td style='font-size:20px;width:200px'>
						{$row['req_dept']}
					</td>
					<td style='font-size:20px;width:180px;float:left'>
						Date
					</td>
					<td style='font-size:20px;width:200px'>
						{$row['req_date']}
					</td>
				</tr>
			</table>
			<table align='center' style='border-spacing: 15px'>
				<tr>
					<th colspan='4' style='font-size:30px;'>
						Benificiary Details
					</th>
				</tr>
				<tr>
					<td style='font-size:20px;width:180px;float:left'>
						{$row['benificiary_type']} ID
					</td>
					<td style='font-size:20px;width:200px'>
						{$row['id']}
					</td>
					<td style='font-size:20px;width:180px;float:left'>
						{$row['benificiary_type']} Name
					</td>
					<td style='font-size:20px;width:200px'>
						{$row['name']}
					</td>
				</tr>
				<tr>
					<td style='font-size:20px;width:180px;float:left'>
						Department
					</td>
					<td style='font-size:20px;width:200px'>
						{$row['department']}
					</td>
					<td style='font-size:20px;width:180px;float:left'>
						Block
					</td>
					<td style='font-size:20px;width:200px'>
						{$row['block']}
					</td>
				</tr>
				<tr>
					<td style='font-size:20px;width:180px;float:left'>
						Floor
					</td>
						<td style='font-size:20px;width:200px'>
							{$row['floor']}
					</td>
					<td style='font-size:20px;width:180px;float:left'>
						Room Number
					</td>
					<td style='font-size:20px;width:200px'>
							{$row['room_no']}
					</td>
				</tr>
				<tr>
					<td style='font-size:20px;width:180px;float:left'>
						EmailID
					</td>
					<td style='font-size:20px;width:200px'>
						{$row['mail_id']}
					</td>
					<td style='font-size:20px;width:180px;float:left'>
						Mobile
					</td>
					<td style='font-size:20px;width:200px'>
						{$row['mobile']}
					</td>
				</tr>
				<tr>
					<td style='font-size:20px;width:180px;float:left'>
						Alternative-EmailID
					</td>
					<td style='font-size:20px;width:200px'>
						{$row['alt_mail_id']}
					</td>
					<td style='font-size:20px;width:180px;float:left'>
						Alternative Mobile
					</td>
					<td style='font-size:20px;width:200px'>
						{$row['alt_mobile']}
					</td>
				</tr>
				</table>
			<table  align='center' style='border:1px solid;border-spacing: 15px;'>
				<tr>
					<td style='font-size:20px;width:100px;margin-left:50px;float:left;'>
						Items
					</td>
					<td style='font-size:20px;width:40px;'>
						Qty
					</td>
					<td style='font-size:20px;width:180px;'>
						Model
					</td>
					<td style='font-size:20px;width:180px;'>
						Make
					</td>
				</tr>
				<tr>
					<td style='font-size:20px;width:100px;margin-left:50px;float:left'>
						Laptop
					</td>
					<td style='font-size:20px;width:40px;'>
						{$row['laptop_qty']}
					</td>
					<td style='font-size:20px;width:180px;'>
						{$row['laptop_model']}
					</td>
					<td style='font-size:20px;width:180px;'>
						{$row['laptop_make']}
					</td>
				</tr>
				<tr>
					<td style='font-size:20px;width:100px;margin-left:50px;float:left'>
						Desktop
					</td>
					<td style='font-size:20px;width:40px;'>
						{$row['desktop_qty']}
					</td>
					<td style='font-size:20px;width:180px;'>
						{$row['desktop_model']}
					</td>
					<td style='font-size:20px;width:180px;'>
						{$row['desktop_make']}
					</td>
				</tr>
				<tr>
					<td style='font-size:20px;width:100px;margin-left:50px;float:left'>
						Printer
					</td>
					<td style='font-size:20px;width:40px;'>
						{$row['printer_qty']}
					</td>
					<td style='font-size:20px;width:180px;'>
						{$row['printer_model']}
					</td>
					<td style='font-size:20px;width:180px;'>
						{$row['printer_make']}
					</td>
				</tr>
				<tr>
					<td colspan='4' style='font-size:20px;width:180px;' align='center'>
						{$row['access']} service required
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>";
		echo $table;
	}
?>
