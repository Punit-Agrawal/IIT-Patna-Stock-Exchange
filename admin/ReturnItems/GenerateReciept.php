<?php 
	include '../../helper/verifier.php';
	verify('admin');
	include '../../helper/includer.php';
?>
<?php
	include "../../helper/dbconnector.php";
	$item_list=json_decode($_GET['item_list'],false);
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
		<h1 align="center">RETURN SLIP</h1>
		<table align="center">
			<tr>
				<td colspan="2" style="font-size:25px;width:200px;">
					Return ID
				</td>
				<td colspan="2" align="center" style="font-size:25px;width:200px;">
					<?php echo $_GET['ret_id']?>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="font-size:25px;width:200px;">
					Acceptor ID
				</td>
				<td colspan="2" align="center" style="font-size:25px;width:200px;">
					<?php echo $_GET['acceptor_id']?>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="font-size:25px;width:200px;">
					Acceptor Name
				</td>
				<td colspan="2" align="center" style="font-size:25px;width:200px;">
					<?php echo $_GET['acceptor_name']?>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="font-size:25px;width:200px;">
					Acceptor Contact
				</td>
				<td colspan="2" align="center" style="font-size:25px;width:200px;">
					<?php echo $_GET['acceptor_contact']?>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="font-size:25px;width:200px;">
					Verifier ID
				</td>
				<td colspan="2" align="center" style="font-size:25px;width:200px;">
					<?php echo $_GET['verifier_id']?>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="font-size:25px;width:200px;">
					Verifier Name
				</td>
				<td colspan="2" align="center" style="font-size:25px;width:200px;">
					<?php echo $_GET['verifier_name']?>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="font-size:25px;width:200px;">
					Verifier Contact
				</td>
				<td colspan="2" align="center" style="font-size:25px;width:200px;">
					<?php echo $_GET['verifier_contact']?>
				</td>
			</tr>
			<tr><td><br/><br/></td></tr>
			<tr align="center">
				<td style="font-size:25px;" colspan="4"><b>Items Returned</b></td>
			</tr>
			<tr>
				<td style="font-size:25px;" colspan="2"></td>
						<tr>
							<td style="font-size:25px;width:200px;border:2px solid;">Request ID</td>
							<td style="font-size:25px;width:200px;border:2px solid;">Stock ID</td>
							<td style="font-size:25px;width:200px;border:2px solid;">Item ID</td>
							<td style="font-size:25px;width:200px;border:2px solid;">Return ID</td>
						</tr>
			<?php 
			foreach ($item_list as $item){
				$stock_id=substr($item,0,strpos($item,"@"));
				$item_id=substr($item,strpos($item,"@")+1);
				$return_query="select ret_id from returns where stock_id='{$stock_id}' and item_id='{$item_id}' and ret_id LIKE '{$_GET['ret_id']}%'";
				$result=mysqli_query($conn, $return_query);
				$result=mysqli_fetch_assoc($result);
				$return_id=$result['ret_id'];
				$issue_query="select req_id from issue where stock_id='{$stock_id}' and item_id='{$item_id}' and return_id LIKE '{$_GET['ret_id']}%'";
				$result=mysqli_query($conn, $issue_query);
				$result=mysqli_fetch_assoc($result);
				$request_id=$result['req_id'];
				
				$str=
"						<tr>
							<td style='font-size:25px;border:2px solid;'>{$request_id}</td>
							<td style='font-size:25px;border:2px solid;'>{$stock_id}</td>
							<td style='font-size:25px;border:2px solid;'>{$item_id}</td>
							<td style='font-size:25px;border:2px solid;'>{$return_id}</td>
						</tr>
";
				echo $str;
			}
			?>
				</td>
			</tr>
		</table>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<b style="float:left">Benificiary Signature:____________</b>
		<b style="margin-right: 10%;float:right">Acceptor Signature:____________</b>
		<script>
			print();
		</script>
	</body>
</html>