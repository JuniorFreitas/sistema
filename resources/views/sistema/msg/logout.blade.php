<div class="form-horizontal text-center" id="sairSi">
    <h4>Você Deseja Sair do Sistema?</h4>
    <button id="simS" name="simS" class="btn btn-primary">SIM</button>
    <button id="naoS" name="naoS" class="btn btn-danger" data-dismiss="modal">NÃO</button>
</div>
<script type="text/javascript">
    $('#simS').on('click', function(){
        $('#conteudoModal').html('Saindo...');
            window.location="{{url('/logout')}}";
    });
</script>