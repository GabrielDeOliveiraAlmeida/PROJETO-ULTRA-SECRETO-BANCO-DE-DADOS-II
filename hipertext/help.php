<?php
include("protect.php");
protect();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title>MOTORISTA - HORA DO LIXO</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>

    <!-- MEU ESTILO -->
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">


    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
<!-- BARRA MENU LATERAL -->
<div>
    <ul id="slide-out" class="side-nav fixed">
        <li><div class = 'user-view'>
            <div class= "background">
            </div>
                <a href="#!"><img class="large circle" src="../horadolixo.png"></a>
                <a href="#!"><span class="white-text name">ADMINISTRADOR</span></a>
        </div></li>
        <ul>
            <li><div class="divider"></div></li>
            <li><a href="rota.php">ROTAS</a></li>
            <li><a href="driver.php">MOTORISTAS</a></li>
            <li><a href="truck.php">CAMINHÕES</a></li>
            <li><a href="option.php">OPÇÕES</a></li>
            <li><a href="#!">AJUDA</a></li>
            <li><div class="divider"></div></li>
            <li><a href="logout.php">SAIR</a></li>
        </ul>
    </ul>
</div>

<div id="site">
    <div class="col s3">
        <!--ABA DE AJUDA DA APLICAÇÃO-->
    </div>
    <div id="help" class="col s12">
        <ul class="collapsible">
            <li>
                <div class="collapsible-header"><i class="material-icons">map</i>MAPA</div>
                <div class="collapsible-body"><span>TUDO SOBRE O MAPA</span></div>
            </li>
            <li>
                <div class="collapsible-header"><i class="material-icons">time_to_leave</i>ROTAS</div>
                <div class="collapsible-body"><span>TUDO SOBRE A ABA ROTAS</span></div>
            </li>
            <li>
                <div class="collapsible-header"><i class="material-icons">streetview</i>COLETORES</div>
                <div class="collapsible-body"><span>TUDO SOBRE O COLETORES</span></div>
            </li>
            <li>
                <div class="collapsible-header"><i class="material-icons">account_box</i>BANCO DE DADOS</div>
                <div class="collapsible-body"><span>BANCO DE DADOS</span></div>
            </li>
            <li>
                <div class="collapsible-header active"><i class="material-icons">supervisor_account</i>SOBRE</div>
                <div class="collapsible-body"><span>OLÁ MARILENE</span></div>
            </li>
        </ul>
    </div>
    </div>
</div>



<footer class="footer">
    <div class="container">
        <div class="footer-copyright">
            TRABALHO PRÁTICO DE BANCO DE DADOS II - FCT UNESP
            <a class="grey-text text-lighten-4 right" href="help.html">Sobre</a>
        </div>
    </div>
</footer>


<!--JQUERY-->
<script type="text/javascript" src="../javascript/jquery.js"></script>
<!--MATERIALIZE-->
<script type="text/javascript" src="../javascript/materialize.min.js"></script>

<script>
    $('.button-collapse').sideNav('show');
    var elem = document.getElementById('tabs');
    $(document).ready(function() {
        Materialize.updateTextFields();
    });
</script>
<!--MEU SCRIPT-->
<script type="text/javascript" src="../javascript/DriverDir/driver.js"></script>

</body>

</html>