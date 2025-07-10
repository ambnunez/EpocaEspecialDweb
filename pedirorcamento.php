<?php
session_start();
require('./includes/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $descricao = $_POST['descricao'];
    $servicos = !empty($_POST['servicos']) ? implode(', ', $_POST['servicos']) : '';

    $sql = "INSERT INTO orcamentos (nome, email, telefone, servicos, descricao, criado) VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nome, $email, $telefone, $servicos, $descricao);

    if ($stmt->execute()) {
        $_SESSION['sucesso'] = "Pedido enviado com sucesso! Em breve entraremos em contacto.";
    } else {
        $_SESSION['erro'] = "Erro ao enviar pedido: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: orcamento.php");
    exit();
}
?>