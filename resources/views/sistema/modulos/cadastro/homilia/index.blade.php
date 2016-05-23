@extends('sistema.layoutSistema')

@section('content')
    <h3>Homílias Dominical</h3>
    <hr>
    <a class="btn btn-primary" style="margin-bottom: 1em" href="{{route('homilia.formCadastro')}}"> Cadastrar Nova
        Homilia</a>
    @if(!count($homilias))
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
            @foreach($homilias as $homilia)
                <tr id="lin{{$homilia->id}}">
                    <td>{{$conta++}}</td>
                    <td><img src="http://i1.ytimg.com/vi/{{$homilia->url}}/0.jpg" alt="{{$homilia->titulo}}" width="150"></td>
                    <td>{{$homilia->titulo}}</td>
                    <td>{{$homilia->dataHoraCriado()}}</td>
                    <td>{{$homilia->url}}</td>
                    <td>{{$homilia->usua->name}}</td>
                    <td width="70">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-cog"></span> Ação <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" style="right: 0; left: auto; min-width:100px">
                                <li><a href="{{route('homilia.editar',$homilia->id)}}"><span
                                                class="glyphicon glyphicon-pencil"></span> Editar</a></li>
                                <li><a href="javascript://" data-toggle="modal" data-target="#dialog"
                                       onclick="chamaModal('Apagar Homila - {{$homilia->titulo}}', '{{$homilia->id}}', '{{action('MsgController@excluirHomilia')}}', '')"><span
                                                class="glyphicon glyphicon-trash"></span> Excluir</a></li>
                            </ul>
                        </div>
                    </td>
            @endforeach
            </tbody>
        </table>
        <nav class="text-center">
            {!!  $homilias->render()!!}
        </nav>
    @endif
@endsection
