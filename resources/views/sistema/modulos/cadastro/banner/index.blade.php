@extends('sistema.layoutSistema')

@section('content')
    <h3>Banner</h3>
    <hr>
    <a class="btn btn-primary" style="margin-bottom: 1em" href="{{route('banner.formCadastro')}}"> Cadastrar Novo
        Banner</a>
    @if(!count($banners))
        <p class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Nenhum Registro encontrado</p>
    @else
        <table class="table" style="background: #FFF; border: none; border-radius: 0.35em">
            <thead>
            <tr>
                <th class="hidden-xs">#</th>
                <th>Imagem</th>
                <th>Titulo</th>
                <th class="hidden-xs">Visto</th>
                <th class="hidden-xs">Data</th>
                <th class="hidden-xs">Publicado</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            {{!$conta=1}}
            @foreach($banners as $banner)
                <tr id="lin{{$banner->id}}">
                    <td>{{$conta++}}</td>
                    <td><img src="{{asset('uploads')."/".$banner->img_banner}}" alt="{{$banner->titulo_banner}}" width="250"></td>
                    <td>{{$banner->titulo_banner}}</td>
                    <td></td>
                    <td>{{$banner->dataHoraCriado()}}</td>
                    <td>{{$banner->usuario->name}}</td>
                    <td width="70">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-cog"></span> Ação <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" style="right: 0; left: auto; min-width:100px">
                                <li><a href="{{route('banner.editar',$banner->id)}}"><span
                                                class="glyphicon glyphicon-pencil"></span> Editar</a></li>
                                <li><a href="javascript://" data-toggle="modal" data-target="#dialog"
                                       onclick="chamaModal('Apagar Banner - {{$banner->titulo_banner}}', '{{$banner->id}}', '{{action('MsgController@excluirBanner')}}', '')"><span
                                                class="glyphicon glyphicon-trash"></span> Excluir</a></li>
                            </ul>
                        </div>
                    </td>
            @endforeach
            </tbody>
        </table>
        <nav class="text-center">
            {!!  $banners->render()!!}
        </nav>
    @endif
@endsection
