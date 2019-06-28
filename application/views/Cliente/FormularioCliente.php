
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $this->config->base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= (isset($cliente)) === true ? 'Alteração' : 'Cadastro' ?> de Clientes</li>
        </ol>
    </nav>
    <?= ($this->session->flashdata('retorno')) ? $this->session->flashdata('retorno') : ''; ?>
    <?= validation_errors(); //var_dump($cliente)?>
    <div class="row"><div class="col-offset-md-4"></div>
        <div class="col-md-5 col-xs-12">
            <form action="" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="id" value="">
                <div class="form-group">
                    <label for="Nome">Nome Cliente</label>
                    <input class="form-control" type="text" name="Nome" id="Nome" value="<?= (isset($cliente)) ? $cliente->nomeCliente : set_value('Nome'); ?>">
                </div>
                <div class="form-group">
                    <label for="cpfCnpj">
                        <input type="radio" name="seletorCpfCnpj" value="1"> Cpf
                        <input type="radio" name="seletorCpfCnpj" value="2"> Cnpj
                    </label>
                    <input class="form-control" type="text" name="cpfCnpj" id="cpfCnpj" value="<?= (isset($cliente)) ? $cliente->cnpjCpf : set_value('cpfCnpj'); ?>">
                </div>
                <div class="form-group">
                    <label id="labelRgIe" for="RgIe">RG ou Inscrição Estadual</label>
                    <input class="form-control" type="text" name="RgIe" id="RgIe" value="<?= (isset($cliente)) ? $cliente->ieRg : set_value('RgIe'); ?>">
                </div>
                <div class="form-group">
                    <label for="Genero">Gênero</label>
                    <select class="form-control" id="Genero" name="Genero">
                        <option value="">Selecione o Gênero</option>;
                        <option <?= (isset($cliente)) && (($cliente->genero) == 1) ? ' selected ' : ''; ?>value="1">Masculino</option>
                        <option <?= (isset($cliente)) && (($cliente->genero) == 2) ? ' selected ' : ''; ?>value="2">Feminino</option>
                        <option <?= (isset($cliente)) && (($cliente->genero) == 3) ? ' selected ' : ''; ?>value="3">Indefinido</option>
                    </select>
                </div>
                <div class="form-group">
                    <label id="labelNascimento" for="Nascimento">Data de Nascimento ou Fundação</label>
                    <input class="form-control" type="date" name="Nascimento" id="Nascimento" value="<?= (isset($cliente)) ? $cliente->dataNascimento : set_value('Nascimento'); ?>">
                </div>
                <div class="form-group">
                    <label for="Endereco">Endereço</label>
                    <input class="form-control" type="text" name="Endereco" id="Endereco" value="<?= (isset($cliente)) ? $cliente->endereco : set_value('Endereco'); ?>">
                </div>

                <div class="form-group">
                    <label for="Bairro">Bairro</label>
                    <input class="form-control" type="text" name="Bairro" id="Bairro" value="<?= (isset($cliente)) ? $cliente->bairro : set_value('Bairro');?>">
                </div>
                <div class="form-group">
                    <label for="Cidade">Cidade</label>
                    <input class="form-control" type="text" name="Cidade" id="Cidade" value="<?= (isset($cliente)) ? $cliente->cidade : set_value('Cidade');?>">
                </div>
                <div class="form-group">
                    <label for="Estado">Estado</label>
                    <input class="form-control" type="text" name="Estado" id="Estado" value="<?= (isset($cliente)) ? $cliente->estado : set_value('Estado'); ?>">
                </div>
                <div class="form-group">
                    <label for="Celular">Nº Celular</label>
                    <input class="form-control" type="text" name="Celular" id="Celular" value="<?= (isset($cliente)) ? $cliente->celular : set_value('Celular'); ?>">
                </div>
                <div class="text-center mb-5">
                    <button class="btn btn-success" type="submit"><i class="fas fa-check"></i><?= (isset($cliente)) === true ? ' Alterar' : ' Salvar' ?></button>
                    <a class="btn btn-warning" href="<?= base_url('Cliente/listar'); ?>"><i class="fas fa-undo"></i> Cancelar</a> 
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
//var options = {
//    onKeyPress: function (cpf, ev, el, op) {
//        var masks = ['000.000.000-000', '00.000.000/0000-00'];
//        $('#cpfCnpj').mask((cpf.length > 14) ? masks[1] : masks[0], op);
//    }
//}

$('#cpfCnpj').length > 11 ? $('#cpfCnpj').mask('00.000.000/0000-00', options) : $('#cpfCnpj').mask('000.000.000-00#', options);
        
        $("input[name='seletorCpfCnpj']").click(function () {
            var calcular = $("input[name='seletorCpfCnpj']:checked").val();
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