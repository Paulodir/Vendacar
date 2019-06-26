<div Class="card-header text-center"  style="background-color: #e3f2fd">
    <h4 class="font-weight-bold"><i class="fas fa-user"></i> Login de Usuário</h4>
</div>
<div Class="card-body">

    <?php
    ($this->session->userdata('logado'))?$log=1:$log=2;
    $mensagem = $this->session->flashdata('retorno');
    echo (isset($mensagem) ? $mensagem : '');
    ?>
    <?= validation_errors(); ?>
    <form action="" method="POST" name="login">
        <div class="form-group">
            <label for="email">E-Mail:</label>
            <input value="<?= (isset($usuario)) ? $usuario->email : set_value('email'); ?>" type="tex" class="form-control" name="email" id="email" placeholder="<?= ($log===1) ? 'Cadastre um' : 'Digite seu '; ?> E-Mail">
        </div>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" class="form-control" name="senha" id="senha" placeholder="<?= ($log===1) ? 'Cadastre um' : 'Digite su'; ?>a Senha">
        </div>
        <div class="container text-center">
            <?php if ($log===1): ?>
                <button class="btn btn-outline-success" type="submit"><i class="fas fa-check"></i>Cadastrar</button>
                <a href="<?= base_url('Veiculo/Listar') ?>" class="btn btn-outline-warning"><i class="fas fa-undo"></i> Voltar</a>
                <div class="align-center mt-2">
                    <a class="btn btn-outline-danger" href="<?= base_url('Usuario/deslogar'); ?>"><i class="fas fa-sign-out-alt"></i> Deslogar</a>
                </div>
            <?php else:?> 
                <button class="btn btn-outline-success" type="submit"><i class="fas fa-check"></i> Acessar</button>
                <a href="<?= base_url('Usuario/Redefinir') ?>" class="btn btn-outline-warning"><i class="fas fa-random"></i> Mudar Minha Senha</a>
            <?php endif ?> 
        </div> <p class="mt-3 mb-3 text-muted text-center">&copy; 2017-2019</p>
    </form>

    <!--Sistema de múltiplo upload:
    https://blueimp.github.io/jQuery-File-Upload/
    
    Integração codeigniter:
    https://github.com/blueimp/jQuery-File-Upload/wiki/Latest-jQuery-File-Upload-easy-integration-with-codeigniter
    
    No método index é feito o do_upload() e salvo no banco de dados se necessário:
    
     if (!defined('BASEPATH')) exit('No direct  access allowed');
    
    class Fileupload extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
        }
    
        function index()
        {
            error_reporting(E_ALL | E_STRICT);
            $this->load->library("UploadHandler");
    
    ///DO_UPLOAD();<--------------------------------------------------------------------------
    //DB_SAVE<--------------------------------------------------------------------------
        }
    }-->
