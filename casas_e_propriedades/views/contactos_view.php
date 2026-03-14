<?php

  $form = !empty($_POST["nome"]) && !empty($_POST["telefone"]) && !empty($_POST["email"]) && !empty($_POST["mensagem"]);
  if($form){


    $g_recaptcha_response = $_POST["g-recaptcha-response"];
    $chave_secreta = "6Lc_9c0rAAAAACOXVy_4YJEn5CBn6QrNIPiuuBaP";
    $resposta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$chave_secreta&response=$g_recaptcha_response");
    $google = json_decode($resposta);

    if($google->success){

      $nome = $_POST["nome"];
      $telefone = $_POST["telefone"];
      $email = $_POST["email"];
      $mensagem = $_POST["mensagem"];

      $mensagem_final = "
        - Nome: $nome
        - Telefone: $telefone
        - E-mail: $email
        - Mensagem: $mensagem
      ";

      $headers = "MIME-Version: 1.0\r\nContent-type:text/html;charset=UTF-8\r\n";

      if(!empty($_POST["receber_copia"])){
        mail($contactos["email_formulario"].",".$email, "Contactos do Site Casas & Propriedades", $mensagem_final, $headers);
      }
      else{
        mail($contactos["email_formulario"], "Contactos do Site Casas & Propriedades", $mensagem_final, $headers);
      }

      header("Location: " . $_SERVER['PHP_SELF']);
      exit;
    }
    else{
      echo "Preencha o recaptcha";
    }
    
  }

?>
  <main class="container-fluid">

    <div class="row mx-1 mx-sm-4">

      <div class="col-2 offset-sm-1 px-0 text-start t1">
        <div>Contactos</div>
        <div>
          <hr class="linha">
        </div>
      </div>
      <div class="col-12 col-lg-9 ps-md-5 mt-5 mt-md-0 text-center text-lg-start margin">
        <div>
          <h5 class="contactos">Morada</h5>
          <p class="contactos-info"><?= $contactos["morada"] ?></p>
        </div>
        <div class="d-flex flex-column flex-lg-row justify-content-lg-between mt-4">
          <div>
            <h5 class="contactos">E-mail</h5>
            <p class="contactos-info"><?= $contactos["email"] ?></p>
          </div>
          <div class="mt-4 mt-md-0 pe-lg-5 me-lg-5">
            <h5 class="contactos">Telefone</h5>
            <p class="contactos-info"><?= $contactos["telefone"] ?></p>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-5">
      <div class="col-12 col-sm-11 m-auto">

        <h2 class="t1 mt-0">Marque sua visita</h2>
        <div>
          <hr class="linha">
        </div>

        <form action="contactos.php" id="formulario_contactos" class="my-5" method="post">
          <input type="text" required placeholder="*Nome" name="nome">
          <input type="number" required placeholder="*Telefone" name="telefone">
          <input type="email" required placeholder="*E-mail" name="email">
          <textarea name="mensagem" placeholder="*Mensagem" required maxlength="250"></textarea>

          <div class="d-flex justify-content-between flex-column flex-md-row">

            <div class="campos-obrigatorios mt-3">
              <div>*Campos de Preenchimento Obrigatório</div>
              <div class="d-flex align-items-start gap-2 mt-3 pe-5">
                <input type="checkbox" name="receber_copia" class="mt-1">
                <div>Desejo receber uma cópia desta mensagem no meu e-mail</div>
              </div>
            </div>

            <div class="me-lg-5 mt-4 mt-md-0">
              <div class="g-recaptcha" data-sitekey="6Lc_9c0rAAAAAM13Fgs5NiIXN_5V78pqz5ztmZNT"></div>
            </div>

          </div>

          <div class="text-center">
            <input type="submit" value="ENVIAR">
          </div>

        </form>

      </div>
    </div>


  </main>