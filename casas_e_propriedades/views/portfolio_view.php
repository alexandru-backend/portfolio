<?php

  $form = !empty($_GET["id"]);
  if($form){
    $id = intval($_GET["id"]);
    $pe = get_portfolio_especifico_activo($id);
    $pi = get_portfolio_imagens($id);
    $imagens = json_decode($pi["imagens"]);

  }

?>
  <main class="container-fluid">

    <div class="container">
      <div class="row">
        <div class="col px-0 text-start t1">
          <div>Portfólio</div>
          <div><?= $pe["nome"] ?></div>
        </div>
        <div class="col-12 px-0"><hr class="linha"></div>
      </div>
    </div>

    <div class="row mb-5">
      <div class="col-12 col-md-7 margin">
        <div class="imagem-portfolio text-center text-md-end">
          <img id="mainImage" src="<?= $imagens[0] ?>" alt="">
        </div>
      </div>

      <div class="col-12 col-md-5 margin px-4 mb-4 portfolio">
        <div id="thumbCarousel" class="carousel slide carousel-dark" data-bs-interval="false">
          <div class="d-flex align-items-center justify-content-center">
            <button class="carousel-control-prev portfolio-setas" type="button" data-bs-target="#thumbCarousel" data-bs-slide="prev">
              <img src="public/imagens/seta-portfolio-esquerda.svg" alt="">
              <span class="visually-hidden">Previous</span>
            </button>
          
            <div class="carousel-inner">

              <?php 
                $total = count($imagens);
                $porSlide = 8;
                $slides = ceil($total / $porSlide);

                for ($i = 0; $i < $slides; $i++): 
              ?>
                <div class="carousel-item <?= ($i == 0) ? 'active' : '' ?>">
                  <div class="d-grid conjunto-mini gap-3">
                    <?php 
                    $inicio = $i * $porSlide;
                    $fim = min($inicio + $porSlide, $total);

                    for ($j = $inicio; $j < $fim; $j++): ?>
                      <img src="<?= $imagens[$j] ?>" class="miniaturas" alt="miniatura">
                    <?php endfor; ?>
                  </div>
                </div>
              <?php endfor; ?>


            </div>
            
            <button class="carousel-control-next portfolio-setas " type="button" data-bs-target="#thumbCarousel" data-bs-slide="next">
              <img src="public/imagens/seta-portfolio-direita.svg" alt="">
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>

    </div>
   
  </main>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const mainImage = document.getElementById("mainImage");
      const thumbs = document.querySelectorAll(".miniaturas");

      thumbs.forEach(thumb => {
        thumb.addEventListener("click", () => {
          mainImage.src = thumb.src;
          mainImage.alt = thumb.alt || "imagem selecionada";
        });
      });
    });
  </script>
