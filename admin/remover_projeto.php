<?php
require('../includes/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Primeiro buscar a imagem para apagar o ficheiro também
    $sqlImg = "SELECT imagem FROM projetos WHERE id = ?";
    $stmtImg = $conn->prepare($sqlImg);
    $stmtImg->bind_param("i", $id);
    $stmtImg->execute();
    $resultado = $stmtImg->get_result();
    $projeto = $resultado->fetch_assoc();

    if ($projeto && file_exists("../uploads/" . $projeto['imagem'])) {
        unlink("../uploads/" . $projeto['imagem']);
    }

    // Agora apagar da base de dados
    $sql = "DELETE FROM projetos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: projetos.php");
        exit();
    } else {
        echo "Erro ao remover projeto!";
    }
}
?>
