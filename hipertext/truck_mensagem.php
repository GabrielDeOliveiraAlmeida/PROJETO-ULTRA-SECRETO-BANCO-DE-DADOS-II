<?php
include_once("conexao.php");


//SLQ INJECTION
$modelo = mysqli_real_escape_string($conn, $_POST['modelo_truck']);
$ano = mysqli_real_escape_string($conn, $_POST['ano_truck']);
$serie = mysqli_real_escape_string($conn, $_POST['serie_truck']);
$placa = mysqli_real_escape_string($conn, $_POST['placa_truck']);

$retorno = array("sucesso"=>TRUE, "msg"=>"");

if($modelo ==""){
        $retorno["sucesso"]=FALSE;
        $retorno["msg"] = "<p class='center-align' style='color: #fc2c2e; '>Modelo não pode ser vazio</p>";
}
if($serie ==""){
        $retorno["sucesso"]=FALSE;
        $retorno["msg"].= "<p class='center-align' style='color: #fc2c2e; '>Serie não pode ser vazio</p>";
}
if($placa == ""){
        $retorno["sucesso"]=FALSE;
        $retorno["msg"].= "<p class='center-align' style='color: #fc2c2e; '>Placa não pode ser vazio</p>";
}



if($retorno["sucesso"]==FALSE){
        echo json_encode($retorno);
}else{
        //FAZ A PORRA DO INSET
        $inserta = "INSERT INTO caminhao(modelo, ano, serie, placa) 
                VALUES ('$modelo', '$ano', '$serie',  '$placa')";
        $result= mysqli_query($conn, $inserta);

//E MANDA DE VOLTA
        if($result){
                $retorno["sucesso"]=TRUE;
                $retorno["msg"] = "<p class='center-align' style='color: #28d728; '>CADASTRO REALIZADO COM SUCESSO</p>";
                echo json_encode($retorno);
        }else{
                $retorno["sucesso"]=FALSE;
                $retorno["msg"] ="<p class= 'center-align' style='color: #fc2c2e; '>CAMINHÃO JÁ CADASTRADO</p>";
                echo json_encode($retorno);
        }
}
?>