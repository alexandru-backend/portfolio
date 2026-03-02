<?php 

  require_once "../components/head.php";

  $carousel = get_carousel();

  $form = !empty($_POST["input_titulo"]) && !empty($_POST["select_activo"]) && !empty($_POST["select_posicao"]) && !empty($_POST["input_imagem"]);
  if($form){
    $titulo = $_POST["input_titulo"];
    $subtitulo = $_POST["input_subtitulo"];
    $tag = $_POST["input_tag"];
    $activo = $_POST["select_activo"];
    $posicao = intval($_POST["select_posicao"]);
    $imagem = $_POST["input_imagem"];

    idu_sql("UPDATE carousel SET posicao = posicao + 1 WHERE posicao >= $posicao");

    idu_sql("INSERT INTO carousel (titulo, subtitulo, tag, activo, posicao, imagem) VALUES ('$titulo', '$subtitulo', '$tag','$activo', $posicao, '$imagem')");

    header("Location: cabecalho-add.php?saved=1");
    exit;
  }
  
?>

    <main class="container-fluid">
      <div class="row mt-4 px-4">
        <div class="col-12 px-0">
          <p><span>Cabeçalho</span> Criação de uma nova imagem de Cabeçalho.</p>
          <hr class="mt-1 mb-0">
          <button class="popup" onclick="window.close()">Fechar</button>
          <hr class="mt-1">
        </div>
        <div class="col-12 px-0">
          <form action="" method="post">

            <label for="titulo">
              <span class="formulario">TÍTULO</span>: <i>(título da imagem do cabeçalho)</i>
              <br>
              <input type="text" value="" name="input_titulo" id="titulo">
            </label>
            
            <label for="subtitulo">
              <span class="formulario">SUBTÍTULO</span>: <i>(subtítulo da imagem do cabeçalho)</i>
              <br>
              <input type="text" value="" name="input_subtitulo" id="subtitulo">
            </label>
            <br>
            <label for="tag">
              <span class="formulario">TAG</span>: <i>(tag da imagem do cabeçalho)</i>
              <br>
              <input type="text" value="" name="input_tag" id="tag">
            </label>
            
            <label for="activo">
              <span class="formulario">ACTIVO</span>: <sup>*</sup>
              <br>
              <select name="select_activo" id="activo">
                <option value="Sim" >Sim</option>
                <option value="Não" >Não</option>
              </select>
            </label>
            <br>
            <label for="posicao">
              <span class="formulario">POSIÇÃO</span>: <i>(posição no slide show)</i> <sup>*</sup>
              <br>
              <select name="select_posicao" id="posicao">
                <?php for($i = count($carousel) + 1; $i >= 1 ; $i--): ?>
                  <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor ?>
              </select>
            </label>
            <hr class="my-3">
            <label for="imagem">
              <span class="formulario">IMAGEM</span>: <sup>*</sup>
              <br>
              <input type="text" value="" name="input_imagem" required readonly id="imagem" class="img">
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