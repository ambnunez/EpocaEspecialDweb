<?php
require('../includes/connection.php');
session_start();
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestão de Orçamentos | Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .main-content { margin-left: 220px; padding: 20px; }
    .resposta-form { display: none; margin-top: 10px; }
  </style>
</head>
<body>

<?php require('../includes/sidebar.php'); ?>

<div class="main-content">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Pedidos de Orçamento</h2>
  </div>

  <!-- Tabela de Pedidos Ativos -->
  <table class="table table-hover table-bordered align-middle">
    <thead class="table-dark">
      <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>Serviços</th>
        <th>Descrição</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>

    <?php
    $sql = "SELECT * FROM orcamentos WHERE estado = 'p' ORDER BY criado DESC";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['telefone']) . "</td>";
            echo "<td>" . htmlspecialchars($row['servicos']) . "</td>";
            echo "<td>" . htmlspecialchars($row['descricao']) . "</td>";
            echo "<td>
                <button class='btn btn-sm btn-success' onclick='mostrarResposta(" . $row['id'] . ")'>Responder</button>
                <form action='recusar_orcamento.php' method='POST' style='display:inline-block;'>
                  <input type='hidden' name='id' value='" . $row['id'] . "'>
                  <button type='submit' class='btn btn-sm btn-danger'>Recusar</button>
                </form>

                <div id='resposta-" . $row['id'] . "' class='resposta-form'>
                  <form action='enviar_resposta.php' method='POST'>
                    <input type='hidden' name='email_cliente' value='" . htmlspecialchars($row['email']) . "'>
                    <input type='hidden' name='nome_cliente' value='" . htmlspecialchars($row['nome']) . "'>
                    <div class='mb-2'>
                      <textarea name='mensagem' class='form-control' rows='3' placeholder='Escreva aqui a sua resposta com o orçamento...' required></textarea>
                    </div>
                    <button type='submit' class='btn btn-primary btn-sm'>Enviar Resposta</button>
                  </form>
                </div>

              </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6' class='text-center'>Nenhum pedido de orçamento pendente.</td></tr>";
    }
    ?>

    </tbody>
  </table>

  <!-- Histórico de Orçamentos -->
  <h4 class="mt-5 mb-3">Histórico de Pedidos Finalizados</h4>

  <table class="table table-bordered align-middle">
    <thead class="table-light">
      <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Serviços</th>
        <th>Descrição</th>
        <th>Resposta</th>
        <th>Estado</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $sqlHist = "SELECT * FROM orcamentos WHERE estado IN ('a','r') ORDER BY criado DESC";
    $resHist = $conn->query($sqlHist);

    if ($resHist->num_rows > 0) {
        while ($row = $resHist->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['servicos']) . "</td>";
            echo "<td>" . nl2br(htmlspecialchars($row['descricao'])) . "</td>";
            echo "<td>" . nl2br(htmlspecialchars($row['resposta'])) . "</td>";
            echo "<td>";
            if ($row['estado'] === 'a') {
              echo "<span class='badge bg-success'>Aceite</span>";
            } elseif ($row['estado'] === 'r') {
              echo "<span class='badge bg-danger'>Recusado</span>";
            }
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6' class='text-center'>Sem histórico de pedidos finalizados.</td></tr>";
    }
    ?>
    </tbody>
  </table>

</div>

<script>
  function mostrarResposta(id) {
    var resposta = document.getElementById('resposta-' + id);
    if (resposta.style.display === 'none' || resposta.style.display === '') {
      resposta.style.display = 'block';
    } else {
      resposta.style.display = 'none';
    }
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
