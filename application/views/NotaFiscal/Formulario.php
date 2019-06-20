<script src="<?= base_url('Incluir/AjaxJquery.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('Incluir/Jquery.Mask.js') ?>" type="text/javascript"></script>
<script type="text/javascript">
    $("#Desconto").mask("00000000000");
    $(document).ready(function () {
        var base_url = "<?= base_url() ?>"
        $('#Montadora').change(function () {
            $('#Modelo').attr('disabled', 'disabled');
            $('#Modelo').html('<option>Carregando...</option>');
            var montadora_id = $('#Montadora').val();
            $.post(base_url + 'Veiculo/getModelosAjax', {
                montadora_id: montadora_id
            }, function (data) {
                $('#Modelo').html(data);
                $('#Modelo').removeAttr('disabled');
            });
        });
    });
</script>
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
                    <label for="Veiculo">Veículo</label>
                    <select class="form-control" id="Veiculo" name="Veiculo">
                        <?php
                        if (count($veiculos) > 0) {
                            echo '<option value="">Selecione um Veículo</option>';
                            foreach ($veiculos as $v) {
                                echo '<option ' . (($v->id == $veiculo->id) ? 'selected' : '') . ' value="' . $v->id . '">' . $v->nomeVeiculo . '</option>' . PHP_EOL;
                            }
                        } else {
                            echo '<option value="">Nenhum Veículo Cadastrado</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Cliente">Cliente</label>
                    <select class="form-control" id="Cliente" name="Cliente">
                        <?php
                        if (count($clientes) > 0) {
                            echo '<option value="">Selecione um Cliente</option>';
                            foreach ($clientes as $c) {
                                echo '<option ' . (($c->id == $cliente->id) ? 'selected' : '') . ' value="' . $c->id . '">' . $c->nomeCliente . '</option>' . PHP_EOL;
                            }
                        } else {
                            echo '<option value="">Nenhum Cliente Cadastrado</option>';
                        }
                        ?>
                    </select>
                </div>
                 <div class="form-group">
                    <label for="Vendedor">Vendedor</label>
                    <select class="form-control" id="Vendedor" name="Vendedor">
                        <?php
                        if (count($funcionarios) > 0) {
                            echo '<option value="">Selecione um Vendedor</option>';
                            foreach ($funcionarios as $f) {
                                echo '<option ' . (($f->id == $funcionario->id) ? 'selected' : '') . ' value="' . $f->id . '">' . $f->nomeFuncionario . '</option>' . PHP_EOL;
                            }
                        } else {
                            echo '<option value="">Nenhum Vendedor Cadastrado</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Pagamento">Forma de Pagamento</label>
                    <select class="form-control" id="Pagamento" name="Pagamento">
                        <option value="">Selecione uma Forma de Pagamento</option>;
                        <option <?= (isset($notafiscal))&&(($notafiscal->formaPagamento) == 1) ? ' selected ' : ''; ?>value="1">Á Vista</option>
                        <option <?= (isset($notafiscal))&&(($notafiscal->formaPagamento) == 2) ? ' selected ' : ''; ?>value="2">Á Prazo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Desconto">Desconto</label> 
                    <input type="text" class="form-control" name="Desconto" id="Desconto" value="<?=set_value('Desconto')?>">
                </div>
                <label for="ICMS">ICMS</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">R$</span>
                    </div>
                    <input disabled type="text" id="ICMS" name="ICMS" class="form-control" value="<?=set_value('ICMS')?>">
                </div>
                <label for="Valor">Valor</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">R$</span>
                    </div>
                    <input disabled type="text" id="Valor" name="Valor" class="form-control" value="">
                </div>
                <div class="text-center mb-5">
                    <button class="btn btn-success" type="submit"><i class="fas fa-check"></i><?= (isset($veiculo)) === true ? ' Alterar' : ' Salvar' ?></button>
                    <a class="btn btn-warning" href="<?= base_url('Modelo/listar'); ?>"><i class="fas fa-undo"></i> Cancelar</a> 
                </div>
            </form>
        </div>
    </div>
</div>


