<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $this->config->base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lista de Notas Fiscais</li>
        </ol>
    </nav> 
    <?PHP
    date_default_timezone_set('America/Sao_Paulo'); # add your city to set local time zone
    ECHO date('Y-m-d H:i:s')
    ?>
    <?= ($this->session->flashdata('retorno')) ? $this->session->flashdata('retorno') : ''; ?>
<?= validation_errors(); // var_dump($notasfiscais)   ?>
    <div class="table-responsive">
        <table class="table table-striped display" style="width:100%">        
            <thead class="thead-dark">
                <tr>
                    <th>NºNF</th>                    
                    <th>Cliente</th>
                    <th>Veiculo</th>
                    <th>Vendedor</th>
                    <th>Emissão</th>
                    <th>ICMS</th>
                    <th>Valor da Nota</th>
                    <th>Situação</th>
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
                        echo '<td>' . $nf->nomeFuncionario . '</td>';
                        echo '<td>' . $nf->dataEmissao . '</td>';
                        echo '<td> R$ ' . $nf->icms . '</td>';
                        echo '<td> R$ ' . $nf->valorFinal . '</td>';
                        echo '<td>';
                        if (($nf->status) == 1) {
                            echo 'Autorizada';
                        } elseif (($nf->status) == 0) {
                            echo 'Cancelada';
                        }
                        echo '</td>';
                        echo '<td>';                  
                        echo '<a href="' . base_url('NotaFiscal/cancelar/') . $nf->id . '" class="btn btn-sm btn-dark" ><i class="fas fa-trash-alt"></i> Deletar</a>';
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