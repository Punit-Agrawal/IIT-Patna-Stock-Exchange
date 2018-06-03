<?php 
	include '../../helper/verifier.php';
	verify('admin');
?>
<?php
	
		$id=$_GET['id'];
		
		include '../../helper/dbconnector.php';
		
		$sql="SELECT DISTINCT SUBSTRING_INDEX(item_id,'/',1) AS name FROM item WHERE stock_id = '{$id}'";
		$item_names=mysqli_query($conn, $sql);
		$items=mysqli_num_rows($item_names);
		$table=
"<table style='border:1px solid;font-size: 25px;text-align: center;'>
	<tr>
		<td style='border:1px solid;'></td>
		<td style='border:1px solid;'>Type</td>
		<td style='border:1px solid;'>Quantity</td>
		<td style='border:1px solid;'>Availablity</td>
		<td style='border:1px solid;'>Damaged</td>
		<td style='border:1px solid;'>Issued</td>
	</tr>
";
		$i=0;
		while($row = mysqli_fetch_array($item_names, MYSQLI_ASSOC)) {
			$i++;
			$sql="SELECT item_id from item WHERE stock_id = '{$id}' AND item_id LIKE '{$row['name']}/%'";
			$result=mysqli_query($conn, $sql);
			$qty=mysqli_num_rows($result);
			
			$sql="SELECT item_id from item WHERE stock_id = '{$id}' AND item_id LIKE '{$row['name']}/%' AND (availablity='fresh' OR availablity='returned')";
			$result=mysqli_query($conn, $sql);
			$available=mysqli_num_rows($result);
			
			$sql="SELECT item_id from item WHERE stock_id = '{$id}' AND item_id LIKE '{$row['name']}/%' AND health='bad'";
			$result=mysqli_query($conn, $sql);
			$damaged=mysqli_num_rows($result);
				
			$sql="SELECT item_id from item WHERE stock_id = '{$id}' AND item_id LIKE '{$row['name']}/%' AND availablity='issued'";
			$result=mysqli_query($conn, $sql);
			$issued=mysqli_num_rows($result);
			
			$table.=
"	<tr style='border: 1px solid' id='main_row_{$i}'>
		<td><button type='button' id='exp_{$i}' onclick='expand({$i},{$items})'>+</button></td>
		<td style='border:1px solid'>{$row['name']}</td>
		<td style='border:1px solid'>{$qty}</td>
		<td style='border:1px solid'>{$available}</td>
		<td style='border:1px solid'>{$damaged}</td>
		<td style='border:1px solid'>{$issued}</td>
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
					<td style='width:100px;border:1px solid'>In Stock</td>
					<td style='width:100px;border:1px solid'>Damaged</td>
					<td style='width:100px;border:1px solid'></td>
					</tr>
";

			$sql="SELECT * FROM item WHERE stock_id = '{$id}' AND item_id LIKE '{$row['name']}/%' ORDER BY SUBSTRING_INDEX(item_id,'/',1)";
			$list_of_items=mysqli_query($conn, $sql);
			$j=0;
			while($adv_row= mysqli_fetch_array($list_of_items, MYSQLI_ASSOC)) {
				$j++;
				$table.=
"				<tr>
					<td id='id_{$i}_{$j}' style='border:1px solid'>{$adv_row['item_id']}</td>
					<td style='border:1px solid'><textarea disabled style='width:200px;height:60px'>{$adv_row['make']}</textarea></td>
					<td style='border:1px solid'><textarea disabled style='width:200px;height:60px'>{$adv_row['model']}</textarea></td>
					<td style='border:1px solid'><textarea ";
				if($adv_row['product_number']!='')
					$table.="disabled ";
				$table.="id='prod_{$i}_{$j}' style='width:200px;height:60px'>{$adv_row['product_number']}</textarea></td>
					<td style='border:1px solid'><textarea ";
				if($adv_row['serial_number']!='')
					$table.="disabled ";
				$table.="id='serial_{$i}_{$j}'style='width:200px;height:60px'>{$adv_row['serial_number']}</textarea></td>
					<td style='border:1px solid'>";
				if($adv_row['availablity']=='issued')
					$table.="NO";
				else
					$table.="YES";
				$table.="</td>
					<td style='border:1px solid'>";
				if($adv_row['health']=='good')
					$table.="NO";
				else
					$table.="YES";
				$table."</td>
";
				if($adv_row['product_number']==''||$adv_row['serial_number']=='')
					$table.=
"					<td style='border:1px'><button id='btn_{$i}_{$j}' type='button' onclick=update({$i},{$j})>Update</button></td>
";
				$table.=
"						</tr>
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