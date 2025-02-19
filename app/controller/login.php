<?php

use DATABASE\Database;

$erro = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST'){   

    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $paramEmail = [
        ':email' => $email,
    ];

    $database = new Database(MYSQL_CONFIG);

    $verificarLogin = $database->execute_query(
        "SELECT *
         FROM usuarios
         WHERE email = :email"
        , $paramEmail
    );

    if (!empty($verificarLogin->results) && isset($verificarLogin->results[0]['senha'])) {
        if (password_verify($senha, $verificarLogin->results[0]['senha'])) {
            session_start();
            $_SESSION['isLogged'] = true;
            $_SESSION['id'] = $verificarLogin->results[0]['id'];
            $_SESSION['nome'] = $verificarLogin->results[0]['nome'];
            $_SESSION['email'] = $verificarLogin->results[0]['email'];
            header("Location: ?route=home");
            exit();
        } else {
            $erro[] = 'Email ou senha inválidos.';
        }
    } else {
        $erro[] = 'Email ou senha inválidos.';
    }
}