<?php
define('RECAPTCHA_SECRET', '6LfZOIksAAAAAOBrGiHNYAs8GjEy9mMIIdnlLuwN'); // <- Muda aqui

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