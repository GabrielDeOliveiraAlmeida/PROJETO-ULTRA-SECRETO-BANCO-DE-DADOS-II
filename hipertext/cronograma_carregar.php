<?php
include_once('conexao.php');
header('Content-Type: text/html; charset=utf-8');
header('Content-Type: application/json; charset=utf-8');

$id = mysqli_real_escape_string($conn, $_POST['id']);
$dia = mysqli_real_escape_string($conn, $_POST['dia']);

$sql = "call cronograma_carregar('$id', '$dia')";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_array($result);

$resultado = array(
	"hora" => $row['hora'],
	"nome" => $row['nome'] .' '. $row['sobrenome'],
	"modelo" => $row['modelo'],
	"placa" => $row['placa'],
	"email" => $row['email'],
);
echo json_encode($resultado);
?>
