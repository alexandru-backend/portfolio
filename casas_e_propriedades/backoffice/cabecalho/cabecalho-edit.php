<?php 

  require_once "../components/head.php";

  $carousel = get_carousel();

  $id = !empty($_GET["id"]) ? intval($_GET["id"]) : 0;
  $ce = get_carousel_especifico($id);

  $form = !empty($_POST["select_activo"]) && !empty($_POST["select_posicao"]) && !empty($_POST["input_imagem"]);
  if($form){
    $titulo = $_POST["input_titulo"];
    $subtitulo = $_POST["input_subtitulo"];
    $tag = $_POST["input_tag"];
    $activo = $_POST["select_activo"];
    $posicao = intval($_POST["select_posicao"]);
    $imagem = $_POST["input_imagem"];

    $posicao_anterior = $ce["posicao"];

    if($posicao != $posicao_anterior){
      if($posicao < $posicao_anterior){
        idu_sql("UPDATE carousel SET posicao = posicao + 1 WHERE posicao >= $posicao AND posicao < $posicao_anterior AND id != $id");
      }else{
        idu_sql("UPDATE carousel SET posicao = posicao - 1 WHERE posicao <= $posicao AND posicao > $posicao_anterior AND id != $id");
      }
    }

    idu_sql("UPDATE carousel SET titulo='$titulo',subtitulo='$subtitulo', tag='$tag', activo='$activo', posicao=$posicao, imagem='$imagem' WHERE id=$id");

    header("Location: cabecalho-edit.php?id=$id&saved=1");
    exit;
  }

?>

    <main class="container-fluid">
      <div class="row mt-4 px-4">
        <div class="col-12 px-0">
          <p><span>Cabeçalho</span> Edição de uma nova imagem de Cabeçalho.</p>
          <hr class="mt-1 mb-0">
          <button class="popup" onclick="window.close()">Fechar</button>
          <hr class="mt-1">
        </div>
        <div class="col-12 px-0">
          <form action="" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">

            <label for="titulo">
              <span class="formulario">TÍTULO</span>: <i>(título da imagem do cabeçalho)</i>
              <br>
              <input type="text" value="<?= $ce["titulo"] ?>" name="input_titulo" id="titulo">
            </label>
            
            <label for="subtitulo">
              <span class="formulario">SUBTÍTULO</span>: <i>(subtítulo da imagem do cabeçalho)</i>
              <br>
              <input type="text" value="<?= $ce["subtitulo"] ?>" name="input_subtitulo" id="subtitulo">
            </label>
            <br>
            <label for="tag">
              <span class="formulario">TAG</span>: <i>(tag da imagem do cabeçalho)</i>
              <br>
              <input type="text" value="<?= $ce["tag"] ?>" name="input_tag" id="tag">
            </label>
            
            <label for="activo">
              <span class="formulario">ACTIVO</span>: <sup>*</sup>
              <br>
              <select name="select_activo" id="activo">
                <option value="Sim" <?= ($ce["activo"] == "Sim") ? "selected" : "" ?>>Sim</option>
                <option value="Não" <?= ($ce["activo"] == "Não") ? "selected" : "" ?>>Não</option>
              </select>
            </label>
            <br>
            <label for="posicao">
              <span class="formulario">POSIÇÃO</span>: <i>(posição no slide show) <sup>*</sup></i> 
              <br>
              <select name="select_posicao" id="posicao">
                <?php for($i = 1; $i <= count($carousel); $i++): ?>
                  <option value="<?= $i ?>" <?= ($ce["posicao"] == $i) ? "selected" : "" ?>><?= $i ?></option>
                <?php endfor ?>
              </select>
            </label>
            <hr class="my-3">
            <label for="imagem">
              <span class="formulario">IMAGEM</span>: <sup>*</sup>
              <br>
              <input type="text" value="<?= $ce["imagem"] ?>" name="input_imagem" required readonly id="imagem" class="img">
              <button type="button" class=" p-0" onclick="abrir_popup_filemanager('imagem')"><img src="../imagens/image.png" alt="" class="icon-galeria"></button>
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