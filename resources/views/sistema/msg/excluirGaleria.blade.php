<div class="form-horizontal text-center" id="sairSi">
    <h4>Você tem certeza que quer excluir esse registro?</h4>
    <button id="simS" name="simS" class="btn btn-primary">SIM</button>
    <button id="naoS" name="naoS" class="btn btn-danger" data-dismiss="modal">NÃO</button>
</div>
<script type="text/javascript">
    $('#simS').on('click', function () {
        var id = "{{$_GET['valor']}}";
        $('#conteudoModal').html('Excluindo...');
        $.get("{{route('galeria.exclui',$_GET['valor'])}}"
                , function (data) {
                    $('#conteudoModal').html("Registro removido com sucesso");
                    $('#lin' + id).fadeOut(500);
                    $('#dialog').modal('hide');
                })
    });
</script>