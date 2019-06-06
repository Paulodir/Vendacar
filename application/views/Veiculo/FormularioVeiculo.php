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
            <li class="breadcrumb-item active" aria-current="page"><?= (isset($veiculo)) === true ? 'Alteração' : 'Cadastro' ?> de Modelos</li>
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
                                echo '<option ' . (($mont->id == $modelo->montadora_id) ? 'selected' : '') . ' value="' . $mont->id . '">' . $mont->nomeMontadora . '</option>';
                            }
                        } else {
                            echo '<option value="">Nenhuma Montadora Cadastrada.</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Modelo">Modelo</label>
                    <select class="form-control" id="Modelo" name="Modelo">
                        <?php
                                                
                        if (count($modelos) > 0) {
                            echo '<option value="">Selecione um Modelo</option>';
                            foreach ($modelos as $mode) {
                                echo '<option ' . (($mode->id == $veiculo->modelo_id) ? 'selected' : '') . ' value="' . $mode->id . '">' . $mode->nomeModelo . '</option>';
                            }
                        } else {
                            echo '<option value="">Nenhum Modelo Cadastrado</option>';
                        }
                        ?>
                    </select>
                </div>
                 <?php 
                /* var_dump($modelos);
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


