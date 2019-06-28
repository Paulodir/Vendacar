<div class="container">
<!--    <hr class="featurette-divider">
    <form class="form-inline my-2 my-lg-0">
        <input type="hidden" name="id" value="">
        <div class="form-group">
            <label for="Veiculo">Pesquizar</label>
            <select class="form-control" id="Veiculo" name="Veiculo">

                <?php
//                if (count($resultados) > 0) {
//                    echo '<option value="">&#x02315 Procurar Veículo</option>';
//                    foreach ($resultados as $r) {
//                        echo '<option data-target="#seleciona" value="' . $r->id . '">' . $r->nomeVeiculo . '</option>' .'<a id="seleciona" type="submit" href=" <?= base_url("Visitante/Veiculo") . "/" . $v->id ?>"/>'. PHP_EOL;
//                    }
//                } else {
//                    echo '<option value="">&#x02315 Nenhum Veículo Cadastrado</option>';
//                }
                ?> 
                
            </select>
        </div>
    </form>-->
    <?php
    if (count($veiculos) > 0) {
        foreach ($veiculos as $v) {
            echo '<hr class="featurette-divider">';
            echo '<div class="row featurette">';
            echo '<div class="col-md-7 order-md-2">';
            echo '<h4 class="text-danger card-subtitle"><b>' . $v->nomeVeiculo . '</b></h4><br>';
            echo '<h4 class="text-primary card-subtitle"><b>R$ ' . $v->valorVeiculo . '</b></h4>';
            echo '<p class="card-text"><b>Detalhes<br>';
            echo 'Montadora: ' . ucwords(strtolower($v->nomeMontadora)) . '  Ano: ' . $v->ano . ' Cor: ' . $v->cor . '<br><br>';
            echo 'Opcionais<br>';
            $opcionais = "";
            foreach ($acessorios as $item) {
                if ($item->id == $v->id)
                    $opcionais .= $item->opcionais . ", ";
            }
            $opcionais = rtrim($opcionais, ', ');
            echo $opcionais . '.';
            echo '<p><a href="' . base_url('Visitante/Veiculo') . '/' . $v->id . '" class="text-info">Continue Lendo...</a></p>';
            echo '</div>';
            echo '<div class="col-md-5 order-md-1">';
            foreach ($foto as $primeira) {
                if ($primeira->veiculo_id == $v->id)
                    echo '<img class="col-md-12" width="500" height="300" src="' . base_url('Uploads/' . $v->id . '/' . $primeira->nome) . '">';
            }
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<br><br><h1>Nenhum Veiculo Cadastrado</h1><br><br>';
    }
    ?>
    <hr class="featurette-divider">
</div>