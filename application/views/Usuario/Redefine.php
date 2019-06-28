<div Class="card-header text-center"  style="background-color: #e3f2fd">
    <h4 class="font-weight-bold"><i class="fas fa-user"></i> Redefiniçao de Senha</h4>
</div>   
<div Class="card-body">
    <?php
    $mensagem = $this->session->flashdata('retorno');
    echo (isset($mensagem) ? $mensagem : '');
    ?>
    <?= validation_errors(); ?>
    <form action="" method="POST" name="login">
        <div class="form-group">
            <label for="email">E-Mail:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
                </div>
                <input type="tex" class="form-control" name="email" id="email" placeholder="Digite seu e-mail"> 
            </div>
        </div>
        <div class="form-group">
            <label for="senha">Senha Atual:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-unlock-alt"></i></span>
                </div>
                <input type="password" class="form-control" name="senha" id="senha" placeholder="Digite a Senha Atual">
            </div>
        </div>
        <div class="form-group">
            <label for="nova">Nova Senha:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                </div>
                <input type="password" class="form-control" name="nova" id="nova" placeholder="Digite Sua Nova Senha">
            </div>
        </div>
        <div class="container text-center">                            
            <button class="btn btn-outline-success" type="submit"><i class="fas fa-check"></i> Alterar</button>
            <a href="<?= base_url('Usuario/Listar') ?>" class="btn btn-outline-warning"><i class="fas fa-undo"></i> Cancelar</a>                            
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
