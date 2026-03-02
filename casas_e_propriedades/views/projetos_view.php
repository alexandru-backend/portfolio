<?php

  $form = !empty($_GET["id"]);
  if($form){
    $id = intval($_GET["id"]);
    $pe = get_projeto_especifico_activo($id);
    $predios = get_todos_predios_por_pai($id);
  }

?>

  <main class="container-fluid">

    <div class="container">
      <div class="row mx-4">
        <div class="col px-0 text-start t1">
          <div>Projetos em Comercialização</div>
          <div><?= $pe["nome"] ?></div>
        </div>
        <div class="col-12 px-0"><hr class="linha"></div>
      </div>
    </div>

    <div class="row mt-5">
      <div class="col-11 px-0 m-auto d-block d-md-flex justify-content-md-center gap-4 flex-wrap area-galeria">

        <?php 
          foreach($predios as $p):  
            $pi = get_predio_imagens($p["id"]);                      
            $imagens = json_decode($pi["imagens"]); 
            $img = $imagens[0];
         ?>


          <div class="caixa mb-4 m-md-0" style="background-image: url('<?= $img ?>')">
            <div>
              <h3 class="subtitulo-1 text-start ps-3 m-auto py-4">
                <span class="linha-h3"> <?= $p["nome"] ?> - <?= $p["tipo"] ?> </span>
              </h3>
            </div>
            <div>
              <a href="predio.php?id=<?= $p["id"] ?>"><button class="ver-mais ver-mais-2 me-4">VER MAIS</button></a>
            </div>
          </div>
        <?php endforeach ?>

      </div>
    </div>

    <div class="row mt-5">
      <div class="col-12 acabamentos">
        <h1 class="text-center margin t1">Acabamentos, Plantas e Preçários</h1>
        <hr class="linha m-auto">
        <div class="d-flex justify-content-center mt-4 mb-5">
          <a href="acabamentos.php?id=<?= $id ?>" class="detalhes me-4"></a>
          <a href="precario.php?id=<?= $id ?>" class="detalhes plantas ms-4"></a>
        </div>
      </div>
    </div>
    
  </main>