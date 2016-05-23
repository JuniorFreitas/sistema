@extends('sistema.layoutSistema')
@section('content')
    <div class="col-md-12">
        <h3>Editar Galeria</h3>
        <div class="alert alert-danger" id="erro"><i class="fa fa-exclamation-triangle"></i> Verifique os campos
        </div>
        <div class="well">
            <form class="form-horizontal" method="post" action="{{route('galeria.atualiza',$galeria->id)}}"
                  enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="form-group" id="vtitulo">
                    <label class="col-md-1 control-label" for="Titulo:">Titulo:</label>
                    <div class="col-md-11">
                        <input id="titulo" name="titulo" value="{{$galeria->titulo_fotos}}" min="" type="text" placeholder="Informe um titulo"
                               class="form-control input-md">
                    </div>
                </div>

                <div class="form-group" id="vurl">
                    <label class="col-md-1 control-label" for="Url:">Url:</label>
                    <div class="col-md-11">
                        <input id="url" name="url" value="{{$galeria->url_fotos}}" min="" type="text" placeholder="Informe uma url"
                               class="form-control input-md">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-8">
                            <b>Foto de Capa:</b>
                            <img src="{{asset('uploads')."/".$galeria->capa_fotos}}" class="img-responsive" alt="Foto de capa">
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group" id="vfile-0">
                            <label class="col-md-2 control-label" for="Imagem:">Imagem: </label>
                            <div class="col-md-10">
                                <input id="file-0" class="file" min="1"
                                       accept="image/png,image/jpg,image/bmp,image/jpeg"
                                       type="file" name="imagem">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="vativo">
                            <label class="col-md-2 control-label" for="Ativo:">Ativo: <i class="fa fa-eyer"></i></label>
                            <div class="col-md-10">
                                <select name="ativo" id="ativo" class="form-control">
                                    @if($galeria->ativo_fotos == "S")
                                        <option value="S" selected>Sim</option>
                                        <option value="N">Não</option>
                                    @else
                                        <option value="N" selected>Não</option>
                                        <option value="S">Sim</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <button class="btn btn-danger btn-block">Editar</button>
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
                if (!validaVazio("titulo", 2)) {
                    erro++;
                }
                if (!validaVazio("url", 2)) {
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