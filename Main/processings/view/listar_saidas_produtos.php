<?php

// Conexão com banco de dados
require_once('../../conexaobd.php');

$output = '';  

$sql = 
"SELECT *, B.nomeProduto FROM controle_produtos JOIN aux_produtos B ON produto = B.idProduto WHERE acaoControle = 2 ORDER BY idControle DESC";  
$result = mysqli_query($con, $sql);  

     $output .= '  

          <table class="table" style="width:100%;">
               <thead>
                    <tr> 
                         <th>Codigo</th>
                         <th>Produto</th>
                         <th>Quantidade</th>
                         <th>Data da saída</th>
                    </tr>
               </thead>    
      ';

     // Verificando quantidade de registros
     $qtd_rows = mysqli_num_rows($result);  
     $sem_registros = ($qtd_rows == 0) ? '<h4>NÃO POSSUI SAÍDAS DE PRODUTOS</h4>' : '';

      // Listar registros
      $i = 0;
      while($row = mysqli_fetch_array($result))  
      {  

           $i++;
           $output .= '  
                <tr>  
                    <td>'.$i.'</td>  
                    <td>'.$row["nomeProduto"].'</td>
                    <td>'.$row["quantidade"].'</td>
                    <td>'.date('d/m/Y', strtotime($row['data'])).'</td>
                </tr>  
           ';  
      }  

 $output .= '</table>  


 <br>'.$sem_registros.'';  

 echo $output;  
?>

