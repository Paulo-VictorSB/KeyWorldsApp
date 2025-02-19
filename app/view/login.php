<?php require_once('app/controller/login.php');?>

<div class="container center-container">
        <div class="row">
            <div class="col-md-8 col-lg-12 offset-md-2 offset-lg-0">
                <div class="login-form">
                    <h2 class="text-center mb-4">Logar</h2>
                    <hr>
                    <form method="POST">
                        <div class="form-group my-2">
                            <label for="email"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Digite seu email" name="email" required>
                        </div>
                        <div class="form-group my-2">
                            <label for="password"><i class="fas fa-lock"></i> Senha</label>
                            <input type="password" class="form-control" id="password" placeholder="Digite sua senha" name="senha" required>
                        </div>

                        <?php if(!empty($erro)): ?>
                            <?php foreach($erro as $err): ?>
                                <p><?=$err?></p>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        
                        <a href="?route=register" class="text-decoration-none text-white">Não tem uma conta? Registre-se agora.</a>
                        <br>
                        <a href="?route=forgot_password" class="text text-white">Esqueceu a senha?</a>
                        <button type="submit" class="btn w-100 my-2 btn-warning btn-block">Entrar</button>
                        <a href="?route=index" class="text-warning">Voltar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>