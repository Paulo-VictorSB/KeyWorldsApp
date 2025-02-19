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

<header>
    <div class="container py-3 mb-4">
        <div class="row align-items-center">
            <div class="col-lg-5 col-md-6 col-6">
                <h3 class="text-warning">&lt;/Key Worlds></h3>
            </div>
            <!-- Ícone do menu hamburguer para mobile -->
            <div class="col-lg-6 col-md-6 col-6 text-end d-lg-none">
                <span class="menu-toggle">&#9776;</span>
            </div>
            <!-- Links normais para telas grandes -->
            <div class="col-lg-7 d-none d-lg-block text-end">
                <a href="#" class="text-warning text-decoration-none h6 mx-3"><i class="fa-solid fa-trophy"></i> Ranking</a>
                <a href="#" class="text-warning text-decoration-none h6 mx-3"><i class="fa-solid fa-house"></i> Início</a>
                <a href="#" class="text-warning text-decoration-none h6 mx-3"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar Perfil</a>
                <a href="#" class="text-warning text-decoration-none h6 mx-3"><i class="fa-solid fa-user"></i> Meu Perfil</a>
                <a href="app/controller/logout.php" class="text-warning text-decoration-none h6 mx-3"><i class="fa-solid fa-door-open"></i> Sair</a>
            </div>
        </div>
    </div>
</header>

<!-- Menu lateral -->
<div class="menu-overlay">
    <span class="close-menu">&times;</span>
    <div class="menu-content">
        <a href="#" class="text-warning my-3"><i class="fa-solid fa-trophy"></i> Ranking</a>
        <a href="#" class="text-warning my-3"><i class="fa-solid fa-house"></i> Início</a>
        <a href="#" class="text-warning my-3"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar Perfil</a>
        <a href="#" class="text-warning my-3"><i class="fa-solid fa-user"></i> Meu Perfil</a>
        <a href="app/controller/logout.php" class="text-warning my-3"><i class="fa-solid fa-door-open"></i> Sair</a>
    </div>
</div>

<main class="mt-5">
    <div class="container border-warning text-white text-center py-5">
        <div class="row justify-content-center align-items-center">
            <div class="col text-center ft">
                <h1>Ola! <?=$_SESSION['nome']?>, Está pronto(a)?</h1>
                <button class="btn bg-warning"><i class="fa-solid fa-play"></i> Começar</button>
            </div>
        </div>
    </div>
</main>
