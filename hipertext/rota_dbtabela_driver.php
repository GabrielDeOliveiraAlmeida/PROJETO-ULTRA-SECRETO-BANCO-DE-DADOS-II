<?php
include_once('conexao.php');
header('Content-Type: text/html; charset=utf-8');

$dia = mysqli_real_escape_string($conn, $_POST['dia']);

$sql = "call motoristas_que_nao_trabalham_no_dia('$dia')";
$result = mysqli_query($conn, $sql);

$output = '<div><table class="highlight" id="selecionardrivers">
    <thead class="centered">
<tr>
    <th width="60%">Nome Completo</th>
    <th width="40%">E-mail</th>
</tr>
</thead>
<tbody>';

$rows = mysqli_num_rows($result);

if($rows > 0){
    while($row = mysqli_fetch_array($result)){
        $output .= '  
                <tr>  
                     <td>'.$row["nome"].' '.$row["sobrenome"].'</td>  
                     <td>'.$row["theEmail"].'</td>  
                </tr>';
    }
}
$output .= '</tbody></table></div>';

echo $output;
?>
