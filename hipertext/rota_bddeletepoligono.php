<?php
include_once("conexao.php");

//** MYSQL INJECTION */
$id_poligono = mysqli_real_escape_string($conn, $_POST['id']);

//**Pesquisar ID da cidade ( chave estrangeira) e retornar o primeiro da lista */
$getIDCom = "delete from poligono where id = '$id_poligono'";
$resultGet = mysqli_query($conn, $getIDCom);

if($resultGet){
    echo "EXCLUIDO";
}else echo "ERROR";

?>