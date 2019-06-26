<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $this->config->base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lista de Modelos</li>
        </ol>
    </nav> 
    <?= ($this->session->flashdata('retorno')) ? $this->session->flashdata('retorno') : ''; ?>
    <?= validation_errors(); ?>
    <div class="table-responsive">
        <table class="table table-striped display" style="width:100%">        
            <thead class="thead-dark">
                <tr>
                    <th>Modelo</th>                    
                    <th>Montadora</th>
                    <th>Categoria</th>
                    <th>Ações</th>
                </tr>
            </thead>        
            <tbody>
                <?php
                if (count($modelos) > 0) {
                    foreach ($modelos as $m) {
                        echo '<tr>';
                        echo '<td>' . $m->nomeModelo . '</td>';
                        echo '<td>' . $m->Montadora . '</td>';
                        echo '<td>';
                        if (($m->tipoModelo) == 1) {
                            echo ' Carro ';
                        } elseif (($m->tipoModelo) == 2) {
                            echo ' Moto ';
                        } elseif (($m->tipoModelo) == 3) {
                            echo ' Caminhão ';
                        }
                        echo '</td>';
                        echo '<td>'
                        . '<a href="' . base_url('Modelo/alterar/') . $m->id . '" class="btn btn-sm btn-outline-secondary mr-2" ><i class="fas fa-pencil-alt"></i> Alterar</a>';
                        if ($m->modeloEmUso < 1) {
                            echo '<a href="' . base_url('Modelo/deletar/') . $m->id . '" class="btn btn-sm btn-outline-secondary" data-confirm=""><i class="fas fa-trash-alt"></i> Deletar</a>';
                        } else {
                            echo '<a href="' . base_url('Modelo/indisponivel/') . '" class="btn btn-sm btn-dark" ><i class="fas fa-trash-alt"></i> Deletar</a>';
                        }
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="6">Nenhum Modelo de Montadora foi cadastrado até o momento.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row mt-1"></div>