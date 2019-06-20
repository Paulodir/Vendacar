<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $this->config->base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lista de Notas Fiscais</li>
        </ol>
    </nav> 
    <?= ($this->session->flashdata('retorno')) ? $this->session->flashdata('retorno') : ''; ?>
    <?= validation_errors(); // var_dump($notasfiscais)?>
    <div class="table-responsive">
        <table class="table table-striped display" style="width:100%">        
            <thead class="thead-dark">
                <tr>
                    <th>Nº NF</th>                    
                    <th>Cliente</th>
                    <th>Veiculo</th>
                    <th>Vendedor</th>
                    <th>Pagamento</th>
                    <th>Emissão</th>
                    <th>ICMS</th>
                    <th>Valor da Nota</th>
                    <th>Ações</th>
                </tr>
            </thead>        
            <tbody>
                <?php
                if (count($notasfiscais) > 0) {
                    foreach ($notasfiscais as $nf) {
                        echo '<tr>';
                        echo '<td>' . $nf->id . '</td>';
                        echo '<td>' . $nf->nomeCliente . '</td>';
                        echo '<td>' . $nf->nomeVeiculo . '</td>';
                        echo '<td>' . $nf->nomeFuncionario. '</td>';
                        echo '<td>';
                        if (($nf->formaPagamento_id) == 1) {
                            echo 'Á Vista';
                        } elseif (($nf->formaPagamento_id) == 2) {
                            echo 'Á Prazo';
                        }       
                        echo '</td>';
                        echo '<td>' . $nf->dataEmissao . '</td>';
                        echo '<td>' . $nf->icms . '</td>';
                        echo '<td>' . $nf->valorNota . '</td>';
                        echo '<td>'
                        . '<a href="' . base_url('NotaFiscal/alterar/') . $nf->id . '" class="btn btn-sm btn-outline-secondary mr-2" ><i class="fas fa-pencil-alt"></i> Alterar</a>';

                            echo '<a href="' . base_url('NotaFiscal/indisponivel/') . '" class="btn btn-sm btn-dark" ><i class="fas fa-trash-alt"></i> Deletar</a>';
               
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="6">Nenhum Nota Fiscal foi cadastrado até o momento.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row mt-1"></div>