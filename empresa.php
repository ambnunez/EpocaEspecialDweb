<?php
session_start();
require('./includes/connection.php');
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechSolutions</title>
    <link rel="stylesheet" href="styles.css"> <!-- Opcional -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>

<?php require('includes/navbar.php'); ?>

<!-- SOBRE -->
<div class="container my-5">
  <div class="row align-items-center">
    <div class="col-md-6 mb-4 mb-md-0">
      <img src="imagens/imagemfundo.png" alt="TechSolutions" class="img-fluid rounded shadow">
    </div>
    <div class="col-md-6">
      <h2 class="mb-3">Sobre a TechSolutions</h2>
      <p>A <strong>TechSolutions</strong> é especializada em soluções digitais inovadoras, como websites, lojas online, marketing digital e manutenção técnica.</p>
      <p>Atuamos em projetos personalizados com design moderno e performance otimizada. Comprometemo-nos com qualidade, rapidez e suporte contínuo.</p>
      <a href="index.php" class="btn btn-success mt-3">Sobre os Nossos Serviços</a>
    </div>
  </div>
</div>

<!-- MAPA -->
<div class="container mb-5">
  <h3 class="text-center mb-4">Onde estamos</h3>
  <div class="rounded shadow overflow-hidden" style="height: 300px;">
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3110.983957237627!2d-8.611004884654452!3d41.14961057928573!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2464fcd4ed6149%3A0xebb8ab80f6df191a!2sAvenida%20da%20Boavista%2C%20Porto!5e0!3m2!1spt-PT!2spt!4v1680991607231!5m2!1spt-PT!2spt"
      width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
      referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>
</div>

<!-- EQUIPA -->
<div class="container my-5">
  <h3 class="text-center mb-4">A Nossa Equipa</h3>

  <div class="row text-center">
    <?php
    $sql = "SELECT * FROM utilizadores WHERE tipo_utilizador = 'equipa' AND visivel = 1";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            // Se tiver imagem, usa a do upload; senão, usa a default
            $imagem = (!empty($row['imagem']))
                ? "uploads/equipa/" . htmlspecialchars($row['imagem'])
                : "imagens/elementos/default.jpg";

            echo '<div class="col-md-4 mb-4">';
            echo '  <img src="' . $imagem . '" alt="Foto de ' . htmlspecialchars($row['nome']) . '" class="img-fluid rounded-circle shadow mb-2" style="width: 200px; height: 200px; object-fit: cover;">';
            echo '  <h5 class="mt-2">' . htmlspecialchars($row['nome']) . '</h5>';
            echo '  <p>Equipa Técnica</p>';
            echo '</div>';
        }
    } else {
        echo '<div class="col-12 text-center text-muted">Nenhum membro de equipa encontrado.</div>';
    }
    ?>
  </div>
</div>


<?php require('includes/footer_infos.php'); ?>
<?php require('includes/rodape.php'); ?>

<!-- Scripts -->
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
