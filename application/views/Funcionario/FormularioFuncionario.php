<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $this->config->base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= (isset($funcionario)) === true ? 'Alteração' : 'Cadastro' ?> de Funcionários</li>
        </ol>
    </nav>
    <?= ($this->session->flashdata('retorno')) ? $this->session->flashdata('retorno') : ''; ?>
    <?= validation_errors(); //var_dump($funcionario)?>
    <div class="row"><div class="col-offset-md-4"></div>
        <div class="col-md-5 col-xs-12">
            <form action="" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="id" value="">
                <div class="form-group">
                    <label for="Nome">Nome Funcionario</label>
                    <input class="form-control" type="text" name="Nome" id="Nome" value="<?= (isset($funcionario)) ? $funcionario->nomeFuncionario : set_value('Nome'); ?>">
                </div>
                <div class="form-group">
                    <label for="Cpf">Cpf</label>
                    <input class="form-control" type="text" name="Cpf" id="Cpf" value="<?= (isset($funcionario)) ? $funcionario->cpf : set_value('Cpf'); ?>">
                </div>
                <div class="form-group">
                    <label for="Rg">RG</label>
                    <input class="form-control" type="text" name="Rg" id="Rg" value="<?= (isset($funcionario)) ? $funcionario->rg : set_value('Rg'); ?>">
                </div>
                <div class="form-group">
                    <label for="Genero">Gênero</label>
                    <select class="form-control" id="Genero" name="Genero">
                        <option value="">Selecione o Gênero</option>;
                        <option <?= (isset($funcionario)) && (($funcionario->genero) == 1) ? ' selected ' : ''; ?>value="1">Masculino</option>
                        <option <?= (isset($funcionario)) && (($funcionario->genero) == 2) ? ' selected ' : ''; ?>value="2">Feminino</option>
                        <option <?= (isset($funcionario)) && (($funcionario->genero) == 3) ? ' selected ' : ''; ?>value="3">Indefinido</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Nascimento">Data de Nascimento</label>
                    <input class="form-control" type="date" name="Nascimento" id="Nascimento" value="<?= (isset($funcionario)) ? $funcionario->dataNascimento : set_value('Nascimento'); ?>">
                </div>
                <div class="form-group">
                    <label for="Endereco">Endereço</label>
                    <input class="form-control" type="text" name="Endereco" id="Endereco" value="<?= (isset($funcionario)) ? $funcionario->endereco : set_value('Endereco'); ?>">
                </div>

                <div class="form-group">
                    <label for="Bairro">Bairro</label>
                    <input class="form-control" type="text" name="Bairro" id="Bairro" value="<?= (isset($funcionario)) ? $funcionario->bairro : set_value('Bairro');?>">
                </div>
                <div class="form-group">
                    <label for="Cidade">Cidade</label>
                    <input class="form-control" type="text" name="Cidade" id="Cidade" value="<?= (isset($funcionario)) ? $funcionario->cidade : set_value('Cidade');?>">
                </div>
                <div class="form-group">
                    <label for="Estado">Estado</label>
                    <input class="form-control" type="text" name="Estado" id="Estado" value="<?= (isset($funcionario)) ? $funcionario->estado : set_value('Estado'); ?>">
                </div>
                <div class="form-group">
                    <label for="Celular">Nº Celular</label>
                    <input class="form-control" type="text" name="Celular" id="Celular" value="<?= (isset($funcionario)) ? $funcionario->celular : set_value('Celular'); ?>">
                </div>
                <div class="form-group">
                    <label for="Salario">Salário</label>
                    <input class="form-control" type="text" name="Salario" id="Salario" value="<?= (isset($funcionario)) ? $funcionario->salario : set_value('Salario'); ?>">
                </div>
                <div class="text-center mb-5">
                    <button class="btn btn-success" type="submit"><i class="fas fa-check"></i><?= (isset($funcionario)) === true ? ' Alterar' : ' Salvar' ?></button>
                    <a class="btn btn-warning" href="<?= base_url('Funcionario/listar'); ?>"><i class="fas fa-undo"></i> Cancelar</a> 
                </div>
            </form>
        </div>
    </div>
</div>
