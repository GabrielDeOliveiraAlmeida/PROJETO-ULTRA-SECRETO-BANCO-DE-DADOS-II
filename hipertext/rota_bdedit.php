<?php
include_once("conexao.php");
header('Content-Type: text/html; charset=utf-8');
header('Content-Type: application/json; charset=utf-8');

$id_poligono = mysqli_real_escape_string($conn, $_POST['id']);
$coord = mysqli_real_escape_string($conn, $_POST['coord']);
$x_coord = mysqli_real_escape_string($conn, $_POST['x']);
$y_coord = mysqli_real_escape_string($conn, $_POST['y']);
$qual = mysqli_real_escape_string($conn, $_POST['qual']);
$qual = intval($qual) - 1;

$resultGet = mysqli_query($conn, "select id from coordenadas where '$id_poligono' = coordenadas.id_rota");
// $qtd = mysqli_num_rows($resultGet) - 1;

// if($qual == 0){
//     mysqli_query($conn, "update rota set 
//     x_origem = '$x_coord',
//     y_origem = '$y_coord' where '$id_poligono'=rota.id;"); 
// }

// if($qtd == $qual){
// $resultado =  mysqli_query($conn, "update rota set 
//     x_destino = '$x_coord',
//     y_destino = '$y_coord' where '$id_poligono'=rota.id;"); 
// }

$cont = 0;
$id=0;
while ($row = mysqli_fetch_array($resultGet)){
    if($cont == $qual){
        $id = $row['id'];
        break;
    } 
    $cont++;
}

$resultado = mysqli_query($conn, "update coordenadas set 
    coord = '$coord',
    x_coord = '$x_coord',
    y_coord = '$y_coord' where '$id_poligono'= coordenadas.id_rota  and coordenadas.id = '$id'");


?>

