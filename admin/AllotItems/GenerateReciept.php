<?php
	$item_list=json_decode($_GET['item_list'],false);
?>
<?php 
	include '../../helper/verifier.php';
	verify('admin');
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
		<h1 align="center">ISSUE SLIP</h1>
		<table align="center">
			<tr>
				<td style="font-size:25px;width:200px;">
					Request ID
				</td>
				<td align="center" style="font-size:25px;width:200px;">
					<?php echo $_GET['req_id']?>
				</td>
			</tr>
			<tr>
				<td style="font-size:25px;width:200px;">
					Issuer ID
				</td>
				<td align="center" style="font-size:25px;width:200px;">
					<?php echo $_GET['issuer_id']?>
				</td>
			</tr>
			<tr>
				<td style="font-size:25px;width:200px;">
					Issuer Name
				</td>
				<td align="center" style="font-size:25px;width:200px;">
					<?php echo $_GET['issuer_name']?>
				</td>
			</tr>
			<tr><td><br/><br/></td></tr>
			<tr align="center">
				<td style="font-size:25px;border:2px solid;"><b>Items Alloted</b></td>
				<td style="font-size:25px;border:2px solid;"><b>Admin Remarks</b></td>
			</tr>
			<?php 
			$remarks_list=json_decode($_GET['remarks_list'],false);
			$i=0;
			foreach ($item_list as $item){
				$str=
"			<tr>
				<td style='font-size:25px;border:2px solid;'>{$item}</td>
				<td style='font-size:25px;border:2px solid;'>{$remarks_list[$i]}</td>
			</tr>
";
				echo $str;
				$i++;
			}
			?>
		</table>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<b style="float:left">Beneficiary Signature:____________</b>
		<b style="margin-right: 10%;float:right">Issuer Signature:____________</b>
		<script>
			print();
		</script>
	</body>
</html>