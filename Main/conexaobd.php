<?php        
$host = "localhost";
$user = "root";
$key = "";
$bd = "projeto_estoque";

// Estabelecendo conexão
$con = new mysqli($host, $user, $key, $bd);

// Declarando o uso do UTF-8
mysqli_set_charset($con,"utf8");

if ($con->connect_errno) {
    echo "Falha ao conectar ao banco: (" . $con->connect_errno . ") " . $con->connect_error;
}
