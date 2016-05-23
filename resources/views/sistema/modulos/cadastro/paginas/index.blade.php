@extends('sistema.layoutSistema')

@section('content')
    <h3>Páginas</h3>
    <hr>
    <a class="btn btn-primary" style="margin-bottom: 1em" href="{{route('paginas.formCadastro')}}"> Cadastrar Nova
        Página</a>
    @if(!count($paginas))
        <p class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Nenhum Registro encontrado</p>
    @else
        <table class="table" style="background: #FFF; border: none; border-radius: 0.35em">
            <thead>
            <tr>
                <th class="hidden-xs">#</th>
                <th>Titulo</th>
                <th>Url</th>
                <th>Categoria</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            {{!$conta=1}}
            @foreach($paginas as $pagina)
                <tr id="lin{{$pagina->id}}">
                    <td>{{$conta++}}</td>
                    <td>{{$pagina->nome_pagina}}</td>
                    <td>{{url('/').'/'.$pagina->cat->slug_menu.'/'.$pagina->url_pagina}}</td>
                    <td>{{$pagina->cat->slug_menu}}</td>
                    <td></td>
                    <td width="70">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-cog"></span> Ação <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" style="right: 0; left: auto; min-width:100px">
                                <li><a href="{{route('paginas.editar',$pagina->id)}}"><span
                                                class="glyphicon glyphicon-pencil"></span> Editar</a></li>
                                <li><a href="javascript://" data-toggle="modal" data-target="#dialog"
                                       onclick="chamaModal('Apagar Pagina - {{$pagina->nome_pagina}}', '{{$pagina->id}}', '{{action('MsgController@excluirPagina')}}', '')"><span
                                                class="glyphicon glyphicon-trash"></span> Excluir</a></li>
                            </ul>
                        </div>
                    </td>
            @endforeach
            </tbody>
        </table>
        <nav class="text-center">
            {!!  $paginas->render()!!}
        </nav>
    @endif
@endsection
