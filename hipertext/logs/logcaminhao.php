<?php
include_once('../conexao.php');
header('Content-Type: text/html; charset=utf-8');

$sql = "call getlogcaminhao()";
$result = mysqli_query($conn, $sql);

$output = '<div><table class="highlight" id="selecionartrucks">
    <thead class="centered">
<tr>
    <th width="25%">Timestamp</th>
    <th width="25%">SQL_User</th>
    <th width="25%">Action</th>
    <th width="25%">Placa</th>
</tr>
</thead>
<tbody>';

$rows = mysqli_num_rows($result);

if($rows > 0){
    while($row = mysqli_fetch_array($result)){
        $output .= '  
                <tr>  
                     <td>'.$row["timestamp"].'</td>
                     <td>'.$row["sqluser"].'</td>  
                     <td>'.$row["action"].'</td>
                     <td>'.$row["placa"].'</td>
                </tr>';
    }
}
$output .= '</tbody></table></div>';

echo $output;
?>
