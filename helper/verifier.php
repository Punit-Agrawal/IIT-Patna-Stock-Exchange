<?php
	session_start();
	function verify($user){
		if(!($user==$_SESSION['status'])){
			session_destroy();
			header("Location:../");
		}
	}
?>