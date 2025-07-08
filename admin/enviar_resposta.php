<?php
require('../includes/connection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email_cliente = $_POST['email_cliente'] ?? '';
    $nome_cliente = $_POST['nome_cliente'] ?? '';
    $mensagem = trim($_POST['mensagem'] ?? '');

    // Obter o ID do orçamento
    $stmt = $conn->prepare("SELECT id FROM orcamentos WHERE email = ? AND resposta IS NULL AND estado = 'p' ORDER BY criado DESC LIMIT 1");
    $stmt->bind_param("s", $email_cliente);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1 && !empty($mensagem)) {
        $row = $result->fetch_assoc();
        $orcamento_id = $row['id'];

        // Atualizar a resposta no orçamento
        $stmt2 = $conn->prepare("UPDATE orcamentos SET resposta = ? WHERE id = ?");
        $stmt2->bind_param("si", $mensagem, $orcamento_id);

        if ($stmt2->execute()) {
            $_SESSION['success'] = "Resposta enviada com sucesso!";
        } else {
            $_SESSION['error'] = "Erro ao atualizar a resposta.";
        }

        $stmt2->close();
    } else {
        $_SESSION['error'] = "Pedido de orçamento não encontrado ou mensagem em branco.";
    }

    $stmt->close();
    $conn->close();
}

header("Location: ../admin/inicio.php");
exit;
