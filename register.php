<?php
include 'config.php'; // Inclua seu arquivo config.php para a conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm-password"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    // Verifique se o nome de usuário já existe no banco de dados
    $checkUserQuery = $mysqli->prepare("SELECT user_id FROM utilizador WHERE username = ?");
    $checkUserQuery->bind_param("s", $username);
    $checkUserQuery->execute();
    $checkUserQuery->store_result();

    if ($checkUserQuery->num_rows > 0) {
        $response["success"] = false;
        $response["message"] = "Nome de usuário já está em uso.";
    } else {
        // Verifique a política de senha forte
        if (strlen($password) < 8 ||
            !preg_match("/[a-z]/", $password) ||
            !preg_match("/[A-Z]/", $password) ||
            !preg_match("/\d/", $password) ||
            !preg_match("/[@$!%*?&]/", $password) ||
            $password !== $confirmPassword) {
            $response["success"] = false;
            $response["message"] = "A senha não atende aos requisitos.";
        } else {
            // Realize o registro do usuário, incluindo nome, email e telefone
            $stmt = $mysqli->prepare("INSERT INTO pessoas (nome, email, telefone) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $phone);

            if ($stmt->execute()) {
                // Obtenha o ID da pessoa recém-inserida
                $personId = $stmt->insert_id;

                // Agora, insira o usuário com a referência para a pessoa
                $stmt = $mysqli->prepare("INSERT INTO utilizador (username, password, pessoa) VALUES (?, ?, ?)");
                $stmt->bind_param("ssi", $username, $password, $personId);

                if ($stmt->execute()) {
                    $response["success"] = true;
                    $response["message"] = "Registro bem-sucedido!";
                } else {
                    $response["success"] = false;
                    $response["message"] = "Erro ao registrar o usuário.";
                }
            } else {
                $response["success"] = false;
                $response["message"] = "Erro ao registrar a pessoa.";
            }
        }
    }

    echo json_encode($response);
    exit;
}
?>




