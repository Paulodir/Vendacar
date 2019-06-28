<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $this->config->base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= (isset($acessorio)) === true ? 'Alteração' : 'Cadastro' ?> de Acessórios</li>
        </ol>
    </nav>
    <?= ($this->session->flashdata('retorno')) ? $this->session->flashdata('retorno') : ''; ?>
    <?= validation_errors(); //var_dump($acessorio)?>
    <div class="row"><div class="col-offset-md-4"></div>
        <div class="col-md-5 col-xs-12">
            <form action="" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="id" value="">
                <div class="form-group">
                    <label for="Acessorio">Acessório</label>
                    <input class="form-control" type="text" name="Acessorio" id="Acessorio" value="<?= (isset($acessorio)) ? $acessorio->descricaoAcessorio : set_value('Acessorio'); ?>">
                </div>
                <div class="form-group">
                    <label for="Tipo">Acessório do Tipo</label>
                    <select class="form-control" id="Tipo" name="Tipo">
                        <option>Tipo do Acessório</option>;
                        <option <?= (isset($acessorio)) && (($acessorio->tipoAcessorio) == 1) ? ' selected ' : ''; ?>value="1">Item de Série</option>
                        <option <?= (isset($acessorio)) && (($acessorio->tipoAcessorio) == 2) ? ' selected ' : ''; ?>value="2">Item Opcional</option>
                    </select>
                </div>
                <div class="form-group">                
                    <label for="Valor">Valor</label>
                    <div class="input-group mb-3">                    
                        <div class="input-group-prepend">
                            <span class="input-group-text">R$</span>
                        </div>
                        <input type="text" id="Valor" name="Valor" class="form-control" value="<?= (isset($acessorio)) === true ? $acessorio->valorAcessorio : set_value('Valor') ?>">
                    </div>
                </div>
                <div class="text-center mb-5">
                    <button class="btn btn-success" type="submit"><i class="fas fa-check"></i><?= (isset($acessorio)) === true ? ' Alterar' : ' Salvar' ?></button>
                    <a class="btn btn-warning" href="<?= base_url('Acessorio/listar'); ?>"><i class="fas fa-undo"></i> Cancelar</a> 
                </div>
            </form>
        </div>
    </div>
</div>
