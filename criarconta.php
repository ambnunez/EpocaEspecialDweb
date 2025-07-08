<?php 
session_start();
require('./includes/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $tipo_utilizador = 'cliente'; // Por padrão
    $visivel = 1; // Novo campo: visível por defeito

    $sql = "INSERT INTO utilizadores (nome, email, password, tipo_utilizador, visivel) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nome, $email, $password, $tipo_utilizador, $visivel);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success text-center'>Conta criada com sucesso! <a href='login.php'>Entrar agora</a></div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Erro ao criar conta: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Criar Conta | TechSolutions</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 100%; max-width: 450px;">
      <h3 class="text-center mb-4">Criar Conta</h3>

      <form action="criarconta.php" method="POST">

        <div class="mb-3">
          <label for="nome" class="form-label">Nome completo ou Empresa</label>
          <input type="text" class="form-control" id="nome" name="nome" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Palavra-passe</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3">
          <label for="confirmar" class="form-label">Confirmar palavra-passe</label>
          <input type="password" class="form-control" id="confirmar" name="confirmar" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Criar Conta</button>

        <div class="text-center mt-3">
          <a href="login.php" class="text-dark text-decoration-none">Já tens conta? Entrar</a>
        </div>

      </form>
    </div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
