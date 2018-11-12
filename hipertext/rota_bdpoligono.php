<?php
include_once("conexao.php");
header('Content-Type: text/html; charset=utf-8');
header('Content-Type: application/json; charset=utf-8');

//** MYSQL INJECTION */
$cidade = mysqli_real_escape_string($conn, $_POST['cidade']);
$uf = mysqli_real_escape_string($conn, $_POST['estado']);
$coord = mysqli_real_escape_string($conn, $_POST['paths']);
$cor = mysqli_real_escape_string($conn, $_POST['cor']);

//**Pesquisar ID da cidade ( chave estrangeira) e retornar o primeiro da lista */
$getIDCom = "select id from cidades where LOCATE('$cidade', nome) and uf='$uf'";
$resultGet = mysqli_query($conn, $getIDCom);

$getID = mysqli_num_rows($resultGet);

$row = mysqli_fetch_array($resultGet);

$cidadeID = $row['id'];

//** Armazenar no banco. */
$result_banco = "INSERT INTO horadolixo.poligono(coord, id_cidade, cor)
        VALUES ('$coord', '$cidadeID', '$cor')";
$result= mysqli_query($conn, $result_banco);

//E MANDA DE VOLTA
if($result){
        echo (mysqli_insert_id($conn));
}else{
        //**Forçar o update já que se não deu certo, possivelmente já está inserido na tabela */
        // $result = mysqli_query($conn, "UPDATE poligono set coord = '$coord' where id = '$id'");
        echo $cor;
}
?>