<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $this->config->base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lista de Clientes</li>
        </ol>
    </nav>
    <?= ($this->session->flashdata('retorno')) ? $this->session->flashdata('retorno') : ''; ?>
    <?= validation_errors(); ?>
    <div class="table-responsive">
        <table class="table table-striped display" style="width:100%">        
            <thead class="thead-dark">
                <tr>
                    <th>Cliente</th>
                    <th>Cpf/ Cnpj</th>
                    <th>Rg / Ie</th>
                    <th>Gênero</th>
                    <th>Nascimento</th>
                    <th>Endereço</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>Celular</th>
                    <th>Ações</th>
                </tr>
            </thead>        
            <tbody>
                <?php
                if (count($clientes) > 0) {
                    foreach ($clientes as $c) {
                        echo '<tr>';
                        echo '<td>' . $c->nomeCliente . '</td>';
                        echo '<td>' . $c->cnpjCpf . '</td>';
                        echo '<td>' . $c->ieRg . '</td>';
                         echo '<td>';
                        if (($c->genero) == 1) {
                            echo ' Masculino ';
                        } elseif (($c->genero) == 2) {
                            echo ' Feminino ';
                        } elseif (($c->genero) == 3) {
                            echo ' Indefinido ';
                        }
                        echo '</td>';
                        echo '<td>' . $c->dataNascimento . '</td>';
                        echo '<td>' . $c->endereco . '</td>';
                        echo '<td>' . $c->bairro . '</td>';
                        echo '<td>' . $c->cidade . '</td>';
                        echo '<td>' . $c->estado . '</td>';
                        echo '<td>' . $c->celular . '</td>';
                        echo '<td>';
                        echo '<a href="' .base_url('Cliente/alterar/' ) .  $c->id . '" class="btn btn-sm btn-outline-secondary mr-2" ><i class="fas fa-pencil-alt"></i> Alterar</a>';
                        if ($c->clienteEmUso < 1) {
                            echo '<a href="' . base_url('Cliente/deletar/') . $c->id . '" class="btn btn-sm btn-outline-secondary" ><i class="fas fa-trash-alt"></i> Deletar</a>';
                        } else {
                            echo '<a href="' . base_url('Cliente/indisponivel/') . '" class="btn btn-sm btn-dark" ><i class="fas fa-trash-alt"></i> Deletar</a>';
                        }
                        echo '</div></td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="6">Nenhuma Cliente foi cadastrada até o momento.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
