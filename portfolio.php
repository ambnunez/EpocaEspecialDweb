<?php
session_start();
require('./includes/connection.php');
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Portfólio | TechSolutions</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
</head>
<body class="bg-light">

<?php require('includes/navbar.php'); ?>

<!-- Título -->
<div class="container my-5">
  <h2 class="text-center mb-4">O Nosso Portfólio</h2>
  <p class="text-center text-muted mb-5">Conhece alguns dos projetos que desenvolvemos com criatividade, inovação e tecnologia.</p>

  <!-- Galeria de Projetos -->
  <div class="row g-4">
    <?php
    $sql = "SELECT * FROM projetos";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            echo '<div class="col-md-4">';
            echo '  <div class="card h-100 shadow-sm">';
            echo '    <img src="uploads/' . htmlspecialchars($row['imagem']) . '" class="card-img-top" alt="' . htmlspecialchars($row['titulo']) . '">';
            echo '    <div class="card-body">';
            echo '      <h5 class="card-title">' . htmlspecialchars($row['titulo']) . '</h5>';
            echo '      <p class="card-text">' . htmlspecialchars($row['descricao']) . '</p>';
            echo '    </div>';
            echo '    <div class="card-footer bg-transparent border-0">';
            echo '    </div>';
            echo '  </div>';
            echo '</div>';
        }
    } else {
        echo '<div class="col-12 text-center"><p class="text-muted">Ainda não existem projetos publicados.</p></div>';
    }
    ?>
  </div>
</div>

<!-- Carrossel de Testemunhos -->
<h2 class="text-center mt-5 mb-4">Testemunhos dos nossos clientes</h2>
<div id="textoCarrossel" class="carousel slide mt-5" data-bs-ride="carousel">
  <div class="carousel-inner text-center p-5 rounded shadow" style="background-color:#66CDAA;">
    <div class="carousel-item active">
      <h5 class="mb-3">BDO Portugal</h5>
      <p>Oferecemos soluções digitais feitas à medida para cada cliente.</p>
    </div>
    <div class="carousel-item">
      <h5 class="mb-3">Deloitte Portugal</h5>
      <p>Estamos sempre disponíveis para ajudar em qualquer momento.</p>
    </div>
    <div class="carousel-item">
      <h5 class="mb-3">João Carreira</h5>
      <p>Trabalhamos com as tendências mais atuais para garantir impacto visual.</p>
    </div>
  </div>

  <!-- Setas -->
  <button class="carousel-control-prev" type="button" data-bs-target="#textoCarrossel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#textoCarrossel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
    <span class="visually-hidden">Seguinte</span>
  </button>
</div>


<h2 class="text-center mt-5 mb-4">Perguntas Frequentes</h2>

<div class="container">
  <div class="mx-auto" style="max-width: 800px; margin-bottom: 50px;">

    <div class="accordion" id="accordion">

      <div class="card">
        <div class="card-header">
          <a class="btn" data-bs-toggle="collapse" href="#collapseOne">
            Quais os serviços que a TechSolutions oferece?
          </a>
        </div>
        <div id="collapseOne" class="collapse show" data-bs-parent="#accordion">
          <div class="card-body">
            Prestamos serviços de desenvolvimento de websites, lojas online (ecommerce), manutenção técnica, 
            gestão de anúncios online e soluções personalizadas à medida de cada cliente.
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <a class="collapsed btn" data-bs-toggle="collapse" href="#collapseTwo">
            A TechSolutions trabalha com empresas de qualquer setor?
          </a>
        </div>
        <div id="collapseTwo" class="collapse" data-bs-parent="#accordion">
          <div class="card-body">
            Sim! Adaptamo-nos a todo o tipo de negócios, desde pequenos empreendedores a empresas de grande dimensão.
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <a class="collapsed btn" data-bs-toggle="collapse" href="#collapseThree">
            Quanto custa criar um website?
          </a>
        </div>
        <div id="collapseThree" class="collapse" data-bs-parent="#accordion">
          <div class="card-body">
            O valor varia consoante a complexidade do projeto. Podes solicitar um orçamento gratuito através do nosso formulário online.
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <a class="collapsed btn" data-bs-toggle="collapse" href="#collapseFour">
            Quanto tempo demora o desenvolvimento de um site?
          </a>
        </div>
        <div id="collapseFour" class="collapse" data-bs-parent="#accordion">
          <div class="card-body">
            Em média, um site institucional demora entre 2 a 4 semanas. Lojas online podem demorar mais.
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <a class="collapsed btn" data-bs-toggle="collapse" href="#collapseFive">
            Prestam serviços de manutenção após o site estar pronto?
          </a>
        </div>
        <div id="collapseFive" class="collapse" data-bs-parent="#accordion">
          <div class="card-body">
            Sim. Temos planos de manutenção quinzenal, mensal, semestral e anual para garantir que o site esteja sempre atualizado e seguro.
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <a class="collapsed btn" data-bs-toggle="collapse" href="#collapseSix">
            Posso alterar o conteúdo do meu site depois de pronto?
          </a>
        </div>
        <div id="collapseSix" class="collapse" data-bs-parent="#accordion">
          <div class="card-body">
            Claro! Criamos soluções com painéis de administração intuitivos para edição fácil de texto, imagens e produtos.
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <a class="collapsed btn" data-bs-toggle="collapse" href="#collapseSeven">
            O site vai aparecer no Google?
          </a>
        </div>
        <div id="collapseSeven" class="collapse" data-bs-parent="#accordion">
          <div class="card-body">
            Sim. Otimizamos os nossos projetos com práticas de SEO para melhorar o posicionamento nos motores de busca.
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <a class="collapsed btn" data-bs-toggle="collapse" href="#collapseEight">
            Têm suporte técnico?
          </a>
        </div>
        <div id="collapseEight" class="collapse" data-bs-parent="#accordion">
          <div class="card-body">
            Sim. Oferecemos suporte via email e telefone, com possibilidade de assistência remota.
          </div>
        </div>
      </div>

    </div>

  </div>
</div>

<!-- Footer -->
<?php require('includes/footer_infos.php'); ?>
<?php require('includes/rodape.php'); ?>

<!-- Scripts -->
<script type="text/javascript" src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
