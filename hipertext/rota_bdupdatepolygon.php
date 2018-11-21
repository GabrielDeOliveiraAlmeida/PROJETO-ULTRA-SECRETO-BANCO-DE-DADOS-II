<?php
include_once("conexao.php");
header('Content-Type: text/html; charset=utf-8');
header('Content-Type: application/json; charset=utf-8');

$id_poligono = mysqli_real_escape_string($conn, $_POST['id']);
$coord = mysqli_real_escape_string($conn, $_POST['coord']);

$resultado = mysqli_query($conn, "update poligono set 
    coord = '$coord' where '$id_poligono'= id");


?>
