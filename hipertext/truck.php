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
    <!--Import jquery-ui.min.css-->
    <link type="text/css" rel="stylesheet" href="../css/jquery-ui.min.css" media="screen,projection"/>
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
                <a href="#!"><img class="circle" src="../horadolixo.png"></a>
                <a href="#!"><span class="white-text name">ADMINISTRADOR</span></a>
        </div></li>
        <ul>
            <li><div class="divider"></div></li>
            <li><a href="rota.php">ROTAS</a></li>
            <li><a href="driver.php">MOTORISTAS</a></li>
            <li><a href="#!">CAMINHÕES</a></li>
            <li><a href="option.php">OPÇÕES</a></li>
            <li><a href="help.php">AJUDA</a></li>
            <li><div class="divider"></div></li>
            <li><a href="logout.php">SAIR</a></li>
        </ul>
    </ul>
</div>

<div id="site">
<div class="col s3">
        <!--CABEÇALHO - ABAS-->
        <div class="row">
            <ul class="tabs tabs-fixed-width	" id="tabs" >
                <li class="tab col s3 "><a href="#truck">CAMINHÕES</a></li>
                <li class="tab col s3"><a class="active" href="#register_truck">CADASTRAR CAMINHÃO</a></li>
            </ul>
        </div>

        <div id="modal" class="modal">
            <!-- AVISO PARA REMOÇÃO -->
            <div class="modal-content">
                <h4>Essa ação é irreversivel</h4>
            </div>
            <button  id="aceito" class=" modal-action modal-close waves-effect waves-green btn-flat">Prosseguir</button>
            <button  class=" modal-action modal-close waves-effect waves-green btn-flat">Recusar</button>
        </div>
        
        <div id="truck" class="col s12">
            <div id="table_truck"></div>
        </div>


        <div class="col s12" id="register_truck">
                <!--MODELO E ANO-->
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">local_shipping</i>
                        <input name="modelo_truck" id="modelo_truck" type="text" class="validate">
                        <label for="modelo">Modelo*</label>
                    </div>
                    <div class="input-field col s6">
                        <input name="ano_truck" id="ano_truck" type="text" class="datepicker">
                        <label for="ano">Ano*</label>
                    </div>
                </div>


                <!--SERIE E PLACA-->
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">email</i>
                        <input name="serie_truck" id="serie_truck" type="number" >
                        <label for="serie" data-error="INCORRETO" data-success="OK">Número de série*</label>
                    </div>

                    <div class="input-field col s6">
                        <i class="material-icons prefix">airplay</i>
                        <input name="placa_truck" id="placa_truck" type="text" class="validate">
                        <label for="placa" data-error="Somente números" data-success="OK">Placa</label>
                    </div>

                </div>
            <button class='btn' id="submit_driver">Cadastrar</button>
            <div id="truck_resposta" class="center-align">
                <!-- RESPOSTA DO SERVIDOR         -->
            </div>
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
<script type="text/javascript" src="../javascript/jquery.min.js"></script>
<!-- JQUERY UI -->
<script type="text/javascript" src="../javascript/jquery-ui.js"></script>
<!-- JQUERY UI-->
<script type="text/javascript" src="../javascript/jquery-ui.min.js"></script>
<!--MATERIALIZE-->
<script type="text/javascript" src="../javascript/materialize.min.js"></script>

<script>
    $('.button-collapse').sideNav('show');
    var elem = document.getElementById('tabs');
    $(document).ready(function() {
        Materialize.updateTextFields();
        $('.modal').modal( {dismissible: false});
    });
</script>

<!--MEU SCRIPT-->
<script type="text/javascript" src="../javascript/TruckDir/truck.js"></script>

</body>
</html>