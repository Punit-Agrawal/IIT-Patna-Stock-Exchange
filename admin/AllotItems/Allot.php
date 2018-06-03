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
		<script>
			var max_printer=0;
			var max_desktop=0;
			var max_laptop=0;
			function lock_req_id(){
				document.getElementById('access').value='';
				var req_id=document.getElementById('req_id').value;
				var url='CheckValidRequestId.php?req_id='+req_id;
				var ajax=new XMLHttpRequest();
				ajax.onreadystatechange=function(){
					if(this.readyState==4 && this.status==200){
						var response=this.responseText;
						if(response!='false'){
							document.getElementById('locked_req_id').innerHTML=req_id;
							max_printer=document.getElementById('max_printer').innerHTML=response.split(" ")[0];
							max_desktop=document.getElementById('max_desktop').innerHTML=response.split(" ")[1];
							max_laptop=document.getElementById('max_laptop').innerHTML=response.split(" ")[2];
							if(response.split(" ")[3]!='No'&&response.split(" ")[4]=='no')
								document.getElementById('access').disabled=false;
							else
								document.getElementById('access').disabled=true;
						}
					}
				};
				ajax.open("GET",url, true);
				ajax.send();
			}
		</script>
		<script>
		var selected_items=0;
		function add(i,j){
			var item=document.getElementById("id_"+i+"_"+j).innerHTML.split("/")[0];
			if(item=="Printer"){
				if(parseInt(max_printer)<=0)
					return;
				else{
					max_printer=parseInt(max_printer)-1;
					document.getElementById("max_printer").innerHTML=max_printer;
				}
			}
			else if(item=="Desktop"){
				if(parseInt(max_desktop)<=0)
					return;
				else{
					max_desktop=parseInt(max_desktop)-1;
					document.getElementById("max_desktop").innerHTML=max_desktop;
				}
			}
			else if(item=="Laptop"){
				if(parseInt(max_laptop)<=0)
					return;
				else{
					max_laptop=parseInt(max_laptop)-1;
					document.getElementById("max_laptop").innerHTML=max_laptop;
				}
			}
			
			selected_items++;
			document.getElementById("btn_"+i+'_'+j).style.visibility='hidden';
			
			var id=document.getElementById("id_"+i+"_"+j+"").innerText;
			var stock_id=document.getElementById("stock_id_"+ +i).innerText;
			var table=document.getElementById("selected_items");

			table.rows[0].cells[0].innerHTML=selected_items+" Selected";
			
			var table_row=table.insertRow(selected_items+ +1);
			table_row.id='selected_item_'+selected_items;

			var table_data_1=table_row.insertCell(0);
			table_data_1.style.border='1px solid';
			table_data_1.innerHTML=stock_id+"@"+id;
			table_data_1.id=i+"_"+j;

			var table_data_2=table_row.insertCell(1);
			table_data_2.style.border='1px solid';
			table_data_2.innerHTML='<textarea id="selected_remarks_'+selected_items+'"></textarea>';

			var table_data_3=table_row.insertCell(2);
			table_data_3.style.border='1px solid';

			table_data_3.innerHTML='<button id="selected_btn_'+selected_items+'" type="button" onclick=remove(this.id)>Remove</button>';

			
		}

		function remove(btn_id){
			var item_number=btn_id.substr(13);
			var row_id="selected_item_"+item_number;
			var row=document.getElementById(row_id);
			var item_row=row.cells[0].id;
			var enable_button='btn_'+item_row;

			var item=document.getElementById("id_"+item_row).innerHTML.split("/")[0];
			if(item=="Printer"){
				max_printer=parseInt(max_printer)+1;
				document.getElementById("max_printer").innerHTML=max_printer;
			}
			else if(item=="Desktop"){
				max_desktop=parseInt(max_desktop)+1;
				document.getElementById("max_desktop").innerHTML=max_desktop;
			}
			else if(item=="Laptop"){
				max_laptop=parseInt(max_laptop)+1;
				document.getElementById("max_laptop").innerHTML=max_laptop;
			}
			
			document.getElementById(enable_button).style.removeProperty("visibility");

			var table=document.getElementById("selected_items");
			
			for(i=item_number;i<selected_items;i++){
				table.rows[parseInt(i) + +1].innerHTML=table.rows[parseInt(i) + +2].innerHTML;
				row=table.rows[parseInt(i) + +1];
				row.id='selected_item_'+ +i;
				cell3.innerHTML='<button id="selected_btn_'+i+'" type="button" onclick=remove(this.id)>Remove</button>';
			}
			table.deleteRow(table.rows.length -1);
			selected_items--;
			table.rows[0].cells[0].innerHTML=selected_items+" Selected";
		}
		</script>
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
				var url='GetIssuableStocks.php?';
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
		<script>
			function allot_access(){
				if(document.getElementById("access").value=='')
					return;
				else{
					var url='AllotAccess.php?req_id='+document.getElementById("locked_req_id").innerHTML+"&id="+document.getElementById("access").value;
					var ajax=new XMLHttpRequest();
					ajax.onreadystatechange=function(){
						if(this.readyState==4 && this.status==200){
							document.getElementById("access").value='';
							document.getElementById('access').disabled=true;
						}
					};
					ajax.open("GET",url, true);
					ajax.send();
				}
			}
			function allot_items(){
				if(selected_items==0)
					return;
				var issuer_id=document.getElementById("issuer_id").value;
				var issuer_name=document.getElementById("issuer_name").value;
				var req_id=document.getElementById("locked_req_id").innerHTML;
				if(issuer_id==''||issuer_name==''||req_id==''){
					alert("Please Fill up Entire Form");
					return;
				}
				var item_list=[];
				var remarks_list=[];
				for(var i=1;i<=selected_items;i++){
					var row=document.getElementById("selected_item_"+ +i);
					var item_id=row.cells[0].innerHTML;
					var remarks=document.getElementById('selected_remarks_'+ +i).value;
					remarks_list.push(remarks);
					item_list.push(item_id);
				}
				var item_json=JSON.stringify(item_list);
				var remarks_json=JSON.stringify(remarks_list);
				window.location.href = "AllotItems.php?req_id="+req_id+"&issuer_id="+issuer_id+"&issuer_name="+issuer_name+"&item_list=" + item_json+"&remarks_list=" + remarks_json;
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
		
		<h1 align="center">Item Allotment</h1>
		<br/>
		<div align="center">
			<table>
				<tr>
					<td style="font-size:20px">Issuer ID</td>
					<td><input type="text" style="font-size:20px" id='issuer_id' name='issuer_id'></td>
					<td style="font-size:20px">Issuer Name</td>
					<td><input type="text" style="font-size:20px" id='issuer_name' name='issuer_name'></td>
				</tr>
			</table>
			<br/>
			<input type="text" placeholder="Request ID" style="width:500px;font-size:20px" id='req_id' name='req_id'>
			<button type="button" onclick="lock_req_id()" style="font-size: 20px">Proceed</button>
			<br/>
			<p style="width:500px;font-size:20px" id='locked_req_id'></p>
			<table align="center">
				<tr>
					<th>Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
					<th>Pendings</th>
				</tr>
				<tr>
					<td style="color:red">Printer</td>
					<td align="right" id="max_printer" style="color:red">0</td>
				</tr>
				<tr>
					<td style="color:red">Desktop</td>
					<td align="right" id="max_desktop" style="color:red">0</td>
				</tr>
				<tr>
					<td style="color:red">Laptop</td>
					<td align="right" id="max_laptop" style="color:red">0</td>
				</tr>
			</table>
		</div>
		<br/>
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
		<br/><br/>
		<br/><br/>
		<div  align="center">
			<input type="email" name="access" id="access" placeholder="Access-ID/Mail-ID" style="font-size:25px;width:317px;" disabled>
			<button type="button" id="allot_id_btn" style="font-size:25px;" onclick=allot_access()>Allot ID</button>
			<br/>
			<br/>
			<table id="selected_items" style='border:1px solid;font-size: 25px;text-align: center;'>
				<tr>
					<td style='border:1px solid;' colspan="3" id="count_selected">0 Selected</td>
				</tr>
				<tr>
					<td style='border:1px solid;width:200px'>ITEM ID</td>
					<td style='border:1px solid;'>REMARKS</td>
					<td style='border:1px solid;width:200px'>REMOVE</td>
				</tr>
			</table>
			<br/>
			<br/>
			<br/>
			<button style="font-size: 20px" type="button" onclick=allot_items() >Continue</button>
		</div>
		
	</body>
</html>