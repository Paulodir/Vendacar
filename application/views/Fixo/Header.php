<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Cadastro de Montadora</title>
        <link href="<?= base_url('Incluir/Bootstrap.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('Incluir/FontAwesome.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <!--
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        -->
    </head>
    <body>
        <nav class="navbar navbar-light navbar-expand-md" style="background-color: #e3f2fd;">
            <a class="navbar-brand" href="<?= $this->config->base_url(); ?>">
                <img src="<?= base_url('Incluir/mao.png') ?>" width="30" height="30" class="d-inline-block align-top" alt="">
                Sistema Gincana
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a href="#" id="menuMontadoras" class="nav-link dropdown-toggle" data-toggle="dropdown">Montadoras</a>
                        <div class="dropdown-menu" aria-labelledby="menuMontadoras">
                            <a href="<?= $this->config->base_url() . 'Montadora/listar'; ?>" class="dropdown-item">Listar</a>
                            <a href="<?= $this->config->base_url() . 'Montadora/cadastrar'; ?>" class="dropdown-item">Cadastrar</a>
                        </div>
                    </li>      
                </ul>

                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('Usuario/deslogar'); ?>">
                            Sair <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
