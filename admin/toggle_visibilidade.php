<?php
require('../includes/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Obter valor atual
    $query = $conn->prepare("SELECT visivel FROM projetos WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();

    if ($row = $result->fetch_assoc()) {
        $novo_estado = $row['visivel'] ? 0 : 1;

        // Atualizar visibilidade
        $update = $conn->prepare("UPDATE projetos SET visivel = ? WHERE id = ?");
        $update->bind_param("ii", $novo_estado, $id);
        $update->execute();
    }
}

header("Location: projetos.php"); // volta à lista
exit();
