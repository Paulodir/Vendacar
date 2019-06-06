<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $this->config->base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lista de Montadoras</li>
        </ol>
    </nav>
    <?= ($this->session->flashdata('retorno')) ? $this->session->flashdata('retorno') : ''; ?>
    <?= validation_errors(); ?>
    <div class="table-responsive">
        <table class="table table-striped display" style="width:100%">        
            <thead class="thead-dark">
                <tr>
                    <th>Montadora</th>
                    <th>Ações</th>
                </tr>
            </thead>        
            <tbody>
                <?php
                if (count($montadoras) > 0) {
                    foreach ($montadoras as $m) {
                        echo '<tr>';
                        echo '<td>' . $m->nomeMontadora . '</td>';
                        echo '<td>';
                        echo '<a href="' . $this->config->base_url() . 'Montadora/alterar/' . $m->id . '" class="btn btn-sm btn-outline-secondary mr-2" ><i class="fas fa-pencil-alt"></i> Alterar</a>';
                        if ($m->montadoraEmUso < 1) {
                            echo '<a href="' . $this->config->base_url() . 'Montadora/deletar/' . $m->id . '" class="btn btn-sm btn-outline-secondary" ><i class="fas fa-trash-alt"></i> Deletar</a>';
                        } else {
                            echo '<a href="' . base_url('Montadora/indisponivel/') . '" class="btn btn-sm btn-dark" ><i class="fas fa-trash-alt"></i> Deletar</a>';
                        }
                        echo '</div></td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="6">Nenhuma Montadora foi cadastrada até o momento.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
