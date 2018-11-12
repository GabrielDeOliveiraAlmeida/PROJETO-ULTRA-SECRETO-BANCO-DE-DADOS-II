<?php
include_once("conexao.php");

$id_poligono = mysqli_real_escape_string($conn, $_POST['id']);
$qual = mysqli_real_escape_string($conn, $_POST['qual']);
$qual = intval($qual) - 1;

$resultGet = mysqli_query($conn, "select id from coordenadas where '$id_poligono' = coordenadas.id_rota");
$qtd = mysqli_num_rows($resultGet) - 1;

$cont = 0;
$id=0;
while ($row = mysqli_fetch_array($resultGet)){
    if($cont == $qual){
        $id = $row['id'];
        break;
    } 
    $cont++;
}

$resultado = mysqli_query($conn, "delete from coordenadas where
    '$id_poligono'= coordenadas.id_rota  and coordenadas.id = '$id'");


?>

