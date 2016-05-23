@extends('site.site')
@section('conteudo')
    <div class="col-md-12">
        <h3>Noticias</h3>
        <div class="linhaDupla"></div>

        @foreach($noticias as $noticia)
            <div class="col-xs-8 col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="{{asset('uploads/'.$noticia->imagem.'.jpg')}}" alt="" class="img-responsive">
                    <p style="font-size: 0.85em; ">
                        <i class="fa fa-calendar"></i>
                        {{$noticia->dataHoraCriado()}}
                        <i class="fa fa-tags"></i> São José de Ribamar </p>
                    <h5 class="text-center">{{$noticia->nome}}</h5>
                    <h5 class="text-center">{{$noticia->descricao}}</h5>
                </div>
            </div>
        @endforeach

    </div>
@endsection