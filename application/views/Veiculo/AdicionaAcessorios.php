<script src="<?= base_url('Incluir/AjaxJquery.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('Incluir/Jquery.Mask.js') ?>" type="text/javascript"></script>
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $this->config->base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= (isset($veiculo)) === true ? 'Cadastro' : 'Alteração' ?> de Acessórios do Veículo</li>
        </ol>
    </nav>
    <?= ($this->session->flashdata('retorno')) ? $this->session->flashdata('retorno') : ''; ?>
    <?= validation_errors(); //var_dump($veiculoacessorio)?>
    <div class="row">
        <div class="col-md-5 col-xs-12">
            <form name="adiciona" action="" method="POST">
                <input type="hidden" name="id" value="">
                <div class="form-group">
                    <label for="Veiculo">Veículo</label>
                    <select class="form-control" id="Veiculo" disabled name="Veiculo">
                        <?php
                        if (count($veiculos) > 0) {
                            echo '<option value="">Selecione um Veículo</option>';
                            foreach ($veiculos as $v) {
                                (isset($veiculo)) === true ? $use = $veiculo->id : $use = $veiculoacessorio->veiculo_id;
                                echo '<option ' . (($v->id == $use) ? 'selected' : '') . ' value="' . $v->id . '">' . $v->nomeVeiculo . '</option>';
                            }
                        } else {
                            echo '<option value="">Nenhum Veículo Cadastrado.</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Acessorio">Acessório</label>
                    <select class="form-control" id="Acessorio" name="Acessorio">
                        <?php
                        if (count($acessorios) > 0) {
                            echo '<option value="">Selecione um Acessório</option>';
                            foreach ($acessorios as $a) {
                                echo '<option ' . (($a->id == $veiculoacessorio->acessorio_id) ? 'selected' : '') . ' value="' . $a->id . '">' . $a->descricaoAcessorio . '</option>';
                            }
                        } else {
                            echo '<option value="">Nenhum Acessório Cadastrado.</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="text-center mb-5">
                    <button class="btn btn-success" type="submit"><i class="fas fa-check"></i> <?=(isset($veiculo)) === true ? 'Adicionar' : 'Alterar' ?></button>
                    <a class="btn btn-warning" href="<?= base_url('Veiculo/listar'); ?>"><i class="fas fa-undo"></i> Cancelar</a> 
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(document).on('submit', 'form[name=adiciona]', function () {
            $('#Veiculo').removeAttr('disabled');
        });
    });
</script>

