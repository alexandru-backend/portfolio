<?php 
  require_once "../components/head.php";

  $predios = get_todos_predios();
  $id = !empty($_GET["id"]) ? intval($_GET["id"]) : 0;
  $p = get_predio_especifico($id);
  $total_predios_home = contar_predios_home($id);

  if(!empty($_POST["select_predio"])){
      $predio_id = intval($_POST["select_predio"]);
      $total = intval($_POST["input_total"]);
      $activo = $_POST["select_activo"];
      $posicao = intval($_POST["select_posicao"]);

      $mostrar = ($activo == "Sim") ? 1 : 0;
      idu_sql("UPDATE predios SET posicao=$posicao, mostrar_na_home=$mostrar WHERE id=$predio_id");

      $p = get_predio_especifico($predio_id);
      $predios_mesmo_projeto = select_sql("SELECT * FROM predios WHERE nome='{$p['nome']}' ORDER BY posicao ASC");

      $ativos = 0;
      foreach($predios_mesmo_projeto as $pr){
          if($activo == "Sim" && $ativos < $total){
              idu_sql("UPDATE predios SET mostrar_na_home=1 WHERE id={$pr['id']}");
              $ativos++;
          } else {
              idu_sql("UPDATE predios SET mostrar_na_home=0 WHERE id={$pr['id']}");
          }
      }

      header("Location: destaques-edit.php?id=$predio_id&saved=1");
      exit;
  }

  if(empty($predios)){
      $predios = [
          ['id'=>1,'nome'=>'Exemplo','posicao'=>1,'activo'=>'Sim']
      ];
  }
  if(empty($p)){
      $p = $predios[0];
  }

?>

<main class="container-fluid">
  <div class="row mt-4 px-4">
    <div class="col-12 px-0">
      <p><span>Destaques</span> Edição do Destaque (<?= $p["id"] ?>).</p>
      <hr class="mt-1 mb-0">
      <button class="popup" onclick="window.close()">Fechar</button>
      <hr class="mt-1">
    </div>
    <div class="col-12 px-0">
      <form action="" method="post">
        <input type="hidden" name="id" value="<?= $p['id'] ?>">
        
        <label for="projeto">
          <span class="formulario">PROJECTO EM COMERCIALIZAÇÃO</span>: <i>(selecione o projecto em comercialização) <sup>*</sup></i> 
          <br>
          <select name="select_predio" id="predio">
            <?php foreach($predios as $predio): ?>
              <option value="<?= $predio["id"] ?>" <?= ($predio["id"] == $p["id"]) ? "selected" : "" ?>><?=  $predio["nome"] ?></option>
            <?php endforeach; ?>
          </select>
        </label>
        <label for="total">
          <span class="formulario">TOTAL DE TIPOS DE FOGO A SEREM EXIBIDOS</span>: <i>(serão exibidos de acordo com a posição) <sup>*</sup></i> 
          <br>
          <input type="number" value="<?= $total_predios_home ?>" name="input_total" id="total" required min="1" max="<?= count($predios) ?>">
        </label>
        <label for="activo">
          <span class="formulario">ACTIVO</span>: <i>(estado do destaque) <sup>*</sup></i> 
          <br>
          <select name="select_activo" id="activo">
            <option value="Sim" <?= ($p["activo"] == "Sim") ? "selected" : "" ?>>Sim</option>
            <option value="Não" <?= ($p["activo"] == "Não") ? "selected" : "" ?>>Não</option>
          </select>
        </label>
        <label for="posicao">
          <span class="formulario">POSIÇÃO</span>: <i>(posição no menu de projectos em comercialização) <sup>*</sup></i> 
          <br>
          <select name="select_posicao" id="posicao">
            <?php for($i = 1; $i <= count($predios); $i++): ?>
              <option value="<?= $i ?>" <?= ($p["posicao"] == $i) ? "selected" : "" ?>><?= $i ?></option>
            <?php endfor ?>
          </select>
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
