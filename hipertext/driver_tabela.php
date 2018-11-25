<?php
include_once('conexao.php');
header('Content-Type: text/html; charset=utf-8');

$sql = "CALL listar_motoristas_por_ordem_alfabetica()";

$result = mysqli_query($conn, $sql);

$output = 
'<div><table id="drivers">
    <thead class="centered">
<tr>
    <th width="40%">Nome Completo</th>
    <th width="30%">E-mail</th>
    <th width="20%">Telefone</th>
    <th width="10%">Excluir</th>
</tr>
</thead>
<tbody>
';

$rows = mysqli_num_rows($result);

if($rows > 0){
    while($row = mysqli_fetch_array($result)){
        $output .= '  
                <tr>  
                     <td>'.$row["nome"].' '.$row["sobrenome"].'</td>  
                     <td>'.$row["email"].'</td>  
                     <td>'.$row["telefone"].'</td>  
                     <td><button onclick="remover(this);" id="'.$row["email"].'" data-id="'.$row["email"].'" class="btn btn_deletar">X</button></td>  
                </tr>';
    }
}
$output .= '</tbody></table></div>';
echo $output;
?>

<!-- data-id2="'.$row["email"].'" -->