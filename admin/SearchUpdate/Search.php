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
		<script type="text/javascript">
			function expand(row_num,total){
				if(document.getElementById("adv_row_"+row_num).style.display==''){
					document.getElementById("adv_row_"+row_num).style.display='none';
					document.getElementById("exp_"+row_num).innerHTML='+';
				}
				else{
					for(i=1;i<=total;i++){
						document.getElementById("adv_row_"+i).style.display='none';
						document.getElementById("exp_"+i).innerHTML='+';
					}
					document.getElementById("adv_row_"+row_num).style.display='';
					document.getElementById("exp_"+row_num).innerHTML='-';
				}
			}
		</script>
		<script>
			$(function(){
				$("#stock_id").autocomplete({
					source: function(request, response) {
					$.ajax({
						url: "search_stock.php",
						data: {
							term : request.term
							},
						dataType: "json",
						success: function( data ) {
							response( data )
							}
						});
					},
					minLength: 1,
					change: function (event, ui){
						if (!ui.item) {
							this.value = '';
						}
					}
				});
			});
		</script>
		<script>
			function update(i,j){
				var stockid=document.getElementById("showing_id").innerHTML;
				var id=document.getElementById("id_"+i+"_"+j+"").innerText;
				if (id!=''){
					var ajax=new XMLHttpRequest();
					ajax.onreadystatechange=function(){
						if(this.readyState==4 && this.status==200){
							if(product!=''&&serial!='')
								document.getElementById("btn_"+i+"_"+j).style.visibility="hidden";
							if(product!='')
								document.getElementById("prod_"+i+"_"+j).disabled=true;
							if(serial!='')
								document.getElementById("serial_"+i+"_"+j).disabled=true;
						}
					};
					var product=document.getElementById("prod_"+i+"_"+j).value;
					var serial=document.getElementById("serial_"+i+"_"+j).value;
					ajax.open("GET", "UpdateItems.php?stockid="+stockid+"&id="+id+"&product="+product+"&serial="+serial, true);
					ajax.send();
				}
			}
		</script>

		<script>
			function show_details(){
				var id=document.getElementById("stock_id").value;
				document.getElementById("showing_id").value='';
				document.getElementById("showing_id").innerHTML=id;
				if (id!=''){
					var ajax=new XMLHttpRequest();
					ajax.onreadystatechange=function(){
						if(this.readyState==4 && this.status==200)
							if(this.responseText=='')
								location="Login.html";
							document.getElementById("stocks").innerHTML=this.responseText;
					};
					ajax.open("GET", "GetStocks.php?id="+id, true);
					ajax.send();
				}
			}
		</script>
		<p><a href='../Home.php'>Back</a></p>
		<h1 align="center">Update and View Stock</h1>
			<input  style="float:left;margin-left: 100px;font-size: 25px" placeholder="Stock-ID" type="text" name="stock_id" id="stock_id">
			<button onclick="show_details()" style="float:left;margin-left: 10px;font-size: 25px" type="button">Show Details</button>
			<br/>
			<br/>
			<br/>
			<br/>
		<p id="showing_id"></p>
		<div id="stocks">
		</div>
	</body>
</html>