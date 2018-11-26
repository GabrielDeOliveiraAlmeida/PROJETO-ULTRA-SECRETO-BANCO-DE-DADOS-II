<?php  
	include_once('conexao.php');
	$sql = "DELETE FROM motorista WHERE email = '".$_POST["id"]."'";
	if(mysqli_query($conn, $sql))  
	{  
		echo 'Data Deleted';  
	}  
 ?>