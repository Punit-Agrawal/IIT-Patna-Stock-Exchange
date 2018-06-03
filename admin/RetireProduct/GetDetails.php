<?php 
		include '../../helper/verifier.php';
		verify('admin');
?>
<?php 
		$id=$_GET['id'];

		include '../../helper/dbconnector.php';
		
		$sql="SELECT * FROM item WHERE product_number='{$id}' or serial_number='{$id}' LIMIT 1";
		$result=mysqli_query($conn, $sql);
		$item_data=mysqli_fetch_assoc($result);
		
		$sql="SELECT * FROM stocking WHERE stock_id='{$item_data['stock_id']}'";
		$result=mysqli_query($conn, $sql);
		$stock_data=mysqli_fetch_assoc($result);
		$table=
"<table style='border:1px solid;font-size: 25px;text-align: center;'>
	<tr>
		<td style='border:1px solid;'>Stock ID</td>
		<td style='border:1px solid;'>Item ID</td>
		<td style='border:1px solid;'>Purchase Order</td>
		<td style='border:1px solid;'>Product Number</td>
		<td style='border:1px solid;'>Serial Number</td>
		<td style='border:1px solid;'>Warranty Start</td>
		<td style='border:1px solid;'>Warranty End</td>
		<td style='border:1px solid;'>Availablity</td>
		<td style='border:1px solid;'>Remarks</td>
		<td style='border:1px solid;'></td>
		</tr>
	<tr style='border: 1px solid'>
		<td id='stock_id' style='border:1px solid'>{$item_data['stock_id']}</td>
		<td id='item_id' style='border:1px solid'>{$item_data['item_id']}</td>
		<td id='po_id' style='border:1px solid'>{$stock_data['po_id']}</td>
		<td id='pno' style='border:1px solid'>{$item_data['product_number']}</td>
		<td id='sno' style='border:1px solid'>{$item_data['serial_number']}</td>
		<td id='warr_s' style='border:1px solid'>{$item_data['warranty_start']}</td>
		<td id='warr_e' style='border:1px solid'>{$item_data['warranty_end']}</td>
		<td id='avail' style='border:1px solid'>{$item_data['availablity']}</td>
		<td style='border:1px solid'>
			<select id='remarks'>
				<option value='EOL' selected>EOL</option>
				<option value='Damaged'>Damaged</option>
			</select>
		</td>
		<td style='border:1px solid' colspan='8'><button id=btn onclick=retire()>Retire</button></td>
	</tr>
</table>
";
		echo $table;
?>