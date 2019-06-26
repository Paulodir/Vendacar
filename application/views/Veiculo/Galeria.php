<style>
    .miniatura {
        height: 75px;
        border: 1px solid #000;
        margin: 10px 5px 0 0;
    } 
</style>
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Galeria do Veículo <?= (isset($veiculo)) === true ? $veiculo->nomeVeiculo : 'Inválido' ?> </li>
        </ol>
    </nav>
    <?= ($this->session->flashdata('retorno')) ? $this->session->flashdata('retorno') : ''; ?>
    <?= validation_errors(); //var_dump($retorno)?>
    <div class="row">
        <div class="mt-3 col-md-4">
            <form method="post" action="" class="border rounded text-center" enctype="multipart/form-data">
                <input type="hidden" name="id" value="">
                <h4 id="label-form" class="card-header bg-transparent "><i class="fas fa-edit"></i>Cadastro de Imagens</h4>

                <div class="form-group ">
                    <label for="files">Escolha os arquivos</label>
                    <input type="file" class="form-control-file input-group" id="files" name="files[]" multiple data-target="#fileSelect" />
                    <a id="fileSelect" ></a>
                </div>
                <hr>            
            <!--<div class="form-group">
                    <label custom-file-label for="files">Insira imagens</label>
                    <input type="file" id="files" name="files[]" multiple accept="image/*" style="display:none;" />
                </div>
                <a href="" id="fileSelect" ><h1><i class="fas fa-cloud-upload-alt"></i></h1></a>-->
                <div class="form-group ">
                    <div id="list"></div>
                </div>
                <hr>
                <div class="form-group">
                    <button  class="btn btn-success" type="submit" name="fileSubmit" value="ENVIAR">Upload</button>
                    <a class="btn btn-warning" href="<?= base_url('Imagem/cadastrar/' . $veiculo->id); ?>">Cancelar</a> 
                </div>
            </form>
        </div>

        <div class="col-md-8 mt-3">
            <form class="border rounded">
                <h5 class="card-header bg-transparent ">Fotos na Galeria | <?= (isset($veiculo)) === true ? $veiculo->nomeVeiculo : 'Veículo Inválido' ?></h5>
                <div class="row">
                    <?php foreach ($fotos as $foto): ?>         
                        <div class="col-md-4 mt-2 mb-1">
                            <div class="col-12 text-center">
                                <img class="img-thumbnail" src="<?= base_url('Uploads/' . $veiculo->id . '/' . $foto->nome) ?>" alt="Card image cap">
                                <div class="text-center">
                                    <a href="<?= base_url('Imagem/deletar/' . $veiculo->id . '/' . $foto->id) ?>" class="btn btn-sm btn-outline-danger mt-1" data-confirm="">Deletar</a>
                                </div>
                            </div>                        
                        </div>
                    <?php endforeach ?> 
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    var fileSelect = document.getElementById("fileSelect");
    var fileElem = document.getElementById("files");
    fileSelect.addEventListener("click", function (e) {
        if (fileElem) {
            fileElem.click();
        }
        e.preventDefault();
    }
    , false);
    function handleFileSelect(evt) {
        var list = document.getElementById("list").childElementCount;
        var files = evt.target.files;
        var qtde = files.length;
        var nomes = fileElem.files;
        var nome;
        if (qtde > 5 || list > 2) {
            alert('apenas 5');
            document.getElementById('files').value = "";
            return;
        } else {
            for (var i = 0, f; f = files[i]; i++) {
                if (!f.type.match('image.*')) {
                    continue;
                }
                var reader = new FileReader();
                reader.onload = (function (theFile) {
                    return function (e) {
                        var span = document.createElement('span');
                        span.innerHTML =
                                "<a href='#'><img  class='img-thumbnail miniatura'   src='" + e.target.result + "'" + "title='" + escape(theFile.name) + "'/>X</a>";
                        document.getElementById('list').insertBefore(span, null);
                        span.children[0].addEventListener("click", function (evt) {
                            span.parentNode.removeChild(span);
                        });
                    };
                })(f);
                reader.readAsDataURL(f);
            }
            return true;
        }
    }
    document.getElementById('files').addEventListener('change', handleFileSelect, false);
</script>