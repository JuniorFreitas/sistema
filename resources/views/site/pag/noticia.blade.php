@if(!count($linha))
    @include('errors.404')
@else
    @extends('site.site')
@section('title')
    {{$linha[0]->nome}}
@endsection
@section('descricao')
    {{$linha[0]->descricao}}
@endsection

@section('conteudo')
    <div class="col-md-9">
        <h2 class="blue" style="font-family: 'Arial'">
            <strong>{{$linha[0]->nome}}</strong>
        </h2>
        <h4 style="color:#666; font-family: 'Arial'">
            {{$linha[0]->descricao}}
        </h4>
        <figure>
            <img src="{{asset('uploads/'.$linha[0]->imagem.'.jpg')}}"
                 alt="Bombeiros são chamados para desobstruir via, após queda de árvore " class="img-responsive"/>
        </figure>

        <p>
            {!!$linha[0]->materia!!}
        </p>

        <h5 class="textoDesc">Data de postagem:{{$linha[0]->dataCriado}}</h5>
        <h5 class="textoDesc">Fonte: {{$linha[0]->fonte}}</h5>

        <a onclick="window.open(this.href, 'sharer', 'toolbar=0,status=0,width=626,height=436');
                return false;" target="_blank" title="Compartilhar"
           href="http://www.facebook.com/sharer.php?u={{url()->current()}}"
           id="fbIS">
            <span class="btn btn-primary bgRedes"><i class="fa fa-facebook-square fa-lg"></i> Compartilhar</span>
        </a>

        <a id="twIS" class="addTwitter"
           href="http://twitter.com/share?url={{url()->current()}}"
           target="_blank" onclick="window.open(this.href, 'sharer', 'toolbar=0,status=0,width=626,height=436');
                return false;" title="Twittar">
            <span class="btn btn-primary bgRedes" )">
            <i class="fa fa-twitter-square fa-lg"></i> Twittar</span>
        </a>

        <a href="https://plus.google.com/share?url={{url()->current()}}"
           title="Compartilhar via Google+" target="_blank" onclick="window.open(this.href, 'sharer', 'toolbar=0,status=0,width=626,height=436');
                return false;">
            <span class="btn btn-primary bgRedes"><i class="fa fa-google-plus-square fa-lg"></i> Compartilhar</span>
        </a>
    </div>

    </div>
@endsection
@endif
