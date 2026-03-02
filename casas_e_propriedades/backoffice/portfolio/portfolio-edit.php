<?php 

  require_once "../components/head.php";

  $portfolio = get_todos_portfolios();

  $id = !empty($_GET["id"]) ? intval($_GET["id"]) : 0;
  $p = get_portfolio_especifico($id);

  $dados_imagem = get_portfolio_imagens($id);
  $imagens_atuais = json_decode($dados_imagem["imagens"] ?? '[]', true);
  if (!is_array($imagens_atuais)) $imagens_atuais = [];

  $form = !empty($_POST["input_nome"]) &&  !empty($_POST["select_activo"]) && !empty($_POST["select_posicao"]) && !empty($_POST["input_imagens"]);
  if($form){
    $nome = $_POST["input_nome"]; 
    $activo = $_POST["select_activo"];
    $posicao = intval($_POST["select_posicao"]);
    $imagens = !empty($_POST["input_imagens"]) ? $_POST["input_imagens"] : [];

    $posicao_anterior = $p["posicao"];

    if($posicao != $posicao_anterior){
      if($posicao < $posicao_anterior){
        idu_sql("UPDATE portfolio SET posicao = posicao + 1 WHERE posicao >= $posicao AND posicao < $posicao_anterior AND id != $id");
      }else{
        idu_sql("UPDATE portfolio SET posicao = posicao - 1 WHERE posicao <= $posicao AND posicao > $posicao_anterior AND id != $id");
      }
    }

    idu_sql("UPDATE portfolio SET nome='$nome', activo='$activo', posicao=$posicao WHERE id=$id");

    $img_json = $_POST["input_imagens"] ?? '[]';
    $imagens_array = json_decode($img_json, true);

    if (!is_array($imagens_array)) {
      $imagens_array = [];
    }

    $img_json = json_encode($imagens_array);

    $existe = get_portfolio_imagens($id);
    if ($existe) {
      idu_sql("UPDATE portfolio_imagens SET imagens='$img_json' WHERE id_portfolio=$id");
    } else {
      idu_sql("INSERT INTO portfolio_imagens (id_portfolio, imagens) VALUES ($id, '$img_json')");
    }

    header("Location: portfolio-edit.php?id=$id&saved=1");
    exit;
  }

?>

    <main class="container-fluid">
      <div class="row mt-4 px-4">
        <div class="col-12 px-0">
          <p><span>Portfólios</span> Criação de um novo Portfólio.</p>
          <hr class="mt-1 mb-0">
          <button class="popup" onclick="window.close()">Fechar</button>
          <hr class="mt-1">
        </div>
        <div class="col-12 px-0">
          <form action="" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">

            <label for="nome">
              <span class="formulario">TÍTULO</span>: <i>(título do portfólio) <sup>*</sup></i> 
              <br>
              <input type="text" value="<?= $p["nome"] ?>" class="contacto" name="input_nome" id="nome" required>
            </label>
            
            <label for="activo">
              <span class="formulario">ACTIVO</span>: <i>(estado do portfólio) <sup>*</sup></i> 
              <br>
              <select name="select_activo" id="activo" required>
                <option value="Sim" <?= ($p["activo"] == "Sim") ? "selected" : "" ?>>Sim</option>
                <option value="Não" <?= ($p["activo"] == "Não") ? "selected" : "" ?>>Não</option>
              </select>
            </label>
            <label for="posicao">
              <span class="formulario">POSIÇÃO</span>: <i>(posição do portfólio) <sup>*</sup></i> 
              <br>
              <select name="select_posicao" id="posicao" required>
                <?php for($i = 1; $i <= count($portfolio); $i++): ?>
                  <option value="<?= $i ?>" <?= ($p["posicao"] == $i) ? "selected" : "" ?>><?= $i ?></option>
                <?php endfor ?>
              </select>
            </label>
            <label for="imagem">
              <span class="formulario">IMAGENS</span>: <sup>*</sup>
              <input type="hidden" name="input_imagens" id="input_imagens" value='<?= !empty($imagens_atuais) ? json_encode($imagens_atuais) : "[]" ?>'>
              <input type="text" id="preview_imagens" readonly value='<?= !empty($imagens_atuais) ? json_encode($imagens_atuais) : "[]" ?>' class="img">
              <button type="button" class="p-0" onclick="abrir_popup_filemanager('input_imagens')">
                <img src="../imagens/image.png" alt="" class="icon-galeria">
              </button>
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
    <script>
      function atualizarImagens(novasImagens) {
        let json = JSON.stringify(novasImagens);
        document.getElementById("input_imagens").value = json;
        document.getElementById("preview_imagens").value = json;
      }
    </script>
  </body>
</html>