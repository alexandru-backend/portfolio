<?php 

  require_once "../components/head.php";

  $predios = get_todos_predios_home();
  $erro = "";
  $sucesso = "";

  $max_posicao = select_sql("SELECT MAX(posicao) as max_pos FROM predios WHERE mostrar_na_home=1")[0]['max_pos'] ?? 0;

  if($_SERVER["REQUEST_METHOD"] === "POST"){
    $predio_id = intval($_POST["select_predio"]);
    $posicao = intval($_POST["input_posicao"]);

    if(!$predio_id){
      $erro = "Selecione um prédio.";
    } elseif($posicao < 1) {
      $erro = "A posição deve ser pelo menos 1.";
    } else {
      idu_sql("UPDATE predios SET posicao = posicao + 1 WHERE mostrar_na_home=1 AND posicao >= $posicao");
      idu_sql("UPDATE predios SET mostrar_na_home=1, activo='Sim', posicao=$posicao WHERE id=$predio_id");
    }
  }

?>

    <main class="container-fluid">
      <div class="row mt-4 px-4">
        <div class="col-12 px-0">
          <p><span>Destaques</span> Novo Destaque</p>
          <hr class="my-3 mb-0">
          <button class="popup" onclick="window.close()">Fechar</button>
          <hr class="my-1">
        </div>
        <div class="col-12 px-0">
          <?php if($erro): ?>
            <div class="cancelar w-100 my-3 p-2 text-white"><?= $erro ?></div>
          <?php endif; ?>
          <?php if($sucesso): ?>
            <div class="guardar w-100 my-3 p-2 text-white"><?= $sucesso ?></div>
          <?php endif; ?>

          <form action="" method="post">
            <label for="predio">
              <span class="formulario">PROJECTO EM COMERCIALIZAÇÃO</span>: <i>(selecione o projecto em comercialização) <sup>*</sup></i> 
              <br>
              <select name="select_predio" id="predio" required>
                <?php foreach($predios as $predio): ?>
                  <option value="<?= $predio['id'] ?>"><?= $predio['nome'] ?></option>
                <?php endforeach; ?>
              </select>
            </label>
            <br>
            <label for="input_posicao">
              <span class="formulario">POSIÇÃO</span>: <i>(posição no menu de projectos em comercialização) <sup>*</sup></i> 
              <br>
              <input type="number" name="input_posicao" id="input_posicao" value="<?= $max_posicao + 1 ?>" min="1" max="<?= $max_posicao + 1 ?>" required>
              <small>Escolha a posição do destaque (1 = primeiro, <?= $max_posicao + 1 ?> = último)</small>
            </label>

            <hr class="my-3">
            <button type="button" onclick="window.close()" class="text-white border-0 px-3 cancelar">Cancelar</button>
            <input type="submit" value="Guardar" class="guardar text-white border-0 px-3">
          </form>

          <hr class="my-3 mb-0">
              <button class="popup" onclick="window.close()">Fechar</button>
              <hr class="my-1">
        </div>
      </div>

      <?php if(!empty($_GET["saved"])): ?>
        <script>
          alert("Operação concluída com sucesso!");
          if(window.opener){
            window.opener.location.reload();
          }
        </script>
      <?php endif ?>
    </main>
    
  </body>
</html>