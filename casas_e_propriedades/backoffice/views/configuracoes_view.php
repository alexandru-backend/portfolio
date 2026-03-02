<?php

  $contactos = get_contactos();

?>
  <main class="container">
    <div class="row mt-5">
      <div class="col-12 px-0">
        <div class="text-end"><img src="imagens/logo.jpg" alt="" class="logo"></div>
        <p><span>Contactos</span> Lista dos Contactos do Site.</p>
      </div>
    </div>

    <div class="row">
      <div class="col-12 tabela px-0">
        <table class="m-auto w-100">
          <tr>
            <th>MORADA</th>
            <th>TELEFONE</th>
            <th>E-MAIL</th>
            <th>FACEBOOK</th>
            <th>AÇÕES</th>
          </tr>
          
          <?php foreach($contactos as $c): ?>                      

            <tr>
              <td><?= $c["morada"] ?></td>
              <td><?= $c["telefone"] ?></td>
              <td><?= $c["email"] ?></td>
              <td><?= $c["facebook"] ?></td>
              <td><button class="popup" onclick="abrir_popup('configuracoes/configuracoes-edit.php?id=<?= $c['id'] ?>')">Editar</button></td>
            </tr>

          <?php endforeach ?>
          
        </table>
      </div>
    </div>
  </main>