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

<main class="mt-3 py-5 justify-content-center d-flex">
    <div class="px-5 text-center border rounded py-5 borda_animada">
        <h3 class="mb-4">Ranking</h3>
        
        <div class="table-responsive">
            <table class="table table-striped table-dark table-bordered">
                <thead>
                    <tr>
                        <th class="text-warning">id</th>
                        <th class="text-warning">Usuário</th>
                        <th class="text-warning">Pontos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($getMelhores->results as $melhores): ?>
                        <tr>
                            <td class="text-warning"><?=$melhores['id']?></td>
                            <td class="text-warning"><?=$melhores['nome']?></td>
                            <td class="text-warning"><?=$melhores['ponto']?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
