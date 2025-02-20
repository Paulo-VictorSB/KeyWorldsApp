<?php

use DATABASE\Database;

$erro = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST'){   

    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';

    $params = [
        ':nome' => $nome,
        ':email' => $email
    ];

    $database = new Database(MYSQL_CONFIG);

    $verificarConta = $database->execute_query("
        SELECT *
        FROM usuarios
        WHERE nome = :nome AND email = :email
    ", $params);

    $verificarConta->results[0];

    if($verificarConta->affected_rows != 0){
        session_start();
        $_SESSION['forgot_password'] = true;
        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;
        header("Location: ?route=recovery_password");
    } else {
        $erro[] = "Email e usuarios não conferem.";
    }
}