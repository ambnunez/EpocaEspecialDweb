<?php
require('../includes/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = trim($_POST['titulo']);
    $descricao = trim($_POST['descricao']);

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
        $nomeImagem = time() . "_" . basename($_FILES['imagem']['name']);
        $caminho = "../uploads/" . $nomeImagem;
        move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho);

        $sql = "INSERT INTO projetos (titulo, descricao, imagem) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $titulo, $descricao, $nomeImagem);

        if ($stmt->execute()) {
            header("Location: projetos.php");
            exit();
        } else {
            echo "Erro ao adicionar projeto!";
        }
    } else {
        echo "Erro no upload da imagem!";
    }
}
?>
