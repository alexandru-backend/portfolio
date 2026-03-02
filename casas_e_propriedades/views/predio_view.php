<?php

  $form = !empty($_GET["id"]);
  if($form){
    $id = intval($_GET["id"]);
    $pe = get_predio_especifico_activo($id);
    $pi = get_predio_imagens($id);
    $pai = get_projeto_especifico_activo($pe["id_projeto"]);
    $imagens = json_decode($pi["imagens"]);
  }

?>

  <main class="container-fluid mt-5">

    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-11 m-auto px-0">
          <div class="container-fluid">
            <div class="row">
              <div class="col-auto">
                <h1 class="predio-titulo mb-0"><?= $pe["tipo"] ?></h1>
                <hr class="linha ">
              </div>
              <div class="col-8 col-sm ps-sm-5 mt-sm-4 mt-sm-0 pe-0 m-sm-auto">
                <h2 class="t1 predio-t1 mt-0 pt-3">Projectos em Comercialização</h2>
                <h2 class="t1 predio-t1 mt-0"><?= $pe["nome"] ?></h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-12 px-3 m-auto d-flex justify-content-center gap-4 flex-wrap">

        <div id="carousel-predio" class="carousel slide w-100 carousel-dark carousel-fade">
          <div class="carousel-inner">
            <?php foreach($imagens as $i => $img):
            ?>
              <div class="carousel-item <?= ($i == 0) ? 'active' : '' ?> predio-imagem">
                <img src="<?= $img ?>" class="d-block w-100 m-auto" alt="">
              </div>
            <?php endforeach ?>
          </div>

          <div class="carousel-indicators mt-4">

            <button class="carousel-control-prev predio-setas" type="button" data-bs-target="#carousel-predio" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            
            <div class="mx-5 text-center">
              <?php foreach($imagens as $i => $img): ?>
                <button type="button" data-bs-target="#carousel-predio" data-bs-slide-to="<?= $i ?>" class="indicadores <?= ($i == 0) ? 'active' : '' ?>" aria-label="Slide <?= $i+1 ?>"></button>
              <?php endforeach ?>
            </div>

            <button class="carousel-control-next predio-setas" type="button" data-bs-target="#carousel-predio" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>  
          </div>
        </div>

      </div>
    </div>

    <div class="row mt-5">
      <div class="col-6  col-md-4  mb-3 d-flex justify-content-center fila">
        <div class="galeria">
          <a href="projetos.php?id=<?= $pai["id"] ?>" class="w-100 h-100 d-block"></a>
        </div>
      </div>
      <div class="col-6  col-md-4 mb-3 d-flex justify-content-center fila">
        <div class="marcar-visita">
          <a href="contactos.php" class="w-100 h-100 d-block"></a>
        </div>
      </div>
      <div class="col-6 col-md-4 mb-3 d-flex justify-content-center fila">
        <div class="partilhar-facebook">
          <a href="https://www.facebook.com/" class="w-100 h-100 d-block" target="_blank"></a>
        </div>
      </div>
    </div>


    <div class="row mt-5">
      <div class="col-12 acabamentos">
        <h1 class="text-center margin t1">Acabamentos, Plantas e Preçários</h1>
        <hr class="linha m-auto">
        <div class="d-flex justify-content-center mt-4 mb-5">
          <a href="acabamentos.php?id=<?= $pai["id"] ?>" class="detalhes me-4"></a>
          <a href="precario.php?id=<?= $pai["id"] ?>" class="detalhes plantas ms-4"></a>
        </div>
      </div>
    </div>

  </main>