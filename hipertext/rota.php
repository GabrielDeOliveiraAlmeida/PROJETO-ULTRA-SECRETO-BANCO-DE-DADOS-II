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
                <a href="#!user"><img class="circle" src=""></a>
                <a href="#!name"><span class="white-text name">ADMINISTRADOR</span></a>
            </div></li>
        <ul>
            <li><div class="divider"></div></li>
            <li><a href="#!">ROTAS</a></li>
            <li><a href="driver.php">MOTORISTAS</a></li>
            <li><a href="truck.php">CAMINHÕES</a></li>
            <li><a href="option.php">OPÇÕES</a></li>
            <li><a href="help.php">AJUDA</a></li>
            <li><div class="divider"></div></li>
            <li><a href="logout.php">SAIR</a></li>
        </ul>
    </ul>
</div>

<!----O MAPA -->
<div id="site">
    <div class="col s3">

        <!--CABEÇALHO - ABAS-->
        <div class="row">
            <ul class="tabs tabs-fixed-width" id="tabs" >
                <li class="tab col s3 "><a href="#tabelarotas">ROTAS</a></li>
                <li class="tab col s3"><a class="active" href="#googlemaps">MAPA</a></li>
                <li id="c" class="tab col s3 disabled "><a href="#caminhao">COLETORES</a></li>
            </ul>
        </div>

        <!--ABA TABELA COM TODAS AS ROTA-->
        <div id="tabelarotas" class="col s12 noselect ">
            <div class="div-table">
                <table id="table">
                    <thead>
                    <tr>
                        <th>Localização</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    



        <!--ABA COM O GOOGLE MAPS E BOTÕES-->
        <div id="googlemaps" class="col s12">
            <!-- <div class="row">
                <input class="form_control" readonly="true" type="text" name="entrada1" id="entrada1" placeholder="Localização">
                <button class="btn" id="adicionar" onclick="addTabela();">Adicionar</button>
                <button class="btn"  onclick="editarTabela();">Editar</button>
                <button class="btn"  onclick="removerTabela();">Remover</button>
                <button class="btn right" id="submit" onclick="salvarPolygons();">Salvar</button>
                <div class="col s5 right">
                    <form id="form" method="post">
                        <input type="text" placeholder="Ex: Presidente Prudente - SP" id="campo-busca" class="autocomplete">
                    </form>
                </div>
            </div>
             -->

            <!-- MAPA -->
            <div id="mapa"></div>
        </div>


        <!-- INFORMAÇÕES SOBRE DETERMINADO DIA DA SEMANA -->
        <div id="caminhao" class="col s12">
            <div class="col s12">
                <p>MOTORISTA</p>

                <p>CAMINHÃO</p>
            </div>
        </div>



    </div> <!--col s3-->
</div> <!--SITE-->



<!-- 
    Modal para escolher
 -->
 <div id="modal" class="modal bottom-sheet">
    <!-- AVISO PARA REMOÇÃO -->
    <div class="modal-content">
            <h4>Escolha cidade para coleta</h4>
            <form id="form" method="post">
                <input type="text" placeholder="Ex: Presidente Prudente - SP" id="campo-busca" class="autocomplete">
            </form>
    </div>
    <button  id="aceito" class=" modal-action modal-close waves-effect waves-green btn-flat">Selecionar</button>
    <button  class=" modal-action modal-close waves-effect waves-green btn-flat">Sair</button>
</div>
    

<!---TABELA DO DIA DA SEMANA - BOTÃO DIREITO-->
<script>
 var htmlTableWeek = "<div class='tableWeek'>\n" +
 "<button id='closeTable' class='closeTable' onclick='hiddenTable()'>X</button>"+
 "<button id='closeTable' class='closeTable' onclick='saveTable()'>Salvar</button>"+
 "<table id=\"tableWeek\" class='tableWeek centered highlight responsive-table'>\n" +
 "<thead>\n" +
 "<tr>\n" +
 "<th>Dias da Semana</th>\n" +
 "<th>Hora</th>\n" +
 "<th>Coletores<th>"+
 "</tr>\n" +
 "</thead>\n" +
 "<tbody>\n" +
 "<tr>\n" +
 "<td>Segunda-Feira</td>\n" +
 "<td><input type=\"time\"></input></td>\n" +
 "<td><button onclick='coletores(0)'>+</button></td>"+
 "</tr>\n" +
 "<tr>\n" +
 "<td>Terça-Feira</td>\n" +
 "<td><input type=\"time\"></input></td>\n" +
 "<td><button onclick='coletores(1)'>+</button></td>"+
 "</tr>\n" +
 "<tr>\n" +
 "<td>Quarta-Feira</td>\n" +
 "<td><input type=\"time\"></input></td>\n" +
 "<td><button onclick='coletores(2)'>+</button></td>"+
 "</tr>\n" +
 "<tr>\n" +
 "<td>Quinta-Feira</td>\n" +
 "<td><input type=\"time\"></input></td>\n" +
 "<td><button onclick='coletores(3)'>+</button></td>"+
 "</tr>\n" +
 "<tr>\n" +
 "<td>Sexta-Feira</td>\n" +
 "<td><input type=\"time\"></input></td>\n" +
 "<td><button onclick='coletores(4)'>+</button></td>"+
 "</tr>\n" +
 "<tr>\n" +
 "<td>Sabado</td>\n" +
 "<td><input type=\"time\"></input></td>\n" +
 "<td><button onclick='coletores(5)'>+</button></td>"+
 "</tr>\n" +
 "<tr>\n" +
 "<td>Domingo</td>\n" +
 "<td><input type=\"time\"></input></td>\n" +
 "<td><button onclick='coletores(6)'>+</button></td>"+
 "</tr>\n" +
 "</tbody>\n" +
 "</table>\n" +
 "</div>";
</script>



<!--RODAPE-->
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
        $('.modal').modal();
        recarregarPolygons();
        Materialize.updateTextFields();
        // $.ajax({
        //     url:"driver_tabela.php",
        //     method:"POST",
        //     success:function(data){
        //         $('#table_driver body').html(data);
        //     }
        // });
    });
</script>

    <!--JQUERY-->
    <script type="text/javascript" src="../javascript/jquery.min.js"></script>
    <!-- JQUERY UI-->
    <script type="text/javascript" src="../javascript/jquery-ui.min.js"></script>
    <!--MATERIALIZE-->
    <script type="text/javascript" src="../javascript/materialize.min.js"></script>
    
<!--GOOGLE MAPS-->
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=drawing"></script>
<!--CODIGOS RELACIADOS AO MAPA-->
<script src="../javascript/MapaDir/gmap.js"></script>
<!--API GOOGLE MAPS-->
<script type="text/javascript" src="../javascript/MapaDir/button_maps.js"></script>
<script type="text/javascript" src="../javascript/MapaDir/ContextMenu.js"></script>
<script type="text/javascript" src="../javascript/MapaDir/contextmenuitens.js"></script>
<script type="text/javascript" src="../javascript/MapaDir/eventhandler.js"></script>
<script type="text/javascript" src="../javascript/MapaDir/ui.js"></script>
<script type="text/javascript" src="../javascript/MapaDir/database.js"></script>
<script type="text/javascript" src="../javascript/MapaDir/busca_cidade.js"></script>

</body>
</html>