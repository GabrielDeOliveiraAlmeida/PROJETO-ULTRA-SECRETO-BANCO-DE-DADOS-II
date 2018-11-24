<?php
include_once('conexao.php');
header('Content-Type: text/html; charset=utf-8');
header('Content-Type: application/json; charset=utf-8');

$id = mysqli_real_escape_string($conn, $_POST['id']);
$dia = mysqli_real_escape_string($conn, $_POST['dia']);

$sql = "call cronograma_remover('$id', '$dia')";
$result = mysqli_query($conn, $sql);
?>
