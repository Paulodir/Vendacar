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
                <img src="<?= base_url('Incluir/logo.png') ?>" width="110" height="55" class="d-inline-block align-top" alt="">
                Vendacar
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
                            <a href="<?= base_url('Montadora/cadastrar'); ?>" class="dropdown-item">Cadastrar</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" id="menuModelos" class="nav-link dropdown-toggle" data-toggle="dropdown">Modelos</a>
                        <div class="dropdown-menu" aria-labelledby="menuModelos">
                            <a href="<?= $this->config->base_url() . 'Modelo/listar'; ?>" class="dropdown-item">Listar</a>
                            <a href="<?= base_url('Modelo/cadastrar'); ?>" class="dropdown-item">Cadastrar</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" id="menuVeiculos" class="nav-link dropdown-toggle" data-toggle="dropdown">Veiculos</a>
                        <div class="dropdown-menu" aria-labelledby="menuVeiculos">
                            <a href="<?= $this->config->base_url() . 'Veiculo/listar'; ?>" class="dropdown-item">Listar</a>
                            <a href="<?= base_url('Veiculo/cadastrar'); ?>" class="dropdown-item">Cadastrar</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" id="menuClientes" class="nav-link dropdown-toggle" data-toggle="dropdown">Clientes</a>
                        <div class="dropdown-menu" aria-labelledby="menuClientes">
                            <a href="<?= base_url('Cliente/listar'); ?>" class="dropdown-item">Listar</a>
                            <a href="<?= base_url('Cliente/cadastrar'); ?>" class="dropdown-item">Cadastrar</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" id="menuSetores" class="nav-link dropdown-toggle" data-toggle="dropdown">Setores</a>
                        <div class="dropdown-menu" aria-labelledby="menuSetores">
                            <a href="<?= base_url('Setor/listar'); ?>" class="dropdown-item">Listar</a>
                            <a href="<?= base_url('Setor/cadastrar'); ?>" class="dropdown-item">Cadastrar</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" id="menuFuncionarios" class="nav-link dropdown-toggle" data-toggle="dropdown">Funcionários</a>
                        <div class="dropdown-menu" aria-labelledby="menuFuncionarios">
                            <a href="<?= base_url('Funcionario/listar'); ?>" class="dropdown-item">Listar</a>
                            <a href="<?= base_url('Funcionario/cadastrar'); ?>" class="dropdown-item">Cadastrar</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" id="menuAcessorios" class="nav-link dropdown-toggle" data-toggle="dropdown">Acessórios</a>
                        <div class="dropdown-menu" aria-labelledby="menuAcessorios">
                            <a href="<?= base_url('Acessorio/listar'); ?>" class="dropdown-item">Listar</a>
                            <a href="<?= base_url('Acessorio/cadastrar'); ?>" class="dropdown-item">Cadastrar</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" id="menuFormasPagamento" class="nav-link dropdown-toggle" data-toggle="dropdown">Formas de Pagamento</a>
                        <div class="dropdown-menu" aria-labelledby="menuFormasPagamento">
                            <a href="<?= base_url('FormaPagamento/listar'); ?>" class="dropdown-item">Listar</a>
                            <a href="<?= base_url('FormaPagamento/cadastrar'); ?>" class="dropdown-item">Cadastrar</a>
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
