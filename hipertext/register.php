<?php
session_start();
if(isset($_SESSION['user'])) header("location: rota.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title>HORA DO LIXO - REGISTER</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>

    <!-- MEU ESTILO -->
    <link rel="stylesheet" type="text/css" href="../css/login.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>


<body>
    <div id="login-page" class="row">

        <div class="col s12 z-depth-6 card-panel">
            <h2 class="center-align">
                HORA DO LIXO
            </h2>
            <form class="register-page" method="POST" action="register_validacao.php">
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
                        <input name="senha1" id="inputPassword" type="password" class="validate">
                        <label for="inputPasswordOne">Senha*</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">https</i>
                        <input name="senha2" id="inputPassword" type="password" class="validate">
                        <label for="inputPasswordTwo">Repetir Senha*</label>
                    </div>
                </div>
                <div class=" red-text center-align">
                    <?php
                    if(isset($_SESSION['registerErro'])){
                        echo $_SESSION['registerErro'];
                        unset($_SESSION['registerErro']);
                    }
                    ?>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button type="submit" class="btn waves-effect waves-light col s12">Register</button>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6 m6 l6">
                        <p
                        class="margin medium-small"><a href="login.php">Fazer Login!</a></p>
                    </div>
                    <!--
                    <div class="input-field col s6 m6 l6">
                        <p class="margin right-align medium-small"><a href="#">Esqueceu a senha?</a></p>
                    </div>
                    -->
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