<?php
require('includes/connection.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $acao = $_POST['acao']; // Deve ser 'a' (aceite) ou 'r' (recusado)

    if (!in_array($acao, ['a', 'r'])) {
        echo "<script>alert('Ação inválida'); history.back();</script>";
        exit;
    }

    // Verifica se o orçamento pertence ao cliente autenticado
    $stmt = $conn->prepare("SELECT email FROM orcamentos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_assoc()) {
        if ($row['email'] !== $_SESSION['email']) {
            echo "<script>alert('Não tens permissão para alterar este orçamento.'); history.back();</script>";
            exit;
        }
    } else {
        echo "<script>alert('Orçamento não encontrado.'); history.back();</script>";
        exit;
    }

    // Atualiza o estado
    $stmt = $conn->prepare("UPDATE orcamentos SET estado = ? WHERE id = ?");
    $stmt->bind_param("si", $acao, $id);
    $stmt->execute();

    echo "<script>alert('A tua decisão foi registada com sucesso.'); window.location.href='area_cliente.php';</script>";
}
?>
