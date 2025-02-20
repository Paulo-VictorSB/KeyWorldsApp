<?php

use DATABASE\Database;

$erro = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = $_POST['user'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['password'] ?? '';
    $termos = $_POST['termos'] ?? '';

    if (empty($termos)) {
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

    // Interrompe o código se houver erros
    if (!empty($erro)) {
        foreach ($erro as $msg) {
            echo "<p>$msg</p>";
        }
        exit();
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
        "SELECT id FROM usuarios WHERE email = :email",
        $paramsEmail
    );

    $validarNome = $database->execute_query(
        "SELECT id FROM usuarios WHERE nome = :nome",
        $paramsNome
    );

    if ($validarEmail->affected_rows > 0 || $validarNome->affected_rows > 0) {
        $erro[] = "Email ou Usuário já cadastrado";
    } else {
        // Insere o usuário
        $registrarUsuario = $database->execute_non_query(
            "INSERT INTO usuarios (id, nome, email, senha) 
             VALUES (0, :nome, :email, :senha)", 
             $params
        );

        // Obtém o ID do usuário recém-criado
        $getId = $database->execute_query(
            "SELECT id FROM usuarios WHERE email = :email",
            $paramsEmail
        );

        if ($getId->affected_rows > 0) {
            $ponto = [':id_usuario' => $getId->results[0]['id']];

            $registrarPontos = $database->execute_non_query(
                "INSERT INTO jogo (id, ponto, id_usuario)
                 VALUES (0, 0, :id_usuario)",
                 $ponto
            );

            if ($registrarUsuario->affected_rows > 0 && $registrarPontos->affected_rows > 0) {
                header("Location: ?route=index");
                exit();
            }
        }
    }
}
