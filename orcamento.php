<?php
session_start();
require('./includes/connection.php');
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TechSolutions - Pedido de Orçamento</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>

<?php require('includes/navbar.php'); ?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">

      <?php if (isset($_SESSION['sucesso'])): ?>
        <div class="alert alert-success">
          <?= $_SESSION['sucesso']; unset($_SESSION['sucesso']); ?>
        </div>
      <?php elseif (isset($_SESSION['erro'])): ?>
        <div class="alert alert-danger">
          <?= $_SESSION['erro']; unset($_SESSION['erro']); ?>
        </div>
      <?php endif; ?>

      <div class="card shadow border-0">
        <div class="card-body p-4">
          <h2 class="text-center mb-4 text-success">Pedir Orçamento</h2>

          <form action="pedirorcamento.php" method="POST">

            <div class="mb-3">
              <label for="nome" class="form-label">Nome</label>
              <input type="text" class="form-control" id="nome" name="nome"
                value="<?php echo isset($_SESSION['nome']) ? htmlspecialchars($_SESSION['nome']) : ''; ?>"
                readonly required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email"
                value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>"
                readonly required>
            </div>

            <div class="mb-3">
              <label for="telefone" class="form-label">Telefone</label>
              <input type="tel" class="form-control" id="telefone" name="telefone" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Serviços desejados</label>
              <div class="row row-cols-1 row-cols-sm-2 g-2">
                <?php
                $servicos = ['Desenvolvimento Web', 'Ecommerce', 'Manutenção', 'Marketing Digital'];
                foreach ($servicos as $servico): ?>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="<?= $servico ?>" name="servicos[]" id="<?= strtolower(str_replace(' ', '', $servico)) ?>">
                    <label class="form-check-label" for="<?= strtolower(str_replace(' ', '', $servico)) ?>"><?= $servico ?></label>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>

            <div class="mb-3">
              <label for="descricao" class="form-label">Descrição do Projeto</label>
              <textarea class="form-control" id="descricao" name="descricao" rows="5" placeholder="Descreva o seu projeto com o máximo de detalhes..." required></textarea>
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-success btn-lg">Enviar Pedido</button>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<?php require('includes/footer_infos.php'); ?>
<?php require('includes/rodape.php'); ?>

<script type="text/javascript" src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
