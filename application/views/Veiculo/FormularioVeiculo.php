<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $this->config->base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= (isset($veiculo)) === true ? 'Alteração' : 'Cadastro' ?> de Veículos</li>
        </ol>
    </nav>
    <?= ($this->session->flashdata('retorno')) ? $this->session->flashdata('retorno') : ''; ?>
    <?= validation_errors(); //var_dump($veiculo)?>
    <div class="row">
        <div class="col-md-5 col-xs-12">
            <form action="" method="POST">
                <input type="hidden" name="id" value="">
                <div class="form-group">
                    <label for="Montadora">Montadora</label>
                    <select class="form-control" id="Montadora" name="Montadora">
                        <?php
                        if (count($montadoras) > 0) {
                            echo '<option value="">Selecione uma Montadora</option>';
                            foreach ($montadoras as $mont) {
                                echo '<option ' . (($mont->id == $veiculo->montadora_id) ? 'selected' : '') . ' value="' . $mont->id . '">' . $mont->nomeMontadora . '</option>' . PHP_EOL;
                            }
                        } else {
                            echo '<option value="">Nenhuma Montadora Cadastrada</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Modelo">Modelo</label>
                    <select class="form-control" id="Modelo" name="Modelo" <?= (isset($veiculo)) === false ? 'disabled' : '' ?>>
                        <?php
                        if ((isset($veiculo)) === true) {
                            if (count($modelos) > 0) {
                                echo '<option value="">Selecione uma Montadora Acima</option>';
                                foreach ($modelos as $mod) {
                                    echo '<option ' . (($mod->id == $veiculo->modelo_id) ? 'selected' : '') . ' value="' . $mod->id . '">' . $mod->nomeModelo . '</option>' . PHP_EOL;
                                }
                            } else {
                                echo '<option value="">Nenhum Modelo Cadastrado</option>';
                            }
                        } else {
                            echo '<option value="">Selecione uma Montadora Acima</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Ano">Ano</label> 
                    <input type="text" class="form-control" name="Ano" id="Ano" value="<?= (isset($veiculo)) === true ? $veiculo->ano : set_value('Ano') ?>">
                </div>
                <div class="form-group">
                    <label for="Cor">Cor</label> 
                    <input type="text" class="form-control" name="Cor" id="Cor" value="<?= (isset($veiculo)) === true ? $veiculo->cor : set_value('Cor') ?>">
                </div>
                <div class="form-group">
                    <label for="Placa">Placa</label> 
                    <input type="text" class="form-control" name="Placa" id="Placa" value="<?= (isset($veiculo)) === true ? $veiculo->placa : set_value('Placa') ?>">
                </div>
                <div class="form-group">
                    <label for="Renavam">Renavam</label> 
                    <input type="text" class="form-control" name="Renavam" id="Renavam" value="<?= (isset($veiculo)) === true ? $veiculo->renavam : set_value('Renavam') ?>">
                </div>
            <!--<div class="form-group">
                    <label for="Serie">Numero de Série</label> 
                    <input type="text" class="form-control" name="Serie" id="Serie" value="<? (isset($veiculo)) === true ? $veiculo->renavam : set_value('Serie') ?>">
                </div>-->
                <div class="form-group">
                    <label for="Valor">Valor</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">R$</span>
                        </div>
                        <input type="text" id="Valor" name="Valor" class="form-control" value="<?= (isset($veiculo)) === true ? $veiculo->valorVeiculo : set_value('Valor') ?>">
                    </div>
                </div>

                <div class="text-center mb-5">
                    <button class="btn btn-success" type="submit"><i class="fas fa-check"></i><?= (isset($veiculo)) === true ? ' Alterar' : ' Salvar' ?></button>
                    <a class="btn btn-warning" href="<?= base_url('Veiculo/listar'); ?>"><i class="fas fa-undo"></i> Cancelar</a> 
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?= base_url('Incluir/AjaxJquery.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('Incluir/Jquery.Mask.js') ?>" type="text/javascript"></script>
<script type="text/javascript">
    $("#Renavam").mask("00000000000");
    $("#Placa").mask("AAA-0000");
    $(document).ready(function () {
        var base_url = "<?= base_url() ?>"
        $(document).on('change', '#Montadora', function () {
            $('#Modelo').attr('disabled', 'disabled');
            $('#Modelo').html('<option>Carregando...</option>');
            var montadora_id = $('#Montadora').val();
            $.post(base_url + 'Veiculo/getModelosAjax', {
                montadora_id: montadora_id
            }, function (data) {
                $('#Modelo').replaceWith('<select class="form-control" id="Modelo" name="Modelo"></select>');
                $('#Modelo').html(data);
                $('#Modelo_chosen').remove();
                $("#Modelo").chosen({no_results_text: "Nenhum registro compatível com "});
            });
        });
    });
</script>

