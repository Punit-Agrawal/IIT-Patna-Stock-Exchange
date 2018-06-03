<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link href="css/template.css" rel="stylesheet" type="text/css"/>
	</head>
	<body style="text-align:center;" >
		<h1 align="center">Computer Center</h1>
		<h2 align="center"><img src="download.png" style="width:100px;height:100px;"/></h2>
		<h2 align="center">Stock Distribution System</h2>
 		<form style="font-size:25px;margin-left:30%;margin-right:30%;margin-top: 1%;border:1px solid;border-bottom: none;"  action="login.php" method="post">
			<br/>
			<select name="user_type" style="font-size:20px;width:250px" required>
				<option value="user" selected>User</option>
				<option value="dept">Head of Department</option>
				<option value="cc">HOD, CC</option>
				<option value="admin">Admin</option>
			</select>
			<br/>
			<br/>
			<input placeholder="Username" style="width:250px;font-size: 25px" type="text" name="user_name" required>
			<br/>
			<br/>
			<input placeholder="Password" style="width:250px;font-size: 25px" type="password" name="password" required>
			<br/>
			<br/>
			<input type="submit" value="Login" style="font-size: 20px">
			<br/>
			<br/>
		</form>
	</body>
</html>