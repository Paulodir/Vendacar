<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script type="text/javascript">
    $("#RG").mask("000000000000000");
    $("#CPF").mask("000.000.000-00");
</script>
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $this->config->base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= (isset($modelo)) === true ? 'Alteração' : 'Cadastro' ?> de Modelos</li>
        </ol>
    </nav>
    <?= ($this->session->flashdata('retorno')) ? $this->session->flashdata('retorno') : ''; ?>
    <?= validation_errors(); //var_dump($modelo)?>
    <div class="row">
        <div class="col-md-5 col-xs-12">
            <form action="" method="POST">
                <input type="hidden" name="id" value="">
                <div class="form-group">
                    <label for="Modelo">Modelo</label>
                    <input class="form-control" type="text" name="Modelo" id="Modelo" value="<?= (isset($modelo)) ? $modelo->nomeModelo : ''; ?>" placeholder="Digite o Modelo">
                </div>                
                <div class="form-group">
                    <label for="Montadora">Montadora</label>
                    <select class="form-control" id="Montadora" name="Montadora">
                        <?php
                        if (count($montadoras) > 0) {
                            echo '<option value="">Selecione uma Montadora</option>';
                            foreach ($montadoras as $m) {
                                echo '<option ' . (($m->id == $modelo->montadora_id) ? 'selected' : '') . ' value="' . $m->id . '">' . $m->nomeMontadora . '</option>';
                            }
                        } else {
                            echo '<option value="">Nenhuma Montadora Cadastrada.</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Categoria">Categoria de Veículo</label>
                    <select class="form-control" id="Categoria" name="Categoria">
                        <option value="">Selecione uma Categoria de Veículo</option>;
                        <option <?= (isset($modelo))&&(($modelo->tipoModelo) == 1) ? ' selected ' : ''; ?>value="1">Carro</option>
                        <option <?= (isset($modelo))&&(($modelo->tipoModelo) == 2) ? ' selected ' : ''; ?>value="2">Moto</option>
                        <option <?= (isset($modelo))&&(($modelo->tipoModelo) == 3) ? ' selected ' : ''; ?>value="3">Caminhão</option>
                    </select>
                </div>



                <?php /* echo '<option ' . (($marca->id == $veiculo->marca_id) ? 'selected' : null) . ' value="' . $marca->id . '">' . $marca->nome . '</option>';
                  if (strlen($_POST['cpf']) < 30) {
                  echo '<span style="color: red"><i class="fas fa-exclamation-circle"></i>A descrição deve conter pelo menos 30 caracteres, Total é ' . strlen($_POST['cpf']) . '.</span>';
                 */ ?>

                <div class="text-center mb-5">
                    <button class="btn btn-success" type="submit"><i class="fas fa-check"></i><?= (isset($modelo)) === true ? ' Alterar' : ' Salvar' ?></button>
                    <a class="btn btn-warning" href="<?= base_url('Modelo/listar'); ?>"><i class="fas fa-undo"></i> Cancelar</a> 
                </div>
            </form>
        </div>
    </div>
</div>


