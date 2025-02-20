<?php require_once('app/controller/register.php');?>

<div class="container center-container">
        <div class="row">
            <div class="col-md-10 col-lg-12 offset-md-2 offset-lg-0">
                <div class="login-form">
                    <h2 class="text-center mb-4">Registrar</h2>
                    <hr>
                    <form method="POST">
                        <div class="form-group my-2">
                            <label for="user"><i class="fas fa-user"></i> Usuário</label>
                            <input type="text" class="form-control" id="user" placeholder="Digite seu Usuário" name="user" minlength="5" required>
                        </div>
                        <div class="form-group my-2">
                            <label for="email"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Digite seu email" name="email" required>
                        </div>
                        <div class="form-group my-2">
                            <label for="password"><i class="fas fa-lock"></i> Senha</label>
                            <input type="password" class="form-control" id="password" placeholder="Digite sua senha" name="password" required minlength="6">
                        </div>
                        <a href="?route=login" class="text-decoration-none text-white">Já tem uma conta? Logar agora.</a>

                        <?php if(!empty($erro)): ?>
                            <?php foreach($erro as $err): ?>
                                <p><?=$err?></p>
                            <?php endforeach; ?>
                        <?php endif; ?>                            
                        <div class="form-group my-2 d-flex align-items-center">
                            <input type="checkbox" id="termos" name="termos" class="me-2" required>
                            <label for="termos" class="mb-0"><span class="text-white">Aceite nossos</span> <a href="?route=termos" class="text-warning">termos</a></label>
                        </div>
                        <button type="submit" class="btn w-100 my-2 btn-warning btn-block">Registar</button>
                        <a href="?route=index" class="text-warning">Voltar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>