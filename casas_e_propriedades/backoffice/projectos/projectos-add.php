<?php 

  require_once "../components/head.php";

  $projetos = get_projetos();


  $form = !empty($_POST["input_titulo"]) &&  !empty($_POST["select_activo"]) && !empty($_POST["select_posicao"]);
  if($form){
    $titulo = $_POST["input_titulo"];
    $subtitulo = $_POST["input_subtitulo"];
    $activo = $_POST["select_activo"];
    $posicao = intval($_POST["select_posicao"]);
    $conteudo = $_POST["text_conteudo"];
    $acabamentos = $_POST["text_acabamentos"];
    $precario = $_POST["text_precario"];

    idu_sql("UPDATE projetos SET posicao = posicao + 1 WHERE posicao >= $posicao");

    idu_sql("INSERT INTO projetos (nome, subitulo, conteudo, activo, posicao, acabamentos, precario) VALUES ('$nome', '$subtitulo', '$conteudo' ,'$activo', $posicao, '$acabamentos', '$precario')");

    header("Location: projectos-add.php?saved=1");
    exit;
  }

?>

    <main class="container-fluid">
      <div class="row mt-4 px-4">
        <div class="col-12 px-0">
          <p><span>Empresa</span> Criação de uma nova imagem de Cabeçalho.</p>
          <hr class="mt-1 mb-0">
          <button class="popup" onclick="window.close()">Fechar</button>
          <hr class="mt-1">
        </div>
        <div class="col-12 px-0">
          <form action="" method="post">
            
            <label for="activo">
              <span class="formulario">ACTIVO</span>: <i>(estado do projecto em comercialização) <sup>*</sup></i> 
              <br>
              <select name="select_activo" id="activo">
                <option value="Sim" >Sim</option>
                <option value="Não">Não</option>
              </select>
            </label>
            <label for="posicao">
              <span class="formulario">POSIÇÃO</span>: <i>(posição no menu de projectos em comercialização) <sup>*</sup></i> 
              <br>
              <select name="select_posicao" id="posicao">
                <?php for($i = count($projetos); $i >= 1; $i--): ?>
                  <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor ?>
              </select>
            </label>
            <label for="titulo">
              <span class="formulario">TÍTULO</span>: <i>(título do projecto em comercialização) <sup>*</sup></i>
              <br>
              <input type="text" value="" name="input_titulo" id="titulo">
            </label>
            <label for="subtitulo">
              <span class="formulario">SUBTÍTULO</span>: <i>(subtítulo do projecto em comercialização)</i>
              <br>
              <input type="text" value="" name="input_subtitulo" id="subtitulo">
            </label>
            <label for="conteudo">
              <span class="formulario mt-2">CONTEÚDO</span>: <i>(contéudo do projecto em comercialização) <sup>*</sup></i> 
              <br>
              <textarea name="text_conteudo" id="conteudo"></textarea>
            </label>
            <label for="acabamentos">
              <span class="formulario mt-2">ACABAMENTOS</span>: <i>(contéudo para download sobre acabamentos, máximo 1 item)</i> 
              <br>
              <textarea name="text_acabamentos" id="acabamentos"></textarea>
            </label>
            <label for="precario">
              <span class="formulario">PLANTAS E PREÇÁRIOS</span>: <i>(contéudo para download sobre plantas e precários, máximo 1 item)</i> 
              <br>
              <textarea name="text_precario" id="precario"></textarea>
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