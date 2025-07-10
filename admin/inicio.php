<?php
require('../includes/connection.php');
session_start();

// Contadores
$res_utilizadores = $conn->query("SELECT COUNT(*) as total FROM utilizadores");
$total_utilizadores = $res_utilizadores->fetch_assoc()['total'];

$res_projetos = $conn->query("SELECT COUNT(*) as total FROM projetos");
$total_projetos = $res_projetos->fetch_assoc()['total'];

$res_orcamentos = $conn->query("SELECT COUNT(*) as total FROM orcamentos");
$total_orcamentos = $res_orcamentos->fetch_assoc()['total'];

// Atividade por semana
$semana = ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'];
$dados_semana = array_fill(0, 7, 0);
$sql = "SELECT WEEKDAY(criado) as dia, COUNT(*) as total FROM orcamentos GROUP BY dia";
$res = $conn->query($sql);
while ($row = $res->fetch_assoc()) {
    $dados_semana[$row['dia']] = $row['total'];
}

// Serviços mais requisitados
$servicos = [];
$quantidades = [];
$sql = "SELECT servicos, COUNT(*) as total FROM orcamentos GROUP BY servicos";
$res = $conn->query($sql);
while ($row = $res->fetch_assoc()) {
    $servicos[] = $row['servicos'];
    $quantidades[] = $row['total'];
}
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>

  <!-- CSS & Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
    }

    .admin-sidebar {
      width: 220px;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      background-color: #0d6efd;
      color: white;
      padding-top: 60px;
      z-index: 1000;
      overflow-y: auto;
    }

    .admin-sidebar .sidebar-title {
      position: absolute;
      top: 0;
      width: 100%;
      padding: 15px 0;
      text-align: center;
      background-color: #0d6efd;
      border-bottom: 1px solid rgba(255, 255, 255, 0.2);
      font-weight: bold;
      font-size: 18px;
    }

    .admin-sidebar a {
      display: block;
      color: white;
      padding: 12px 20px;
      text-decoration: none;
      transition: background 0.2s;
    }

    .admin-sidebar a:hover {
      background-color: #0b5ed7;
    }

    .main-content {
      margin-left: 220px;
      padding: 30px;
      background-color: #f8f9fa;
      min-height: 100vh;
    }

    @media (max-width: 768px) {
      .admin-sidebar {
        position: relative;
        width: 100%;
        height: auto;
        padding-top: 60px;
      }

      .main-content {
        margin-left: 0;
        padding: 20px;
      }
    }
  </style>
</head>
<body>

<?php require('../includes/sidebar.php'); ?>

<div class="main-content">
  <div class="container">
    <h2 class="text-center mb-4">Painel de Administração</h2>

    <!-- Cartões de contagem -->
    <div class="row g-4 text-white">
      <div class="col-md-4">
        <div class="card bg-primary shadow text-center p-3">
          <h5>Total de Utilizadores</h5>
          <p class="display-6"><?= $total_utilizadores ?></p>
          <small>(Admin, Equipa, Clientes)</small>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bg-success shadow text-center p-3">
          <h5>Projetos Publicados</h5>
          <p class="display-6"><?= $total_projetos ?></p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bg-warning shadow text-center p-3">
          <h5>Pedidos de Orçamento</h5>
          <p class="display-6"><?= $total_orcamentos ?></p>
        </div>
      </div>
    </div>

    <!-- Gráficos lado a lado -->
    <div class="my-5">
      <div class="row justify-content-center align-items-start g-4">
        <!-- Gráfico de Atividade -->
        <div class="col-md-4 text-center">
          <h4 class="mb-3">Atividade por Semana</h4>
          <canvas id="graficoAtividade" width="400" height="300"></canvas>
        </div>

        <!-- Gráfico de Serviços -->
        <div class="col-md-4 text-center">
          <h4 class="mb-3">Serviços Mais Requisitados</h4>
          <canvas id="graficoServicos" width="400" height="300"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- JS Charts -->
<script>
const ctx = document.getElementById('graficoAtividade').getContext('2d');
new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
    datasets: [{
      label: 'Pedidos / Atividades',
      data: <?= json_encode($dados_semana) ?>,
      backgroundColor: 'rgba(13, 110, 253, 0.7)'
    }]
  },
  options: {
    responsive: true,
    plugins: { legend: { display: false } }
  }
});

const ctx2 = document.getElementById('graficoServicos').getContext('2d');
new Chart(ctx2, {
  type: 'pie',
  data: {
    labels: <?= json_encode($servicos) ?>,
    datasets: [{
      data: <?= json_encode($quantidades) ?>,
      backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#6610f2', '#fd7e14']
    }]
  },
  options: { responsive: true }
});
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
