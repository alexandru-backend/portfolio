<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';

define('SMTP_USER', 'racicovschialexandru@gmail.com');   // <- Muda aqui
define('SMTP_PASS', 'jrbi wxuf svwd bhbf');      // <- App Password aqui
define('SMTP_FROM_NAME', 'MediTrust Hospital');

function enviarEmailConfirmacaoMarcacao(string $nome, string $email, string $doutor, string $departamento, string $data): bool {
    $dataFormatada = date('d/m/Y', strtotime($data));

    $html = "
    <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden;'>
        <div style='background-color: #1977cc; padding: 20px; text-align: center;'>
            <h1 style='color: white; margin: 0;'>MediTrust</h1>
        </div>
        <div style='padding: 30px; line-height: 1.6; color: #333;'>
            <h2 style='color: #1977cc;'>✔ Marcação Confirmada</h2>
            <p>Olá, <strong>{$nome}</strong>!</p>
            <p>A tua marcação foi recebida com sucesso. Aqui estão os detalhes:</p>
            <hr style='border: 0; border-top: 1px solid #eee;'>
            <p><strong>Médico:</strong> {$doutor}</p>
            <p><strong>Departamento:</strong> {$departamento}</p>
            <p><strong>Data:</strong> {$dataFormatada}</p>
            <hr style='border: 0; border-top: 1px solid #eee;'>
            <p>Se precisares de alterar ou cancelar a tua consulta, contacta-nos o mais breve possível.</p>
        </div>
        <div style='background-color: #f8f9fa; padding: 15px; text-align: center; font-size: 12px; color: #777;'>
            <p>&copy; 2026 MediTrust Hospital. Todos os direitos reservados.</p>
        </div>
    </div>";

    return _enviarEmail($email, $nome, 'Confirmação da sua Marcação — MediTrust', $html);
}

function enviarEmailConfirmacaoContacto(string $nome, string $email, string $titulo): bool {
    $html = "
    <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden;'>
        <div style='background-color: #1977cc; padding: 20px; text-align: center;'>
            <h1 style='color: white; margin: 0;'>MediTrust</h1>
        </div>
        <div style='padding: 30px; line-height: 1.6; color: #333;'>
            <h2 style='color: #1977cc;'>✔ Mensagem Recebida</h2>
            <p>Olá, <strong>{$nome}</strong>!</p>
            <p>Recebemos a tua mensagem com o assunto: <strong>{$titulo}</strong></p>
            <p>A nossa equipa irá responder em breve.</p>
        </div>
        <div style='background-color: #f8f9fa; padding: 15px; text-align: center; font-size: 12px; color: #777;'>
            <p>&copy; 2026 MediTrust Hospital. Todos os direitos reservados.</p>
        </div>
    </div>";

    return _enviarEmail($email, $nome, 'Recebemos a sua mensagem — MediTrust', $html);
}

function _enviarEmail(string $paraEmail, string $paraNome, string $assunto, string $html): bool {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USER;
        $mail->Password   = SMTP_PASS;
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8';

        $mail->setFrom(SMTP_USER, SMTP_FROM_NAME);
        $mail->addAddress($paraEmail, $paraNome);

        $mail->isHTML(true);
        $mail->Subject = $assunto;
        $mail->Body    = $html;

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log('PHPMailer Error: ' . $mail->ErrorInfo);
        return false;
    }
}

?>