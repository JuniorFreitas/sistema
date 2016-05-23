@extends('sistema.layoutSistema')
@section('content')
    <h3>Notícias</h3>
    <hr>
    <a class="btn btn-primary" style="margin-bottom: 1em" href="{{route('noticia.formCadastro')}}"> Cadastrar
        Uma Nova Notícia</a>
    <a class="btn btn-danger" href="javascript://" style="margin-bottom: 1em" data-toggle="modal" data-target="#dialog"
       onclick="chamaModal('Nova Categoria', '', '{{route('categoria.index')}}', '')"> Cadastrar Uma Nova
        Categoria</a>


    @if(!count($noticias))
        <p class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Nenhum Registro encontrado</p>
    @else
        <table class="table" style="background: #FFF; border: none; border-radius: 0.35em">
            <thead>
            <tr>
                <th class="hidden-xs">#</th>
                <th>Imagem</th>
                <th>Titulo</th>
                <th class="hidden-xs">Categoria</th>
                <th class="hidden-xs">Data</th>
                <th class="hidden-xs">Publicado</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            {{!$conta=1}}
            @foreach($noticias as $noticia)
                <tr id="lin{{$noticia->id}}">
                    <td>{{$conta++}}</td>
                    <td><img src="{{asset('uploads')."/".$noticia->img_noticias}}" alt="" width="120"></td>
                    <td>{{$noticia->titulo_noticias}}</td>
                    <td>{{$noticia->cat->nome_tipos}}</td>
                    <td>{{$noticia->dataHoraProgramada()}}</td>
                    <td>{{$noticia->usuarioCriado->name}}</td>
                    <td width="70">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-cog"></span> Ação <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" style="right: 0; left: auto; min-width:100px">
                                <li><a href="{{route('noticia.editar',$noticia->id)}}"><span
                                                class="glyphicon glyphicon-pencil"></span> Editar</a></li>
                                <li>
                                <li>
                                    <a href="javascript://" data-toggle="modal" data-target="#dialog"
                                       onclick="chamaModal('Apagar Notícia - {{$noticia->titulo_noticias}}', '{{$noticia->id}}', '{{action('MsgController@excluir')}}', '')"><span
                                                class="glyphicon glyphicon-trash"></span> Excluir</a></li>
                            </ul>
                        </div>
                    </td>
            @endforeach
            </tbody>
        </table>
        <nav class="text-center">
            {!!  $noticias->render()!!}
        </nav>
    @endif
@endsection