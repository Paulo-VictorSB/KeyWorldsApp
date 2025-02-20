<?php

session_start(); // Inicia a sessão

use DATABASE\Database;
$database = new Database(MYSQL_CONFIG);
$erro = "";

// Gera um texto único aleatório
function gerarTextoUnico($tamanho = 10) {
    $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$&';
    $caracteresArray = str_split($caracteres);
    shuffle($caracteresArray);
    return implode('', array_slice($caracteresArray, 0, $tamanho));
}

// Inicializa a variável de sessão se não existir
if (!isset($_SESSION['textoUnico'])) {
    $_SESSION['textoUnico'] = gerarTextoUnico();
}

$textoUnico = $_SESSION['textoUnico'];
$pontoAtual = 0;

// Verifica se o ID do usuário está na sessão
if (isset($_SESSION['id'])) {
    $params = [':id' => $_SESSION['id']];
    $result = $database->execute_query("SELECT ponto FROM jogo WHERE id_usuario = :id", $params);

    // Se houver um resultado, atribui o valor da pontuação atual
    if (!empty($result->results)) {
        $pontoAtual = $result->results[0]['ponto'];
    }

    // Se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $resposta = $_POST['respostaInput'] ?? '';
        $textoUnico = $_SESSION['textoUnico'] ?? gerarTextoUnico();

        if ($resposta === $textoUnico) {
            $novoPonto = $pontoAtual + 1;

            $params = [
                ':id' => $_SESSION['id'],
                ':ponto' => $novoPonto
            ];

            // Atualiza a pontuação no banco de dados
            $adicionarPontos = $database->execute_non_query("
                UPDATE jogo
                SET ponto = :ponto
                WHERE id_usuario = :id
            ", $params);

            // Atualiza a sessão com um novo texto único
            $_SESSION['textoUnico'] = gerarTextoUnico();

            // Obtém o novo valor atualizado do banco
            $result = $database->execute_query("SELECT ponto FROM jogo WHERE id_usuario = :id", [':id' => $_SESSION['id']]);
            if (!empty($result->results)) {
                $pontoAtual = $result->results[0]['ponto'];
            }
        } else {
            $erro = "Resposta incorreta. Tente novamente!";
        }
    }
}

?>

<main class="mt-5 py-5">
    <div class="container border-warning text-white text-center border rounded py-5 borda_animada" style="min-height: 50vh;">
        <div class="row mt-5 mb-3">
            <div class="col">
                <h1 class="text-warning text-break" id="textoProtegido"><?=$_SESSION['textoUnico']?></h1>
            </div>
        </div>
        <div class="row my-3">
            <div class="col">
                <form method="POST" class="d-flex flex-column flex-md-row gap-2 justify-content-center align-items-center">
                    <input type="text" name="respostaInput" id="respostaInput" 
                        class="form-control shadow text-center" 
                        style="max-width: 300px; width: 100%;">
                    <input type="submit" value="Enviar" class="btn bg-warning shadow">
                </form>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                <? if(!empty($erro)): ?>
                    <p class="text-warning"><?=$erro?></p>
                <? endif; ?>
                <h3>Placar Total</h3>
            </div>
        </div>
        <div class="row justify-content-center my-3">
            <div class="col-auto">
                <h3 class="text-warning border-warning border rounded p-3 borda_animada"><?=$pontoAtual?></h3>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-auto">
                <a href="?route=home" class="text-warning text-decoration-none fs-5">Voltar</a>
            </div>
        </div>
    </div>
</main>

<script>
        $(document).ready(function () {
            var texto = $("#textoProtegido");

            // Impede a seleção de texto
            texto.on("selectstart", function (event) {
                event.preventDefault();
            });

            // Impede copiar usando Ctrl+C
            $(document).on("keydown", function (event) {
                if (event.ctrlKey && (event.key === "c" || event.key === "C")) {
                    event.preventDefault();
                    alert("Copiar este conteúdo não é permitido!");
                }
            });

            // Impede copiar com o botão direito
            texto.on("contextmenu", function (event) {
                event.preventDefault();
                alert("O menu de contexto foi desativado!");
            });

            // Impede copiar diretamente
            texto.on("copy", function (event) {
                event.preventDefault();
                alert("Copiar este conteúdo não é permitido!");
            });
        });
    </script>