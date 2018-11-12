<?php
include_once("conexao.php");
//** MYSQL INJECTION */
header('Content-Type: text/html; charset=utf-8');
header('Content-Type: application/json; charset=utf-8');
$cidade = mysqli_real_escape_string($conn, $_POST['cidade']);
$uf = mysqli_real_escape_string($conn, $_POST['estado']);

//**Pesquisar ID da cidade ( chave estrangeira) e retornar o primeiro da lista */
$getIDCom = "select id from cidades where '$cidade'=nome and uf='$uf'";
$resultGet = mysqli_query($conn, $getIDCom);
$getID = mysqli_num_rows($resultGet);

$row = mysqli_fetch_array($resultGet);
$cidadeID = $row['id'];


$resultado = mysqli_query($conn,"call recarregar('$cidadeID')");
$campo = array();

$tam = mysqli_num_rows($resultado);
if($tam > 0){
    while($row = mysqli_fetch_array($resultado)){
        $arr = array(
            'id' => $row['id'],
            'pol' => $row['coord'],
            'cor' =>$row['cor']
        );
        // $id = $row['id_rota'];
        // $coord = $row['coord'];
        // $x = $row['x_coord'];
        // $y = $row['y_coord'];
        // $arr = array(
        //     'x' => $row['x_coord'],
        //     'y' => $row['y_coord'],
        // );
        array_push($campo, $arr);
    }
    // $resposta =array(
    //     'id' => $id_rota,
    //     'pol' => $pol,
    //     'coord' => $campo,
    // );
    echo json_encode($campo); 
}




?>