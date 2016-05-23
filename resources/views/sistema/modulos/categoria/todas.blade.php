<h4>CATEGORIAS CADASTRADAS</h4>
<hr>
@foreach($categorias as $categoria)
    {{$categoria->nome_tipos}}<br>
@endforeach
<hr>

<form method="post" class="form-horizontal" id="formCadastra">
    {!! csrf_field() !!}
    <div class="form-group" id="vtitulo">
        <label class="col-md-1 control-label" for="Titulo:">Titulo:</label>
        <div class="col-md-11">
            <input id="titulo" name="titulo" value="" min="" type="text" placeholder="Informe o nome para Categoria"
                   class="form-control input-md">
        </div>
    </div>

    <div class="form-group" id="vativo">
        <label class="col-md-1 control-label" for="Ativo:">Ativo: </label>
        <div class="col-md-11">
            <select name="ativo" id="ativo" class="form-control">
                <option value="" selected>Selecione uma opção</option>
                <option value="S">Sim</option>
                <option value="N">Não</option>
            </select>
        </div>
    </div>

    <button class="btn btn-danger btn-block"> Cadastrar</button>
</form>

<script type="text/javascript">
    $(function () {
        $("#erro").hide();
        $("form").on("submit", function (e) {
            var erro = 0;
            if (!validaVazio("titulo", 5)) {
                erro++;
            }
            if (!validaSelect("ativo")) {
                erro++;
            }
            if (erro > 0) {
                $("#erro").html('<i class="fa fa-warning"></i> Por favor, verifique o(s) campo(s) marcado(s)!').fadeIn();
                setTimeout(function () {
                            $("#erro").fadeOut();
                        }, 5000
                );
                return false;
            }
            if (erro == 0) {
                return true;
            }
            e.preventDefault();
        });
        return false;
    });
</script>