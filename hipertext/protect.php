<?php
//verificando se nao existe a funcao protect
if(!function_exists("protect")){
    function protect(){
        if(!isset($_SESSION)){
            session_start();
        }
        if(!isset($usuario)){
            header('Location: login.php');
        }
    }
}
?>﻿