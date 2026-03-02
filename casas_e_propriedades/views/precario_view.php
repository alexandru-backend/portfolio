<?php

  $form = !empty($_GET["id"]);
  if($form){
    $id = intval($_GET["id"]);
    $pe = get_projeto_especifico_activo($id);
  }

?>
  <main class="container-fluid">

    <div class="container">
      <div class="row">
        <div class="col px-0 text-start t1">Plantas e Preçários - (<?= $pe["nome"] ?>)</div>
        <div class="col-12 px-0"><hr class="linha"></div>
        <div class="col-12 px-0 precario">
          <?= $pe["precario"] ?> 
        </div>
      </div>
    </div>
    
  </main>