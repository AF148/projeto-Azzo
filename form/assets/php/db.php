<?php
$host = "localhost";
$user = "root";
$password = ""; // Se houver uma senha, coloque-a aqui.
$dbname = "Azzo";

$conn = new mysqli($host, $user, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error . " (Código de erro: " . $conn->connect_errno . ")");
}
?>