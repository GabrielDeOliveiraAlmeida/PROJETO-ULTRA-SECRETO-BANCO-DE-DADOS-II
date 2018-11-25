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
            <li>
                <div class='user-view'>
                    <div class="background">
                    </div>
                <a href="#!"><img class="circle" src="../horadolixo.png"></a>
                <a href="#!"><span class="white-text name">ADMINISTRADOR</span></a>
            </li>
            <ul>
                <li>
                    <div class="divider"></div>
                </li>
                <li><a href="rota.php">ROTAS</a></li>
                <li><a href="#!">MOTORISTAS</a></li>
                <li><a href="truck.php">CAMINHÕES</a></li>
                <li><a href="option.php">OPÇÕES</a></li>
                <li><a href="help.php">AJUDA</a></li>
                <li>
                    <div class="divider"></div>
                </li>
                <li><a href="logout.php">SAIR</a></li>
            </ul>
        </ul>
    </div>



    <div id="site">
        <div class="col s3 ">
            <!--CABEÇALHO - ABAS-->
            <div class="row">
                <ul class="tabs tabs-fixed-width	" id="tabs">
                    <li class="tab col s3 "><a href="#drivers">MOTORISTAS</a></li>
                    <li class="tab col s3"><a class="active" href="#register_driver">CADASTRAR MOTORISTAS</a></li>
                </ul>
            </div>

            <!--ABA TABELA COM TODAS OS CARAS-->
            <div id="drivers" class="col s12">
                <div id="modal1" class="modal">
                    <!-- AVISO PARA REMOÇÃO -->
                    <div class="modal-content">
                        <h4>Essa ação é irreversivel</h4>
                    </div>
                    <button  id="aceito" class=" modal-action modal-close waves-effect waves-green btn-flat">Prosseguir</button>
                    <button  class=" modal-action modal-close waves-effect waves-green btn-flat">Recusar</button>
                </div>

                <div id="table_driver">
                    
                    <!-- TODOS OS MOTORISTAS -->
                </div>
            </div>


            <div class="col s12 " id="register_driver">
                <!-- <form class="col s12" name="envia_msg" id="envia_msg" method='POST' > -->

                <!--NOME E SOBRENOME-->
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input name="nome_driver" id="nome_driver" type="text" class="validate">
                        <label for="firstname">Primeiro Nome*</label>
                    </div>
                    <div class="input-field col s6">
                        <input name="sobrenome_driver" id="sobrenome_driver" type="text" class="validate">
                        <label for="surname">Sobrenome</label>
                    </div>
                </div>


                <!--EMAIL E TELEFONE-->
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">email</i>
                        <input name="email_driver" id="email_driver" type="email">
                        <label for="email_driver" data-error="INCORRETO" data-success="OK">Email*</label>
                    </div>

                    <div class="input-field col s6">
                        <i class="material-icons prefix">phone</i>
                        <input name="telefone_driver" id="telefone_driver" type="number" class="validate">
                        <label for="icon_telephone" data-error="Somente números" data-success="OK">Telefone</label>
                    </div>

                    <!--SENHA-->
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">https</i>
                            <input name="password_driver" id="password_driver" type="password" onkeyup="tamanhoSenha(this);"
                                class="validate">
                            <label for="password" data-error="Mínimo de 8 caracteres" data-success="OK">Senha*</label>
                        </div>

                        <div class="input-field col s6">
                            <input id="confirm_password" type="password" class="validate">
                            <label for="confirm_password" data-error="Senha não conferem" data-success="OK">Repetir
                                Senha*</label>
                        </div>
                    </div>
                </div>
                <button class='btn' id="submit_driver">Cadastrar</button>
                </form>
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
                <a class="grey-text text-lighten-4 right" href="help.html">Sobre</a>
            </div>
        </div>
    </footer>

    <!--JQUERY-->
    <script type="text/javascript" src="../javascript/jquery.min.js"></script>
    <!-- JQUERY UI-->
    <script type="text/javascript" src="../javascript/jquery-ui.min.js"></script>
    <!--MATERIALIZE-->
    <script type="text/javascript" src="../javascript/materialize.min.js"></script>
    <script>
        $('.button-collapse').sideNav('show');
        var elem = document.getElementById('tabs');
        $(document).ready(function () {
            Materialize.updateTextFields();
            $('.modal').modal( {dismissible: false});
        });
    </script>

    <!--MEU SCRIPT-->
    <script type="text/javascript" src="../javascript/DriverDir/driver.js"></script>


</body>

</html>