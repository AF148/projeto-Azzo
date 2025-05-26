<?php
// Exibir erros para depuração
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$database = "azzo"; // Substitua pelo nome correto do seu banco

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $database);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário garantindo que não estejam vazios
    $nome = isset($_POST["nome"]) ? trim($_POST["nome"]) : '';
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : '';
    $telefone = isset($_POST["telefone"]) ? trim($_POST["telefone"]) : '';
    $genero = isset($_POST["genero"]) ? trim($_POST["genero"]) : '';
    $datanascimento = isset($_POST["datanascimento"]) ? trim($_POST["datanascimento"]) : '';
    $cidade = isset($_POST["cidade"]) ? trim($_POST["cidade"]) : '';
    $estado = isset($_POST["estado"]) ? trim($_POST["estado"]) : '';
    $endereco = isset($_POST["endereco"]) ? trim($_POST["endereco"]) : '';
    $senha = isset($_POST["senha"]) ? password_hash(trim($_POST["senha"]), PASSWORD_DEFAULT) : '';

    // Verifica se campos obrigatórios estão preenchidos
    if (empty($email) || empty($senha)) {
        die("Erro: O campo 'email' e 'senha' são obrigatórios!");
    }

    // Verifica se o email já existe no banco antes de inserir
    $stmt_check = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        die("Erro: Esse email já está cadastrado!");
    }

    $stmt_check->close();

    // Prepara a inserção segura dos dados no banco
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, telefone, genero, datanascimento, cidade, estado, endereco, senha) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $nome, $email, $telefone, $genero, $datanascimento, $cidade, $estado, $endereco, $senha);

    // Executa a inserção e verifica se foi bem-sucedida
    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso!";
        header("refresh:3;url=pagina_de_sucesso.html"); // Redireciona após 3 segundos
        exit();
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }

    // Fecha a conexão
    $stmt->close();
    $conn->close();
} else {
    echo "Erro: O formulário não foi enviado corretamente.";
}

if (!$resultado) {
    echo "Erro na inserção: " . mysqli_error($conn);
}


?>
