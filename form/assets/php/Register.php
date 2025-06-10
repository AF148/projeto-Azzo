<?php
// Configurações do banco
$servername = "localhost";
$username = "root";
$password = "";
$database = "azzo";

$conn = new mysqli($servername, $username, $password, $database);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST["nome"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $telefone = trim($_POST["telefone"]);
    $genero = trim($_POST["genero"]);
    $datanascimento = $_POST["datanascimento"];
    $cidade = trim($_POST["cidade"]);
    $estado = trim($_POST["estado"]);
    $endereco = trim($_POST["endereco"]);
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

    // Prepara e executa a inserção no banco de dados
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, telefone, genero, datanascimento, cidade, estado, endereco, senha) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $nome, $email, $telefone, $genero, $datanascimento, $cidade, $estado, $endereco, $senha);

    if ($stmt->execute()) {
        // Redireciona para o HTML correto com parâmetro de sucesso
        header("Location: logado.php?sucesso=1");
        exit();
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }
    

    $stmt->close();
    $conn->close();
}
?>