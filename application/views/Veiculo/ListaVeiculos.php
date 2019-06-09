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
            <thead class="thead-dark">
                <tr>
                    <th>Veiculo</th>                    
                    <th>Ano</th>
                    <th>Cor</th>
                    <th>Renavam</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
            </thead>        
            <tbody>
                <?php
                if (count($veiculos) > 0) {
                    foreach ($veiculos as $v) {
                        echo '<tr>';
                        echo '<td>' . $v->Veiculo . '</td>';
                        echo '<td>' . $v->ano . '</td>';
                        echo '<td>' . $v->cor . '</td>';
                        echo '<td>' . $v->renavam . '</td>';
                        echo '<td>' . $v->valorVeiculo . '</td>';
                        echo '<td>'
                        . '<a href="' . base_url('Veiculo/alterar/') . $v->id . '" class="btn btn-sm btn-outline-secondary mr-2" ><i class="fas fa-pencil-alt"></i> Alterar</a>';
                        if ($v->veiculoEmUso < 1) {
                            echo '<a href="' . base_url('Veiculo/deletar/') . $v->id . '" class="btn btn-sm btn-outline-secondary" ><i class="fas fa-trash-alt"></i> Deletar</a>';
                        } else {
                            echo '<a href="' . base_url('Veiculo/indisponivel/') . '" class="btn btn-sm btn-dark" ><i class="fas fa-trash-alt"></i> Deletar</a>';
                        }
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="6">Nenhum Veículo foi cadastrado até o momento.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row mt-1"></div>