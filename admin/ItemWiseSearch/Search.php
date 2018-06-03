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
		<!--script src="http://malsup.github.com/jquery.form.js"></script-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>	</head>
	</head>
	<body>
		<script type="text/javascript">
			function expand(row_num,total){
				if(document.getElementById("adv_row_"+row_num).style.display==''){
					document.getElementById("adv_row_"+row_num).style.display='none';
					document.getElementById("exp_"+row_num).innerHTML='+';
					var rows=document.getElementById("total_item_"+row_num).value;
					for(j=1;j<=rows;j++)
						document.getElementById("item_row_"+row_num+"_"+j).style.display='none';
				}
				else{
					for(i=1;i<=total;i++){
						document.getElementById("adv_row_"+i).style.display='none';
						document.getElementById("exp_"+i).innerHTML='+';
						var rows=document.getElementById("total_item_"+i).value;
						for(j=1;j<=rows;j++)
							document.getElementById("item_row_"+i+"_"+j).style.display='none';
					}
					document.getElementById("adv_row_"+row_num).style.display='';
					document.getElementById("exp_"+row_num).innerHTML='-';
					var make=document.getElementById("filter_"+row_num).value;
					var rows=document.getElementById("total_item_"+row_num).value;
					if(make=='')
						for(j=1;j<=rows;j++)
								document.getElementById("item_row_"+row_num+"_"+j).style.display='';
					else{
						for(j=1;j<=rows;j++){
							if(document.getElementById("make_"+row_num+"_"+j).value==make){
								document.getElementById("item_row_"+row_num+"_"+j).style.display='';
							}
						}
					}
				}
			}
		</script>
		<script>
			function update_filters(row_no){
				var items=document.getElementById("total_item_"+row_no).value;
				var makes=[];var unique_makes=[];
				for(var j=1;j<=items;j++)
					makes.push(document.getElementById("make_"+row_no+"_"+j).value);
				for(j=0;j<items;j++){
					var found=false;
					for(i=0;i<unique_makes.length;i++){
						if(makes[j]==unique_makes[i])
							found=true;
					}
					if(found==false)
						unique_makes.push(makes[j]);
				}
				var filter=document.getElementById("filter_"+row_no);
				for(i=0;i<unique_makes.length;i++){
					option=document.createElement("option");
					option.text=unique_makes[i];
					option.value=unique_makes[i];
					filter.add(option);
				}
			}
			
			function show_data(){
				var url='GetStocks.php?';
				var all=document.getElementsByName("item_type");
				var none=true;
				for(var i=0;i<all.length;i++){
					if (all[i].checked ) {
						if(none==false)
							url+="&";
						url+='item_type[]='+all[i].value;
						none=false;
					}
				}
				if(none==true)
					return;
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
		
		<h1 align="center">Item Search</h1>
		<br/>
		<div align="center">
			<input type="checkbox" name="item_type" value="Printer" style="font-size: 20px">Printer
			<input type="checkbox" name="item_type" value="Desktop" style="font-size: 20px">Desktop
			<input type="checkbox" name="item_type" value="Laptop" style="font-size: 20px">Laptop
			<br/>
			<br/>
			<button type="button"  onclick="show_data()" style="width:150px;font-size: 20px" >Details</button>
		</div>
		<br/>
		<br/>
		<br/>
		<div id="stocks" align="center">
		</div>		
	</body>
</html>