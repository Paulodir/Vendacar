<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
    <div class="col-12">
        <span style="color:red;font-size:11px;"><b>(*) Campos Obrigatórios</b></span>
    </div>
    <form action=""  method="post">
        <div>
            <div class="col-12">
                <h2 >Informações Pessoais</h2>
                <p></p>
            </div>
            <div class="col-12">
                <div class="form-group ">
                    <label for="nome">Nome</label>
                    <span style="color:red;font-size:12px;font-weight:bold;"><b>*</b></span>
                    <input type="text" id="nome" name="nome" class="form-control input-name" data-validation="required" placeholder="Insira seu Nome" >        
                </div>
            </div>
            <div class="col-12">
                <div class="form-group ">
                    <label for="email">Email</label>
                    <span style="color:red;font-size:12px;font-weight:bold;"><b>*</b></span>
                    <input type="email" id="email" name="email" class="form-control input-email" data-validation="required email" placeholder="Insira seu Email">        
                </div>
            </div>
            <div class="col-6">
                <div class="form-group ">
                    <label for="telefone">Telefone</label>
                    <input type="text" id="telefone" name="telefone" class="form-control input-telefone"  placeholder="(00)0000-0000">        
                </div>
            </div>
            <div class="col-6">
                <div class="form-group ">
                    <label for="celular">Celular</label>
                    <input type="text" id="celular" name="celular" class="form-control input-celular" placeholder="(00)00000-0000">        
                </div>
            </div>
            <div class="col-12">
                <div class="form-group ">
                    <label for="mensagem">Mensagem</label>
                    <textarea id="mensagem" name="mensagem" class="form-control textarea-mensagem" placeholder="Faça um Orçamento sem compromisso ou tire aqui suas dúvidas..." rows="5"></textarea>        
                </div>
            </div>
        </div>
        <div class="text-center mb-2 col-12">
            <button class="btn btn-primary" type="submit"><i class="far fa-envelope"></i> Enviar</button>
        </div>
    </form>
</div>

