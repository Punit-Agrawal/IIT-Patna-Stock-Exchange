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
			function lock_ben_id(){
				var ben_id=document.getElementById("ben_id").value;
				var url='CheckValidBenificiaryId.php?ben_id='+ben_id;
				var ajax=new XMLHttpRequest();
				ajax.onreadystatechange=function(){
					if(this.readyState==4 && this.status==200){
						var response=this.responseText;
						document.getElementById("locked_ben_id").innerHTML=ben_id;
						show_data(ben_id);
					}
				};
				ajax.open("GET",url, true);
				ajax.send();
			}
		</script>
		
		
		<script>
			function show_data(ben_id){
				var url='GetItems.php?ben_id='+ben_id;
				var ajax=new XMLHttpRequest();
				ajax.onreadystatechange=function(){
					if(this.readyState==4 && this.status==200)
						if(this.responseText=='')
							location="Login.html";
						document.getElementById("stocks").innerHTML=this.responseText;
				};
					ajax.open("GET",url, true);
				ajax.send();
			}
		</script>
		<script>
			$(function(){
				$("#ben_id").autocomplete({
					source: function(request, response) {
					$.ajax({
						url: "search_ben.php",
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
		
		<h1 align="center">Check Dues</h1>
		<br/>
		<div align="center">
			<input type="text" placeholder="Benificiary ID" style="width:500px;font-size:20px" id='ben_id' name='ben_id'>
			<br/>
			<br/>
			<button type="button" onclick="lock_ben_id()" style="font-size: 20px">Proceed</button>
			<br/>
			<p style="width:500px;font-size:20px" id='locked_ben_id'></p>
			<br/>
		</div>
		<br/>
		<br/>
		<div id="stocks" align="center">
		</div>
		<br/><br/>
		<br/><br/>
		<div  align="center">
			<br/>
			<button style="font-size: 20px" type="button" onclick=print() >Print</button>
		</div>
		
	</body>
</html>