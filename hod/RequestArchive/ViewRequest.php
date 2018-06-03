<?php 
	include '../../helper/verifier.php';
	verify('hod');
	include '../../helper/includer.php';
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
	<body>
		<script>
			function expand(row_num,total){
				if(document.getElementById("adv_row_"+row_num).style.display==''){
					document.getElementById("adv_row_"+row_num).style.display='none';
					document.getElementById("exp_"+row_num).innerHTML='+';
				}
				else{
					for(i=1;i<=total;i++){
						document.getElementById("adv_row_"+i).style.display='none';
						document.getElementById("exp_"+i).innerHTML='+';
					}
					document.getElementById("adv_row_"+row_num).style.display='';
					document.getElementById("exp_"+row_num).innerHTML='-';
				}
			}
		</script>
<?php 
	include '../../helper/dbconnector.php';
	$hod_query="select dept from heads where off_email='{$_SESSION['hod_id']}'";
	$result=mysqli_query($conn, $hod_query);
	$row = mysqli_fetch_assoc($result);
	$branch = $row['dept'];
	if($branch=='CC')
		$request_query="select * from request order by benificiary_type,req_date";
	else
		$request_query="select * from request where req_dept='{$branch}' order by benificiary_type,req_date";
	$requests=mysqli_query($conn, $request_query);
	$no_of_requests=mysqli_num_rows($requests);
	if($no_of_requests==0){
		echo "No Archive Request<br/><br/>";
		echo "<a href='../Home.php'>Back to Home</a>";
	}
	else{
		$table=
"<table style='border:1px solid;font-size: 25px;text-align: center;'>
	<tr>
		<td style='border:1px solid;'></td>
		<td style='border:1px solid;'>Request ID</td>
		<td style='border:1px solid;'>Requesting Department</td>
		<td style='border:1px solid;'>Request For</td>
		<td style='border:1px solid;'>Dept Approval</td>
		<td style='border:1px solid;'>CC Approval</td>
		<td style='border:1px solid;'>Status</td>
	</tr>
";
		$i=0;
		while($row = mysqli_fetch_array($requests, MYSQLI_ASSOC)) {
			$i++;
			$table.=
"	<tr style='border: 1px solid' id='main_row_{$i}'>
		<td><button type='button' id='exp_{$i}' onclick='expand({$i},{$no_of_requests})'>+</button></td>
		<td id='req_id_{$i}' style='border:1px solid'>{$row['req_id']}</td>
		<td style='border:1px solid'>{$row['req_dept']}</td>
		<td style='border:1px solid'>{$row['benificiary_type']}</td>
		<td style='border:1px solid'>{$row['dept_hod_approval']}</td>
		<td style='border:1px solid'>{$row['cc_hod_approval']}</td>
		<td style='border:1px solid'>{$row['status']}</td>
		</tr>
";
			$table.=
"	<tr style='display:none;' id='adv_row_{$i}'>
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
				<tr>
					<td style='font-size:20px;width:180px;float:left'>
						Dept HOD Remarks
					</td>
					<td style='font-size:20px;width:200px'>
						{$row['dept_hod_remarks']}
					</td>
					<td style='font-size:20px;width:180px;float:left'>
						CC HOD Remarks
					</td>
					<td style='font-size:20px;width:200px'>
						{$row['cc_hod_remarks']}
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
					<td style='font-size:20px;width:180px;'>
						Alloted
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
					<td style='font-size:20px;width:180px;'>
						{$row['laptop_alloted']}
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
					<td style='font-size:20px;width:180px;'>
						{$row['desktop_alloted']}
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
					<td style='font-size:20px;width:180px;'>
						{$row['printer_alloted']}
					</td>
				</tr>
				<tr>
					<td colspan='5' style='font-size:20px;width:180px;' align='center'>
						{$row['access']} service required
					</td>
				</tr>
			</table>
";
			if(!($row['printer_alloted']==0&&$row['desktop_alloted']==0&&$row['laptop_alloted']==0)){
				$table.=
"			<table  align='center' style='border-spacing: 15px;'>
				<tr>
					<td style='font-size:20px;width:150px;'>
						Stock ID
					</td>
					<td style='font-size:20px;width:150px;'>
						Item ID
					</td>
					<td style='font-size:20px;width:180px;'>
						Admin Remarks
					</td>
				</tr>
";
				$issue_query="select * from issue where req_id='{$row['req_id']}' and stock_id!='email-id' and stock_id!='internet'";
				$issues=mysqli_query($conn, $issue_query);
				while($issue_data=mysqli_fetch_assoc($issues)){
					$table.=
"				<tr>
					<td style='font-size:20px;width:150px;'>
						{$issue_data['stock_id']}
					</td>
					<td style='font-size:20px;width:150px;'>
						{$issue_data['item_id']}
					</td>
					<td style='font-size:20px;width:180px;'>
						{$issue_data['admin_remarks']}
					</td>
				</tr>
";
				}
				$table.=
"			</table>
		</td>
";
			}
			$table.=
"	</tr>
";
		}
		$table.=
"</table>
";
	echo $table;
	}
?>
		
	</body>
</html>