<?php

// Conexão com banco de dados
require_once('../../conexaobd.php');

$output = '';  

$sql = "SELECT * FROM aux_produtos ORDER BY idProduto DESC";  
$result = mysqli_query($con, $sql);  

     $output .= '  

          <table class="table" style="width:100%;">
               <thead>
                    <tr> 
                         <th>Codigo</th>
                         <th>Produto</th>
                         <th>Imagem</th>
                    </tr>
               </thead>    
      ';

     // Verificando quantidade de registros
     $qtd_rows = mysqli_num_rows($result);  
     $sem_registros = ($qtd_rows == 0) ? '<h4>NÃO POSSUI PRODUTOS CADASTRADOS</h4>' : '';

      // Listar registros
      $i = 0;
      while($row = mysqli_fetch_array($result))  
      {  

          // Verificando se produto possui imagem
          if($row["imagemProduto"] != ''){
               $imagem = "<a href='uploads/produtos/".$row["imagemProduto"]."''><img class='minha-imagem' src='uploads/produtos/".$row["imagemProduto"]."'> </a>";
          }else{
               $imagem = "<img src='https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg'>";
          }

           $i++;
           $output .= '  
                <tr>  
                    <td>'.$i.'</td>  
                    <td>'.$row["nomeProduto"].'</td>
                    <td>'.$imagem.'</td>
                </tr>  
           ';  
      }  

 $output .= '</table>  


 <br>'.$sem_registros.'';  

 echo $output;  
?>

