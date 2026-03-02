<?php

  $predios = get_todos_predios_home();
  $total_predios = count($predios);

?>

  <main class="container-fluid">
    <?php foreach($predios as $i => $p): ?>

      <?php
        $pai = get_projeto_especifico_activo($p["id_projeto"]);
        $elementos_por_pagina = 4;
        $total_imagens = get_total_imagens($p["id"]);
        $total_paginas = ceil($total_imagens / $elementos_por_pagina);

      ?>

      <div class="row mx-4">
        <div class="container">
          <div class="row mx-4">
            <div class="col px-0 text-start t1"><?= $pai["nome"] ?></div>
            <div class="col-12 px-0"><hr class="linha"></div>
          </div>
        </div>
        <div class="col-12 px-0">
          <!-- Desktop -->
          <div id="carousel-<?= $p["id"] ?>" class="carousel slide d-none d-md-block" data-bs-ride="carousel">
            <div class="carousel-inner">
              <?php for($j = 0; $j < $total_paginas; $j++): ?>
                <div class="carousel-item <?= ($j == 0) ? "active" : "" ?>">
                  <div class="almada">
                    <?php $ip = get_imagens_pagina($p["id"], $j+1) ?>
                    <?php foreach($ip as $foto): ?>
                      <img src="<?= $foto ?>" alt="<?= $foto ?>" class="w-100 h-100">
                    <?php endforeach ?>
                  </div>
                </div>
              <?php endfor ?>
            </div>
            <div class="carousel-indicators">
              <?php for($j = 0; $j < $total_paginas; $j++): ?>

                <button type="button" data-bs-target="#carousel-<?= $p["id"] ?>" data-bs-slide-to="<?= $j ?>" class="indicadores <?= ($j == 0) ? "active" : "" ?>" aria-label="Slide <?= $j+1 ?>"></button>
              <?php endfor ?>
            
            </div>
          </div>


          <!-- Mobile -->
          <div id="carousel-mobile-<?= $p["id"] ?>" class="carousel slide d-md-none d-block" data-bs-ride="carousel">
            <div class="carousel-inner">
              <?php for($j = 0; $j < $total_paginas; $j++): ?>
                <?php 
                  $ip = get_imagens_pagina($p["id"], $j+1);
                  $foto = $ip[0];
                ?>
                <div class="carousel-item <?= ($j == 0) ? "active" : "" ?>">
                  <div class="almada almada-mobile">
                    <img src="<?= $foto ?>" class="d-block w-75" alt="...">
                  </div> 
                </div>
              <?php endfor ?>
            </div>
            <div class="carousel-indicators carousel-indicators-mobile">
              <?php for($j = 0; $j < $total_paginas; $j++): ?>
                <button type="button" data-bs-target="#carousel-mobile-<?= $p["id"] ?>" data-bs-slide-to="<?= $j ?>" class="indicadores <?= ($j == 0) ? "active" : "" ?>" aria-label="Slide <?= $j+1 ?>"></button>
              <?php endfor ?>
            </div>
          </div>

        </div>
      </div>

      <div class="row">

        <div class="col-12 px-0">

          <!-- Desktop -->
          <div class="almada-texto text-start d-none d-md-block">
            <h5><?= $pai["nome"] ?></h5>
            <hr class="linha">
            <p><?= $p["tipo"] ?></p>
            <div class="setas">
              <button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?= $p["id"] ?>" data-bs-slide="prev">
                <img src="public/imagens/seta-esquerda-branca.svg" alt="">
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carousel-<?= $p["id"] ?>" data-bs-slide="next">
                <img src="public/imagens/seta-direita-branca.svg" alt="">
                <span class="visually-hidden">Next</span>
              </button>
            </div>
            <a href="predio.php?id=<?= $p["id"] ?>"><div class="ver-mais text-center mx-auto mt-3">VER MAIS</div></a>
          </div>

          <!-- Mobile -->
          <div class="almada-texto almada-texto-mobile text-start d-md-none d-block">
            <h5><?= $pai["nome"] ?></h5>
            <hr class="linha">
            <p><?= $p["tipo"] ?></p>
            <div class="setas">
              <button class="carousel-control-prev" type="button" data-bs-target="#carousel-mobile-<?= $p["id"] ?>" data-bs-slide="prev">
                <img src="public/imagens/seta-esquerda-branca.svg" alt="">
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carousel-mobile-<?= $p["id"] ?>" data-bs-slide="next">
                <img src="public/imagens/seta-direita-branca.svg" alt="">
                <span class="visually-hidden">Next</span>
              </button>
            </div>
             <a href="predio.php?id=<?= $p["id"] ?>"><div class="ver-mais text-center mx-auto mt-3">VER MAIS</div></a>
          </div>

        </div>

      </div>
      <?php if($i < count($predios)-1): ?>
        <div class="row">
          <div class="col-12 px-0">
            <hr class="sombra">
          </div>
        </div>
      <?php endif ?>
    <?php endforeach ?>

  </main>