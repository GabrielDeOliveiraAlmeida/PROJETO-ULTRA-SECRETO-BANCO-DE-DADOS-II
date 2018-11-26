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

    </div> <!--col s3-->
</div> <!--SITE-->


<!-- Modal Structure -->
  <div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content">
        <div>
            <div>
                <p>Horário inicial</p>
                <input class="time" type="time" id="hora" required>
            </div>
            <p>Motorista</p>
            <input readonly="true" onclick="selecaoDriver();" type="text" id="selecaodriver" placeholder=Nome do Motorista"></input>
        </div>
        <div>
            <p>Caminhão</p>
            <input readonly="true" onclick="selecaoTruck();" type="text" id="selecaotruck" placeholder="Nome do Motorista"></input>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat "><i class="large material-icons">close</i></a>
        <button onclick="cronogramaRemover();" class="modal-action modal-close waves-effect waves-green btn-flat" id="cronogramarmv"><i class="material-icons">delete</i></button>
        <button onclick="cronogramaSalvar();" class="large modal-action modal-close waves-effect waves-green btn-flat" id="cronogramabotao"><i class="large material-icons">save</i></button>

    </div>
  </div>

  <div id="modal2" class="modal modal-fixed-footer">
    <div class="modal-content" id="tabelas">
      
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat "><i class="large material-icons">close</i></a>
    </div>
  </div>


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
 "<button id='closeTable' class='closeTable btn-flat' onclick='hiddenTable()'><i class='material-icons'>close</i></button>"+
 "<table id=\"tableWeek\" class='tableWeek centered highlight responsive-table'>\n" +
 "<thead>\n" +
 "<tr>\n" +
 "<th>Dias da Semana</th>\n" +
 "<th>Coletores<th>"+
 "</tr>\n" +
 "</thead>\n" +
 "<tbody>\n" +
 "<tr>\n" +
 "<td>Segunda-Feira</td>\n" +
 
 "<td><button class='btn-flat' onclick="+"coletores('segunda')"+"><i class='large material-icons'>add</i></button></td>"+
 "</tr>\n" +
 "<tr>\n" +
 "<td>Terça-Feira</td>\n" +
 
 "<td><button class='btn-flat' onclick="+"coletores('terca')"+"><i class='large material-icons'>add</i></button></td>"+
 "</tr>\n" +
 "<tr>\n" +
 "<td>Quarta-Feira</td>\n" +
 
 "<td><button  class='btn-flat' onclick="+"coletores('quarta')"+"><i class='large material-icons'>add</i></button></td>"+
 "</tr>\n" +
 "<tr>\n" +
 "<td>Quinta-Feira</td>\n" +
 
 "<td><button  class='btn-flat' onclick="+"coletores('quinta')"+"><i class='large material-icons'>add</i></button></td>"+
 "</tr>\n" +
 "<tr>\n" +
 "<td>Sexta-Feira</td>\n" +
 
 "<td><button class='btn-flat' onclick="+"coletores('sexta')"+"><i class='large material-icons'>add</i></button></td>"+
 "</tr>\n" +
 "<tr>\n" +
 "<td>Sabado</td>\n" +
 
 "<td><button class='btn-flat' onclick="+"coletores('sabado')"+"><i class='large material-icons'>add</i></button></td>"+
 "</tr>\n" +
 "<tr>\n" +
 "<td>Domingo</td>\n" +
 
 "<td><button class='btn-flat' onclick="+"coletores('domingo')"+"><i class='large material-icons'>add</i></button></td>"+
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
            <a class="grey-text text-lighten-4 right" href="help.php">Sobre</a>
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
    $("#hora").val("00:00");
    $('.timepicker').pickatime({
    default: 'now', // Set default time: 'now', '1:30AM', '16:30'
    fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
    twelvehour: false, // Use AM/PM or 24-hour format
    donetext: 'OK', // text for done-button
    canceltext: 'Cancel', // Text for cancel-button,
    container: undefined, // ex. 'body' will append picker to body
    ampmclickable: true, // make AM PM clickable
    aftershow: function(){} //Function for after opening timepicker
  });
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
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDbwXqLMKGgcJASjwylctZixNeBXLLq95k&sensor=false&libraries=drawing"></script>
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