@extends('sistema.layoutSistema')
@section('content')
    <div class="col-md-12">
        <h3>Editar Vídeo</h3>
        <div class="alert alert-danger" id="erro"><i class="fa fa-exclamation-triangle"></i> Verifique os campos
        </div>
        <div class="well">
            <form method="post" action="{{route('videos.atualiza',$video->id)}}" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="form-group col-md-12" id="vtitulo">
                    <label class="control-label" for="Titulo">Titulo</label>
                    <input id="titulo" name="titulo" value="{{$video->nome_video}}" min="3" type="text" placeholder="Informe um titulo"
                           class="form-control input-md">
                </div>

                <div class="form-group col-md-12" id="vurl">
                    <label class="control-label" for="url">URL</label>
                    <input id="url" name="url" value="{{$video->url_video}}" min="3" type="text" placeholder="Informe uma url"
                           class="form-control input-md">
                </div>

                <div class="form-group col-md-4" id="vativo">
                    <label class="control-label" for="filebutton">Ativo<i class="fa fa-eyer"></i></label>
                    <select name="ativo" id="ativo" class="form-control">
                        @if($video->ativo_video=='S')
                            <option value="sim" selected>Sim</option>
                            <option value="não">Não</option>
                        @else
                            <option value="não" selected>Não</option>
                            <option value="sim">Sim</option>
                        @endif
                    </select>
                </div>

                <button class="btn btn-primary btn-block">Editar</button>
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