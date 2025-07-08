<?php
require('../includes/connection.php');
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestão de Utilizadores | Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .main-content { margin-left: 220px; padding: 20px; }
  </style>
</head>
<body>

<?php require('../includes/sidebar.php'); ?>

<div class="main-content">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Gestão de Utilizadores</h2>
    <div>
      <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#modalAdicionar">Adicionar Equipa</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdicionarAdmin">Adicionar Admin</button>
    </div>
  </div>

  <!-- Filtro por tipo -->
  <div class="mb-4">
    <select class="form-select w-auto" id="filtroTipo" onchange="filtrarTabela()">
      <option value="todos">Todos</option>
      <option value="admin">Admins</option>
      <option value="equipa">Equipa</option>
      <option value="cliente">Clientes</option>
    </select>
  </div>

  <!-- Tabela de Utilizadores -->
  <table class="table table-hover table-bordered align-middle">
    <thead class="table-dark">
      <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Tipo</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody id="tabelaUtilizadores">
      <?php
      $sql = "SELECT * FROM utilizadores WHERE visivel = 1";
      $resultado = $conn->query($sql);

      if ($resultado->num_rows > 0) {
          while ($row = $resultado->fetch_assoc()) {
              echo "<tr data-tipo='" . strtolower($row['tipo_utilizador']) . "'>";
              echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
              echo "<td>" . htmlspecialchars($row['email']) . "</td>";
              echo "<td>" . ucfirst(htmlspecialchars($row['tipo_utilizador'])) . "</td>";
              echo "<td>
                      <form action='remover_utilizador.php' method='POST' onsubmit='return confirm(\"Tens a certeza que queres remover este utilizador?\");'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <button type='submit' class='btn btn-sm btn-danger'>Remover</button>
                      </form>
                    </td>";
              echo "</tr>";
          }
      } else {
          echo "<tr><td colspan='4' class='text-center'>Nenhum utilizador encontrado.</td></tr>";
      }
      ?>
    </tbody>
  </table>
</div>

<!-- Modal Adicionar Equipa -->
<div class="modal fade" id="modalAdicionar" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" action="adicionar_utilizador.php" method="POST" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title">Adicionar Utilizador à Equipa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Nome</label>
          <input type="text" class="form-control" name="nome" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" class="form-control" name="password" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Imagem</label>
          <input type="file" class="form-control" name="imagem" accept="image/*" required>
          <div class="form-text">Envie uma foto do membro da equipa (JPG, PNG, GIF).</div>
        </div>
        <input type="hidden" name="tipo_utilizador" value="equipa">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Adicionar</button>
      </div>
    </form>
  </div>
</div>


<!-- Modal Adicionar Admin -->
<div class="modal fade" id="modalAdicionarAdmin" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" action="adicionar_utilizador.php" method="POST">
      <div class="modal-header">
        <h5 class="modal-title">Adicionar Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Nome</label>
          <input type="text" class="form-control" name="nome" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" class="form-control" name="password" required>
        </div>
        <input type="hidden" name="tipo_utilizador" value="admin">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Adicionar</button>
      </div>
    </form>
  </div>
</div>

<script>
function filtrarTabela() {
    const tipoSelecionado = document.getElementById("filtroTipo").value;
    const linhas = document.querySelectorAll("#tabelaUtilizadores tr");
    linhas.forEach(linha => {
        const tipo = linha.getAttribute("data-tipo");
        linha.style.display = (tipoSelecionado === "todos" || tipo === tipoSelecionado) ? "" : "none";
    });
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
