<?php

  require_once "../required.php";

  verificar_logado();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Backoffice - Casas & Propriedades</title>

  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

  <!-- LOCAL CSS -->
  <link rel="stylesheet" href="css/style.css">

  <!-- LOCAL JS -->
  <script src="../public/js/funcoes.js"></script>

</head>
<body>

  <header class="container-fluid">
    <div class="row">
      <div class="col-12 px-0">
        <nav class="navbar navbar-expand-md py-0" data-bs-theme="dark">
          <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <img src="public/imagens/icones/abrir-menu.svg" alt="">
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="home.php">HOME</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="cabecalho.php">CABEÇALHO</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="empresa.php">EMPRESA</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    PROJECTOS
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item p-0" href="projectos.php">PROJECTOS EM COMERCIALIZAÇÃO</a></li>
                    <li><hr class="dropdown-divider m-1"></li>
                    <li><a class="dropdown-item p-0" href="predios.php">TIPOS DE FOGO</a></li>
                    <li><hr class="dropdown-divider m-1"></li>
                    <li><a class="dropdown-item p-0" href="destaques.php">DESTAQUES (HOME)</a></li>
                </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="portfolio.php">PORTFÓLIO</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    CONFIGURAÇÕES
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item p-0" href="configuracoes.php">CONTACTOS</a></li>
                    <li><hr class="dropdown-divider m-1"></li>
                    <li><a class="dropdown-item p-0" href="alterar_password.php">ALTERAR PASSWORD</a></li>
                </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="http://localhost/casas_e_propriedades/public/filemanager/dialog.php" target="_blank">GESTOR DE FICHEIROS</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="logout.php">LOGOUT</a>
                </li>
                  
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </header>