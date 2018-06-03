<?php 
	include '../../helper/verifier.php';
	verify('admin');
	include '../../helper/includer.php';
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link href="../../css/template.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		<script>
		function  add(){
			var pos=document.getElementById("types").value=+document.getElementById("types").value+ +1;
			var container=document.getElementById("ItemList");
			var div=document.createElement("div");
			div.id="div_"+ +pos;
			div.innerHTML=''+
			'<table style="border:1px solid;">'+
			'	<tr>'+
			'		<td>'+
			'			<select name="type_'+pos+'" style="width:150px;border:1px solid;font-size: 20px">'+
			'				<option value="Printer">Printer</option>'+
			'				<option value="Desktop">Desktop</option>'+
			'				<option value="Laptop">Laptop</option>'+
			'			</select>'+
			'		</td>'+
			'	</tr>'+
			'</table>'+
			'<br/>'+
			'<table id="table_'+pos+'" style="border:1px solid;text-align:center;">'+
			'	<tr>'+
			'		<td style="font-size:15px;border:1px solid">'+
			'			Quantity'+
			'		</td>'+
			'		<td>'+
			'			<input name="qty_'+pos+'" type="number" style="width:200px">'+
			'		</td>'+
			'		<td style="font-size:15px;border:1px solid">'+
			'			Unit Price'+
			'		</td>'+
			'		<td>'+
			'			<input name="unit_'+pos+'" type="text" style="width:200px">'+
			'		</td>'+
			'		<td style="font-size:15px;border:1px solid">'+
			'			Total Price'+
			'		</td>'+
			'		<td>'+
			'			<input name="total_'+pos+'" type="text" style="width:200px">'+
			'		</td>'+
			'	</tr>'+
			'	<tr>'+
			'		<td style="font-size:15px;border:1px solid">'+
			'			Make'+
			'		</td>'+
			'		<td>'+
			'			<textarea name="make_'+pos+'" style="width:200px;height:65px"></textarea>'+
			'		</td>'+
			'		<td style="font-size:15px;border:1px solid">'+
			'			Model'+
			'		</td>'+
			'		<td>'+
			'			<textarea name="model_'+pos+'" style="width:200px;height:65px"></textarea>'+
			'		</td>'+
			'		<td style="font-size:15px;border:1px solid">'+
			'			Description'+
			'		</td>'+
			'		<td>'+
			'			<textarea name="description_'+pos+'" style="width:200px;height:65px"></textarea>'+
			'		</td>'+
			'	</tr>'+
			'	<tr>'+
			'		<td style="font-size:15px;border:1px solid">'+
			'			Warranty Start Date'+
			'		</td>'+
			'		<td>'+
			'			<input name="warr_start_'+pos+'" type="date" style="width:200px">'+
			'		</td>'+
			'		<td style="font-size:15px;border:1px solid">'+
			'			Duration'+
			'		</td>'+
			'		<td>'+
			'			<input name="duration_'+pos+'" type="number" placeholder="months" style="width:200px">'+
			'		</td>'+
			'	</tr>'+
			'</table>';
			div.append(document.createElement("br"));
			div.append(document.createElement("br"));
			container.appendChild(div);
		}
		function remove(){
			var pos=document.getElementById("types").value;
			if(pos==0)
				return;
			var div=document.getElementById("div_"+pos);
			div.parentNode.removeChild(div);
			document.getElementById("types").value=pos-1;
		}
		</script>
		<h1 align="center">STOCK ENTRY FORM</h1>

		<form action="SubmitStock.php" method="get" ><div>
			<table style="border-spacing: 15px">
				<tr>
					<td style="font-size:20px;width:180px;float:left">
						Register Number
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="reg" required>
					</td>
					<td style="font-size:20px;width:180px;float:left">
						Page Number
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="page" required>
					</td>
					<td style="font-size:20px;width:180px;float:left">
						Entry Number
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="sno" required>
					</td>
				</tr>
				<tr>
					<td style="font-size:20px;width:180px;float:left">
						Purchase Order
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="po_number" required>
					</td>
					<td style="font-size:20px;width:180px;float:left">
						Location
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<select style="width:200px" name="loc">
							<option value="">--------</option>
							<option value="location1">Block 9 Store Room</option>
							<option value="location2">Institute Campus</option>
							<option value="location3">Location 3</option>
						</select>
					</td>
					<td style="font-size:20px;width:180px;float:left">
						Bill Number
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="bill" required>
					</td>
				</tr>
				<tr>
					<td style="font-size:20px;width:180px;float:left">
						Supplier's Name
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="supp_name" required>
					</td>
				</tr>
				<tr>
					<td style="font-size:20px;width:180px;float:left">
						Supplier's Address
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="supp_add1" required>
					</td>
					<td style="font-size:20px;width:180px;float:left">
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="supp_add2">
					</td>
					<td style="font-size:20px;width:180px;float:left">
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="supp_add3">
					</td>
				</tr>
				<tr>
					<td style="font-size:20px;width:180px;float:left">
						Pincode
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="pincode">
					</td>
					<td style="font-size:20px;width:180px;float:left">
						Supplier's Email
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="supp_mail">
					</td>
					<td style="font-size:20px;width:180px;float:left">
						Supplier's Phone
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="supp_phone">
					</td>
				</tr>
				<tr>
					<td style="font-size:20px;width:180px;float:left">
						Indentor's Name
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="indentor" required>
					</td>
					<td style="font-size:20px;width:180px;float:left">
						Reciever's Name
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="reciever" required>
					</td>
				</tr>
				<tr>
					<td style="font-size:20px;width:180px;float:left">
						Recieve Date
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="date" name="recieve_date" required>
					</td>
					<td style="font-size:20px;width:180px;float:left">
						Recieving Place
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="place" required>
					</td>
					<td rowspan="2" style="font-size:20px;width:180px;float:left">
							Remarks
					</td>
					<td rowspan="2" style="font-size:20px;border:1px solid;width:200px">
						<textarea style="width:200px;height:65px" name="remarks"></textarea>
					</td>
				</tr>
				<tr>
					<td style="font-size:20px;width:180px;float:left">
						Entered By
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="entered" required>
					</td>
					<td style="font-size:20px;width:180px;float:left">
						Checked By
					</td>
					<td style="font-size:20px;border:1px solid;width:200px">
						<input style="width:200px" type="text" name="checked" required>
					</td>
				</tr>
			</table>
			</div>
			<br/>
			<div>
			<div id="ItemList" style="margin:5px;"></div>



			<input name="types" type="text" id="types" value="0" style="visibility: hidden;">
			<div align="center">
			
			<button type="button" name="Add" id="Add" onclick="add()">Add Item</button>
			<button name="Add" type="button" id="Add" onclick="remove()" style="margin:5px">Remove Item</button></div>
			
			</div>

			<div align="center" style="margin:10px"><input type="submit" value="Enter Stock"></div>
		</form>
	</body>
</html>
