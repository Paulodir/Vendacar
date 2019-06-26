<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $this->config->base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lista de Veículos</li>
        </ol>
    </nav> 
    <?= ($this->session->flashdata('retorno')) ? $this->session->flashdata('retorno') : ''; ?>
    <?= validation_errors(); ?>
    <div class="table-responsive">
        <table class="table table-striped display" style="width:100%">        
            <h2>Acessórios do Veículo <?= (isset($veiculo)) === true ? ucwords(strtolower($veiculo->nomeVeiculo)) : 'Cadastro' ?> </h2>
            <h4>Adicionar um Acessório<a href="<?= base_url('VeiculoAcessorio/incluirAcessorios/' . $veiculo->id); ?>">[ +adicionar ]</a></h4>
            <thead class="thead-dark">
                <tr>
                    <th>Acessórios</th>  
                    <th>Categoria</th>
                    <th>Valor do Acessório</th>
                    <th>Ações</th>
                </tr>
            </thead>        
            <tbody>
                <?php
                if (count($veiculoacessorios) > 0) {
                    foreach ($veiculoacessorios as $v) {
                        echo '<tr>';
                        echo '<td>' . $v->descricaoAcessorio . '</td>';
                        echo '<td>';
                        if (($v->tipoAcessorio) == 1) {
                            echo ' Item de Série ';
                        } elseif (($v->tipoAcessorio) == 2) {
                            echo ' Item Opcional ';
                        }
                        echo '</td>';
                        echo '<td> R$ ' . $v->valorAcessorio . '</td>';
                        echo '<td>';
                        echo '<a href="' . base_url('VeiculoAcessorio/alterarAcessorios/') . $v->id . '/' . $v->veiculo_id . '" class="btn btn-sm btn-outline-secondary mr-2" ><i class="fas fa-pencil-alt"></i> Alterar</a>';
                        echo '<a href="' . base_url('VeiculoAcessorio/deletarAcessorios/') . $v->id . '/' . $v->veiculo_id . '" class="btn btn-sm btn-outline-secondary" data-confirm=""><i class="fas fa-trash-alt"></i> Deletar</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="6">O Veículo ' . $veiculo->nomeVeiculo . ' não possui nenhum acessório até o momento.</td></tr>';
                }
                ?>

            </tbody>
        </table>
    </div>
</div>
<div class="row mt-1"></div>
