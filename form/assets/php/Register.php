<?php
// Configurações do banco de dados (substitua com suas informações)
$servername = "localhost"; // Ou o endereço do seu servidor de banco de dados
$username = "root"; // Seu usuário do banco de dados
$password = ""; // Sua senha do banco de dados


// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Coleta os dados do formulário
$nome = $_POST["nome"];
$email = $_POST["email"];
$telefone = $_POST["telefone"];
$genero = $_POST["genero"];
$datanascimento = $_POST["datanascimento"];
$cidade = $_POST["cidade"];
$estado = $_POST["estado"];
$endereco = $_POST["endereco"];
$senha = password_hash($_POST["senha"], PASSWORD_DEFAULT); // Hash da senha para segurança

// Prepara a instrução SQL para inserir os dados
$sql = "INSERT INTO usuarios (nome, email, telefone, genero, datanascimento, cidade, estado, endereco, senha)
        VALUES ('$nome', '$email', '$telefone', '$genero', '$datanascimento', '$cidade', '$estado', '$endereco', '$senha')";

// Executa a instrução SQL e verifica se foi bem-sucedida
if ($conn->query($sql) === TRUE) {
    echo "Cadastro realizado com sucesso!";
    // Redireciona para uma página de sucesso após 3 segundos (opcional)
    header("refresh:3;url=pagina_de_sucesso.html");
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
