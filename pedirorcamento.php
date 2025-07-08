<?php
session_start();
require('./includes/connection.php'); // Ligação à base de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $descricao = $_POST['descricao'];

    // Verificar se foram selecionados serviços
    if (!empty($_POST['servicos'])) {
        $servicos = implode(', ', $_POST['servicos']); // Junta todos os serviços selecionados
    } else {
        $servicos = '';
    }

    // Inserir na base de dados
    $sql = "INSERT INTO orcamentos (nome, email, telefone, servicos, descricao, criado) VALUES (?, ?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $nome, $email, $telefone, $servicos, $descricao);


    if ($stmt->execute()) {
        echo "<div class='container my-5'>
                <div class='alert alert-success'>Pedido enviado com sucesso! Em breve entraremos em contacto.</div>
                <a href='index.php' class='btn btn-primary'>Voltar ao Início</a>
              </div>";
    } else {
        echo "<div class='container my-5'>
                <div class='alert alert-danger'>Erro ao enviar pedido: " . $conn->error . "</div>
                <a href='index.php' class='btn btn-secondary'>Voltar</a>
              </div>";
    }

    $stmt->close();
}

$conn->close();
?>
