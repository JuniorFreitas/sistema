@extends('sistema.layoutSistema')
@section('content')
    <div class="col-md-12">
        <h3>Cadastro de Vídeo</h3>
        <div class="alert alert-danger" id="erro"><i class="fa fa-exclamation-triangle"></i> Verifique os campos
        </div>
        <div class="well">
            <form method="post" action="{{route('videos.cadastrar')}}" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="form-group col-md-12" id="vtitulo">
                    <label class="control-label" for="Titulo">Titulo</label>
                    <input id="titulo" name="titulo" value="" min="3" type="text" placeholder="Informe um titulo"
                           class="form-control input-md">
                </div>

                <div class="form-group col-md-12" id="vurl">
                    <label class="control-label" for="url">URL</label>
                    <input id="url" name="url" value="" min="3" type="text" placeholder="Informe uma url"
                           class="form-control input-md">
                </div>

                <div class="form-group col-md-4" id="vativo">
                    <label class="control-label" for="filebutton">Ativo<i class="fa fa-eyer"></i></label>
                    <select name="ativo" id="ativo" class="form-control">
                        <option value="" selected>Selecione uma Opção</option>
                        <option value="S">Sim</option>
                        <option value="N">Não</option>
                    </select>
                </div>

                <button class="btn btn-primary btn-block">Cadastrar</button>
            </form>
        </div>
        <br>

    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function () {
            $("#erro").hide();

            $("form").on("submit", function (e) {
                var erro = 0;
                if (!validaVazio("titulo", 5)) {
                    erro++;
                }
                if (!validaVazio("url", 5)) {
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
@endsection