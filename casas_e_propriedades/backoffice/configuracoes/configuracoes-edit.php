<?php 

  require_once "../components/head.php";

  $contactos = get_contactos();

  $id = !empty($_GET["id"]) ? intval($_GET["id"]) : 0;
  $c = get_contacto($id);

  $form = !empty($_POST["input_morada"]) &&  !empty($_POST["input_telefone"]) && !empty($_POST["input_email"]) && !empty($_POST["input_facebook"]);
  if($form){
    $morada = $_POST["input_morada"];
    $telefone = $_POST["input_telefone"];
    $email = $_POST["input_email"];
    $facebook = $_POST["input_facebook"];

    idu_sql("UPDATE contactos SET morada='$morada', telefone='$telefone', email='$email', facebook='$facebook' WHERE id=$id");

    header("Location: configuracoes-edit.php?id=$id&saved=1");
    exit;
  }
  
?>


    <main class="container-fluid">
      <div class="row mt-4 px-4">
        <div class="col-12 px-0">
          <p><span>Contactos</span> Edição dos Contactos.</p>
          <hr class="mt-1 mb-0">
          <button class="popup" onclick="window.close()">Fechar</button>
          <hr class="mt-1">
        </div>
        <div class="col-12 px-0">
          <form action="" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">

            <label for="morada">
              <span class="formulario">MORADA</span>: <i><sup>*</sup></i> 
              <br>
              <input type="text" value="<?= $c["morada"] ?>"  name="input_morada" id="nome" class="contacto" required>
            </label>
            <label for="telefone">
              <span class="formulario">TELEFONE</span>: <i><sup>*</sup></i> 
              <br>
              <input type="text" value="<?= $c["telefone"] ?>"  name="input_telefone" id="telefone" required>
            </label>
            <label for="email">
              <span class="formulario">E-MAIL</span>: <i>(e-mail para recebimento de formulários)<sup>*</sup></i> 
              <br>
              <input type="text" value="<?= $c["email"] ?>"  name="input_email" id="email" required>
            </label>
            <label for="facebook">
              <span class="formulario">FACEBOOK</span>: <i>(link para o facebook)<sup>*</sup></i> 
              <br>
              <input type="text" value="<?= $c["facebook"] ?>" name="input_facebook" id="facebook" required>
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