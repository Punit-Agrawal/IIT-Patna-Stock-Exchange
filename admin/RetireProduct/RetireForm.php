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
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>	</head>
	</head>
	<body>
		<script>
			function retire(){
				var stock_id=document.getElementById("stock_id").innerHTML;
				var item_id=document.getElementById("item_id").innerHTML;
				var remarks=document.getElementById("remarks").value;
				if (confirm('Are you sure you want to retire this Item, haivng Stcok-ID "'+stock_id+'" and Item-ID "'+item_id+'" ?')) {
					var url='retire.php?stock_id='+stock_id+'&item_id='+item_id+'&remarks='+remarks;

					var ajax=new XMLHttpRequest();
					ajax.onreadystatechange=function(){
						if(this.readyState==4 && this.status==200){
							location.reload();
						}
					};
					ajax.open("GET",url, true);
					ajax.send();
				}
			}
		</script>
		<script>
			function show_data(){
				var id=document.getElementById("id").value;
				if(id!=''){
					var url='GetDetails.php?id='+id;
					var ajax=new XMLHttpRequest();
					ajax.onreadystatechange=function(){
						if(this.readyState==4 && this.status==200)
							document.getElementById("data").innerHTML=this.responseText;
					};
					ajax.open("GET",url, true);
					ajax.send();
				}
			}
		</script>
		<script>
			$(function(){
				$("#id").autocomplete({
					source: function(request, response) {
					$.ajax({
						url: "search_id.php",
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
		
		<h1 align="center">Retire Product</h1>
		<br/>
		<div align="center">
			<input type="text" placeholder="Product ID/Serial ID" style="width:500px;font-size:20px" id='id' name='id'>
			<button type="button" onclick="show_data()" style="font-size: 20px">Display</button>
			<br/>
			<br/>
			<div id="data"></div>
		</div>
	</body>
</html>