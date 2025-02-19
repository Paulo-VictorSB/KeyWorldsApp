<?php

use DATABASE\Database;

$erro = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nome  = $_POST['user'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['password'] ?? '';
    $termos = $_POST['termos'] ?? '';

    if(empty($termos)){
        $erro[] = "Para usar nosso aplicativo, você precisa assinar os termos de serviço.";
    }

    $regexNome = '/^.{5,}$/';
    $regexEmail = '/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/';

    if (!preg_match($regexNome, $nome)) {
        $erro[] = "O nome deve ter pelo menos 5 caracteres.<br>";
    }
    
    if (!preg_match($regexEmail, $email)) {
        $erro[] = "O email não é válido.<br>";
    }
    
    if (empty($senha)) {
        $erro[] = "A senha não pode estar vazia!";
    } else {
        $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
    }

    $paramsEmail = [':email' => $email];
    $paramsNome = [':nome' => $nome];

    $params = [
        ':nome' => $nome,
        ':email' => $email,
        ':senha' => $senhaHash
    ];

    $database = new Database(MYSQL_CONFIG);

    $validarEmail = $database->execute_query(
        "SELECT *
        FROM usuarios 
        WHERE email = :email"
        , $paramsEmail
    );

    $paramsNome = $database->execute_query(
        "SELECT *
        FROM usuarios 
        WHERE nome = :nome"
        , $paramsNome
    );

    if($validarEmail->affected_rows > 0 || $validarNome->affected_rows > 0){
        $erro[] = "Email ou Usuário já cadastrado";
    } else {

        $registrarUsuario = $database->execute_non_query(
        "INSERT INTO usuarios (id, nome, email, senha) 
         VALUES (0, :nome, :email, :senha)", 
         $params
        );

        if($registrarUsuario->affected_rows != 0){
            header("Location: ?route=index");
        }
    }
}