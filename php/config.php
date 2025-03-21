<?php
// Configurações de exibição de erros
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Configurações do banco de dados
$host = 'localhost'; // Nome do host
$port = '3306'; // Porta do banco de dados (opcional)
$dbname = 'projeto'; // Nome do banco de dados
$username = 'root'; // Nome de usuário do banco de dados
$password = 'Sistema.1983'; // Senha do usuário do banco de dados

// Construir a string de conexão DSN
$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

// Conexão com o banco de dados usando PDO
try {
    $pdo = new PDO($dsn, $username, $password);
    // Definir o modo de erro do PDO para Exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Verificar se o primeiro usuário já existe
    //$stmt = $pdo->prepare('SELECT COUNT(*) FROM Users');
    //$stmt->execute();
    //$count = $stmt->fetchColumn();

    //if ($count === '0') {
        //Dados do primeiro usuário
    //    $username = 'foresp';
    //    $password = password_hash('foresp', PASSWORD_DEFAULT);
    //    $role = 'admin';

        // Inserir primeiro usuário na tabela
    //    $stmt = $pdo->prepare('INSERT INTO Users (username, password, role) VALUES (?, ?, ?)');
    //    $stmt->execute([$username, $password, $role]);

    //    echo 'Primeiro usuário criado com sucesso!';
    //} else {
    //    echo 'Já existem usuários na tabela. Não é possível criar o primeiro usuário.';
    //}
    //echo 'Conexão com o banco de dados estabelecida com sucesso!';
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
?>
