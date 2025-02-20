<?php

session_start();

use DATABASE\Database;

$erro = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $senha = $_POST['senha'] ?? '';
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';

    if($senha == $confirmar_senha){
        $senhaHash = password_hash($senha,  PASSWORD_BCRYPT);
    }

    $params = [
        ':nome' => $_SESSION['nome'],
        ':email' => $_SESSION['email'],
        ':senha' => $senhaHash
    ];

    $database = new Database(MYSQL_CONFIG);

    $atualizar_senha = $database->execute_non_query("
        UPDATE usuarios
        SET senha = :senha
        WHERE nome = :nome AND email = :email
    ", $params);

    if($atualizar_senha->affected_rows != 0){
        header("Location: app/controller/logout.php");
    }

}