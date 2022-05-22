<?php  

// Conexão com o banco de dados
require_once('../../conexaobd.php');

// Declarando variaveis
$produto = $_POST["produto"];
$quantidade = $_POST["quantidade"];
$data = $_POST["data"];

// Realizando cadastro
$insertEntrada = "INSERT INTO controle_produtos(acaoControle, produto, quantidade, data) VALUES(1, ".$produto.", ".$quantidade.", '".$data."')";  

// Verificando se deu tudo certo...
if(mysqli_query($con, $insertEntrada)){
    echo 1;
}else{
    echo 2;
}
   

?>