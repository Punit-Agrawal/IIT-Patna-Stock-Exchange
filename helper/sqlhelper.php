<?php
function insert($conn,$table,$array){
		$len=sizeof($array);
		$sql="insert into {$table} (";
		$i=0;
		foreach($array as $x =>$val){
			$i++;
			$sql.=" {$x} ";
			if($i==$len)
				$sql.=" ) ";
			else
				$sql.=",";
		}
		$sql.=" values( ";
		$i=0;
		foreach($array as $x =>$val){
			$i++;
			$sql.=" '{$val}' ";
			if($i==$len)
				$sql.=" ) ";
			else
				$sql.=",";
		}

		$log = Logger::getLogger("MessageLogger");
		$log->trace("{$_SESSION['user_name']}#Query:{$sql}#{$_SERVER['REMOTE_ADDR']}#{$_SESSION['status']}");
		
		mysqli_query($conn, $sql);
		return $sql;
	}
	
	function update($conn,$table,$array,$where){
		$len=sizeof($array);
		$sql="update {$table} set ";
		$i=0;
		foreach($array as $x =>$val){
			$i++;
			$sql.=" {$x} = '{$val}' ";
			if($i==$len)
				$sql.=" ";
			else
				$sql.=",";
		}
		$sql.=" where '$where'";

		$log = Logger::getLogger("MessageLogger");
		$log->trace("{$_SESSION['user_name']}#Query:{$sql}#{$_SERVER['REMOTE_ADDR']}#{$_SESSION['status']}");
		
		mysqli_query($conn, $sql);		
		return $sql;
	}
	
	function toString($array){
		$str='';
		foreach($array as $key => $value)
			$str.=" {$key}=>{$value} ";
		return $str;
	}
?>