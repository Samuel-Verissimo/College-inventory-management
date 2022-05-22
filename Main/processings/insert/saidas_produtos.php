<?php  

// Conexão com o banco de dados
require_once('../../conexaobd.php');

// Declarando variaveis
$produto = $_POST["produto"];
$quantidade = $_POST["quantidade"];
$data = $_POST["data"];

// Realizando cadastro
$insertSaida = "INSERT INTO controle_produtos(acaoControle, produto, quantidade, data) VALUES(2, ".$produto.", ".$quantidade.", '".$data."')";  

// Verificando se deu tudo certo...
if(mysqli_query($con, $insertSaida)){
    echo 1;
}else{
    echo 2;
}
   

?>