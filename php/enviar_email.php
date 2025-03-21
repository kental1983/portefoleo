<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $mensagem = $_POST["mensagem"];

    $mail = new PHPMailer(true);

    try {
        $mail->setFrom($email, $nome);
        $mail->addAddress("kental1982@hotmail.com"); // Insira o endereço de e-mail para onde deseja enviar a mensagem
        $mail->Subject = "Nova mensagem do formulário de contato";
        $mail->Body = "Nome: $nome\n";
        $mail->Body .= "Email: $email\n";
        $mail->Body .= "Mensagem:\n$mensagem";

        $mail->send();

        echo "Mensagem enviada com sucesso!";
    } catch (FFI\Exception $e) {
        echo "Ocorreu um erro no envio da mensagem: " . $mail->ErrorInfo;
    }
}
?>
