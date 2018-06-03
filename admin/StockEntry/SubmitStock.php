<?php 
	include '../../helper/verifier.php';
	verify('admin');
	include '../../helper/includer.php';
?>
<?php 
	include('../../log4php/Logger.php');
	Logger::configure('../../log4phpconfig.xml');
	$log = Logger::getLogger("MessageLogger");
?>
<?php
	include '../../helper/dbconnector.php';
	include '../../helper/sqlhelper.php';
		
	$stockid="{$_GET['reg']}/{$_GET['page']}/{$_GET['sno']}";

	$check_sql="select * from stocking where stock_id='{$stockid}'";
	$result=mysqli_num_rows(mysqli_query($conn, $check_sql));
	if($result!=0){
		echo "Duplicate Entry Not allowed";
		echo "<br/>";
		echo "<a href='StockEntry.php'>Fill Stock Again</a><br/>";
		echo "<a href='../Home.php'>Home</a>";
	}
	else{
		$array=array(
				"stock_id"			=>	$stockid,
				"po_id"				=>	$_GET['po_number'],
				"location"			=>	$_GET['loc'],
				"bill_number"		=>	$_GET['bill'],
				"supplier_name"		=>	$_GET['supp_name'],
				"supplier_address1"	=>	$_GET['supp_add1'],
				"supplier_address2"	=>	$_GET['supp_add2'],
				"supplier_address3"	=>	$_GET['supp_add3'],
				"pincode"			=>	$_GET['pincode'],
				"supplier_email"	=>	$_GET['supp_mail'],
				"supplier_phone"	=>	$_GET['supp_phone'],
				"indentor_name"		=>	$_GET['indentor'],
				"reciever_name"		=>	$_GET['reciever'],
				"recieving_date"	=>	$_GET['recieve_date'],
				"recieving_place"	=>	$_GET['place'],
				"entered_by"		=>	$_GET['entered'],
				"checked_by"		=>	$_GET['checked'],
				"remarks"			=>	$_GET['remarks']
		);
		insert($conn, "stocking", $array);
				
		echo "<br/>";
		$items=$_GET['types'];
		$count=1;
		for($i=1;$i<=$items;$i++){
			$type="type_{$i}";
			$qty="qty_{$i}";
			$unit="unit_{$i}";
			$total="total_{$i}";
			$make="make_{$i}";
			$model="model_{$i}";
			$description="description_{$i}";
			$warr_start="warr_start_{$i}";
			$duration="duration_{$i}";
			$warr_end = date_create($_GET[$warr_start]);
			date_add($warr_end, date_interval_create_from_date_string("{$duration} Months"));
			$warr_end= date_format($warr_end, 'Y-m-d');
				
			for($j=1;$j<=$_GET[$qty];$j++){
				$itemid="{$_GET[$type]}/{$count}";
				$array=array(
					"stock_id"			=>	$stockid,
					"item_id"			=>	$itemid,
					"quantity"			=>	$_GET[$qty],
					"unit_price"		=>	$_GET[$unit],
					"total_price"		=>	$_GET[$total],
					"make"				=>	$_GET[$make],
					"model"				=>	$_GET[$model],
					"item_description"	=>	$_GET[$description],
					"serial_number"		=>	'',
					"product_number"	=>	'',
					"warranty_start"	=>	$_GET[$warr_start],
					"warranty_end"		=>	$_GET[$warr_start],
					"availablity"		=>	"fresh",
					"health"			=>	"good"
				);
				insert($conn, "item", $array);
								
				$sql="update item set warranty_end=DATE_ADD(warranty_start, INTERVAL {$_GET[$duration]} MONTH) where stock_id='{$stockid}' AND item_id='{$itemid}'";
				
				mysqli_query($conn, $sql);
				$count++;
			}
		}
		echo "Stock entered Successfully<br/>";
		echo "<a href='../Home.php'>Home</a>";
	}
	
?>
