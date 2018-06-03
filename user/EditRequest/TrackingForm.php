<?php
	include '../../helper/verifier.php';
	verify('user');
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
		<script>
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
			function lock_req_id(){
				var req_id=document.getElementById('req_id').value;
				var url='CheckValidRequestId.php?req_id='+req_id;
				var ajax=new XMLHttpRequest();
				ajax.onreadystatechange=function(){
					if(this.readyState==4 && this.status==200){
						var response=this.responseText;
						if(response!='false'){
							document.getElementById('locked_req_id').innerHTML=req_id;
							document.getElementById("req_details").innerHTML=this.responseText;
						}
					}
				};
				ajax.open("GET",url, true);
				ajax.send();
			}
		</script>
		<script>
			$(function(){
				$("#req_id").autocomplete({
					source: function(request, response) {
					$.ajax({
						url: "search_req.php",
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
		<h1 align="center">TRACK YOUR REQUEST</h1>
		<div align="center">
			<input type="text" placeholder="Request ID" style="width:500px;font-size:20px" id='req_id' name='req_id'>
			<button type="button" onclick="lock_req_id()" style="font-size: 20px">Submit</button>
			<br/>
			<p style="width:500px;font-size:20px" id='locked_req_id'></p>
		</div>
		<div id="req_details">
		</div>
	</body>
</html>