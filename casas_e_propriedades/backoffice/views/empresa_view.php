<?php

  $empresas = get_empresas();

  if(!empty($_POST["acao"]) && !empty($_POST["ids"])){
    $ids = array_map("intval", $_POST["ids"]);
    $ids_str = implode(",", $ids);
    $acao = $_POST["acao"];

    if($acao === "apagar"){
      foreach($ids as $id){
        $item = select_sql("SELECT posicao FROM empresas WHERE id=$id");
        if(!empty($item)){
          $posicao = $item[0]['posicao'];
          idu_sql("DELETE FROM carousel WHERE id=$id");
          idu_sql("UPDATE empresas SET posicao = posicao - 1 WHERE posicao > $posicao");
        }
      }
    } elseif($acao === "ativar"){
      idu_sql("UPDATE empresas SET activo = 'Sim' WHERE id IN ($ids_str)");
    } elseif($acao === "desativar"){
      idu_sql("UPDATE empresas SET activo = 'Não' WHERE id IN ($ids_str)");
    }

    header("Location: empresa.php?saved=1");
    exit;
  }
?>
<main class="container">
    <div class="row mt-5">
      <div class="col-12 px-0">
        <div class="text-end"><img src="imagens/logo.jpg" alt="" class="logo"></div>
        <p class=""><span>Empresa</span> Listagem de todos os artigos.</p>
        <hr class="mt-1 mb-1">
      </div>
    </div>

    <div class="row">
      <div class="col-12 px-0">
        <button class="popup" onclick="abrir_popup('empresa/empresa-add.php')">NOVO</button>
        <hr class="mt-1">
      </div>
      <div class="col-12 tabela px-0">
        <form action="" method="post">
          <table class="m-auto w-100">
            <tr>
              <th><input type="checkbox" id="select_all" class="checkbox"></th>
              <th>ID</th>
              <th class="table-medium">NOME</th>
              <th class="table-large">TEXTO</th>
              <th>ACTIVO</th>
              <th>POSIÇÃO</th>
              <th>AÇÕES</th>
            </tr>
            
            <?php foreach($empresas as $e): ?>                      

              <tr>
                <td><input type="checkbox" name="ids[]" value="<?= $e["id"] ?>" class="checkbox"></td>
                <td><?= $e["id"] ?></td>
                <td><?= $e["nome"] ?></td>
                <td><?= substr($e["texto"],0 ,150) ?>...</td>
                <td><?= $e["activo"] ?></td>
                <td><?= $e["posicao"] ?></td>
                <td><button type="button" class="popup" onclick="abrir_popup('empresa/empresa-edit.php?id=<?= $e['id'] ?>')">Editar</button>|<a href="empresa/empresa-delete.php?id=<?= $e['id'] ?>" onclick="return confirm('Esta ação é irreversível, deseja continuar?')">Excluir</a></td>
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