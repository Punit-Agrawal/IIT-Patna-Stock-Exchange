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
		var selected_items=0;
		function add(i){
			
			selected_items++;
			document.getElementById("btn_"+i).style.visibility='hidden';
			
			var item_id=document.getElementById("item_id_"+i).innerText;
			var stock_id=document.getElementById("stock_id_"+ +i).innerText;
			var table=document.getElementById("selected_items");

			table.rows[0].cells[0].innerHTML=selected_items+" Selected";
			
			var table_row=table.insertRow(selected_items+ +1);
			table_row.id='selected_item_'+selected_items;

			var table_data_1=table_row.insertCell(0);
			table_data_1.style.border='1px solid';
			table_data_1.innerHTML=stock_id+"@"+item_id;
			table_data_1.id=i;

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
						
			document.getElementById(enable_button).style.removeProperty("visibility");

			var table=document.getElementById("selected_items");
			
			for(i=item_number;i<selected_items;i++){
				table.rows[parseInt(i) + +1].innerHTML=table.rows[parseInt(i) + +2].innerHTML;
				row=table.rows[parseInt(i) + +1];
				row.id='selected_item_'+ +i;
				cell3=row.cells[2];
				cell3.innerHTML='<button id="selected_btn_'+i+'" type="button" onclick=remove(this.id)>Remove</button>';
			}
			table.deleteRow(table.rows.length -1);
			selected_items--;
			table.rows[0].cells[0].innerHTML=selected_items+" Selected";
		}
		</script>
		
		<script>
			function show_data(ben_id){
				var url='GetReturnableItems.php?ben_id='+ben_id;
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
			function return_items(){
				if(selected_items==0)
					return;
				var acceptor_id=document.getElementById("acceptor_id").value;
				var acceptor_name=document.getElementById("acceptor_name").value;
				var acceptor_contact=document.getElementById("acceptor_contact").value;

				var verifier_id=document.getElementById("verifier_id").value;
				var verifier_name=document.getElementById("verifier_name").value;
				var verifier_contact=document.getElementById("verifier_contact").value;


				var ben_id=document.getElementById("locked_ben_id").innerHTML;
				if(acceptor_id==''||acceptor_name==''||acceptor_contact==''||verifier_id==''||verifier_name==''||verifier_contact==''||ben_id==''){
					alert("Please Fill up Entire Form");
					return;
				}
				var item_list=[];
				var remarks_list=[];
				for(var i=1;i<=selected_items;i++){
					var row=document.getElementById("selected_item_"+ +i);
					var item_id=row.cells[0].innerHTML;
					item_list.push(item_id);
					var remarks=document.getElementById('selected_remarks_'+ +i).value;
					remarks_list.push(remarks);
				}
				var item_json=JSON.stringify(item_list);
				var remarks_json=JSON.stringify(remarks_list);
				window.location.href = "ReturnItems.php?ben_id="+ben_id+"&acceptor_id="+acceptor_id+"&acceptor_name="+acceptor_name+"&acceptor_contact="+acceptor_contact+"&verifier_id="+verifier_id+"&verifier_name="+verifier_name+"&verifier_contact="+verifier_contact+"&item_list=" + item_json+"&remarks_list="+remarks_json;
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
		
		<h1 align="center">Return Items</h1>
		<br/>
		<div align="center">
			<input type="text" placeholder="Benificiary ID" style="width:500px;font-size:20px" id='ben_id' name='ben_id'>
			<br/>
			<br/>
			<button type="button" onclick="lock_ben_id()" style="font-size: 20px">Proceed</button>
			<br/>
			<p style="width:500px;font-size:20px" id='locked_ben_id'></p>
			<br/>
			<table>
				<tr>
					<td style="font-size:20px">Reciever ID</td>
					<td><input type="text" style="font-size:20px" id='acceptor_id' name='acceptor_id'></td>
					<td style="font-size:20px">Reciever Name</td>
					<td><input type="text" style="font-size:20px" id='acceptor_name' name='acceptor_name'></td>
					<td style="font-size:20px">Reciever Contact</td>
					<td><input type="text" style="font-size:20px" id='acceptor_contact' name='acceptor_contact'></td>
				</tr>
				<tr>
					<td style="font-size:20px">Verifier ID</td>
					<td><input type="text" style="font-size:20px" id='verifier_id' name='verifier_id'></td>
					<td style="font-size:20px">Verifier Name</td>
					<td><input type="text" style="font-size:20px" id='verifier_name' name='verifier_name'></td>
					<td style="font-size:20px">Verifier Contact</td>
					<td><input type="text" style="font-size:20px" id='verifier_contact' name='verifier_contact'></td>
				</tr>
			</table>
		</div>
		<br/>
		<br/>
		<div id="stocks" align="center">
		</div>
		<br/><br/>
		<br/><br/>
		<div  align="center">
			<table id="selected_items" style='border:1px solid;font-size: 25px;text-align: center;'>
				<tr>
					<td style='border:1px solid;' colspan="3" id="count_selected">0 Selected</td>
				</tr>
				<tr>
					<td style='border:1px solid;width:200px'>ITEM ID</td>
					<td style='border:1px solid;width:200px'>REMARKS</td>
					<td style='border:1px solid;width:200px'>DESELECT</td>
				</tr>
			</table>
			<br/>
			<br/>
			<br/>
			<button style="font-size: 20px" type="button" onclick=return_items() >Confirm</button>
		</div>
		
	</body>
</html>