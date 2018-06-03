<h1 style='text-align:center'>Stock Distribution Report - Student </h1>

<?php	
		
		include './helper/dbconnector.php';
	
			$sql1="SELECT * FROM item where item_id like '%Laptop%' and serial_number is not null";
		//	var_dump($sql);
			$list_of_items1=mysqli_query($conn, $sql1);
			$items1=mysqli_num_rows($list_of_items1);
			
		
			$sql2="SELECT * FROM item where item_id like '%Desktop%' and serial_number<>''";
		//	var_dump($sql);
			$list_of_items2=mysqli_query($conn, $sql2);
			$items2=mysqli_num_rows($list_of_items2);			
			
			$sql3="SELECT * FROM student_allocation_report where item_id like '%Laptop%'";
		//	var_dump($sql);
			$list_of_items3=mysqli_query($conn, $sql3);
			$items3=mysqli_num_rows($list_of_items3);	

			$sql4="SELECT * FROM student_allocation_report where item_id like '%Desktop%'";
		//	var_dump($sql);
			$list_of_items4=mysqli_query($conn, $sql4);
			$items4=mysqli_num_rows($list_of_items4);		

			$sql5="SELECT * FROM item LEFT JOIN issue ON issue.stock_id=item.stock_id and issue.item_id=item.item_id WHERE issue.stock_id is null and issue.item_id is null AND item.item_id like '%Laptop%' AND serial_number<>''";
		//	var_dump($sql5);
			$list_of_items5=mysqli_query($conn, $sql5);
			$items5=mysqli_num_rows($list_of_items5);				
			
			$sql6="SELECT * FROM item LEFT JOIN issue ON issue.stock_id=item.stock_id and issue.item_id=item.item_id WHERE issue.stock_id is null and issue.item_id is null AND item.item_id like '%Desktop%' AND serial_number<>''";
		//	var_dump($sql6);
			$list_of_items6=mysqli_query($conn, $sql6);
			$items6=mysqli_num_rows($list_of_items6);	
			
			$sql="SELECT * FROM student_allocation_report order by issue_date desc";
		//	var_dump($sql);
			$list_of_items=mysqli_query($conn, $sql);
		//	$items=mysqli_num_rows($list_of_items);
			
?>

<table style='text-align: start;'>
	<tr>
				<td style='width:200px;'><?php echo "Total no. of Laptops: ".$items1; ?></td> 	
				<td style='width:200px;'><?php echo "Total no. of Desktops: ".$items2; ?></td>
				<td style='width:200px;'><?php echo "Total no. of Laptops issued to student: ".$items3; ?></td>
				<td style='width:200px;'><?php echo "Total no. of Desktops issued to student: ".$items4; ?></td>
				<td style='width:200px;'><?php echo "Total no. of Laptops  available: ".$items5; ?></td> 	
				<td style='width:200px;'><?php echo "Total no. of Desktops available: ".$items6; ?></td> 					
				<td style='width:200px;'><?php echo " Report generated on: ".date('d/m/Y H:i:s')." (server time) "; ?></td>
	</tr>
	

</table>
		
			<table style='text-align: center;'>
				<tr>
				<th style='width:200px;border:1px solid;'>Sl no.</th>
				<th style='width:200px;border:1px solid;'>Request Id</th>
				<th style='width:200px;border:1px solid;'>Request Date</th>
				<th style='width:200px;border:1px solid;'>Issue Date</th>
				<th style='width:200px;border:1px solid;'>Name</th>
				<th style='width:200px;border:1px solid;'>Roll No.</th>
				<th style='width:200px;border:1px solid;'>Department</th>
				<th style='width:200px;border:1px solid;'>Mail Id</th>		
				<th style='width:200px;border:1px solid;'>Alt. Mail Id</th>
				<th style='width:200px;border:1px solid;'>Stock Id</th>
				<th style='width:200px;border:1px solid;'>Item Id</th>
				<th style='width:200px;border:1px solid;'>Serial No.</th>
				<th style='width:200px;border:1px solid;'>Product No.</th>
				<th style='width:200px;border:1px solid;'>Warranty Start</th>
				<th style='width:200px;border:1px solid;'>Warranty End </th>
				<th style='width:200px;border:1px solid;'>Admin Remarks</th>    
				</tr>

<?php
			$j=0;
			while(($adv_row=mysqli_fetch_assoc($list_of_items))) 
			{ $j++
?>			
				<tr>
				<td style='width:200px;border:1px solid;'><?php echo $j ?></td>
				<td style='width:200px;border:1px solid;'><?php echo $adv_row['req_id'] ?></td>
				<td style='width:200px;border:1px solid;'><?php echo $adv_row['req_date'] ?></td>
				<td style='width:200px;border:1px solid;'><?php echo $adv_row['issue_date'] ?></td>
				<td style='width:200px;border:1px solid;'><?php echo $adv_row['name'] ?></td>
				<td style='width:200px;border:1px solid;'><?php echo $adv_row['id'] ?></td>
				<td style='width:200px;border:1px solid;'><?php echo $adv_row['department'] ?></td>
				<td style='width:200px;border:1px solid;'><?php echo $adv_row['mail_id'] ?></td>
				<td style='width:200px;border:1px solid;'><?php echo $adv_row['alt_mail_id'] ?></td>
				<td style='width:200px;border:1px solid;'><?php echo $adv_row['stock_id'] ?></td>
				<td style='width:200px;border:1px solid;'><?php echo $adv_row['item_id'] ?></td>
				<td style='width:200px;border:1px solid;'><?php echo $adv_row['serial_number'] ?></td>
				<td style='width:200px;border:1px solid;'><?php echo $adv_row['product_number'] ?></td>
				<td style='width:200px;border:1px solid;'><?php echo $adv_row['warranty_start'] ?></td>
				<td style='width:200px;border:1px solid;'><?php echo $adv_row['warranty_end'] ?></td>
				<td style='width:200px;border:1px solid;'><?php echo $adv_row['admin_remarks'] ?></td>
				</tr>
<?php
			}
?>			
		</table>
		


