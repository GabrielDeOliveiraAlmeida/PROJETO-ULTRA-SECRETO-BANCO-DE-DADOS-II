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
<!----O MAPA -->
<div id="site">
    <div class="col s3">

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

          <!--CABEÇALHO - ABAS-->
        <div class="row">
            <ul class="tabs tabs-fixed-width" id="tabs" >
                <li class="tab col s3 "><a href="#logm">LOGs Motorista</a></li>
                <li class="tab col s3"><a href="#logc">LOGs Caminhão</a></li>
                <li class="tab col s3"><a href="#loga">LOG Administrador</a></li>
                <li class="tab col s3"><a class="active" href="#adm">Administrador</a></li> 
            </ul>
        </div>


        <div id="logm" class="col s12"></div>
        <div id="logc" class="col s12"></div>
        <div id="loga" class="col s12"></div>
        <div id="adm" class="col s12">
                            <!--EMAIL E TELEFONE-->
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">email</i>
                        <input id="email" type="email">
                        <label for="email_driver" data-error="INCORRETO" data-success="OK">Email*</label>
                    </div>
                       <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">https</i>
                            <input  id="password" type="password" onkeyup="tamanhoSenha(this);"
                                class="validate">
                            <label for="password" data-error="Mínimo de 8 caracteres" data-success="OK">Senha*</label>
                        </div>

                        <div class="input-field col s6">
                            <input id="confirm" type="password" class="validate">
                            <label for="confirm_password" data-error="Senha não conferem" data-success="OK">Repetir
                                Senha*</label>
                        </div>
                    </div>
                </div>
                <button class='btn' id="submit_driver">Cadastrar</button>
                <div id="resp" class="center-align">
                    <!-- RESPOSTA DO FORMULARIO -->
                </div>


        </div>
</div>
</div>

    <footer class="footer">
        <div class="container">
            <div class="footer-copyright">
                TRABALHO PRÁTICO DE BANCO DE DADOS II - FCT UNESP
                <a class="grey-text text-lighten-4 right" href="help.php">Sobre</a>
            </div>
        </div>
    </footer>
    <!--JQUERY-->
    <script type="text/javascript" src="../javascript/jquery.min.js"></script>
    <!-- JQUERY UI-->
    <script type="text/javascript" src="../javascript/jquery-ui.min.js"></script>
    <!--MATERIALIZE-->
    <script type="text/javascript" src="../javascript/materialize.min.js"></script>
    <script type="text/javascript" src="../javascript/Log/log.js"></script>
</body>
</html>