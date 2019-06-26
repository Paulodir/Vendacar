<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ADMIN VendaCar Veículos</title>
        <link href="<?= base_url('Incluir/Bootstrap.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('Incluir/FontAwesome.css') ?>" rel="stylesheet" type="text/css"/>        
        <link href="<?= base_url('Incluir/dataTables.bootstrap4.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('Incluir/chosen.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('Incluir/fileinput.css') ?>" rel="stylesheet" type="text/css"/>
        <style type="text/css">
            .custom-toggler.navbar-toggler {
                border-color: rgb(0, 123, 255);
            }
            .custom-toggler .navbar-toggler-icon {
                background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(0, 123, 255, 0.7)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-light navbar-expand-xl" style="background-color: #d3d3d3; color: #00FF00;">
            <a class="navbar-brand " href="<?= $this->config->base_url(); ?>">
                <img src="<?= base_url('Incluir/logo.png') ?>" width="110" height="55" class="d-inline-block align-top" alt="">
                Vendacar
            </a>
            <button class="navbar-toggler ml-auto custom-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a href="#" id="menuMontadoras" class="nav-link dropdown-toggle text-primary" data-toggle="dropdown">Montadoras</a>
                        <div class="dropdown-menu" aria-labelledby="menuMontadoras">
                            <a href="<?= base_url('Montadora/listar'); ?>" class="dropdown-item text-primary">Listar</a>
                            <a href="<?= base_url('Montadora/cadastrar'); ?>" class="dropdown-item text-primary">Cadastrar</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" id="menuModelos" class="nav-link dropdown-toggle text-primary" data-toggle="dropdown">Modelos</a>
                        <div class="dropdown-menu" aria-labelledby="menuModelos">
                            <a href="<?= base_url('Modelo/listar'); ?>" class="dropdown-item text-primary">Listar</a>
                            <a href="<?= base_url('Modelo/cadastrar'); ?>" class="dropdown-item text-primary">Cadastrar</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" id="menuVeiculos" class="nav-link dropdown-toggle text-primary" data-toggle="dropdown">Veiculos</a>
                        <div class="dropdown-menu" aria-labelledby="menuVeiculos">
                            <a href="<?= base_url('Veiculo/listar'); ?>" class="dropdown-item text-primary">Listar</a>
                            <a href="<?= base_url('Veiculo/cadastrar'); ?>" class="dropdown-item text-primary">Cadastrar</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" id="menuAcessorios" class="nav-link dropdown-toggle text-primary" data-toggle="dropdown">Acessórios</a>
                        <div class="dropdown-menu" aria-labelledby="menuAcessorios">
                            <a href="<?= base_url('Acessorio/listar'); ?>" class="dropdown-item text-primary">Listar</a>
                            <a href="<?= base_url('Acessorio/cadastrar'); ?>" class="dropdown-item text-primary">Cadastrar</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" id="menuClientes" class="nav-link dropdown-toggle text-primary" data-toggle="dropdown">Clientes</a>
                        <div class="dropdown-menu" aria-labelledby="menuClientes">
                            <a href="<?= base_url('Cliente/listar'); ?>" class="dropdown-item text-primary">Listar</a>
                            <a href="<?= base_url('Cliente/cadastrar'); ?>" class="dropdown-item text-primary">Cadastrar</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" id="menuSetores" class="nav-link dropdown-toggle text-primary" data-toggle="dropdown">Setores</a>
                        <div class="dropdown-menu" aria-labelledby="menuSetores">
                            <a href="<?= base_url('Setor/listar'); ?>" class="dropdown-item text-primary">Listar</a>
                            <a href="<?= base_url('Setor/cadastrar'); ?>" class="dropdown-item text-primary">Cadastrar</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" id="menuFuncionarios" class="nav-link dropdown-toggle text-primary" data-toggle="dropdown">Funcionários</a>
                        <div class="dropdown-menu" aria-labelledby="menuFuncionarios">
                            <a href="<?= base_url('Funcionario/listar'); ?>" class="dropdown-item text-primary">Listar</a>
                            <a href="<?= base_url('Funcionario/cadastrar'); ?>" class="dropdown-item text-primary">Cadastrar</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" id="menuNotasFiscais" class="nav-link dropdown-toggle text-primary" data-toggle="dropdown">Notas Fiscais</a>
                        <div class="dropdown-menu" aria-labelledby="menuNotasFiscais">
                            <a href="<?= base_url('NotaFiscal/cadastrar'); ?>" class="dropdown-item text-primary">Gerar Nova NF</a>
                            <a href="<?= base_url('NotaFiscal/listar'); ?>" class="dropdown-item text-primary">Resumo NFs Emitidas</a>
                            <a href="<?= base_url('FormaPagamento/listar'); ?>" class="dropdown-item text-primary">Formas de Pagamento Disponíveis</a>
                            <a href="<?= base_url('FormaPagamento/cadastrar'); ?>" class="dropdown-item text-primary">Cadastrar Formas de Pagamento</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" id="menuUsuarios" class="nav-link dropdown-toggle text-primary" data-toggle="dropdown">Usuarios</a>
                        <div class="dropdown-menu" aria-labelledby="menuUsuarios">                            
                            <a href="<?= base_url('Usuario/listar'); ?>" class="dropdown-item text-primary">Listar</a>
                            <a href="<?= base_url('Usuario/cadastrar'); ?>" class="dropdown-item text-primary">Cadastrar</a>
                            <a href="<?= base_url('Usuario/Redefinir') ?>" class="dropdown-item text-primary">Mudar Minha Senha</a>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item">
                        <a class="btn btn-sm btn-outline-danger" href="<?= base_url('Usuario/deslogar'); ?>"><i class="fas fa-sign-out-alt"></i> Deslogar</a>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
