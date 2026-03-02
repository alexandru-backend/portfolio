<?php

  $pagina = get_pagina_especifica(2);

?>
  <main class="container-fluid">

    <div class="container">
      <div class="row mb-5">
        <div class="col px-0 text-start t1"><?= $pagina["nome"] ?></div>
        <div class="col-12 px-0"><hr class="linha"></div>
        <div class="col-12 px-0">
          <?= $pagina["texto"] ?>
        </div>
      </div>
    </div>

  </main>
