<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

define('RECAPTCHA_SECRET', $_ENV['RECAPTCHA_SECRET']);

function validarRecaptcha(): bool {
    $token = $_POST['g-recaptcha-response'] ?? '';
    if (empty($token)) return false;

    $resposta = file_get_contents(
        'https://www.google.com/recaptcha/api/siteverify?secret=' 
        . RECAPTCHA_SECRET . '&response=' . urlencode($token)
    );

    $dados = json_decode($resposta, true);
    return $dados['success'] === true;
}

?>