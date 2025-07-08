<?php
require('../includes/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Remoção lógica
    $sql = "UPDATE utilizadores SET visivel = 0 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: utilizadores.php?removido=1");
        exit; // <-- MUITO IMPORTANTE
    } else {
        echo "Erro ao ocultar utilizador.";
    }
}
?>
