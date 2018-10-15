<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title>HORA DO LIXO - LOGIN</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>

    <!-- MEU ESTILO -->
    <link rel="stylesheet" type="text/css" href="../css/login.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>


<body>
    <div id="login-page" class="row" method="POST" action="valida.php">

        <div class="col s12 z-depth-6 card-panel">
            <h2 class="center-align">
                HORA DO LIXO
            </h2>
            <form class="login-page" method="POST" action="valida.php">
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">email</i>
                        <input name="email" id="inputEmail" type="email" c required autofocus>
                        <label for="inputEmail" >Email*</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">https</i>
                        <input name="senha" id="inputPassword" type="password" class="validate">
                        <label for="inputPassword">Senha*</label>
                    </div>
                </div>
                <div class=" red-text center-align">
                    <?php
                    if(isset($_SESSION['loginErro'])){
                        echo $_SESSION['loginErro'];
                        unset($_SESSION['loginErro']);
                    }
                    if(isset($_SESSION['logindeslogado'])){
                        echo $_SESSION['logindeslogado'];
                        unset($_SESSION['logindeslogado']);
                    }
                    ?>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button type="submit" class="btn waves-effect waves-light col s12">Login</button>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6 m6 l6">
                        <p
                        class="margin medium-small"><a href="#">Registrar Agora!</a></p>
                    </div>
                    <div class="input-field col s6 m6 l6">
                        <p class="margin right-align medium-small"><a href="#">Esqueceu a senha?</a></p>
                    </div>
                </div>
            </form>
        </div> <!-- /container -->
    </div>
</div>


<footer class="footer">
    <div class="footer-copyright center-align">
        TRABALHO PRÁTICO DE BANCO DE DADOS II - FCT UNESP
    </div>
</footer>


<!--JQUERY-->
<script type="text/javascript" src="../javascript/jquery.js"></script>
<!--MATERIALIZE-->
<script type="text/javascript" src="../javascript/materialize.min.js"></script>

<script>
    function mensagem(){
        Materialize.toast($_SESSION['loginErro']);
    }
    $(document).ready(function() {
        Materialize.updateTextFields();
    });
</script>

</body>




</html>