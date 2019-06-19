<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $this->config->base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= (isset($formapagamento)) === true ? 'Alteração' : 'Cadastro' ?> Formas de Pagamento</li>
        </ol>
    </nav>
    <?= ($this->session->flashdata('retorno')) ? $this->session->flashdata('retorno') : ''; ?>
    <?= validation_errors(); //var_dump($acessorio)?>
    <div class="row"><div class="col-offset-md-4"></div>
        <div class="col-md-5 col-xs-12">
            <form action="" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="id" value="">
                <div class="form-group">
                    <label for="Pagamento">Formas de Pagamento</label>
                    <input class="form-control" type="text" name="Pagamento" id="Pagamento" value="<?= (isset($formapagamento)) ? $formapagamento->descricaoPagamento : set_value('Pagamento'); ?>">
                </div>
                <div class="text-center mb-5">
                    <button class="btn btn-success" type="submit"><i class="fas fa-check"></i><?= (isset($formapagamento)) === true ? ' Alterar' : ' Salvar' ?></button>
                    <a class="btn btn-warning" href="<?= base_url('Acessorio/listar'); ?>"><i class="fas fa-undo"></i> Cancelar</a> 
                </div>
            </form>
        </div>
    </div>
</div>
