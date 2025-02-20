<?php require_once('app/controller/recovery_password.php')?>

<div class="container center-container">
        <div class="row">
            <div class="col-md-8 col-lg-10 offset-md-2 offset-lg-1">
                <div class="login-form">
                    <h2 class="text-center mb-4">Esqueceu a senha?</h2>
                    <hr>
                    <p>Confirme seus dados para comprovar que a conta é realmente sua. </p>
                    <form method="POST">
                        <div class="form-group my-2">
                            <label for="password"><i class="fas fa-lock"></i> Senha</label>
                            <input type="password" class="form-control" id="password" placeholder="Digite sua senha" name="senha" required>
                        </div>
                        <div class="form-group my-2">
                            <label for="password"><i class="fas fa-lock"></i> Confirmar senha</label>
                            <input type="password" class="form-control" id="password" placeholder="Confirme a nova senha" name="confirmar_senha" required>
                        </div>

                        <?php if(!empty($erro)): ?>
                            <?php foreach($erro as $err): ?>
                                <p><?=$err?></p>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <button type="submit" class="btn w-100 my-2 btn-warning btn-block">Confirmar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>