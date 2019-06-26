<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $this->config->base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lista de Acessorios</li>
        </ol>
    </nav>
    <?= ($this->session->flashdata('retorno')) ? $this->session->flashdata('retorno') : ''; ?>
    <?= validation_errors(); ?>
    <div class="table-responsive">
        <table class="table table-striped display" style="width:100%">        
            <thead class="thead-dark">
                <tr>
                    <th>Acessório</th>
                    <th>Categoria</th>
                    <th>Valor do Acessório</th>
                    <th>Ações</th>
                </tr>
            </thead>        
            <tbody>
                <?php
                if (count($acessorios) > 0) {
                    foreach ($acessorios as $a) {
                        echo '<tr>';
                        echo '<td>' . $a->descricaoAcessorio . '</td>';
                        echo '<td>';
                        if (($a->tipoAcessorio) == 1) {
                            echo ' Item de Série ';
                        } elseif (($a->tipoAcessorio) == 2) {
                            echo ' Item Opcional ';
                        }
                        echo '</td>';
                        echo '<td> R$ ' . $a->valorAcessorio . '</td>';
                        echo '<td>';
                        echo '<a href="' . base_url('Acessorio/alterar/') . $a->id . '" class="btn btn-sm btn-outline-secondary mr-2" ><i class="fas fa-pencil-alt"></i> Alterar</a>';
                        echo '<a href="' . base_url('Acessorio/deletar/') . $a->id . '" class="btn btn-sm btn-outline-secondary" data-confirm=""><i class="fas fa-trash-alt"></i> Deletar</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="6">Nenhuma Acessorio foi cadastrada até o momento.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
