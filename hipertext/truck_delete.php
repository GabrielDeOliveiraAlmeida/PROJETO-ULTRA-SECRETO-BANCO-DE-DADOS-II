<?php  
	include_once('conexao.php');
	$sql = "DELETE FROM caminhao WHERE placa = '".$_POST["id"]."'";
	mysqli_query($conn, $sql)
 ?>