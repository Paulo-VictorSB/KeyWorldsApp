<?php

require_once('app/view/inc/nav_home.php');

use DATABASE\Database;
$database = new Database(MYSQL_CONFIG);

$getMelhores = $database->execute_query("
    SELECT usuarios.id, usuarios.nome, jogo.ponto
    FROM usuarios
    LEFT JOIN jogo ON usuarios.id = jogo.id_usuario
    ORDER BY jogo.ponto DESC
    LIMIT 3
");

?>

<main class="justify-content-center d-flex">
    <div class="px-5 text-center border rounded py-5 borda_animada">
        <h3 class="mb-4">Ranking</h3>
        
        <div class="table-responsive">
            <table class="table table-striped table-dark table-bordered text-start">
                <thead>
                    <tr>
                        <th class="text-warning">Posição</th>
                        <th class="text-warning">Usuário</th>
                        <th class="text-warning">Pontos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $posicao = 1; // Contador para definir a posição no ranking
                    foreach ($getMelhores->results as $melhores): 
                        // Definir a quantidade de troféus com base na posição
                        $trofeus = '';
                        if ($posicao == 1) {
                            $trofeus = '<i class="fa-solid fa-trophy text-warning"></i> <i class="fa-solid fa-trophy text-warning"></i> <i class="fa-solid fa-trophy text-warning"></i>';
                        } elseif ($posicao == 2) {
                            $trofeus = '<i class="fa-solid fa-trophy text-warning"></i> <i class="fa-solid fa-trophy text-warning"></i>';
                        } elseif ($posicao == 3) {
                            $trofeus = '<i class="fa-solid fa-trophy text-warning"></i>';
                        }
                    ?>
                        <tr>
                            <td class="text-warning"><?= $posicao ?> <?= $trofeus ?></td>
                            <td class="text-warning"><?= $melhores['nome'] ?></td>
                            <td class="text-warning"><?= $melhores['ponto'] ?></td>
                        </tr>
                    <?php 
                        $posicao++; // Incrementar posição para a próxima iteração
                    endforeach; 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

