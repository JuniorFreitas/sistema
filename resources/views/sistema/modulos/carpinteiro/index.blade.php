@extends('sistema.layoutSistema')

@section('content')
    <h3>Carpinteiro</h3>
    <hr>
    <a class="btn btn-primary" style="margin-bottom: 1em" href="{{route('carpinteiro.formCadastro')}}"> Cadastrar Nova
        Edição</a>
    @if(!count($carpinteiros))
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
            @foreach($carpinteiros as $carpinteiro)
                <tr id="lin{{$carpinteiro->id}}">
                    <td>{{$conta++}}</td>
                    <td><img src="{{asset('uploads/'.$carpinteiro->img_carpinteiro)}}" alt="{{$carpinteiro->titulo_carpinteiro}}" width="150"></td>
                    <td>{{$carpinteiro->titulo_carpinteiro}}</td>
                    <td>{{$carpinteiro->dataHoraCriado()}}</td>
                    <td>{{$carpinteiro->arquivo_carpinteiro}}</td>
                    <td>{{$carpinteiro->usuario->name}}</td>
                    <td width="70">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-cog"></span> Ação <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" style="right: 0; left: auto; min-width:100px">
                                <li><a href="{{route('carpinteiro.editar',$carpinteiro->id)}}"><span
                                                class="glyphicon glyphicon-pencil"></span> Editar</a></li>
                                <li><a href="javascript://" data-toggle="modal" data-target="#dialog"
                                       onclick="chamaModal('Apagar Edição - {{$carpinteiro->titulo_carpinteiro}}', '{{$carpinteiro->id}}', '{{action('MsgController@excluirCarpinteiro')}}', '')"><span
                                                class="glyphicon glyphicon-trash"></span> Excluir</a></li>
                            </ul>
                        </div>
                    </td>
            @endforeach
            </tbody>
        </table>
        <nav class="text-center">
            {!!  $carpinteiros->render()!!}
        </nav>
    @endif
@endsection
