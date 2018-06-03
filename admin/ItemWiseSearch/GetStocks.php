<?php 
	include '../../helper/verifier.php';
	verify('admin');
	
	$item_type=$_GET['item_type'];

		include '../../helper/dbconnector.php';
		
		$sql="SELECT DISTINCT stock_id FROM item WHERE ";
		$i=0;
		foreach($item_type as $item){
			if($i==0)
				$sql.="(";
			$sql.="SUBSTRING_INDEX(item_id,'/',1)='{$item}'";
			if($i==sizeof($item_type)-1)
				$sql.=" ) ";
			else
				$sql.=" OR ";
			$i++;
		}
		$rows_of_sid=mysqli_query($conn, $sql);
		$count_rows_sid=mysqli_num_rows($rows_of_sid);
		$table=
"<table style='border:1px solid;font-size: 25px;text-align: center;'>
	<input type='text' id='total_stock_id' value='{$count_rows_sid}' style='visibility:hidden'>
	<tr>
		<td style='border:1px solid;'></td>
		<td style='border:1px solid;'>Stock ID</td>
		<td style='border:1px solid;'>Purchase Order</td>
		<td style='border:1px solid;'>Availablity</td>
		<td style='border:1px solid;'></td>
		<td style='border:1px solid;'>Filter</td>
	</tr>
";
		
		$i=0;
		while($row=mysqli_fetch_array($rows_of_sid, MYSQLI_ASSOC)){
			$i++;

			$sql="SELECT po_id FROM stocking WHERE stock_id='{$row['stock_id']}'";
			$po_id=mysqli_query($conn, $sql);
			$po_id=mysqli_fetch_array($po_id,MYSQLI_ASSOC)['po_id'];

			$sql="SELECT item_id,make,model,product_number,serial_number,availablity,health FROM item WHERE ";
			$x=0;
			foreach($item_type as $item ){
				if($x==0)
					$sql.=" ( ";
				$sql.="stock_id = '{$row['stock_id']}' AND item_id LIKE'{$item}%' ";
				if($x==sizeof($item_type)-1)
					$sql.=" ) ";
					else
						$sql.=" OR ";
				$x++;
			}
			$sid_item_data=mysqli_query($conn, $sql);
			$count_sid_items=mysqli_num_rows($sid_item_data);
			
			$table.=
"	<tr style='border: 1px solid' id='main_row_{$i}'>
		<input style='visibility:hidden' id='total_item_{$i}' value='{$count_sid_items}'>
		<td><button type='button' id='exp_{$i}' onclick='expand({$i},{$count_rows_sid})'>+</button></td>
		<td id='stock_id_{$i}' style='border:1px solid'>{$row['stock_id']}</td>
		<td style='border:1px solid'>{$po_id}</td>
		<td style='border:1px solid'>{$count_sid_items}</td>
		<td><button type='button'  onclick='update_filters({$i})' style='width:150px;border:1px solid;font-size: 20px'>Update Filters</button></td>
		<td style='border:1px solid'>
			<select id='filter_{$i}' style='font-size: 22px;width:200px;text-align: center;'>
				<option value=''>------Select------</option>
			</select>
		</td>
	</tr>
";

			$table.=
"	<tr style='display:none;' id='adv_row_{$i}'>
		<td style='border:1px solid'></td>
		<td style='border:1px solid' colspan='5'>
			<table style='text-align: center;'>
				<tr>
					<td style='width:200px;border:1px solid'>Item ID</td>
					<td style='width:200px;border:1px solid'>Make</td>
					<td style='width:200px;border:1px solid'>Model</td>
					<td style='width:100px;border:1px solid'>Product ID</td>
					<td style='width:100px;border:1px solid'>Serial Number</td>
					<td style='width:100px;border:1px solid'>Status</td>
					<td style='width:100px;border:1px solid'>Health</td>
				</tr>
";

			$j=0;
			while($adv_row= mysqli_fetch_array($sid_item_data, MYSQLI_ASSOC)) {
				$j++;
				$table.=
"				<tr id='item_row_{$i}_{$j}' style='display:none'>
					<td id='id_{$i}_{$j}' style='border:1px solid'>{$adv_row['item_id']}</td>
					<td style='border:1px solid'><textarea id='make_{$i}_{$j}' disabled style='width:200px;height:60px'>{$adv_row['make']}</textarea></td>
					<td style='border:1px solid'><textarea disabled style='width:200px;height:60px'>{$adv_row['model']}</textarea></td>
					<td style='border:1px solid'><textarea disabled style='width:200px;height:60px'>{$adv_row['product_number']}</textarea></td>
					<td style='border:1px solid'><textarea disabled style='width:200px;height:60px'>{$adv_row['serial_number']}</textarea></td>
					<td style='border:1px solid' bgcolor=";
				if($adv_row['availablity']=='fresh')
					$table.="'#00FF00'";
				else if($adv_row['availablity']=='issued')
					$table.="'#FF0000'";
				else 
					$table.="'#0000FF'";
				$table.=">{$adv_row['availablity']}</td>
					<td style='border:1px solid' bgcolor=";
				if($adv_row['health']=='good')
					$table.="'#00FF00'";
				else
					$table.="'#FF0000'";
				$table.=">{$adv_row['health']}</td>
				</tr>
";
			}
			$table.=
"			</table>
		</td>
	</tr>
";
		}
		$table.=
"</table>
";
		echo $table;
?>