<?php

  $projetos = get_projetos();

  if(!empty($_POST["acao"]) && !empty($_POST["ids"])){
    $ids = array_map("intval", $_POST["ids"]);
    $ids_str = implode(",", $ids);
    $acao = $_POST["acao"];

    if($acao === "apagar"){
      foreach($ids as $id){
        $item = select_sql("SELECT posicao FROM projetos WHERE id=$id");
        if(!empty($item)){
          $posicao = $item[0]['posicao'];
          idu_sql("DELETE FROM projetos WHERE id=$id");
          idu_sql("UPDATE projetos SET posicao = posicao - 1 WHERE posicao > $posicao");
        }
      }
    }elseif($acao === "ativar"){
      idu_sql("UPDATE projetos SET activo = 'Sim' WHERE id IN ($ids_str)");
    }elseif($acao === "desativar"){
      idu_sql("UPDATE projetos SET activo = 'Não' WHERE id IN ($ids_str)");
    }

    header("Location: projectos.php?saved=1");
    exit;
  }
?>
<main class="container">
    <div class="row mt-5">
      <div class="col-12 px-0">
        <div class="text-end"><img src="imagens/logo.jpg" alt="" class="logo"></div>
        <p class=""><span>Projectos</span> Listagem de todos os Projectos em Comercialização.</p>
        <hr class="mt-1 mb-1">
      </div>
    </div>

    <div class="row">
      <div class="col-12 px-0">
        <button class="popup" onclick="abrir_popup('projectos/projectos-add.php')">NOVO</button>
        <hr class="mt-1">
      </div>
      <div class="col-12 tabela px-0">
        <form action="" method="post">
          <table class="m-auto w-100">
            <tr>
              <th><input type="checkbox" id="select_all" class="checkbox"></th>
              <th>ID</th>
              <th>TÍTULO</th>
              <th>SUBTÍTULO</th>
              <th>CONTÉUDO</th>
              <th>POSIÇÃO</th>
              <th>ACTIVO</th>
              <th>AÇÕES</th>
            </tr>
            
            <?php foreach($projetos as $p): ?>                      

              <tr>
                <td><input type="checkbox" name="ids[]" value="<?= $p["id"] ?>" class="checkbox"></td>
                <td><?= $p["id"] ?></td>
                <td><?= $p["nome"] ?></td>
                <td><?= $p["subtitulo"] ?></td>
                <td><?= substr($p["conteudo"],0 ,150) ?></td>
                <td><?= $p["posicao"] ?></td>
                <td><?= $p["activo"] ?></td>
                <td><button type="button" class="popup" onclick="abrir_popup('projectos/projectos-edit.php?id=<?= $p['id'] ?>')">Editar</button>|<a href="projectos/projectos-delete.php?id=<?= $p['id'] ?>" onclick="return confirm('Esta ação é irreversível, deseja continuar?')">Excluir</a></td>
              </tr>

            <?php endforeach ?>
            
          </table>
          <div class="px-2 py-3 itens">
            Com os itens selecionados: 
            <button type="submit" class="popup" name="acao" value="apagar" onclick="return confirm('Tem a certeza que quer apagar os selecionados?')">apagar</button> |
            <button type="submit" class="popup" name="acao" value="ativar">ativar</button> |
            <button type="submit" class="popup" name="acao" value="desativar">desativar</button>
          </div>
        </form>
      </div>
    </div>
  </main>
  <script>
    document.getElementById("select_all").addEventListener("change", function(){
      const checkboxes = document.querySelectorAll("input[name='ids[]']");
      checkboxes.forEach(cb => cb.checked = this.checked);
    });
  </script>