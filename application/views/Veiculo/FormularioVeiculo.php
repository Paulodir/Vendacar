<script src="<?= base_url('Incluir/AjaxJquery.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('Incluir/Jquery.Mask.js') ?>" type="text/javascript"></script>
<script type="text/javascript">
    $("#Renavam").mask("000000000000000");
    $(document).ready(function () {
        var base_url = "<?= base_url() ?>"
        $('#Montadora').change(function () {
            $('#Modelo').attr('disabled', 'disabled');
            $('#Modelo').html('<option>Carregando...</option>');
            var montadora_id = $('#Montadora').val();
            $.post(base_url + 'Veiculo/getModelos', {
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
    <?= validation_errors(); //var_dump($modelo)?>
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
                                echo '<option value="' . $mont->id . '">' . $mont->nomeMontadora . '</option>' . PHP_EOL;
                            }
                        } else {
                            echo '<option value="">Nenhuma Montadora Cadastrada</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Modelo">Modelo</label>
                    <select class="form-control" id="Modelo" name="Modelo" disabled>
                        <!-- $options = '<option>Selecione o Modelo</option>';
     foreach ($modelos as $modelo) {
         $options .= '<option value=' . $modelo->id . '">' . $modelo->nomeModelo . '</option>' . PHP_EOL;
     }
                 <label for="Modelo">Modelo</label>
                 <select class="form-control" id="Modelo" name="Modelo" disabled>-->
                        <?php
                        if ((isset($veiculo)) === true) {
                            if (count($modelos) > 0) {
                                echo '<option value="">Selecione uma Montadora Acima</option>';
                                foreach ($modelos as $mod) {
                                    echo '<option value="' . $mod->id . '">' . $mod->nomeModelo . '</option>' . PHP_EOL;
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
                    <input type="text" class="form-control" name="Ano" id="Ano" value="<?= set_value('Ano') ?>">
                </div>
                <div class="form-group">
                    <label for="Cor">Cor</label> 
                    <input type="text" class="form-control" name="Cor" id="Cor" value="<?= set_value('Cor') ?>">
                </div>
                <div class="form-group">
                    <label for="Renavam">Renavam</label> 
                    <input type="text" class="form-control" name="Renavam" id="Renavam" value="<?= set_value('Renavam') ?>">
                </div>
                <label for="Valor">Valor</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">R$</span>
                    </div>
                    <input type="text" id="Valor" name="Valor" class="form-control" value="<?= set_value('Valor') ?>">
                </div>
<?php
/* var_dump($modelos);var_dump($montadoras);
 * echo '<option ' . (($marca->id == $veiculo->marca_id) ? 'selected' : null) . ' value="' . $marca->id . '">' . $marca->nome . '</option>';
  if (strlen($_POST['cpf']) < 30) {
  echo '<span style="color: red"><i class="fas fa-exclamation-circle"></i>A descrição deve conter pelo menos 30 caracteres, Total é ' . strlen($_POST['cpf']) . '.</span>';
  window.setTimeout(function() {
  $(".alert").fadeTo(500, 0).slideUp(500, function(){
  $(this).remove();
  });
  }, 4000);
 */
?>

                <div class="text-center mb-5">
                    <button class="btn btn-success" type="submit"><i class="fas fa-check"></i><?= (isset($veiculo)) === true ? ' Alterar' : ' Salvar' ?></button>
                    <a class="btn btn-warning" href="<?= base_url('Modelo/listar'); ?>"><i class="fas fa-undo"></i> Cancelar</a> 
                </div>
            </form>
        </div>
    </div>
</div>


