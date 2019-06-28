<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $this->config->base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lista de Funcionarios</li>
        </ol>
    </nav>
    <?= ($this->session->flashdata('retorno')) ? $this->session->flashdata('retorno') : ''; ?>
    <?= validation_errors(); ?>
    <div class="table-responsive">
        <table class="table table-striped display" style="width:100%">        
            <thead class="thead-dark">
                <tr>
                    <th>Funcionário</th>
                    <th>Cpf/ Cnpj</th>
                    <th>Rg / Ie</th>
                    <th>Setor</th>
                    <th>Nascimento</th>
                    <th>Cidade</th>                
                    <th>Celular</th>
                    <th>Salário</th>
                    <th>Ações</th>
                </tr>
            </thead>        
            <tbody>
                <?php
                if (count($funcionarios) > 0) {
                    foreach ($funcionarios as $f) {
                        echo '<tr>';
                        echo '<td>' . $f->nomeFuncionario . '</td>';
                        echo '<td>' . $f->cpf . '</td>';
                        echo '<td>' . $f->rg . '</td>';
                        echo '<td>' . $f->nomeSetor . '</td>';
                        echo '<td>' . $f->nascimento . '</td>';
                        echo '<td>' . $f->cidade . '</td>';
                        echo '<td>' . $f->celular . '</td>';
                        echo '<td>' . $f->salario . '</td>';
                        echo '<td>';
                        echo '<a href="' . base_url('Funcionario/alterar/') . $f->id . '" class="btn btn-sm btn-outline-secondary mr-2" ><i class="fas fa-pencil-alt"></i> Alterar</a>';
                        if ($f->funcionarioEmUso < 1) {
                            echo '<a href="' . base_url('Funcionario/deletar/') . $f->id . '" class="btn btn-sm btn-outline-secondary" data-confirm=""><i class="fas fa-trash-alt"></i> Deletar</a>';
                        } else {
                            echo '<a href="' . base_url('Funcionario/indisponivel/') . '" class="btn btn-sm btn-dark" ><i class="fas fa-trash-alt"></i> Deletar</a>';
                        }
                        echo '</div></td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="6">Nenhuma Funcionario foi cadastrada até o momento.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
