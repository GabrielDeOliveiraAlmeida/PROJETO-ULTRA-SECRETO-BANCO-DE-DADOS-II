<?php
include_once('conexao.php');
header('Content-Type: text/html; charset=utf-8');
header('Content-Type: application/json; charset=utf-8');

$id = mysqli_real_escape_string($conn, $_POST['id']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$placa = mysqli_real_escape_string($conn, $_POST['placa']);
$dia = mysqli_real_escape_string($conn, $_POST['dia']);
$hora = mysqli_real_escape_string($conn, $_POST['hora']);

if($email == "" && $placa == "") echo "false";
else{
	$sql = "call cronograma_salvar('$id', '$email', '$placa', '$hora' , '$dia')";
	$result = mysqli_query($conn, $sql);
}
?>
