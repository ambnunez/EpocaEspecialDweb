<?php
require('../includes/connection.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $stmt = $conn->prepare("UPDATE orcamentos SET estado = 'r' WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Orçamento recusado.";
    } else {
        $_SESSION['error'] = "Erro ao recusar.";
    }

    $stmt->close();
}

$conn->close();
header("Location: ../admin/inicio.php");
exit;
