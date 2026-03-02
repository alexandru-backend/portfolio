<?php 

  require_once "../components/head.php";

  $empresa = get_empresas();

  $id = !empty($_GET["id"]) ? intval($_GET["id"]) : 0;
  $e = get_empresa($id);

  $form = !empty($_POST["input_nome"]) &&  !empty($_POST["select_activo"]) && !empty($_POST["select_posicao"]);
  if($form){
    $nome = $_POST["input_nome"];
    $activo = $_POST["select_activo"];
    $posicao = intval($_POST["select_posicao"]);
    $texto = $_POST["text_conteudo"];

    $posicao_anterior = $e["posicao"];

    if($posicao != $posicao_anterior){
      if($posicao < $posicao_anterior){
        idu_sql("UPDATE empresas SET posicao = posicao + 1 WHERE posicao >= $posicao AND posicao < $posicao_anterior AND id != $id");
      }else{
        idu_sql("UPDATE empresas SET posicao = posicao - 1 WHERE posicao <= $posicao AND posicao > $posicao_anterior AND id != $id");
      }
    }

    idu_sql("UPDATE empresas SET nome='$nome', activo='$activo', posicao=$posicao, texto='$texto' WHERE id=$id");

    header("Location: empresa-edit.php?id=$id&saved=1");
    exit;
  }
  
?>

    <main class="container-fluid">
      <div class="row mt-4 px-4">
        <div class="col-12 px-0">
          <p><span>Empresa</span> Edição do artigo (<?= $e["nome"] ?>).</p>
          <hr class="mt-1 mb-0">
          <button class="popup" onclick="window.close()">Fechar</button>
          <hr class="mt-1">
        </div>
        <div class="col-12 px-0">
          <form action="" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">

            <label for="nome">
              <span class="formulario">NOME</span>: <i>(nome do artigo) <sup>*</sup></i> 
              <br>
              <input type="text" value="<?= $e["nome"] ?>" class="empresa" name="input_nome" id="nome" required>
            </label>
            
            <label for="activo">
              <span class="formulario">ACTIVO</span>: <i>(estado do artigo) <sup>*</sup></i> 
              <br>
              <select name="select_activo" id="activo" class="empresa">
                <option value="Sim" <?= ($e["activo"] == "Sim") ? "selected" : "" ?>>Sim</option>
                <option value="Não" <?= ($e["activo"] == "Não") ? "selected" : "" ?>>Não</option>
              </select>
            </label>
            <label for="posicao">
              <span class="formulario">POSIÇÃO</span>: <i>(posição no menu empresa) <sup>*</sup></i> 
              <br>
              <select name="select_posicao" id="posicao" class="empresa">
                <?php for($i = 1; $i <= count($empresa); $i++): ?>
                  <option value="<?= $i ?>" <?= ($e["posicao"] == $i) ? "selected" : "" ?>><?= $i ?></option>
                <?php endfor ?>
              </select>
            </label>
            <label for="conteudo">
              <span class="formulario">CONTEÚDO</span>: <i>(contéudo do artigo) <sup>*</sup></i> 
              <br>
              <textarea name="text_conteudo" id="conteudo" class="empresa"><?= $e["texto"] ?></textarea>
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