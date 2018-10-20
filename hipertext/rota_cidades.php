<?php
include_once("conexao.php");
$termo = ($_GET['termo']);
$q = mysqli_real_escape_string($conn, $termo);

$sql = "SELECT * FROM horadolixo.cidades WHERE LOCATE('$q',nome) ORDER BY nome ASC, estado ASC limit 10";
$r = mysqli_query($conn, $sql);

if ( mysqli_num_rows($r) == '0')
    $resultado = "Sem resultados";
else {
    $resultado = "";
    while ($l = mysqli_fetch_array($r))
        $resultado .= $l['nome'] . ' - ' . $l['uf'] . ',';
}
$resultado =rtrim($resultado, ',');
echo $resultado;
?>