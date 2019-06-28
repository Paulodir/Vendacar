<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>VendaCar</title>
        <link href="<?= base_url('Incluir/Bootstrap.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('Incluir/FontAwesome.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('Incluir/chosen.css') ?>" rel="stylesheet" type="text/css"/>
        <style type="text/css">
            .featurette-divider {
                color: #f00;background-color: #f00;height: 1px;
            }
            .menu2 a {
                float: left;
                color: red;
                text-transform: uppercase;
                margin: 0 15px;
            }            
            a:hover, a:link, a:visited {
                color: blue;
                text-decoration: none!important;
            }
            footer{
                background-color:#D3D3D3
            }
            .copyright{
                float: right;
                position:absolute;
                bottom:0;
                right: 2px;
            }
        </style>
    </head>
    <body style="<?= 'background-image:url(' . base_url('Incluir/background.jpg') ?>">
<!--        <?//var_dump($resultados);?>-->
        <header>
            <div class="row d-none d-md-block">
                <img class="col-md-12 expand-md" height="175px" src="<?= base_url('Incluir/Header.jpg') ?>">
            </div>
            <nav class="navbar navbar-expand-md navbar-light" style="background-color:#d3d3d3">
                <a class="navbar-brand" href="<?= base_url(); ?>">
                    <img src="<?= base_url('Incluir/logo.png') ?>" width="110" height="55" class="d-inline-block align-top" alt="" style="margin:0">
                    VENDACAR
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('Visitante/Home') ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('Visitante/Veiculos') ?>">Veículos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('Visitante/Contato') ?>">Fale Conosco</a>
                        </li>
                    </ul>

                </div>

                <?php if ($this->session->userdata('logado')): ?>
                    <form class="form-inline mt-2 mt-md-0">
                        <a href="<?= base_url('Veiculo/Listar') ?>" class="btn btn-outline-success my-2 my-sm-0" >Área Administrativa</a>
                    </form>
                <?php endif ?> 
            </nav>
        </header>
