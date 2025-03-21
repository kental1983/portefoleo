<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $mensagem = $_POST["mensagem"];

    // Configurar o endereço de email para onde as mensagens serão enviadas
    $to = "kental1983@hotmail.com"; // Substitua pelo seu endereço de email real

    // Assunto e mensagem do email
    $subject = "Nova mensagem de contato do portfólio";
    $message = "Nome: $nome\nEmail: $email\nMensagem:\n$mensagem";

    // Cabeçalhos do email
    $headers = "From: $email"; // O remetente será o email fornecido no formulário de contato

    // Enviar o email
    if (mail($to, $subject, $message, $headers)) {
        echo "Mensagem enviada com sucesso!";
    } else {
        echo "Erro ao enviar a mensagem.";
    }
}
?>

