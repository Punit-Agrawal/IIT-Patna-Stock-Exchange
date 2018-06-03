<?php 
	include '../../helper/verifier.php';
	verify('admin');
?>
<?php 
		$ben_id=$_GET['ben_id'];

		include '../../helper/dbconnector.php';
		
		$check_query="select * from issue where return_id='' and SUBSTRING_INDEX(req_id,'/',1)='{$ben_id}' and item_id != 'internet' and item_id!='email-id'";
		$rows_of_benif=mysqli_query($conn, $check_query);
		$count_rows_benif=mysqli_num_rows($rows_of_benif);
		$table=
"<table style='border:1px solid;font-size: 25px;text-align: center;'>
	<tr>
		<td style='border:1px solid;'>Purchase Order</td>
		<td style='border:1px solid;'>Stock ID</td>
		<td style='border:1px solid;'>Item ID</td>
		<td style='border:1px solid;'>Serial Number</td>
		<td style='border:1px solid;'>Product Number</td>
		<td style='border:1px solid;'>Admin Remarks</td>		
		<td style='border:1px solid;'></td>
	</tr>
";
		
		$i=0;
		while($row=mysqli_fetch_array($rows_of_benif, MYSQLI_ASSOC)){
			$i++;

			$sql="SELECT * FROM stocking WHERE stock_id='{$row['stock_id']}'";
			$stock_data=mysqli_query($conn, $sql);
			$stock_data=mysqli_fetch_array($stock_data,MYSQLI_ASSOC);
			
			$sql="SELECT * FROM item WHERE stock_id='{$row['stock_id']}' and item_id='{$row['item_id']}'";
			$item_data=mysqli_query($conn, $sql);
			$item_data=mysqli_fetch_array($item_data,MYSQLI_ASSOC);
			
			$sql="SELECT * FROM request WHERE req_id='{$row['req_id']}'";
			$req_data=mysqli_query($conn, $sql);
			$req_data=mysqli_fetch_array($req_data,MYSQLI_ASSOC);
			
			$po_id=$stock_data['po_id'];
			$stock_id=$row['stock_id'];
			$item_id=$row['item_id'];
			$make=$item_data['serial_number'];
			$model=$item_data['product_number'];
			$adminR=$row['admin_remarks'];

			$table.=
"	<tr style='border: 1px solid' id='main_row_{$i}'>
		<td id='po_id_{$i}' style='border:1px solid'>{$po_id}</td>
		<td id='stock_id_{$i}' style='border:1px solid'>{$stock_id}</td>
		<td id='item_id_{$i}' style='border:1px solid'>{$item_id}</td>
		<td id='make_{$i}' style='border:1px solid'>{$make}</td>
		<td id='model_{$i}' style='border:1px solid'>{$model}</td>
		<td id='admin_remarks_{$i}' style='border:1px solid'>{$adminR}</td>
		<td style='border:1px'><button id='btn_{$i}' type='button' onclick=add({$i})>Return</button></td>
	</tr>
";
		}
		$table.=
"</table>
";
		echo $table;
?>