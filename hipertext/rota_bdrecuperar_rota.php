<?php
include_once("conexao.php");

header('Content-Type: text/html; charset=utf-8');
header('Content-Type: application/json; charset=utf-8');

//** MYSQL INJECTION */
$id = mysqli_real_escape_string($conn, $_POST['id']);

$resultado = mysqli_query($conn,"call recarregar_rota('$id')");

$campo = array();
$tam = mysqli_num_rows($resultado);
if($tam > 0){
    while($row = mysqli_fetch_array($resultado)){
        $arr = array(
            'coord' => $row['coord'],
            'x' => $row['x_coord'],
            'y' => $row['y_coord']
        );
        array_push($campo, $arr);
    }
    echo json_encode($campo); 
}




?>