<div Class="card-header text-center"  style="background-color: #e3f2fd">
    <h4 class="font-weight-bold"><i class="fas fa-user"></i> Login de Usuário</h4>
</div>
<div Class="card-body">

    <?php
    ($this->session->userdata('logado')) ? $log = 1 : $log = 2;
    $mensagem = $this->session->flashdata('retorno');
    echo (isset($mensagem) ? $mensagem : '');
    ?>
<?= validation_errors(); ?>
    <form action="" method="POST" name="login">
        <div class="form-group">
            <label for="email">E-Mail:</label>
            <input value="<?= (isset($usuario)) ? $usuario->email : ''; ?>" type="tex" class="form-control" name="email" id="email" placeholder="<?= ($log === 1) ? 'Cadastre um' : 'Digite seu '; ?> E-Mail">
        </div>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" class="form-control" name="senha" id="senha" placeholder="<?= ($log === 1) ? 'Cadastre uma' : 'Digite su'; ?> Senha">
        </div>
        <div class="container text-center">
<?php if ($log === 1): ?>
                <button class="btn btn-outline-success" type="submit"><i class="fas fa-check"></i> <?= (isset($usuario)) ? 'Alterar ' : 'Cadastrar'; ?></button>
                <a href="<?= base_url('Usuario/Listar') ?>" class="btn btn-outline-warning"><i class="fas fa-undo"></i> Voltar</a>
                <div class="align-center mt-2">
                    <a class="btn btn-outline-danger" href="<?= base_url('Usuario/deslogar'); ?>"><i class="fas fa-sign-out-alt"></i> Deslogar</a>
                </div>
<?php else: ?> 
                <button class="btn btn-outline-success" type="submit"><i class="fas fa-check"></i> Acessar</button>
                <a href="<?= base_url('Usuario/Redefinir') ?>" class="btn btn-outline-warning"><i class="fas fa-random"></i> Mudar Minha Senha</a>
<?php endif ?> 
        </div> <p class="mt-3 mb-3 text-muted text-center">&copy; 2017-2019</p>
    </form>
