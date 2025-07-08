<!-- Sidebar Admin -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
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
  }
  .admin-sidebar a {
    display: block;
    color: white;
    padding: 12px 20px;
    text-decoration: none;
  }
  .admin-sidebar a:hover {
    background-color: #0b5ed7;
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
  }
</style>

<div class="admin-sidebar">
  <div class="sidebar-title">Admin</div>
  <a href="inicio.php"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
  <a href="utilizadores.php"><i class="bi bi-people me-2"></i>Utilizadores</a>
  <a href="projetos.php"><i class="bi bi-folder2-open me-2"></i>Projetos</a>
  <a href="pedidosorcamentos.php"><i class="bi bi-file-earmark-text me-2"></i>Orçamentos</a>
  <a href="definicoes.php"><i class="bi bi-gear me-2"></i>Definições</a>
  <a href="index.php" class="mt-4"><i class="bi bi-box-arrow-right me-2"></i>Sair</a>
</div>
