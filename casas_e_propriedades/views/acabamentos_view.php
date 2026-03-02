<?php

  $form = !empty($_GET["id"]);
  if($form){
    $id = intval($_GET["id"]);
    $pe = get_projeto_especifico($id);
  }

?>
  <main class="container-fluid">

    <div class="container">
      <div class="row mb-5">
        <div class="col px-0 text-start t1">Acabamentos - (<?= $pe["nome"] ?>)</div>
        <div class="col-12 px-0"><hr class="linha"></div>
        <div class="col-12 px-0">
          <?= $pe["acabamentos"] ?>
        </div>
      </div>
    </div>

  </main>