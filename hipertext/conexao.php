<?php
	$servidor = "localhost";
//	$usuario = "root";
//	$senha = "";
//	$dbname = "horadolixo";
//
	//Criar a conexao
	$conn = mysqli_connect($servidor, 'root', "", 'horadolixo');

	if(!$conn){
		echo "erro";
	    die("Falha na conexao: " . mysqli_connect_error());

	}
	
?>
