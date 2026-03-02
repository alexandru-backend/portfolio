<?php

  $erro = "";
  $sucesso = "";

  if($_SERVER["REQUEST_METHOD"] === "POST"){
    $senha = $_POST["input_senha"] ?? '';
    $confirm_senha = $_POST["input_confirm_senha"] ?? '';

    if(empty($senha) || empty($confirm_senha)){
      $erro = "Por favor, preencha todos os campos!";
    }elseif($senha !== $confirm_senha){
      $erro = "As senhas não coincidem!";
    }else{
      $hash = password_hash($senha, PASSWORD_DEFAULT);
      $id = $_SESSION["utilizador"]["id"];

      $stmt = $pdo->prepare("UPDATE backoffice SET senha = ? WHERE id = ?");
      $stmt->execute([$hash, $id]);

      session_destroy();
      header("Location: index.php?senha_nova=1");
      exit;
    }
  }

?>

  <main class="container">
    <div class="row mt-5 mb-">
      <div class="col-12 px-0">
        <div class="text-end"><img src="imagens/logo.jpg" alt="" class="logo"></div>
        <p class="mb-0"><span>Alterar senha</span> Informe uma nova senha abaixo.</p>
        <hr class="my-1">
        <form action="" method="post">
          
          <?php if(!empty($erro)): ?>
              <div class="cancelar w-100 mb-y p-2 text-white"><?= $erro ?></div>
          <?php endif; ?>
          <input type="hidden" name="id" value="<?= $id ?>">

          <label for="senha">
            <span class="formulario">NOVA SENHA</span>: <i><sup>*</sup></i> 
            <br>
            <input type="password" value="" class="empresa" name="input_senha" id="senha" required>
          </label>
          <label for="confirm_senha">
            <span class="formulario">CONFIRAMÇÃO NOVA SENHA</span>: <i><sup>*</sup></i> 
            <br>
            <input type="password" value="" class="empresa" name="input_confirm_senha" id="confirm_senha" required>
          </label>
          
          <hr class="my-2">
          <input type="submit" value="Enviar" class="guardar text-white border-0 px-3">
          <hr class="my-2">
        </form>
      </div>
    </div>
  </main>