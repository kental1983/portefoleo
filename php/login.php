<?php
include 'config.php'; // Inclua seu arquivo config.php para a conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Consulte o banco de dados para obter o hash de senha e o sal associados ao nome de usuário
    $stmt = $mysqli->prepare("SELECT password, salt FROM utilizador WHERE username = ?");
    $stmt->bind_param("s", $username);

    if ($stmt->execute()) {
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($hashedPassword, $salt);
            $stmt->fetch();

            // Combine a senha fornecida com o sal
            $passwordSalted = $password . $salt;

            // Verifique se a senha é correta usando password_verify
            if (password_verify($passwordSalted, $hashedPassword)) {
                $response["success"] = true;
                $response["message"] = "Login bem-sucedido!";
            } else {
                $response["success"] = false;
                $response["message"] = "Senha incorreta.";
            }
        } else {
            $response["success"] = false;
            $response["message"] = "Nome de usuário não encontrado.";
        }
    } else {
        $response["success"] = false;
        $response["message"] = "Erro na consulta: " . $stmt->error;
    }

    echo json_encode($response);
    exit;
}
?>

