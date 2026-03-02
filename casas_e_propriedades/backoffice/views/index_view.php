<?php

  require_once "../required.php";


  $erro = "";

  if($_SERVER["REQUEST_METHOD"] === "POST"){
      $login = $_POST['input_login'];
      $senha = $_POST['input_senha'];

      if(fazer_login($login, $senha)){
          header("Location: home.php");
          exit;
      } else {
          $erro = "Não foi possível fazer login, tente novamente.";
      }
  }
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
        <nav class="navbar navbar-expand-md bg-body-tertiary" data-bs-theme="dark">
          <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <img src="public/imagens/icones/abrir-menu.svg" alt="">
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="index.php">LOGIN</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="recuperar_password.php">RECUPERAR SENHA</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </header>
  <main class="container">
    <div class="row mt-5 mb-">
      <div class="col-12 px-0">
        <div class="text-end"><img src="imagens/logo.jpg" alt="" class="logo"></div>
        <p class="mb-0"><span>Fazer Login</span> É necessário fazer login para ter acesso ao sistema.</p>
        <hr class="my-1">
        <form action="" method="post">
        <?php if(!empty($_GET['senha_nova'])): ?>
        <div class="guardar w-100 my-3 p-2 text-white text-center">
          Senha atualizada com sucesso! Faça login novamente.
        </div>
      <?php endif; ?>
        <?php if(!empty($erro)): ?>
          <div class="cancelar w-100 my-3 p-2 text-white">
            <?= $erro ?>
          </div>
        <?php endif; ?>
          <input type="hidden" name="id" value="<?= $id ?>">

          <label for="login">
            <span class="formulario">LOGIN</span>: <i><sup>*</sup></i> 
            <br>
            <input type="text" value="" class="empresa" name="input_login" id="login" required>
          </label>
          <br>
          <label for="senha">
            <span class="formulario">SENHA</span>: <i><sup>*</sup></i> 
            <br>
            <input type="password" value="" class="empresa" name="input_senha" id="senha" required>
          </label>
          <br>
          <label for="senha">
            <span class="formulario">IDIOMA</span>: <i><sup>*</sup></i> 
            <br>
            <select name="select_activo" id="activo" class="empresa">
              <option value="portugues">Português</option>
              <option value="english">English</option>
            </select>
          </label>
          <br><br>
          <a href="recuperar_password.php">recuperar senha</a>
          <hr class="my-2">
          <input type="submit" value="Entrar" class="guardar text-white border-0 px-3">
          <hr class="my-2">
        </form>
      </div>
    </div>
  </main>