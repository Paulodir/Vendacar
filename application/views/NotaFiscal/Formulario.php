<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $this->config->base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= (isset($veiculo)) === true ? 'Alteração' : 'Cadastro' ?> de Veículos</li>
        </ol>
    </nav>
    <?= ($this->session->flashdata('retorno')) ? $this->session->flashdata('retorno') : ''; ?>
    <?= validation_errors(); //var_dump($formaspagamento)?>
    <div class="row">
        <div class="col-md-5 col-xs-12">
            <form action="" name="notafiscal" method="POST">                
                <input type="hidden" name="id" value="">
                <?PHP date_default_timezone_set('America/Sao_Paulo'); ?>
                <input type="hidden" name="emissao" value="<?= date('Y-m-d H:i:s') ?>">
                <div class="form-group">
                    <label for="Veiculo">Veículo<b> / </b>Placa</label>
                    <select class="form-control" id="Veiculo" name="Veiculo">
                        <?php
                        if (count($veiculos) > 0) {
                            echo '<option value="">Selecione um Veículo</option>';
                            foreach ($veiculos as $v) {
                                echo '<option ' . (($v->id == $veiculo->id) ? 'selected' : '') . ' value="' . $v->id . '">' . $v->nomeVeiculo . ' / ' . $v->placa . '</option>' . PHP_EOL;
                            }
                        } else {
                            echo '<option value="">Nenhum Veículo Cadastrado</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Cliente">Cliente<b> / </b>CPF CNPJ</label>
                    <select class="form-control" id="Cliente" name="Cliente">
                        <?php
                        if (count($clientes) > 0) {
                            echo '<option value="">Selecione um Cliente</option>';
                            foreach ($clientes as $c) {
                                echo '<option ' . (($c->id == $cliente->id) ? 'selected' : '') . ' value="' . $c->id . '">' . $c->nomeCliente . ' / ' . $c->cnpjCpf . '</option>' . PHP_EOL;
                            }
                        } else {
                            echo '<option value="">Nenhum Cliente Cadastrado</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Vendedor">Vendedor<b> / </b>CPF</label>
                    <select class="form-control" id="Vendedor" name="Vendedor">
                        <?php
                        if (count($funcionarios) > 0) {
                            echo '<option value="">Selecione um Vendedor</option>';
                            foreach ($funcionarios as $f) {
                                echo '<option ' . (($f->id == $funcionario->id) ? 'selected' : '') . ' value="' . $f->id . '">' . $f->nomeFuncionario . ' /  ' . $f->cpf . '</option>' . PHP_EOL;
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
                        <?php
                        if (count($formaspagamento) > 0) {
                            echo '<option value="">Selecione uma Forma de Pagamento</option>';
                            foreach ($formaspagamento as $fp) {
                                echo '<option ' . (($fp->id == $funcionario->id) ? 'selected' : '') . ' value="' . $fp->id . '">' . $fp->descricaoPagamento . '</option>' . PHP_EOL;
                            }
                        } else {
                            echo '<option value="">Nenhuma Forma de Pagamento Cadastrada</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="AcrescimoDesconto">
                        <input type="radio" name="calcula" value="1"> Acréscimo
                        <input type="radio" name="calcula" value="2"> Desconto
                    </label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">R$</span>
                        </div>
                        <input type="text" class="form-control" name="AcrescimoDesconto" id="AcrescimoDesconto" value="<?= set_value('AcrescimoDesconto') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="ValorVeiculo">Valor do Veículo</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">R$</span>
                        </div>
                        <input type="text" disabled id="ValorVeiculo" name="ValorVeiculo" class="form-control" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="ValorFinal">Valor da Nota</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">R$</span>
                        </div>
                        <input type="text" id="ValorFinal" name="ValorFinal" class="form-control" value="">
                    </div>
                </div>
                <div class="text-center mb-5">
                    <button class="btn btn-success" type="submit"><i class="fas fa-check"></i><?= (isset($veiculo)) === true ? ' Alterar' : ' Salvar' ?></button>
                    <a class="btn btn-warning" href="<?= base_url('Modelo/listar'); ?>"><i class="fas fa-undo"></i> Cancelar</a> 
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?= base_url('Incluir/AjaxJquery.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('Incluir/Jquery.Mask.js') ?>" type="text/javascript"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $(document).on('submit', 'form[name=notafiscal]', function () {
            $('#ValorVeiculo').removeAttr('disabled');
        });
        var base_url = "<?= base_url() ?>"
        $('#Veiculo').change(function () {
            var veiculo_id = $('#Veiculo').val();
            $.post(base_url + 'Veiculo/getValorAjax', {
                veiculo_id: veiculo_id
            }, function (data) {
                $('#ValorVeiculo').val(data);                
            });
        });
        $("input[name='calcula']").click(function () {
            var calcular = $("input[name='calcula']:checked").val();
            //alert(calcular);
            $('#AcrescimoDesconto').on('keydown keyup click', function () {
                if ($(this).attr('name') === 'ValorFinal') {
                    return false;
                };
                var valor1 = ($('#ValorVeiculo').val() == '' ? 0 : $('#ValorVeiculo').val());
                var valor2 = ($('#AcrescimoDesconto').val() == '' ? 0 : $('#AcrescimoDesconto').val());
                if (calcular == 1) {
                    var ValorFinal = (parseFloat(valor1) + parseFloat(valor2));
                } else if (calcular == 2) {
                    var ValorFinal = (parseFloat(valor1) - parseFloat(valor2));
                };
                if (!isNaN(ValorFinal)) {
                    $('#ValorFinal').val(ValorFinal.toFixed(2))
                };
            });
        });
    });
</script>

