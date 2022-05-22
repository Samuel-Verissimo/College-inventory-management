<?php

// Conexão com banco de dados
require_once('../../conexaobd.php');

$output = '';  

// Consultando VIEW criada
$sql = "SELECT * FROM view_estoqueprodutos";  
$result = mysqli_query($con, $sql);  

     $output .= '  

          <table class="table" style="width:100%;">
               <thead>
                    <tr> 
                         <th>Código</th>
                         <th>Produto</th>
                         <th>Quantidade atual</th>
                         <th>Imagem</th>
                         <th>Status</th>
                    </tr>
               </thead>    
      ';

     // Verificando quantidade de registros
     $qtd_rows = mysqli_num_rows($result);  
     $sem_registros = ($qtd_rows == 0) ? '<h4>NÃO POSSUI PRODUTOS NO ESTOQUE</h4>' : '';

      // Listar registros
      $i = 0;
      while($row = mysqli_fetch_array($result))  
      {  

          // Verificando se produto possui imagem
          if($row["imagemProduto"] != ''){
               $imagem = "<a href='uploads/produtos/".$row["imagemProduto"]."''><img src='uploads/produtos/".$row["imagemProduto"]."'> </a>";
          }else{
               $imagem = "<img src='https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg'>";
          }

          // Verificando quantidade atual para gerar status
          if($row["quantidadeAtual"] < 1){
            $status = "<label class='badge badge-danger'>Esgotado</label>";
           
          }elseif($row["quantidadeAtual"] > 10){
            $status = "<label class='badge badge-success'>Em estoque</label>";

          }else{
             $status = "<label class='badge badge-warning'>Esgotando</label>";
          }

           $i++;
           $output .= '  
                <tr>  
                    <td>'.$row["idProduto"].'</td>  
                    <td>'.$row["nomeProduto"].'</td>
                    <td>'.$row["quantidadeAtual"].'</td>
                    <td>'.$imagem.'</td>
                    <td>'.$status.'</td>
                </tr>  
           ';  
      }  

 $output .= '</table>  


 <br>'.$sem_registros.'';  

 echo $output;  
?>

