<?php
// 1. Importante: Inclui o teu ficheiro de configuração/conexão aqui!
// Se o config.php estiver na pasta raiz, usas ../ para subir um nível.
require_once '../helpers/base_dados_helper.php';

if($_SERVER["REQUEST_METHOD"] === "POST") {
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

        // Resposta para o JavaScript
        echo "sucesso";
        exit;
    } else {
        // Se houver erros, enviamos os erros para o JS saber
        echo implode(", ", $erros);
        exit;
    }
}