<?php
include_once("conexao.php");
header('Content-Type: text/html; charset=utf-8');
header('Content-Type: application/json; charset=utf-8');
$id_poligono = mysqli_real_escape_string($conn, $_POST['id']);
$x_coord = mysqli_real_escape_string($conn, $_POST['x']);
$y_coord = mysqli_real_escape_string($conn, $_POST['y']);
$coord = mysqli_real_escape_string($conn, $_POST['coord']);



//mysqli_query($conn,  "CALL inserircoord('$id_poligono','$x_coord', '$y_coord'");
//$resultGet = mysqli_query($conn,  "CALL inserircoord('$id_poligono','$x_coord', '$y_coord')");
$resultGet = mysqli_query($conn,  "CALL inserircoord('$id_poligono','$coord', '$x_coord', '$y_coord')");

// $resultGet = mysqli_query($conn, "select * from poligono where '$id_poligono' = poligono.id");

// $row = mysqli_fetch_array($resultGet);

// if($row['x_origem'] == null){
//     mysqli_query($conn, "update poligono set 
//     x_origem = '$x_coord',
//     y_origem = '$y_coord' where '$id_poligono'=poligono.id;");
// }else{
//     mysqli_query($conn, "update poligono set 
//     x_destino = '$x_coord',
//     y_destino = '$y_coord' where '$id_poligono'=poligono.id;");
// }

// mysqli_query($conn,  "insert into coordenadas(id_poligono, x_coord, y_coord)  values ('$id_poligono', '$x_coord', '$y_coord')");

?>
