<?php
require_once '../helpers/base_dados_helper.php';

  if($_SERVER["REQUEST_METHOD"] === "POST") {

    require_once '../helpers/recaptcha_helper.php';
    if (!validarRecaptcha()) {
        echo "Por favor, confirma que não és um robô.";
        exit;
    }

    $nome   = trim($_POST["nome"] ?? "");
    $email  = trim($_POST["email"] ?? "");
    $titulo = trim($_POST["titulo"] ?? "");
    $texto  = trim($_POST["texto"] ?? "");

    $erros = [];

    // Validações
    if($nome === "" || $email === "" || $titulo === "" || $texto === "") $erros[] = "Preencha todos os campos.";
    if(mb_strlen($nome) > 20) $erros[] = "Nome demasiado grande.";
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) $erros[] = "Email inválido.";
    if(mb_strlen($texto) > 150) $erros[] = "Mensagem demasiado grande."; 

    if(empty($erros)) {
      $stmt = $pdo->prepare("INSERT INTO contactos (nome, email, titulo, texto) VALUES (:nome, :email, :titulo, :texto)");
      $stmt->execute([
          "nome" => $nome,
          "email" => $email,
          "titulo" => $titulo,
          "texto" => $texto,
      ]);

      require_once '../helpers/email_helper.php';
      enviarEmailConfirmacaoContacto($nome, $email, $titulo);

      echo "sucesso";
      exit;
    } else {
      echo implode(", ", $erros);
      exit;
    }
  }

?>