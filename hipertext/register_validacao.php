<?php
session_start();
include_once("conexao.php");
//O campo usuário e senha preenchido entra no if para validar
if((isset($_POST['email'])) && (isset($_POST['senha1']) && (isset($_POST['senha2'])))){

    $usuario = mysqli_real_escape_string($conn, $_POST['email']); //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
    $senha = mysqli_real_escape_string($conn, $_POST['senha1']);

    //Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
    $result_usuario = "SELECT * FROM adm WHERE usuario = '$usuario'";
    $resultado_usuario = mysqli_query($conn, $result_usuario);
    $resultado = mysqli_fetch_assoc($resultado_usuario);


    if(!isset($resultado)){
        if ($_POST['senha1'] != $_POST['senha2']){
            $_SESSION['registerErro'] = "As senhas precisam ser iguais!";
            header("Location: register.php");
            return;
        }else{
            $result_cadastro = "INSERT INTO adm(usuario, senha) VALUES ('$usuario', '$senha')";
            $resultado_cadastro = mysqli_query($conn, $result_cadastro);
            $cresultado = mysqli_fetch_assoc($resultado_cadastro);

            if (!isset($cresultado)){
                $_SESSION['registerErro'] = "Cadastro realizado com sucesso!";
                header("Location: register.php");
            }else{
                $_SESSION['registerErro'] = "Erro ao se cadastrar... [?ConnectionError?]";
                header("Location: register.php");
            }
        }
    }else{
        $_SESSION['registerErro'] = "Usuário já cadastrado";
        header("Location: register.php");
    }
    //O campo usuário e senha não preenchido entra no else e redireciona o usuário para a página de login
}else{
    $_SESSION['registerErro'] = "Erro ao se cadastrar... [?Arguing Error?]";
    header("Location: register.php");
}
?>
