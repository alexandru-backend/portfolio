<?php

  $predios = get_todos_predios();

  $projetos = [];
  foreach($predios as $p){
    $nome = $p['nome'];
    if(!isset($projetos[$nome])){
      $projetos[$nome] = [
        'ids' => [],
        'total_home' => 0,
        'posicao' => $p['posicao'],
        'activo' => 'Sim'
      ];
    }
    $projetos[$nome]['ids'][] = $p['id'];
    if($p['mostrar_na_home'] == 1){
      $projetos[$nome]['total_home']++;
    }
    if($p['activo'] == 'Não'){
      $projetos[$nome]['activo'] = 'Não';
    }
  }

  if(!empty($_POST["acao"]) && !empty($_POST["ids"])){
    $ids = array_map("intval", $_POST["ids"]);
    $ids_str = implode(",", $ids);
    $acao = $_POST["acao"];

    if($acao === "apagar"){
      foreach($ids as $id){
      $item = select_sql("SELECT posicao FROM predios WHERE id=$id AND mostrar_na_home=1");

      if(!empty($item)){
        $posicao = $item[0]['posicao'];
        idu_sql("UPDATE predios SET mostrar_na_home=0 WHERE id=$id");
        idu_sql("UPDATE predios SET posicao = posicao - 1 WHERE mostrar_na_home=1 AND posicao > $posicao");
      }
  }
    }elseif($acao === "ativar"){
      foreach($ids as $id){
          idu_sql("UPDATE predios SET mostrar_na_home=1 WHERE id=$id");
      }
    }elseif($acao === "desativar"){
      foreach($ids as $id){
          idu_sql("UPDATE predios SET mostrar_na_home=0 WHERE id=$id");
      }
    }

    header("Location: destaques.php?saved=1");
    exit;
  }
?>

  <main class="container">
    <div class="row mt-5">
      <div class="col-12 px-0">
        <div class="text-end"><img src="imagens/logo.jpg" alt="" class="logo"></div>
        <p><span>Destaques</span> Listagem dos Projectos em destaque na Home.</p>
        <hr class="mt-1">
      </div>
    </div>

    <div class="row">
      <div class="col-12 px-0">
        <button class="popup" onclick="abrir_popup('destaques/destaques-add.php')">NOVO</button>
        <hr class="mt-1">
      </div>

      <div class="col-12 tabela px-0">
        <form action="" method="post">
          <table class="m-auto w-100">
            <tr>
              <th><input type="checkbox" id="select_all" class="checkbox"></th>
              <th>ID</th>
              <th>PROJETO</th>
              <th>TOTAL DE TIPOS DE FOGO EXIBIDOS</th>
              <th>POSIÇÃO</th>
              <th>ACTIVO</th>
              <th>AÇÕES</th>
            </tr>
            
            <?php foreach($projetos as $i => $p): ?>                      
              <tr>
                <td>
                  <input type="checkbox" name="ids[]" value="<?= $p['ids'][0] ?>" class="checkbox">
                </td>
                <td><?= $p['ids'][0] ?></td>
                <td><?= $i ?></td>
                <td><?= $p['total_home'] ?></td>
                <td><?= $p['posicao'] ?></td>
                <td><?= $p['activo'] ?></td>
                <td><button type="button" class="popup" onclick="abrir_popup('destaques/destaques-edit.php?id=<?= $p['ids'][0] ?>')">Editar</button>|<a href="destaques/destaques-delete.php?id=<?= $p['ids'][0] ?>" onclick="return confirm('Esta ação é irreversível, deseja continuar?')">Excluir</a></td>
              </tr>
            <?php endforeach ?>
          </table>

          <div class="px-2 py-3 item w-100">
            Com os itens selecionados: 
            <button type="submit" class="popup" name="acao" value="apagar" onclick="return confirm('Tem a certeza que quer apagar os selecionados?')">apagar</button> |
            <button type="submit" class="popup" name="acao" value="ativar">ativar</button> |
            <button type="submit" class="popup" name="acao" value="desativar">desativar</button>
          </div>
        </form>
      </div>
    </div>

    <script>
      document.getElementById("select_all").addEventListener("change", function(){
        const checkboxes = document.querySelectorAll("input[name='ids[]']");
        checkboxes.forEach(cb => cb.checked = this.checked);
      });
    </script>
  </main>
