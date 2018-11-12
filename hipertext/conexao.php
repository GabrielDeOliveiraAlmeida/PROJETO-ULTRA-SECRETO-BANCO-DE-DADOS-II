<?php
	$servidor = "localhost";

	//Criar a conexao
	$conn = mysqli_connect($servidor, 'root', '', 'horadolixo');
	mysqli_set_charset( $conn, 'utf8');
	if(!$conn){
		echo "erro";
	    die("Falha na conexao: " . mysqli_connect_error());
	}
	
?>
