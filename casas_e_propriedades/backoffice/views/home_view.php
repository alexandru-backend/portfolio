<?php
  
  $nome = $_SESSION["utilizador"]["nome"] ?? 'Utilizador';
?>
<main class="container">
    <div class="row mt-5">
      <div class="col-12 px-0">
        <div class="text-end"><img src="imagens/logo.jpg" alt="" class="logo"></div>
        <p class=""><span>Bem-vindo <?= $nome ?></span>, seleccione uma opção dos menus acima.</p>
        <hr class="mt-1">
      </div>
    </div>
  </main>