<?php

require_once '../helpers/base_dados_helper.php';

  $departamentos_validos = ["cardiology", "neurology", "orthopedics", "pediatrics", "dermatology", "general"];
  $doutores_validos = ["dr-johnson", "dr-martinez", "dr-chen", "dr-patel", "dr-williams", "dr-thompson"];

  if ($_SERVER["REQUEST_METHOD"] === "POST") {

    require_once '../helpers/recaptcha_helper.php';
    if (!validarRecaptcha()) {
        echo "Por favor, confirma que não és um robô.";
        exit;
    }

    $nome        = trim($_POST["nome"] ?? "");
    $email       = trim($_POST["email"] ?? "");
    $telemovel   = trim($_POST["telemovel"] ?? "");
    $departamento = trim($_POST["departamento"] ?? "");
    $data        = trim($_POST["data"] ?? "");
    $doutor      = trim($_POST["doutor"] ?? "");
    $descricao   = trim($_POST["descricao"] ?? "");

    $erros = [];


    if ($nome === "" || $email === "" || $telemovel === "" || $departamento === "" || $data === "" || $doutor === "") {
      $erros[] = "Preencha todos os campos obrigatórios.";
    }
    if (mb_strlen($nome) > 50) $erros[] = "Nome demasiado longo.";
    if (mb_strlen($email) > 100) $erros[] = "Email demasiado longo.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $erros[] = "Email inválido.";
    if (mb_strlen($telemovel) > 20) $erros[] = "Telemóvel demasiado longo.";
    if (!in_array($departamento, $departamentos_validos)) $erros[] = "Departamento inválido.";
    if (!in_array($doutor, $doutores_validos)) $erros[] = "Doutor inválido.";
    $data_obj = DateTime::createFromFormat("Y-m-d", $data);
    if (!$data_obj || $data_obj->format("Y-m-d") !== $data) $erros[] = "Data inválida.";
    if ($data_obj && $data_obj < new DateTime("today")) $erros[] = "A data não pode ser no passado.";
    if (mb_strlen($descricao) > 500) $erros[] = "Descrição demasiado longa.";

    if (empty($erros)) {
      $stmt = $pdo->prepare("INSERT INTO marcacoes (nome, email, telemovel, departamento, data, doutor, descricao) VALUES (:nome, :email, :telemovel, :departamento, :data, :doutor, :descricao)");
      $stmt->execute([
          "nome" => $nome,
          "email" => $email,
          "telemovel" => $telemovel,
          "departamento" => $departamento,
          "data" => $data,
          "doutor" => $doutor,
          "descricao" => $descricao ?: null,
      ]);

      require_once '../helpers/email_helper.php';
      enviarEmailConfirmacaoMarcacao($nome, $email, $doutor, $departamento, $data);

      echo "sucesso";
      exit;
    } else {
      echo implode("<br>", $erros); 
      exit;
    }
  }

?>