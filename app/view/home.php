<?php
session_start();

$isLogged = $_SESSION['isLogged'] ?? false;
$deslogar = $_GET['deslogar'] ?? '';

if ($isLogged == false) {
    echo 'O Usuário precisa estar logado para acessar essa área.<br>';
    echo '<a href="index.php">Página inicial.</a>';
    exit();
}

?>

<?php require_once('app/view/inc/nav_home.php');?>

<main class="mt-5">
    <div class="container border-warning text-white text-center py-5">
        <div class="row justify-content-center align-items-center">
            <div class="col text-center ft">
                <h1>Ola! <?=$_SESSION['nome']?>, Está pronto(a)?</h1>
                <a href="?route=play" class="btn bg-warning"><i class="fa-solid fa-play"></i> Começar</a>
            </div>
        </div>
    </div>
</main>
