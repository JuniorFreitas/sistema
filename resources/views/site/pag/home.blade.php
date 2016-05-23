@extends('site.site')
@section('title', 'Inicio do Site')
@section('descricao', 'Descrição do site')


@section('conteudo')
    <div class="col-md-8 col-sm-8">
        <div class="flexslider">
            <ul class="slides">
                @foreach($carousel as $slide)
                    <li>
                        <img src="{{asset('uploads/'.$slide->imagem.'.jpg')}}" class="img-responsive"/>
                        <a href="{{route('site.noticias',['slug'=>$slide->slug])}}">
                            <div class="flex-caption">
                                <h6>{{$slide->dataCriado}}</h6>
                                <h4>{{$slide->nome}}</h4>
                                <h5>{{$slide->descricao}}</h5>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-md-4 col-sm-4">
        <img src="{{asset('/build/imagens/filiaweb.jpg')}}" alt="FiliaWeb" title="Clique aqui e faça sua pré-filiação"
             class="img-responsive">
        <div class="barra">
            <h5 class="titulos" style="margin-left: 3%;padding: 4% 0px 2% 14%;">Palavra do Presidente</h5>
        </div>
        <div style="width: 93%;margin-left: 5%;margin-top: 8%;">
            <p>"Cada um de nós compõe a sua história; Cada ser em si carrega o dom de ser
                capaz de ser feliz" <br>
            <p class="text-right">(Almir Sater e Renato Teixeira)</p>
            <button class="btn btn-inverse" style="margin-bottom: 3%;">Ver mais...</button>
        </div>
        </p>
        <div class="linhaDupla"></div>
    </div>

    <div class="col-md-12" style="margin-top: 2.5%;">
        <img src="{{asset('/build/imagens/ptb-midias.png')}}" alt="nas midias" class="img-responsive">
    </div>

    <div class="col-md-12" style="margin-top: 1.5%;">
        <div class="barra">
            <a href="{{route('site.allNoticias')}}" class="btn btn-inverse pull-right" style="margin-top: 0.3%;">Ver Todas</a>
            <h5 class="titulos" style="margin-left: 2.5%; padding: 1.3% 0px 0% 3%;">Notícias</h5>
        </div>

        @if(empty($unNot[0])):
        <div class="alert alert-warning">Nenhum registro encontrado!</div>
        @else
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{asset('imagens/uploads/'.$unNot[0]->imagem.'.jpg')}}" alt="Pf1"
                             class="img-responsive thumbnail">
                    </div>
                    <div class="col-md-6">
                        <h3 style="font-weight: bold; margin-top: -1%;">{{$unNot[0]->nome}}</h3>
                        <div class="linhaDupla" style="height: 2px"></div>
                        <p class="timeRed">Publicado em: {{$unNot[0]->dataCriado}}</p>
                        <p class="text-justify">{{$unNot[0]->descricao}}</p>
                        <a class="btn btn-inverse" href="{{route('site.noticias',['slug'=>$unNot[0]->slug])}}"
                           style="margin-top: 0.3%;">Ler mais...</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                @foreach($noticias as $noticia)
                    <p class="timeRed">Publicado em: {{$noticia->dataCriado}}</p>
                    <a href="{{route('site.noticias',['slug'=>$noticia->slug])}}">
                        <h5 class="text-justify" style="margin-top: -3%; font-weight: bold">{{$noticia->nome}}</h5></a>
                    <div class="linhaDupla"></div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="col-md-12">
        <div class="barra">
            <button class="btn btn-inverse pull-right" style="margin-top: 0.3%;">Ver Todos</button>
            <h5 class="titulos" style="margin-left: 2.5%; padding: 1.3% 0px 0% 3%;">Vídeos</h5>
        </div>
    </div>
@endsection
