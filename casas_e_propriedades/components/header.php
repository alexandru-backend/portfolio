<?php

  require_once "required.php";

  $contactos = get_contacto();
  $projetos_dropdown = get_projetos_dropdown();
  $portfolio_dropdown = get_portfolio_dropdown();
  $empresas_dropdown = get_empresa_dropdown();
  $carousel = get_carousel_activo();

?>


<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Casas & Propriedades</title>

  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

  <!-- CSS -->
  <link rel="stylesheet" href="public/fonts/stylesheet.css">
  <link rel="stylesheet" href="public/css/style.css">

  <!-- JS LOCAL -->
  <script src="public/js/funcoes.js"></script>
  <script>
    var menu_atual = "<?= $menu_atual ?>";
    // if(menu_atual != "home"){scroll_automatico();}
  </script>

  <!-- GOOGLE RECAPTCHA -->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>

  <header class="container-fluid">

    <div class="row px-0">
      
      <div class="col-12 text-center logo d-flex justify-content-center px-0"><a href="index.php"><img src="public/imagens/logo.png" alt="logotipo"></a></div>
    
      <div class="col-12 nav justify-content-center d-none d-md-flex px-0">
        <!-- Desktop -->
        <nav class="navbar navbar-expand-md bg-body-tertiary">
          <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <img src="public/imagens/icones/abrir-menu.svg" alt="">
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
              <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link <?= ($menu_atual == "home") ? "active" : "" ?>" aria-current="page" href="index.php">HOME</a>
                </li>
                <li class="nav-item dropdown">
                <a id="menu_empresas" class="nav-link dropdown-toggle <?= ($menu_atual == "empresa") ? "active" : "" ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    EMPRESA
                </a>
                <ul class="dropdown-menu">
                  <?php foreach($empresas_dropdown as $i => $p): ?>

                    <li><a class="dropdown-item p-0" href="empresa.php?id=<?= $p["id"] ?>"><?= $p["nome"] ?></a></li>
                    <?php if($i < count($empresas_dropdown) - 1): ?>
                      <li><hr class="dropdown-divider m-1"></li>
                    <?php endif ?>
                  <?php endforeach ?>
                </ul>
                </li>
                <li class="nav-item dropdown">
                <a id="menu_projetos" class="nav-link dropdown-toggle <?= ($menu_atual == "projeto" || $menu_atual == "predio") ? "active" : "" ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    PROJECTOS EM COMERCIALIZAÇÃO
                </a>
                <ul class="dropdown-menu">
                  
                  <?php foreach($projetos_dropdown as $i => $p): ?>

                    <li><a class="dropdown-item p-0" href="projetos.php?id=<?= $p["id"] ?>"><?= $p["nome"] ?></a></li>
                    <?php if($i < count($projetos_dropdown) - 1): ?>
                      <li><hr class="dropdown-divider m-1"></li>
                    <?php endif ?>

                  <?php endforeach ?>
                </ul>
                </li>
                <li class="nav-item dropdown">
                <a id="menu_portfolio" class="nav-link dropdown-toggle <?= ($menu_atual == "portfolio") ? "active" : "" ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    PORTFÓLIO
                </a>
                <ul class="dropdown-menu">
                  <?php foreach($portfolio_dropdown as $i => $p): ?>
                    
                    <li><a class="dropdown-item p-0" href="portfolio.php?id=<?= $p["id"] ?>"><?= $p["nome"] ?></a></li>
                    <?php if($i < count($portfolio_dropdown) - 1): ?>
                      <li><hr class="dropdown-divider m-1"></li>
                    <?php endif ?>

                  <?php endforeach ?>
                </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link <?= ($menu_atual == "contactos") ? "active" : "" ?>" href="contactos.php">CONTACTOS</a>
                </li>
                  
              </ul>
            </div>
          </div>
        </nav>

      </div>

      <div class="col-12 d-md-none d-flex justify-content-center ps-0 altura">
        <!-- Mobile -->
        <nav class="navbar navbar-expand-md bg-body-tertiary p-0 z-3" id="nav-mobile">
          <div class="container-fluid p-0 justify-content-center">
            <button class="navbar-toggler collapsed p-0 d-flex" type="button" data-bs-toggle="collapse" data-bs-target="#nav-mobile-collapse" aria-controls="nav-mobile-collapse" aria-expanded="false" aria-label="Toggle navigation">
              <img class="abrir-menu" src="public/imagens/icones/abrir-menu.svg" alt="">
              <img class="fechar-menu" src="public/imagens/icones/fechar-menu.svg" alt="">
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="nav-mobile-collapse">
              <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link <?= ($menu_atual == "home") ? "active" : "" ?>" aria-current="page" href="index.php">HOME</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?= ($menu_atual == "empresa") ? "active" : "" ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  EMPRESA
                </a>
                <ul class="dropdown-menu">
                  <?php foreach($empresas_dropdown as $i => $p): ?>

                    <li><a class="dropdown-item p-0" href="empresa.php?id=<?= $p["id"] ?>"><?= $p["nome"] ?></a></li>
                    <?php if($i < count($empresas_dropdown) - 1): ?>
                      <li><hr class="dropdown-divider m-1"></li>
                    <?php endif ?>

                  <?php endforeach ?>
                </ul>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?= ($menu_atual == "projeto" || $menu_atual == "predio") ? "active" : "" ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    PROJECTOS EM COMERCIALIZAÇÃO
                </a>
                <ul class="dropdown-menu">

                    <?php foreach($projetos_dropdown as $i => $p): ?>

                      <li><a class="dropdown-item p-0" href="projetos.php?id=<?= $p["id"] ?>"><?= $p["nome"] ?></a></li>
                      <?php if($i < count($projetos_dropdown) - 1): ?>
                        <li><hr class="dropdown-divider m-1"></li>
                      <?php endif ?>

                    <?php endforeach ?>

                </ul>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?= ($menu_atual == "porftolio") ? "active" : "" ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    PORTFÓLIO
                </a>
                <ul class="dropdown-menu">
                  <?php foreach($portfolio_dropdown as $i => $p): ?>

                    <li><a class="dropdown-item p-0" href="portfolio.php?id=<?= $p["id"] ?>"><?= $p["nome"] ?></a></li>
                    <?php if($i < count($portfolio_dropdown) - 1): ?>
                      <li><hr class="dropdown-divider m-1"></li>
                    <?php endif ?>

                  <?php endforeach ?>
                </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link pb-4 <?= ($menu_atual == "contactos") ? "active" : "" ?>" href="contactos.php">CONTACTOS</a>
                </li>
                
              </ul>
            </div>
          </div>
        </nav>

      </div>

      <div class="col-12 p-0">
        <div id="carousel-header" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">

            <?php foreach($carousel as $i => $c): ?>                      
              
              <div class="carousel-item <?= ($i == 0) ? "active" : "" ?> cabecalho">
                <img src="<?= $c["imagem"] ?>" class="d-block w-100" alt="erro">
                <div class="carousel-caption text-start">
                  <h5 class="titulo mb-0"><?= $c["titulo"] ?></h5>
                  <hr class="linha">
                  <p class="subtitulo-2"><?= $c["tag"] ?></p>
                </div>
              </div> 

            <?php endforeach ?>
            
          </div>
        </div>
      </div>

    </div> 

  </header>