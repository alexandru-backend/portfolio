<?php 

  require_once "../components/head.php";

  $projetos = get_projetos();
  $predios = get_todos_predios();

  $id = !empty($_GET["id"]) ? intval($_GET["id"]) : 0;
  $p = get_predio_especifico($id);

  $dados_imagem = get_predio_imagens($id);
  $imagens_atuais = json_decode($dados_imagem["imagens"] ?? '[]', true);
  if (!is_array($imagens_atuais)) $imagens_atuais = [];

  $form = !empty($_POST["select_projeto"]) &&  !empty($_POST["select_activo"]) && !empty($_POST["select_posicao"])  && !empty($_POST["input_observacao"]) && !empty($_POST["input_imagens"]);
  if($form){
    $nome = $_POST["select_projeto"]; 
    $activo = $_POST["select_activo"];
    $posicao = intval($_POST["select_posicao"]);
    $observacao = $_POST["input_observacao"];
    $imagens = !empty($_POST["input_imagens"]) ? $_POST["input_imagens"] : [];

    $posicao_anterior = $p["posicao"];

    if($posicao != $posicao_anterior){
      if($posicao < $posicao_anterior){
        idu_sql("UPDATE predios SET posicao = posicao + 1 WHERE posicao >= $posicao AND posicao < $posicao_anterior AND id != $id");
      }else{
        idu_sql("UPDATE predios SET posicao = posicao - 1 WHERE posicao <= $posicao AND posicao > $posicao_anterior AND id != $id");
      }
    }

    idu_sql("UPDATE predios SET nome='$nome', tipo='$observacao', activo='$activo', posicao=$posicao WHERE id=$id");

    $img_json = $_POST["input_imagens"] ?? '[]';
    
    $imagens_array = json_decode($img_json, true);
    if (!is_array($imagens_array)) {
        $imagens_array = [$img_json];
    }
    $img_json = json_encode($imagens_array);

    $existe = get_predio_imagens($id);
    if ($existe) {
        idu_sql("UPDATE predio_imagens SET imagens='$img_json' WHERE id_predio=$id");
    } else {
        idu_sql("INSERT INTO predio_imagens (id_predio, imagens) VALUES ($id, '$img_json')");
    }

    header("Location: predios-edit.php?id=$id&saved=1");
    exit;
  }
  
?>

    <main class="container-fluid">
      <div class="row mt-4 px-4">
        <div class="col-12 px-0">
          <p><span>Tipos de Fogo</span> Criação de um novo Projecto em Comercialização Tipos de Fogo.</p>
          <hr class="mt-1 mb-0">
          <button class="popup" onclick="window.close()">Fechar</button>
          <hr class="mt-1">
        </div>
        <div class="col-12 px-0">
          <form action="" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">
            
            <label for="activo">
              <span class="formulario">ACTIVO</span>: <i>(estado do projecto em comercialização tipos de fogo) <sup>*</sup></i> 
              <br>
              <select name="select_activo" id="activo" required>
                <option value="Sim" <?= ($p["activo"] == "Sim") ? "selected" : "" ?>>Sim</option>
                <option value="Não" <?= ($p["activo"] == "Não") ? "selected" : "" ?>>Não</option>
              </select>
            </label>
            <label for="posicao">
              <span class="formulario">POSIÇÃO</span>: <i>(posição do projectos em comercialização tipos de fogo) <sup>*</sup></i> 
              <br>
              <select name="select_posicao" id="posicao" required>
                <?php for($i = 1; $i <= count($predios); $i++): ?>
                  <option value="<?= $i ?>" <?= ($p["posicao"] == $i) ? "selected" : "" ?>><?= $i ?></option>
                <?php endfor ?>
              </select>
            </label>
            <label for="projeto">
              <span class="formulario">PROJECTO EM COMERCIALIZAÇÃO</span>: <i>(projecto em comercialização associado) <sup>*</sup></i> 
              <br>
              <select name="select_projeto" id="projeto" required>
                <?php foreach($projetos as $projeto): ?>
                  <option value="<?= $projeto["nome"] ?>" <?= ($projeto["id"] == $p["id"]) ? "selected" : "" ?>><?=  $projeto["nome"] ?></option>
                <?php endforeach; ?>
              </select>
            </label>
            <label for="observacao">
              <span class="formulario">OBSERVAÇÃO</span>: <i>(exemplo: t0, t1, alçados) <sup>*</sup></i>
              <br>
              <input type="text" value="<?= $p["tipo"] ?>" name="input_observacao" id="observacao" required>
            </label>
            <label for="imagem">
              <span class="formulario">IMAGENS</span>: <sup>*</sup>
              <br>
              <input type="hidden" name="input_imagens" id="input_imagens" value='<?= !empty($imagens_atuais) ? json_encode($imagens_atuais) : "[]" ?>'>
              <input type="text" id="preview_imagens" readonly value='<?= !empty($imagens_atuais) ? json_encode($imagens_atuais) : "[]" ?>' class="img">
              <br>
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