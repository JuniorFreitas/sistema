@extends('sistema.layoutSistema')
@section('content')
    <div class="col-md-12">
        <h3>Cadastro de Notícia</h3>
        <hr>
        <div class="alert alert-danger" id="erro"><i class="fa fa-exclamation-triangle"></i></div>
        <form class="well form-horizontal" action="{{route('noticia.cadastrar')}}" method="post"
              enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="form-group" id="vtitulo">
                <label class="col-md-1 control-label" for="Titulo:">Titulo:</label>
                <div class="col-md-11">
                    <input id="titulo" name="titulo" value="" min="5" type="text" placeholder="Informe o Titulo"
                           class="form-control input-md">
                </div>
            </div>

            <div class="form-group" id="vdescricao">
                <label class="col-md-1 control-label" for="Descrição:">Subtitulo:</label>
                <div class="col-md-11">
                    <input id="descricao" name="descricao" value="" min="" type="text"
                           placeholder="Informe um subtitulo"
                           class="form-control input-md">
                </div>
            </div>

            <div class="form-group" id="vmateria">
                <label class="col-md-1 control-label" for="Materia:">Materia:</label>
                <div class="col-md-11">
                     <textarea name="materia" id="editor" cols="10" class="form-control"
                               rows="3">{{old('materia')}}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="vfile-0">
                        <label class="col-md-2 control-label" for="Imagem:">Imagem: </label>
                        <div class="col-md-10">
                            <input id="file-0" class="file" min="1" accept="image/png,image/jpg,image/bmp,image/jpeg"
                                   type="file" name="imagem">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Data <i class="fa fa-calendar"></i> :</label>
                        <div class="col-md-10">
                            <input type="text" id="data" readonly="true" class="form-control" value="{{old('data')}}"
                                   name="data" maxlength="10" size="" OnKeyPress="formatar('##/##/####', this)">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="vcategoria">
                        <label class="control-label col-md-2" for="Categoria:">Categoria:</label>
                        <div class="col-md-10">
                            <select name="categoria" id="categoria" class="form-control">
                                <option value="" selected>Selecione uma opção</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->nome_tipos}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group" id="vativo">
                        <label class="col-md-2 control-label" for="Ativo:">Ativo: <i class="fa fa-eyer"></i></label>
                        <div class="col-md-10">
                            <select name="ativo" id="ativo" class="form-control">
                                <option value="" selected>Selecione uma opção</option>
                                <option value="S">Sim</option>
                                <option value="N">Não</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group" id="vfonte">
                <label class="col-md-1 control-label" for="Fonte:">Fonte:</label>
                <div class="col-md-11">
                    <input id="fonte" name="fonte" value="" min="" type="text" placeholder="Informe a fonte"
                           class="form-control input-md">
                </div>
            </div>
            <button class="btn btn-block btn-danger">Cadastrar</button>

        </form>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('/js/tinymce/js/tinymce/tinymce.min.js')}}"></script>
    <script>
        $(function () {
            $("#erro").hide();
            $("#data").datepicker();
            $("form").on("submit", function (e) {
                var erro = 0;
                if (!validaVazio("titulo", 5)) {
                    erro++;
                }
                if (!validaVazio("fonte", 2)) {
                    erro++;
                }
                if (!validaVazio("file-0", 1)) {
                    erro++;
                }
                if (!validaSelect("ativo")) {
                    erro++;
                }
                if (!validaSelect("categoria")) {
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

    @include('sistema.filemanager')
@endsection