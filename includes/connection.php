<?php
// Dados de conexão
$host = 'localhost';
$user = 'web1'; 
$password = 'web1'; 
$database = 'epocaespecialdweb';

// Conexão à base de dados
$conn = new mysqli($host, $user, $password, $database);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

?>
