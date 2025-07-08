<?php
require('../includes/connection.php');
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestão de Projetos | Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .main-content { margin-left: 220px; padding: 20px; }
    .img-thumb {
      width: 100px;
      height: 60px;
      object-fit: cover;
      border-radius: 5px;
    }
  </style>
</head>
<body>

<?php require('../includes/sidebar.php'); ?>

<div class="main-content">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Gestão de Projetos</h2>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAdicionarProjeto">
      Adicionar Projeto
    </button>
  </div>

  <!-- Tabela de Projetos -->
  <table class="table table-hover table-bordered align-middle">
    <thead class="table-dark">
      <tr>
        <th>Imagem</th>
        <th>Título</th>
        <th>Descrição</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody id="tabelaProjetos">
      <?php
      $sql = "SELECT * FROM projetos";
      $resultado = $conn->query($sql);

      if ($resultado->num_rows > 0) {
          while ($row = $resultado->fetch_assoc()) {
              echo "<tr>";
              echo "<td><img src='../uploads/" . htmlspecialchars($row['imagem']) . "' class='img-thumb' alt='Projeto'></td>";
              echo "<td>" . htmlspecialchars($row['titulo']) . "</td>";
              echo "<td>" . htmlspecialchars($row['descricao']) . "</td>";
              echo "<td>
                      <form action='remover_projeto.php' method='POST' onsubmit='return confirm(\"Tens a certeza que queres remover este projeto?\");'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <button type='submit' class='btn btn-sm btn-danger'>Remover</button>
                      </form>
                    </td>";
              echo "</tr>";
          }
      } else {
          echo "<tr><td colspan='4' class='text-center'>Nenhum projeto encontrado.</td></tr>";
      }
      ?>
    </tbody>
  </table>
</div>

<!-- Modal Adicionar Projeto -->
<div class="modal fade" id="modalAdicionarProjeto" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" action="adicionar_projeto.php" method="POST" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title">Adicionar Novo Projeto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Título do Projeto</label>
          <input type="text" class="form-control" name="titulo" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Descrição Curta</label>
          <textarea class="form-control" name="descricao" rows="3" required></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Imagem do Projeto</label>
          <input type="file" class="form-control" name="imagem" accept="image/*" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Adicionar Projeto</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
