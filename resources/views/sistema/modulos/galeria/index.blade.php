@extends('sistema.layoutSistema')

@section('content')
    <h3>Galeria de Fotos</h3>
    <hr>
    <a class="btn btn-primary" style="margin-bottom: 1em" href="{{route('galeria.formCadastro')}}"> Cadastrar Nova
        Galeria</a>
    @if(!count($galerias))
        <p class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Nenhum Registro encontrado</p>
    @else
        <table class="table" style="background: #FFF; border: none; border-radius: 0.35em">
            <thead>
            <tr>
                <th class="hidden-xs">#</th>
                <th>Imagem</th>
                <th>Titulo</th>
                <th>Data</th>
                <th>URL</th>
                <th>Publicado</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            {{!$conta=1}}
            @foreach($galerias as $galeria)
                <tr id="lin{{$galeria->id}}">
                    <td>{{$conta++}}</td>
                    <td><img src="{{asset('uploads/'.$galeria->capa_fotos)}}" alt="{{$galeria->titulo_fotos}}" width="150"></td>
                    <td>{{$galeria->titulo_fotos}}</td>
                    <td>{{$galeria->dataHoraCriado()}}</td>
                    <td>{{$galeria->url_fotos}}</td>
                    <td>{{$galeria->usuario->name}}</td>
                    <td width="70">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-cog"></span> Ação <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" style="right: 0; left: auto; min-width:100px">
                                <li><a href="{{route('galeria.editar',$galeria->id)}}"><span
                                                class="glyphicon glyphicon-pencil"></span> Editar</a></li>
                                <li><a href="javascript://" data-toggle="modal" data-target="#dialog"
                                       onclick="chamaModal('Apagar Galeria - {{$galeria->titulo_fotos}}', '{{$galeria->id}}', '{{action('MsgController@excluirGaleria')}}', '')"><span
                                                class="glyphicon glyphicon-trash"></span> Excluir</a></li>
                            </ul>
                        </div>
                    </td>
            @endforeach
            </tbody>
        </table>
        <nav class="text-center">
            {!!  $galerias->render()!!}
        </nav>
    @endif
@endsection
