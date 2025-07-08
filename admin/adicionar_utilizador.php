<?php
require('../includes/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $tipo_utilizador = $_POST['tipo_utilizador'];

    // PROCESSAR UPLOAD DA IMAGEM
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $pasta_destino = "../uploads/equipa/";
        if (!is_dir($pasta_destino)) {
            mkdir($pasta_destino, 0777, true); // criar pasta se não existir
        }

        $nome_ficheiro = uniqid() . "_" . basename($_FILES['imagem']['name']);
        $caminho_ficheiro = $pasta_destino . $nome_ficheiro;

        $tipo_ficheiro = strtolower(pathinfo($caminho_ficheiro, PATHINFO_EXTENSION));
        $permitidos = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($tipo_ficheiro, $permitidos)) {
            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_ficheiro)) {
                $imagem = $nome_ficheiro; // nome do ficheiro para a base de dados
            } else {
                die("Erro ao carregar a imagem!");
            }
        } else {
            die("Tipo de imagem não suportado! Apenas JPG, JPEG, PNG e GIF.");
        }
    } else {
        die("Erro no upload da imagem!");
    }

    // INSERIR NA BASE DE DADOS
    $sql = "INSERT INTO utilizadores (nome, email, password, tipo_utilizador, imagem) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nome, $email, $password, $tipo_utilizador, $imagem);

    if ($stmt->execute()) {
        header("Location: utilizadores.php");
        exit();
    } else {
        echo "Erro ao adicionar utilizador!";
    }
}

?>
