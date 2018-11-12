<?php
include_once("conexao.php");

$cidade = mysqli_real_escape_string($conn, $_POST['cidade']);
$cidade = str_replace("+"," ",$cidade);
$uf = mysqli_real_escape_string($conn, $_POST['estado']);
$sql = "SELECT * FROM cidades WHERE nome = '$cidade' and uf = '$uf'";
$r = mysqli_query($conn, $sql);

if ( mysqli_num_rows($r) == '1'){
if($r) echo "TRUE";
else echo "FALSE";
}else echo "FALSE";


?>