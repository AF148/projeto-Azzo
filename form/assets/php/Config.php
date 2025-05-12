<?php
$host = "localhost";
$user = "root";          // Usuário padrão do XAMPP
$password = "";          // Senha padrão do XAMPP (em branco)
$dbname = "Azzo";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>