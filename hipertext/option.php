<?php
include("protect.php");
protect();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8" />
	<title>HORA DO LIXO (ADM)</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
    <!--Import jquery-ui.min.css-->
    <link type="text/css" rel="stylesheet" href="../css/jquery-ui.min.css" media="screen,projection" />
    <!-- MEU ESTILO -->
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>

<!-- BARRA MENU LATERAL -->
<div>
    <ul id="slide-out" class="side-nav fixed">
        <li><div class = 'user-view'>
                <div class= "background">
                </div>
                <a href="#!"><img class="circle" src="../horadolixo.png"></a>
                <a href="#!"><span class="white-text name">ADMINISTRADOR</span></a>
            </div></li>
        <ul>
            <li><div class="divider"></div></li>
            <li><a href="rota.php">ROTAS</a></li>
            <li><a href="driver.php">MOTORISTAS</a></li>
            <li><a href="truck.php">CAMINHÕES</a></li>
            <li><a href="#!">OPÇÕES</a></li>
            <li><a href="help.php">AJUDA</a></li>
            <li><div class="divider"></div></li>
            <li><a href="logout.php">SAIR</a></li>
        </ul>
    </ul>
</div>








    <!--JQUERY-->
    <script type="text/javascript" src="../javascript/jquery.min.js"></script>
    <!-- JQUERY UI-->
    <script type="text/javascript" src="../javascript/jquery-ui.min.js"></script>
    <!--MATERIALIZE-->
    <script type="text/javascript" src="../javascript/materialize.min.js"></script>
    
</body>
</html>