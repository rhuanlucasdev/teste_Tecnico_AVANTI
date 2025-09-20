<?php
//Configurações do banco de dados
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "estoque_db";

//Criando conexao
$conn = new mysqli($host, $user, $pass, $dbname);

//Checar conexao
if ($conn->connect_error) {
  die("Erro na conexao com o banco: ". $conn->connect_error);
}
?>