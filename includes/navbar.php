<nav class="navbar navbar-expand-lg shadow-sm p-3" style="background: linear-gradient(to right, #66CDAA, #20B2AA);">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold text-white" href="index.php" style="font-size: 1.5rem;">TechSolutions</a>
    
    <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
      aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ms-auto align-items-lg-center gap-2">

        <a class="nav-link text-white fw-medium" href="orcamento.php">Orçamentos</a>
        <a class="nav-link text-white fw-medium" href="empresa.php">Empresa</a>
        <a class="nav-link text-white fw-medium" href="portfolio.php">Portfólio</a>

        <?php if (isset($_SESSION['nome'])): ?>
          <a class="nav-link text-white fw-semibold border-start ps-3" href="area_cliente.php">
            Olá, <?php echo htmlspecialchars($_SESSION['nome']); ?>!
          </a>

          <a class="nav-link fw-bold text-danger" href="logout.php">Sair</a>
        <?php else: ?>
          <a class="nav-link text-white fw-medium" href="login.php">Login</a>
        <?php endif; ?>

      </div>
    </div>
  </div>
</nav>
