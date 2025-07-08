<?php
require('includes/connection.php');
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

$email = $_SESSION['email'];
$nome = $_SESSION['nome'] ?? 'Cliente';
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <title>Área de Cliente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<?php require('includes/navbar.php'); ?>

<div class="container py-5">
  <div class="text-center mb-4">
    <h2 class="fw-bold"><i class="bi bi-person-circle me-2"></i>Olá, <?= htmlspecialchars($nome) ?></h2>
    <p class="text-muted">A tua área de cliente</p>
  </div>

  <!-- Em Andamento -->
  <div class="mb-5">
    <h4><i class="bi bi-hourglass-split me-2"></i>Pedidos em Andamento</h4>
    <hr>
    <?php
    $stmt = $conn->prepare("SELECT * FROM orcamentos WHERE email = ? AND resposta IS NOT NULL AND estado = 'p' ORDER BY criado DESC");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>
    <?php if ($result->num_rows > 0): ?>
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-primary">
            <tr>
              <th>Serviço</th>
              <th>Descrição</th>
              <th>Resposta</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?= htmlspecialchars($row['servicos']) ?></td>
                <td><?= nl2br(htmlspecialchars($row['descricao'])) ?></td>
                <td><?= nl2br(htmlspecialchars($row['resposta'])) ?></td>
                <td>
                  <form action="responder_orcamento.php" method="POST" class="d-inline">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button type="submit" name="acao" value="a" class="btn btn-sm btn-success">
                      <i class="bi bi-check-circle-fill me-1"></i> Aceitar
                    </button>
                    <button type="submit" name="acao" value="r" class="btn btn-sm btn-outline-danger">
                      <i class="bi bi-x-circle me-1"></i> Recusar
                    </button>
                  </form>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <div class="alert alert-info text-center">
        Não tens pedidos em andamento.<br>
        <a href="orcamento.php" class="btn btn-outline-primary mt-3">
          <i class="bi bi-plus-circle"></i> Fazer Novo Pedido
        </a>
      </div>
    <?php endif; ?>
  </div>

  <!-- Histórico -->
  <div>
    <h4><i class="bi bi-clock-history me-2"></i>Histórico de Pedidos</h4>
    <hr>
    <?php
    $stmt = $conn->prepare("SELECT * FROM orcamentos WHERE email = ? AND estado IN ('a', 'r') ORDER BY criado DESC");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>
    <?php if ($result->num_rows > 0): ?>
      <div class="table-responsive">
        <table class="table table-striped align-middle">
          <thead class="table-secondary">
            <tr>
              <th>Serviço</th>
              <th>Descrição</th>
              <th>Resposta</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?= htmlspecialchars($row['servicos']) ?></td>
                <td><?= nl2br(htmlspecialchars($row['descricao'])) ?></td>
                <td><?= nl2br(htmlspecialchars($row['resposta'])) ?></td>
                <td>
                  <?php
                    echo match($row['estado']) {
                      'a' => '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Aceite</span>',
                      'r' => '<span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i> Recusado</span>',
                      default => '<span class="badge bg-secondary">Desconhecido</span>'
                    };
                  ?>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <div class="alert alert-secondary text-center">
        Ainda não tens pedidos finalizados.<br>
        <a href="orcamento.php" class="btn btn-outline-primary mt-3">
          <i class="bi bi-plus-circle"></i> Fazer Pedido
        </a>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php require('includes/footer_infos.php'); ?>
<?php require('includes/rodape.php'); ?>

<script type="text/javascript" src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
