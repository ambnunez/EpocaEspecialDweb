<?php
session_start();
require('./includes/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Verificar se o email existe
    $sql = "SELECT * FROM utilizadores WHERE email = ? AND visivel = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        $user = $resultado->fetch_assoc();

        if (!$user['visivel']) {
            $erro = "A sua conta está desativada. Contacte o administrador.";
        } elseif (password_verify($password, $user['password'])) {
            // Guardar dados na sessão
            $_SESSION['id'] = $user['id'];
            $_SESSION['nome'] = $user['nome'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['tipo_utilizador'] = $user['tipo_utilizador'];

            // Redirecionar dependendo do tipo de utilizador
            if ($user['email'] === "admin@techsolutions.com" && $user['tipo_utilizador'] === "admin") {
                header('Location: admin/inicio.php');
                exit();
            } else {
                header('Location: index.php');
                exit();
            }
        } else {
            $erro = "Palavra-passe incorreta!";
        }
    } else {
        $erro = "Email não encontrado!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | TechSolutions</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url('imagens/loginsfundo.jpg') no-repeat center center fixed;
      background-size: cover;
    }
    .login-card {
      background-color: rgba(255, 255, 255, 0.9);
      border-radius: 12px;
    }
  </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
  <div class="card shadow p-4 login-card" style="width: 100%; max-width: 400px;">
    <h3 class="text-center mb-4">Login</h3>

    <?php if (isset($erro)): ?>
      <div class="alert alert-danger text-center"><?php echo $erro; ?></div>
    <?php endif; ?>

    <form action="login.php" method="POST">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Palavra-passe</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>

      <button type="submit" class="btn btn-primary w-100">Entrar</button>

      <div class="text-center mt-3">
        <a href="#">Esqueceste a tua palavra-passe?</a>
      </div>

      <div class="text-center mt-3">
        <a href="criarconta.php" class="text-dark text-decoration-none">Registar</a>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
