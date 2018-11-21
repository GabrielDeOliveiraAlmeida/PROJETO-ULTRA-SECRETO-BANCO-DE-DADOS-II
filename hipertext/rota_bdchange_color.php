<?php
include_once("conexao.php");
header('Content-Type: text/html; charset=utf-8');
header('Content-Type: application/json; charset=utf-8');

$id_poligono = mysqli_real_escape_string($conn, $_POST['id']);
$color = mysqli_real_escape_string($conn, $_POST['color']);

$resultGet = mysqli_query($conn,  "CALL changecolor('$id_poligono','$color')");
echo $resultGet;
?>
