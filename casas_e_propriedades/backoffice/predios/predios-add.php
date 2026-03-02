<?php 

  require_once "../components/head.php";

  $projetos = get_projetos();
  $predios = get_todos_predios();


  $form = !empty($_POST["select_projeto"]) &&  !empty($_POST["select_activo"]) && !empty($_POST["select_posicao"])  && !empty($_POST["input_observacao"]) && !empty($_POST["input_imagens"]);
  if($form){
    $nome = $_POST["select_projeto"];
    $activo = $_POST["select_activo"];
    $posicao = intval($_POST["select_posicao"]);
    $observacao = $_POST["input_observacao"];
    $imagens = $_POST["input_imagens"] ?? '[]';

    $imagens_array = json_decode($imagens, true);
    if (!is_array($imagens_array)) {
        $imagens_array = [$imagens];
    }
    $img_json = json_encode($imagens_array);

    $id_projeto = intval($_POST['select_projeto']);
    $nome_projeto = '';
    foreach($projetos as $p){
        if($p['id'] === $id_projeto){
            $nome_projeto = $p['nome'];
            break;
        }
    }

    idu_sql("UPDATE carousel SET posicao = posicao + 1 WHERE posicao >= $posicao");

    idu_sql("INSERT INTO predios (id_projeto, nome, tipo, activo, posicao) VALUES ($id_projeto, '$nome_projeto', '$observacao', '$activo', $posicao)");
    
    $novo_id = get_last_insert_id();

    idu_sql("INSERT INTO predio_imagens (id_predio, imagens) VALUES ($novo_id, '$img_json')");

    header("Location: predios-add.php?saved=1");
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
            
            <label for="activo">
              <span class="formulario">ACTIVO</span>: <i>(estado do projecto em comercialização tipos de fogo) <sup>*</sup></i> 
              <br>
              <select name="select_activo" id="activo" required>
                <option value="Sim">Sim</option>
                <option value="Não">Não</option>
              </select>
            </label>
            <label for="posicao">
              <span class="formulario">POSIÇÃO</span>: <i>(posição do projectos em comercialização tipos de fogo) <sup>*</sup></i> 
              <br>
              <select name="select_posicao" id="posicao" required>
                <?php for($i = count($predios) + 1; $i >= 1; $i--): ?>
                  <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor ?>
              </select>
            </label>
            <label for="projeto">
              <span class="formulario">PROJECTO EM COMERCIALIZAÇÃO</span>: <i>(projecto em comercialização associado) <sup>*</sup></i> 
              <br>
              <select name="select_projeto" id="projeto" required>
                <?php foreach($projetos as $projeto): ?>
                  <option value="<?= $projeto["id"] ?>" ><?=  $projeto["nome"] ?></option>
                <?php endforeach; ?>
              </select>
            </label>
            <label for="observacao">
              <span class="formulario">OBSERVAÇÃO</span>: <i>(exemplo: t0, t1, alçados) <sup>*</sup></i>
              <br>
              <input type="text" value="" name="input_observacao" id="observacao" required>
            </label>
            <label for="imagem">
              <span class="formulario">IMAGENS</span>: <sup>*</sup>
              <input type="hidden" name="input_imagens" id="input_imagens" value='[]'>
              <input type="text" id="preview_imagens" readonly value='[]' class="img">
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