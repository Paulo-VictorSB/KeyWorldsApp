<?php

require_once('app/view/inc/nav_home.php');

session_start(); 

use DATABASE\Database;
$database = new Database(MYSQL_CONFIG);
$params = [
    ':id' => $_SESSION['id']
];

$getPontos = $database->execute_query("
    SELECT jogo.ponto
    FROM jogo
    LEFT JOIN usuarios ON jogo.id_usuario = usuarios.id
    WHERE usuarios.id = :id
", $params);

?>

<main class="justify-content-center d-flex">
    <div class="border-warning text-center border rounded borda_animada p-5 h-50">
        <div class="form-group my-2">
            <label for="user"><i class="fas fa-user"></i> Usuário : <?=$_SESSION['nome']?></label>
        </div>
        <div class="form-group my-2">
            <label for="email"><i class="fas fa-envelope"></i> Email: <?=$_SESSION['email']?></label>
        </div>
        <div class="form-group my-2">
            <label for="password"><i class="fas fa-lock"></i> Pontos: <?=$getPontos->results[0]['ponto']?></label>
        </div>
    </div>
</main>