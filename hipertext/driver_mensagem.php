<?php
include_once("conexao.php");


        // //SLQ INJECTION
$nome = mysqli_real_escape_string($conn, $_POST['nome_driver']);
$sobrenome = mysqli_real_escape_string($conn, $_POST['sobrenome_driver']);
$email = mysqli_real_escape_string($conn, $_POST['email_driver']);
$telefone = mysqli_real_escape_string($conn, $_POST['telefone_driver']);
$senha = mysqli_real_escape_string($conn, $_POST['password_driver']);

$retorno = array("sucesso"=>TRUE, "msg"=>"");

if($nome ==""){
        $retorno["sucesso"]=FALSE;
        $retorno["msg"] = "<p class='center-align' style='color: #fc2c2e; '>Nome não pode ser vazio</p>";
}
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
$senha = password_hash($senha, PASSWORD_DEFAULT); //CODIFICAR SENHA
// //password_verify($_POST['senha'], row['senha']);    //DECODIFICAR SENHA

// //FAZ A PORRA DO INSERT
$result_banco = "INSERT INTO horadolixo.motorista(email, nome, sobrenome, telefone, senha)
        VALUES ('$email', '$nome','$sobrenome','$telefone', '$senha')";

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