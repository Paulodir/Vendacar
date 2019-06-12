<script src="<?= base_url('Incluir/AjaxJquery.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('Incluir/Jquery.Mask.js') ?>" type="text/javascript"></script>
<script type="text/javascript">
    $("#Renavam").mask("00000000000");
        });
</script>
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $this->config->base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= (isset($setor)) === true ? 'Alteração' : 'Cadastro' ?> de Setores</li>
        </ol>
    </nav>
    <?= ($this->session->flashdata('retorno')) ? $this->session->flashdata('retorno') : ''; ?>
    <?= validation_errors(); //var_dump($setor)?>
    <div class="row">
        <div class="col-md-5 col-xs-12">
            <form action="" method="POST">
                <input type="hidden" name="id" value="">
                               <div class="form-group">
                    <label for="Setor">Setor</label> 
                    <input type="text" class="form-control" name="Setor" id="Setor" value="<?= (isset($setor)) === true ? $setor->nomeSetor : set_value('Setor') ?>">
                </div>                  
                <div class="text-center mb-5">
                    <button class="btn btn-success" type="submit"><i class="fas fa-check"></i><?= (isset($setor)) === true ? ' Alterar' : ' Salvar' ?></button>
                    <a class="btn btn-warning" href="<?= base_url('Setor/listar'); ?>"><i class="fas fa-undo"></i> Cancelar</a> 
                </div>
            </form>
        </div>
    </div>
</div>


