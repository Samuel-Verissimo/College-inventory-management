<?php

// Conexão com banco de dados
require_once('../../conexaobd.php');

// Destino que a imagem sera guardada
$destino = "../../uploads/produtos/";

// Se não existir, criar
if (!file_exists($destino)) {
    mkdir($destino, 0777, true);
}

// Variaveis das documentações
$arquivo = $_FILES["files"]; 
$nome_arquivo = array_filter($arquivo['name']); 

// Extensões aceitas
$ext_aceitas = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 


// Se existir documentos
if(!empty($nome_arquivo)){  

    // Declarando o nome do novo do produto
    $novo_produto = $_POST["novo_produto"]; 

    // Verificando se já existe esse produto
    $sql_verifica = mysqli_query($con, "SELECT nomeProduto FROM aux_produtos WHERE nomeProduto = UPPER('$novo_produto')");

    // Se existir registros...
    if (mysqli_num_rows($sql_verifica) > 0) {
        echo 3;
        exit;

    // Se não existir registros...
    }else{
        // Total de arquivos
        $qtd_arquivos = count($_FILES['files']['name']);

        // Loop para enviar todos os arquivos
        for($i = 0; $i < $qtd_arquivos; $i++){

            // File upload path  
            $fileName = basename($arquivo['name'][$i]);  
            $caminho_arquivo = $destino . $fileName;  
            
            // Verificando as extensões do arquivo 
            $fileType = pathinfo($caminho_arquivo, PATHINFO_EXTENSION);  
            if(in_array($fileType, $ext_aceitas)){  

                // Enviar arquivos para a pasta
                if(move_uploaded_file($arquivo["tmp_name"][$i], $caminho_arquivo)){  
                    $uploadedFile = $fileName; 
                }

                // Salvando o caminho das imagens no banco.
                $upload = "INSERT INTO aux_produtos (nomeProduto, imagemProduto) VALUES (UPPER('$novo_produto'), '$uploadedFile')";
                $executa_upload = mysqli_query($con, $upload) or die("Não foi possível realizar esse cadastro!");
            }    
        } 

        // Caso der tudo certo, exibir a mensagem para o usuário...
        if ($executa_upload) {echo 1;exit;}
        else{echo 2;exit;}  
    }
}



?>


