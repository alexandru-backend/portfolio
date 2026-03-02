<?php 

  require_once "../components/head.php";

  $portfolio = get_todos_portfolios();

  $form = !empty($_POST["input_nome"]) &&  !empty($_POST["select_activo"]) && !empty($_POST["select_posicao"]) && !empty($_POST["input_imagens"]);
  if($form){
    $nome = $_POST["input_nome"]; 
    $activo = $_POST["select_activo"];
    $posicao = intval($_POST["select_posicao"]);
    $imagens = $_POST["input_imagens"] ?? '[]';
    
    $imagens_array = json_decode($imagens, true);
    if (!is_array($imagens_array)) {
        $imagens_array = [$imagens];
    }
    $img_json = json_encode($imagens_array);

    idu_sql("UPDATE portfolio SET posicao = posicao + 1 WHERE posicao >= $posicao");

    idu_sql("INSERT INTO portfolio (nome, activo, posicao) VALUES ('$nome', '$activo', $posicao)");

    $novo_id = get_last_insert_id();

    idu_sql("INSERT INTO portfolio_imagens (portfolio, imagens) VALUES ($novo_id, '$img_json')");

    header("Location: portfolio-add.php?saved=1");
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
              <input type="text" value="" class="contacto" name="input_nome" id="nome" required>
            </label>
            
            <label for="activo">
              <span class="formulario">ACTIVO</span>: <i>(estado do portfólio) <sup>*</sup></i> 
              <br>
              <select name="select_activo" id="activo" required>
                <option value="Sim">Sim</option>
                <option value="Não">Não</option>
              </select>
            </label>
            <label for="posicao">
              <span class="formulario">POSIÇÃO</span>: <i>(posição do portfólio) <sup>*</sup></i> 
              <br>
              <select name="select_posicao" id="posicao" required>
                <?php for($i = count($portfolio) + 1; $i >= 1; $i--): ?>
                  <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor ?>
              </select>
            </label>
            <label for="imagem">
              <span class="formulario">IMAGENS</span>: <sup>*</sup>
              <input type="hidden" name="input_imagens" id="input_imagens" value=''>
              <input type="text" id="preview_imagens" readonly value='' class="img">
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