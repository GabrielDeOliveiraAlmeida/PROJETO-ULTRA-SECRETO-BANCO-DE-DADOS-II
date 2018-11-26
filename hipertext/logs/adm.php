<?php
include_once("../conexao.php");


        // //SLQ INJECTION
$email = mysqli_real_escape_string($conn, $_POST['email']);
$senha = mysqli_real_escape_string($conn, $_POST['password']);

$retorno = array("sucesso"=>TRUE, "msg"=>"");

if($email ==""){
        $retorno["sucesso"]=FALSE;
        $retorno["msg"].= "<p class='center-align' style='color: #fc2c2e; '>Email não pode ser vazio</p>";
}
if($senha == ""){
        $retorno["sucesso"]=FALSE;
        $retorno["msg"].= "<p class='center-align' style='color: #fc2c2e; '>Senha não pode ser vazio</p>";
}

if($retorno["sucesso"]==FALSE){
        echo json_encode($retorno);
}else{
// $senha = password_hash($senha, PASSWORD_DEFAULT); //CODIFICAR SENHA (Desativado temporariamente, tendo em vista que não será usado no momento)
// //password_verify($_POST['senha'], row['senha']);    //DECODIFICAR SENHA

// //FAZ A PORRA DO INSERT
$result_banco = "INSERT INTO adm
        VALUES ('$email', '$senha')";

$result= mysqli_query($conn, $result_banco);

//E MANDA DE VOLTA
if($result){
        $retorno["msg"] = "<p class='center-align' style='color: #28d728; '>CADASTRO REALIZADO COM SUCESSO</p>";
        echo json_encode($retorno);
}else{
        $retorno["sucesso"]=FALSE;
        $retorno["msg"] ="<p class= 'center-align' style='color: #fc2c2e; '>E-MAIL JÁ CADASTRADO</p>";
        echo json_encode($retorno);
}
}
?>