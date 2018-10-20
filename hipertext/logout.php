<?php
session_start();

unset(
    $_SESSION['usuario'],
    $_SESSION['senha'],
    $_SESSION['user'],
    $_SESSION['conn']
);

$_SESSION['logindeslogado'] = "Deslogado com sucesso";

session_destroy();
//redirecionar o usuario para a página de login
header("Location: login.php");
?>