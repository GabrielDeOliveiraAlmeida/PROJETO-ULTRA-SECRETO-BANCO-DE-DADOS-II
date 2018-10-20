<?php  
	include_once('conexao.php');
	$sql = "DELETE FROM horadolixo.motorista WHERE email = '".$_POST["id"]."'";  
	if(mysqli_query($conn, $sql))  
	{  
		echo 'Data Deleted';  
	}  
 ?>