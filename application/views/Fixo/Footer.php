<script src="<?= base_url('Incluir/Jquery.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('Incluir/Bootstrap.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('Incluir/AjaxJquery.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('Incluir/Jquery.Mask.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('Incluir/jquery.dataTables.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('Incluir/dataTables.bootstrap4.js') ?>"type="text/javascript"></script>
<script src="<?= base_url('Incluir/chosen.jquery.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('Incluir/fileinput.js') ?>" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
    $(document).ready(function () {
        $('table').not('.semDataTables').DataTable({
            "language": {
                "lengthMenu": "Mostrando _MENU_ registros por página",
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sFirst": "Primeiro",
                    "sPrevious": "Anterior",
                    "sNext": "Seguinte",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            }
        });
        setTimeout(function () {
            $('.alert').html('');
            $('.alert').removeClass();
        }, 7500);

        $('a[data-confirm]').click(function (ev) {
            var href = $(this).attr('href');
            if (!$('#confirm-delete').length) {
                $('body').append('<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-header bg-danger text-white"><b>EXCLUIR REGISTRO?</b><button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Deseja realmente excluir este Registro?<br>Isto é  Irreversível!</div><div class="modal-footer"><button type="button" class="btn btn-success" data-dismiss="modal"><i class="fas fa-undo"></i> Cancelar</button><a class="btn btn-danger text-white" id="dataConfirmOk"><i class="fas fa-trash-alt"></i> Apagar</a></div></div></div></div>');
            }
            $('#dataConfirmOk').attr('href', href);
            $('#confirm-delete').modal({show: true});
            return false;
        });
//        $("input[name='seletorCpfCnpj']").click(function () {
//        var calcular = $("input[name='seletorCpfCnpj']:checked").val();
//                $(document).on('keydown', '#cpfCnpj', function (e) {
//        var digit = e.key.replace(/\D/g, '');
//                var value = $(this).val().replace(/\D/g, '');
//                var size = value.concat(digit).length;
//                if (seletorCpfCnpj == 1) {
//        $(this).mask(? '000.000.000-00');
//        } else if (seletorCpfCnpj == 2) {
//        $(this).mask(? '000.000.000-00' : '00.000.000/0000-00');
//        };
//        });
//        } 
//        );
        $("input[name='seletorCpfCnpj']").click(function () {
            $('#cpfCnpj').val('');
            var seletor = $("input[name='seletorCpfCnpj']:checked").val();
            if (seletor == 1) {
                $('#cpfCnpj').mask('000.000.000-00');
                $("#labelRgIe").html("RG");
                $("#labelNascimento").html("Data de Nascimento");
            } else if (seletor == 2) {
                $('#cpfCnpj').mask('00.000.000/0000-00');
                $("#labelRgIe").html("Inscrição Estadual");
                $("#labelNascimento").html("Data de Fundação");
            }
        });
        $("#Valor, #Salario").mask("000.000.000.000.000,00", {reverse: true});
        $('#Celular').mask('(00)00000-0000');
        $('#Cpf').mask('000.000.000-83', {reverse: true});
        $("form select").chosen({no_results_text: "Nenhum registro compatível com "});
    });

</script>
</body>
</html>
