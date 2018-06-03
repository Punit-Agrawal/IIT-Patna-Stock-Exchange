<?php
	include '../../helper/verifier.php';
	verify('user');
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
			function change(issuer){
				$(document).ready(function(){
					$("#student_form").slideUp();
					$("#employee_form").slideUp();
					$("#department_form").slideUp();
					$("#"+issuer+"_form").slideDown();
				});
			}
		</script>
		<h1 align="center">Issue Form</h1>
			<table align="center" style="border-spacing: 15px;">
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
						<?php echo $_SESSION['emp_name']?>
					</td>
					<td style="font-size:20px;width:180px;float:left">
						Email
					</td>
					<td style="font-size:20px;width:200px">
						<?php echo $_SESSION['emp_mail']?>@iitp.ac.in
					</td>
				</tr>
				<tr>
					<td style="font-size:20px;width:180px;float:left">
						Department
					</td>
					<td style="font-size:20px;width:200px">
						<?php echo $_SESSION['dept']?>
					</td>
					<td style="font-size:20px;width:180px;float:left">
						Date
					</td>
					<td style="font-size:20px;width:200px">
						<?php echo date("d/m/Y")?>
					</td>
				</tr>
			</table>
		<div style="margin-left: 50px">
			<p>Issue Against</p>
			<input type="radio" onclick=change(this.value) name="issuer" value="student">Student<br/>
			<input type="radio" onclick=change(this.value) name="issuer" value="employee">Employee<br/>
			<input type="radio" onclick=change(this.value) name="issuer" value="department">Department<br/>
		</div>
		<br/>
		<br/>
		<br/>
		

		<form id="student_form" action="SubmitRequest.php" method="get" hidden>
			<input type="text" name="benificiary_type" hidden value="STUDENT">

			<table align="center" style="border-spacing:15px">
				<tr>
					<th colspan="6" style="font-size:30px;">
						Benificiary Details
					</th>
				</tr>
				<tr>
					<td style="font-size:20px;width:180px;float:left">
						Student ID
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="id" required>
					</td>
					<td style="font-size:20px;width:180px;float:left">
						Student Name
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="name" required>
					</td>
				</tr>
				<tr>
					<td style="font-size:20px;width:180px;float:left">
						Department
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<select style="width:200px" name="department" required>
							<option value="CSE">CSE</option>
							<option value="ECE">ECE</option>
							<option value="CE">CE</option>
							<option value="IT">IT</option>
							<option value="ME">ME</option>
							<option value="EE">EE</option>
							<option value="CBE">CBE</option>
							<option value="MSE">MSE</option>
							<option value="CHE">CHE</option>
							<option value="PHY">PHY</option>
							<option value="MA">MA</option>
							<option value="HSS">HSS</option>
							<option value="CEE">CEE</option>
							<option value="CSM">CSM</option>

						</select>
					</td>
					<td style="font-size:20px;width:180px;float:left">
						Room Number
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="room_no" required>
					</td>
				</tr>
				<tr>
					<td style="font-size:20px;width:180px;float:left">
						Block
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="block" required>
					</td>
					<td style="font-size:20px;width:180px;float:left">
						Floor
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="floor" required>
					</td>
				</tr>
				<tr>
					<td style="font-size:20px;width:180px;float:left">
						Email-ID
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="email" name="mail_id" required>
					</td>
					<td style="font-size:20px;width:180px;float:left">
						Mobile
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="mobile" required>
					</td>
				</tr>
				<tr>
					<td style="font-size:20px;width:180px;float:left">
						Alternative Email-ID
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="email" name="alt_mail_id">
					</td>
					<td style="font-size:20px;width:180px;float:left">
						Alternative Mobile
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="alt_mobile">
					</td>
				</tr>
				<tr>
					<td style="font-size:20px;width:180px;float:left">
						PhD category
					</td>		
					<td style="font-size:20px;border:1px solid;width:200px">
						<select style="width:200px" name="PhD_category" required>
							<option value="Not Applicable">Not Applicable</option>
							<option value="Institute (UGC)">Institute (UGC)</option>
							<option value="Institute(CSIR)">Institute(CSIR)</option>
							<option value="Institute fellowship">Institute fellowship</option>
							<option value="Visvesvaraya">Visvesvaraya</option>
						</select>
					</td>					
				</tr>
			</table>
			<br/>

			<table  align="center" style="border:1px solid;border-spacing: 15px;">
				<tr>
					<td style="font-size:20px;width:100px;float:left;">
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
					<td style="font-size:20px;width:100px;float:left">
						Laptop
					</td>
					<td style="font-size:20px;width:40px;">
						<input value="0" style="width:40px" type="number" name="laptop_qty" required>
					</td>
					<td style="font-size:20px;width:180px;">
						<textarea style="height:23px;width:200px" name="laptop_model" required>na</textarea>
					</td>
					<td style="font-size:20px;width:180px;">
						<textarea style="height:23px;width:200px" name="laptop_make" required>na</textarea>
					</td>
				</tr>
				<tr>
					<td style="font-size:20px;width:100px;float:left">
						Desktop
					</td>
					<td style="font-size:20px;width:40px;">
						<input value="0" style="width:40px" type="number" name="desktop_qty" required>
					</td>
					<td style="font-size:20px;width:180px;">
						<textarea style="height:23px;width:200px" name="desktop_model" required>na</textarea>
					</td>
					<td style="font-size:20px;width:180px;">
						<textarea style="height:23px;width:200px" name="desktop_make" required>na</textarea>
					</td>
				</tr>
				<tr>
					<td style="font-size:20px;width:100px;float:left">
						Printer
					</td>
					<td style="font-size:20px;width:40px;">
						<input value="0" style="width:40px" type="number" name="printer_qty" required>
					</td>
					<td style="font-size:20px;width:180px;">
						<textarea style="height:23px;width:200px" name="printer_model" required>na</textarea>
					</td>
					<td style="font-size:20px;width:180px;">
						<textarea style="height:23px;width:200px" name="printer_make" required>na</textarea>
					</td>
				</tr>
			</table>
			<br/>
			<div align="center">
				<input type="radio" name="access" value="Internet" required>Internet Access
				<input type="radio" name="access" value="Email-id"  required>Email-ID
				<input type="radio" name="access" value="No" required selected>None
			</div>
			
			<div align="center" style="margin:10px"><input type="submit" value="Submit Request"></div>
		</form>


		<form id="employee_form" action="SubmitRequest.php" method="get" hidden>
			<input type="text" name="benificiary_type" hidden value="EMPLOYEE">

			<table align="center" style="border-spacing: 15px">
				<tr>
					<th colspan="6" style="font-size:30px;">
						Benificiary Details
					</th>
				</tr>
				<tr>
					<td style="font-size:20px;width:180px;float:left">
						Employee ID
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="id" required>
					</td>
					<td style="font-size:20px;width:180px;float:left">
						Employee Name
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="name" required>
					</td>
				</tr>
				<tr>
					<td style="font-size:20px;width:180px;float:left">
						Department
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<select style="width:200px" name="department" required>
							<option value="CSE">CSE</option>
							<option value="ECE">ECE</option>
							<option value="CE">CE</option>
							<option value="IT">IT</option>
							<option value="ME">ME</option>
							<option value="EE">EE</option>
							<option value="CBE">CBE</option>
							<option value="MSE">MSE</option>
							<option value="CHE">CHE</option>
							<option value="PHY">PHY</option>
							<option value="MA">MA</option>
							<option value="HSS">HSS</option>
							<option value="CEE">CEE</option>
							<option value="CSM">CSM</option>
							<option value="CASE">CASE</option>
							<option value="Academics">Academics</option>
							<option value="Hostel">Hostel</option>
							<option value="Girl's Hostel">Girl's Hostel</option>
							<option value="library">library</option>
							<option value="Sports Gymkhana">Sports Gymkhana</option>
							<option value="Guesthouse">Guesthouse</option>
							<option value="SAIF">SAIF</option>
							<option value="IWD">IWD</option>
							<option value="RnD">RnD</option>
							<option value="Admin">Admin</option>
							<option value="TnP">TnP</option>
							<option value="Hospital">Hospital</option>
							<option value="Directorate">Directorate</option>
							<option value="CC">CC</option>
							<option value="SnP">SnP</option>
							<option value="Audit">Audit</option>
							<option value="Registrar Office">Registrar Office</option>
							<option value="Accounts">Accounts</option>
							<option value="Security Unit">Security Unit</option>
						</select>
					</td>
					<td style="font-size:20px;width:180px;float:left">
						Room Number
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="room_no" required>
					</td>
				</tr>
				<tr>
					<td style="font-size:20px;width:180px;float:left">
						Block
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="block" required>
					</td>
					<td style="font-size:20px;width:180px;float:left">
						Floor
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="floor" required>
					</td>
				</tr>
				<tr>
					<td style="font-size:20px;width:180px;float:left">
						Email-ID
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="email" name="alt_mail_id" required>
					</td>
					<td style="font-size:20px;width:180px;float:left">
						Mobile
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="alt_mobile" required>
					</td>
				</tr>
				<tr>
					<td style="font-size:20px;width:180px;float:left">
						Alternative Email-ID
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="email" name="mail_id" required>
					</td>
					<td style="font-size:20px;width:180px;float:left">
						Alternative Mobile
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="mobile" required>
					</td>
				</tr>
			</table>
			<br/>
			<table  align="center" style="border:1px solid;border-spacing: 15px;">
				<tr>
					<td style="font-size:20px;width:100px;float:left;">
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
					<td style="font-size:20px;width:100px;float:left">
						Laptop
					</td>
					<td style="font-size:20px;width:40px;">
						<input value="0" style="width:40px" type="number" name="laptop_qty" required>
					</td>
					<td style="font-size:20px;width:180px;">
						<textarea style="height:23px;width:200px" name="laptop_model" required>na</textarea>
					</td>
					<td style="font-size:20px;width:180px;">
						<textarea style="height:23px;width:200px" name="laptop_make" required>na</textarea>
					</td>
				</tr>
				<tr>
					<td style="font-size:20px;width:100px;float:left">
						Desktop
					</td>
					<td style="font-size:20px;width:40px;">
						<input value="0" style="width:40px" type="number" name="desktop_qty" required>
					</td>
					<td style="font-size:20px;width:180px;">
						<textarea style="height:23px;width:200px" name="desktop_model" required>na</textarea>
					</td>
					<td style="font-size:20px;width:180px;">
						<textarea style="height:23px;width:200px" name="desktop_make" required>na</textarea>
					</td>
				</tr>
				<tr>
					<td style="font-size:20px;width:100px;float:left">
						Printer
					</td>
					<td style="font-size:20px;width:40px;">
						<input value="0" style="width:40px" type="number" name="printer_qty" required>
					</td>
					<td style="font-size:20px;width:180px;">
						<textarea style="height:23px;width:200px" name="printer_model" required>na</textarea>
					</td>
					<td style="font-size:20px;width:180px;">
						<textarea style="height:23px;width:200px" name="printer_make" required>na</textarea>
					</td>
				</tr>
			</table>
			<br/>
			<div align="center">
				<input type="radio" name="access" value="Internet" required>Internet Access
				<input type="radio" name="access" value="Email-id"  required>Email-ID
				<input type="radio" name="access" value="No" selected required>None
			</div>
			

			<div align="center" style="margin:10px"><input type="submit" value="Submit Request"></div>
		</form>


		<form id="department_form" action="SubmitRequest.php" method="get" hidden>
			<input type="text" name="benificiary_type" hidden value="DEPARTMENT">


			<table align="center" style="border-spacing: 15px">
				<tr>
					<th colspan="6" style="font-size:30px;">
						Benificiary Details
					</th>
				</tr>
				<tr>
					<td style="font-size:20px;width:180px;float:left">
						Representor ID
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="id" required>
					</td>
					<td style="font-size:20px;width:180px;float:left">
						Representor Name
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="name" required>
					</td>
				</tr>
				<tr>
					<td style="font-size:20px;width:180px;float:left">
						Department
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<select style="width:200px" name="department" required>
							<option value="CSE">CSE</option>
							<option value="ECE">ECE</option>
							<option value="CE">CE</option>
							<option value="IT">IT</option>
							<option value="ME">ME</option>
							<option value="EE">EE</option>
							<option value="CBE">CBE</option>
							<option value="MSE">MSE</option>
							<option value="CHE">CHE</option>
							<option value="PHY">PHY</option>
							<option value="MA">MA</option>
							<option value="HSS">HSS</option>
							<option value="CEE">CEE</option>
							<option value="CSM">CSM</option>
							<option value="CASE">CASE</option>
							<option value="Academics">Academics</option>
							<option value="Hostel">Hostel</option>
							<option value="Girl's Hostel">Girl's Hostel</option>
							<option value="library">library</option>
							<option value="Sports Gymkhana">Sports Gymkhana</option>
							<option value="Guesthouse">Guesthouse</option>
							<option value="SAIF">SAIF</option>
							<option value="IWD">IWD</option>
							<option value="RnD">RnD</option>
							<option value="Admin">Admin</option>
							<option value="TnP">TnP</option>
							<option value="Hospital">Hospital</option>
							<option value="Directorate">Directorate</option>
							<option value="CC">CC</option>
							<option value="SnP">SnP</option>
							<option value="Audit">Audit</option>
							<option value="Registrar Office">Registrar Office</option>
							<option value="Accounts">Accounts</option>
						</select>
					</td>
					<td style="font-size:20px;width:180px;float:left">
						Room Number
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="room_no" required>
					</td>
				</tr>
				<tr>
					<td style="font-size:20px;width:180px;float:left">
						Block
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="block" required>
					</td>
					<td style="font-size:20px;width:180px;float:left">
						Floor
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="floor" required>
					</td>
				</tr>
				<tr>
					<td style="font-size:20px;width:180px;float:left">
						Email-ID
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="email" name="mail_id" required>
					</td>
					<td style="font-size:20px;width:180px;float:left">
						Mobile
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="mobile" required>
					</td>
				</tr>
				<tr>
					<td style="font-size:20px;width:180px;float:left">
						Alternative Email-ID
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="email" name="alt_mail_id" required>
					</td>
					<td style="font-size:20px;width:180px;float:left">
						Alternative Mobile
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="alt_mobile" required>
					</td>
				</tr>
			</table>
			<br/>
			<table  align="center" style="border:1px solid;border-spacing: 15px;">
				<tr>
					<td style="font-size:20px;width:100px;float:left;">
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
					<td style="font-size:20px;width:100px;float:left">
						Laptop
					</td>
					<td style="font-size:20px;width:40px;">
						<input value="0" style="width:40px" type="number" name="laptop_qty" required>
					</td>
					<td style="font-size:20px;width:180px;">
						<textarea style="height:23px;width:200px" name="laptop_model" required>na</textarea>
					</td>
					<td style="font-size:20px;width:180px;">
						<textarea style="height:23px;width:200px" name="laptop_make" required>na</textarea>
					</td>
				</tr>
				<tr>
					<td style="font-size:20px;width:100px;float:left">
						Desktop
					</td>
					<td style="font-size:20px;width:40px;">
						<input value="0" style="width:40px" type="number" name="desktop_qty" required>
					</td>
					<td style="font-size:20px;width:180px;">
						<textarea style="height:23px;width:200px" name="desktop_model" required>na</textarea>
					</td>
					<td style="font-size:20px;width:180px;">
						<textarea style="height:23px;width:200px" name="desktop_make" required>na</textarea>
					</td>
				</tr>
				<tr>
					<td style="font-size:20px;width:100px;float:left">
						Printer
					</td>
					<td style="font-size:20px;width:40px;">
						<input value="0" style="width:40px" type="number" name="printer_qty" required>
					</td>
					<td style="font-size:20px;width:180px;">
						<textarea style="height:23px;width:200px" name="printer_model" required>na</textarea>
					</td>
					<td style="font-size:20px;width:180px;">
						<textarea style="height:23px;width:200px" name="printer_make" required>na</textarea>
					</td>
				</tr>
			</table>
			<br/>
			<div align="center">
				<input type="radio" name="access" value="Internet" required>Internet Access
				<input type="radio" name="access" value="Email-id"  required>Email-ID
				<input type="radio" name="access" value="No" required selected>None
			</div>
			

			<div align="center" style="margin:10px"><input type="submit" value="Submit Request"></div>
		</form>
	</body>
</html>