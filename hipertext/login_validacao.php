<?php
session_start();
include_once("conexao.php");
//O campo usuário e senha preenchido entra no if para validar
if((isset($_POST['email'])) && (isset($_POST['senha']))){

    $usuario = mysqli_real_escape_string($conn, $_POST['email']); //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);

    //Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
    $result_usuario = "SELECT * FROM horadolixo.adm WHERE usuario = '$usuario' and senha = '$senha'";
    $resultado_usuario = mysqli_query($conn, $result_usuario);
    $resultado = mysqli_fetch_assoc($resultado_usuario);


    if(isset($resultado)){
        $_SESSION['user'] = $resultado;
        header("Location: rota.php");
    }else{
        $_SESSION['loginErro'] = "Usuário ou senha Inválido";
        header("Location: login.php");
    }
    //O campo usuário e senha não preenchido entra no else e redireciona o usuário para a página de login
}else{
    $_SESSION['loginErro'] = "Usuário ou senha inválido";
    header("Location: login.php");
}
?>
