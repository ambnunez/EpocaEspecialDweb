<?php
session_start();
?>

<!-- filepath: c:\laragon\www\epocaespecialdwebv1\index.php -->
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechSolutions</title>
    <link rel="stylesheet" href="styles.css"> <!-- Opcional -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- Scroll suave -->
    <style>
      html {
        scroll-behavior: smooth;
      }

        .text-green-custom {
                color:rgb(68, 146, 120);
        }

    </style>
</head>
<body>

<?php require('./includes/connection.php'); ?>
<?php require('includes/navbar.php'); ?>

<!-- Banner -->
<div class="container-fluid px-0 position-relative">
  <img src="imagens/index2.jpg" class="img-fluid w-100" alt="Banner" style="height: 400px; object-fit: cover; filter: brightness(0.4);">
  <div class="position-absolute top-50 start-50 translate-middle text-center text-white px-3">
    <h1 class="display-4 fw-bold">Bem-vindo à <span class="text-green-custom">TECHSOLUTIONS</span></h1>
    <p class="lead">Transformamos ideias em soluções digitais.</p>
  </div>
</div>

<!-- Secção Desenvolvimento -->
<div id="desenvolvimento" class="container my-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <img src="imagens/imagem1.jpg" class="img-thumbnail" alt="Desenvolvimento de Websites">
        </div>
        <div class="col-md-6">
            <h3>Desenvolvimento de Websites</h3>
            <p>Criamos websites personalizados, rápidos e responsivos, com foco na experiência do utilizador e na performance. Utilizamos boas práticas de SEO e design moderno para garantir uma presença digital forte, adaptada a qualquer dispositivo e fácil de gerir.</p>
        </div>
    </div>
</div>

<!-- Secção Manutenção -->
<div id="manutencao" class="container my-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h3>Manutenção Técnica</h3>
            <p>Garantimos que o seu site funciona corretamente, sem falhas nem riscos de segurança. Prestamos serviços de atualização, correção de erros, backups e suporte técnico, assegurando a estabilidade contínua da sua presença online.</p>
        </div>
        <div class="col-md-6">
            <img src="imagens/imagem1.jpg" class="img-thumbnail" alt="Manutenção Técnica">
        </div>
    </div>
</div>

<!-- Secção E-Commerce -->
<div id="ecommerce" class="container my-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <img src="imagens/imagem1.jpg" class="img-thumbnail" alt="E-Commerce">
        </div>
        <div class="col-md-6">
            <h3>E-Commerce</h3>
            <p>Desenvolvemos lojas virtuais completas, com sistema de gestão de produtos, pagamentos integrados e design atrativo. Ajudamos o seu negócio a vender online de forma segura, intuitiva e eficaz, com foco na conversão de visitantes em clientes.</p>
        </div>
    </div>
</div>

<!-- Secção Marketing Digital -->
<div id="marketing" class="container my-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h3>Marketing Digital</h3>
            <p>Aumente a visibilidade da sua marca com estratégias digitais personalizadas: gestão de redes sociais, campanhas de Google Ads, email marketing e criação de conteúdo. Trabalhamos com foco em resultados e crescimento sustentável do seu negócio.</p>
        </div>
        <div class="col-md-6">
            <img src="imagens/imagem1.jpg" class="img-thumbnail" alt="Marketing Digital">
        </div>
    </div>
</div>

<!-- Seção "Nós Garantimos" -->
<div id="nos-garantimos" class="py-5" style="background-color: rgb(92, 153, 125);">
  <div class="container text-center text-white">
    <h2 class="mb-4 fw-bold">Nós Garantimos</h2>
    <div class="row justify-content-center gy-3">

      <div class="col-6 col-md-3">
        <div class="card bg-transparent border-0 text-white h-100">
          <div class="card-body p-2">
            <i class="bi bi-patch-check-fill fs-1 mb-2"></i>
            <h6 class="card-title fw-semibold mb-1">Qualidade</h6>
            <p class="card-text small mb-0">Produtos e serviços de excelência.</p>
          </div>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="card bg-transparent border-0 text-white h-100">
          <div class="card-body p-2">
            <i class="bi bi-lightning-fill fs-1 mb-2"></i>
            <h6 class="card-title fw-semibold mb-1">Rapidez</h6>
            <p class="card-text small mb-0">Entrega rápida e eficiente.</p>
          </div>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="card bg-transparent border-0 text-white h-100">
          <div class="card-body p-2">
            <i class="bi bi-currency-euro fs-1 mb-2"></i>
            <h6 class="card-title fw-semibold mb-1">Preços</h6>
            <p class="card-text small mb-0">Competitivos e justos.</p>
          </div>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="card bg-transparent border-0 text-white h-100">
          <div class="card-body p-2">
            <i class="bi bi-headset fs-1 mb-2"></i>
            <h6 class="card-title fw-semibold mb-1">Suporte</h6>
            <p class="card-text small mb-0">Apoio dedicado aos clientes.</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>



<!-- Footer e rodapé -->
<?php require('includes/footer_infos.php'); ?>
<?php require('includes/rodape.php'); ?>

<!-- Scripts -->
<script type="text/javascript" src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
