<?php

// Conexão com banco de dados
require_once('../../conexaobd.php');

    // Declarando o nome do novo do produto
    $novo_produto = $_POST["produto"]; 

      // Verificando se já existe esse produto
      $sql_verifica = mysqli_query($con, "SELECT nomeProduto FROM aux_produtos WHERE nomeProduto = UPPER('$novo_produto')");

      // Se existir registros...
      if (mysqli_num_rows($sql_verifica) > 0) {
          echo 3;
          exit;
      }else{

        // Salvando apenas o nome do novo produto
        $upload = "INSERT INTO aux_produtos (nomeProduto) VALUES (UPPER('$novo_produto'))";
        $executa_upload = mysqli_query($con, $upload) or die("Não foi possível realizar esse cadastro!");

        if($executa_upload){
            echo 1;
        }else{
            echo 2;
        }
      }

?>


