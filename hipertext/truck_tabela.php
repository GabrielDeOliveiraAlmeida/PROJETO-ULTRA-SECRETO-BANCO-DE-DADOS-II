<?php
include_once('conexao.php');


$sql = "SELECT * FROM horadolixo.caminhao ORDER BY modelo";

$result = mysqli_query($conn, $sql);

$output = 
'<div><table class="centered">
    <thead>
<tr>
    <th>Modelo</th>
    <th>Ano</th>
    <th>Número série</th>
    <th>Placa</th>
    <th>Excluir</th>
</tr>
</thead>
<tbody>
';

$rows = mysqli_num_rows($result);

if($rows > 0){
    while($row = mysqli_fetch_array($result)){
        $output .= '  
                <tr>  
                     <td>'.$row["modelo"].'</td>  
                     <td>'.$row["ano"].'</td>  
                     <td>'.$row["serie"].'</td>  
                     <td>'.$row["placa"].'</td>  
                     <td><button onclick="remover(this);" id="'.$row["placa"].'" data-id="'.$row["placa"].'" class="btn btn_deletar">X</button></td>  
                </tr>';
    }
}
$output .= '</tbody></table></div>';
echo $output;
?>