
<div class="container-fluid">
    <hr class="featurette-divider">
    <div class="row">
        <div class="col-md-12">
            <h2>
                <?= (isset($veiculo)) === true ? $veiculo->nomeVeiculo . ' ' . $veiculo->ano : '' ?>
            </h2>
        </div>
        <div class="col-md-12 d-none d-md-block">
            <div class="col-md-12">
                <h3>
                    <?= (isset($veiculo)) === true ? 'R$ ' . $veiculo->valorVeiculo : '' ?>
                </h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="container">
                <div class="jumbotron jumbotron-fluid border rounded">

                    <div id="imagemCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php
                            $count = count($fotos);
                            for ($i = 0; $i < $count; $i++):
                                ?>
                                <li data-target="#imagemCarousel" data-slide-to="<?= $i ?>" <?= ($i == 0) ? 'class="active"' : '' ?>></li>                       
                            <?php endfor ?> 
                        </ol>
                        <div class="carousel-inner">
                            <?php foreach ($fotos as $posicao => $foto): ?>
                                <div class="carousel-item  <?= ($posicao == 0) ? 'active' : '' ?>">
                                    <img class="d-block w-100" src="<?= base_url('Uploads/' . $veiculo->id . '/' . $foto->nome) ?>" alt="Slide">
                                </div>
                            <?php endforeach ?> 
                        </div>
                        <a class="carousel-control-prev" href="#imagemCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="carousel-control-next" href="#imagemCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Próximo</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <table class="table table-striped table-bordered ">
                <thead><h3>Informações do Veiculo</h3></thead>
                <tbody>
                    <tr>
                        <th>Preço </th>
                        <td><?= (isset($veiculo)) === true ? 'R$ ' . $veiculo->valorVeiculo : '' ?></td>
                    </tr>
                    <tr>
                        <th>Cor </th>
                        <td><?= (isset($veiculo)) === true ? $veiculo->cor : '' ?></td>
                    </tr>
                    <tr>
                        <th>Ano</th>
                        <td><?= (isset($veiculo)) === true ? $veiculo->ano : '' ?></td>
                    </tr>
                    <tr>
                        <th>Placa</th>
                        <td><?= (isset($veiculo)) === true ? $veiculo->placa : '' ?></td>
                    </tr>
                    <tr>
                        <th>Nº de Série</th>
                        <td>117974</td>
                    </tr>
                    <tr>
                        <th>Kilometragem</th>
                        <td>117974</td>
                    </tr>
                    <tr>
                        <th>Motor</th>
                        <td>2.0</td>
                    </tr>
                    <tr>
                        <th>Combustivel </th>
                        <td>Gasolina</td>
                    </tr>
                    <tr>
                        <th>Transmição</th>
                        <td>Automática</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <table class="table table-striped">
                <tbody>                  
                    <tr>
                        <th>Item de Série</th>
                    </tr>
                    <?php
                    foreach ($veiculoacessorios as $item) {
                        if (($item->id == $veiculo->id) && ($item->tipoAcessorio == 1)) {
                            echo'<tr><td>';
                            echo $item->opcionais;
                            echo '</td></tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-4"> <!--<tr><td colspan="6">Nenhuma Acessorio foi cadastrada até o momento.</td></tr>';-->
            <table class="table table-striped">
                <tbody>                  
                    <tr>
                        <th>Item Opcional</th>
                    </tr>
                    <?php
                    foreach ($veiculoacessorios as $item) {
                        if (($item->id == $veiculo->id) && ($item->tipoAcessorio == 2)) {
                            echo'<tr><td>';
                            echo $item->opcionais;
                            echo '</td></tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <iframe  class="col-md-12" src="<?= base_url('Visitante/contato') ?>" width="300" height="600" name="lugar" noresize></iframe>
        </div>
    </div>
    <hr class="featurette-divider">
</div>