<?php
include_once 'db.php'; // Inclua o arquivo de conexão

// Verifique se o usuário deseja excluir um registro
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $deleteQuery = "DELETE FROM users WHERE id = ?";
    $deleteStmt = $conn->prepare($deleteQuery);
    $deleteStmt->bind_param("i", $id);

    if ($deleteStmt->execute()) {
        echo "Usuário excluído com sucesso!";
    } else {
        echo "Erro ao excluir o usuário: " . $deleteStmt->error;
    }
    $deleteStmt->close();
}

// Selecione todos os usuários
$query = "SELECT * FROM users"; 
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Inicie a tabela
    echo "<table border='1'>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Sexo</th>
                <th>Data de Nascimento</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>Endereço</th>
                <th>Ações</th>
            </tr>";

    // Exiba os dados de cada linha
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['nome']}</td>
                <td>{$row['email']}</td>
                <td>{$row['telefone']}</td>
                <td>{$row['sexo']}</td>
                <td>{$row['data_nascimento']}</td>
                <td>{$row['cidade']}</td>
                <td>{$row['estado']}</td>
                <td>{$row['endereco']}</td>
                <td>
                    <a href='view_users.php?delete={$row['id']}' onclick=\"return confirm('Tem certeza que deseja excluir este usuário?');\">Excluir</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum registro encontrado.";
}

$conn->close(); // Feche a conexão
?>