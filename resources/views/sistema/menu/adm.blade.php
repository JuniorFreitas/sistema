<div class="navbar-header" style="margin-right:40px;">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="{{route('sistema.home')}}">SISTEMA 2.0</a>
</div>

<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">

        <li class="dropdown" id="cadastro">
            <a href="javascript://" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-shopping-cart"></i>
                Cadastro <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="{{route('noticia.index')}}">Notícias</a></li>
                <li><a href="{{route('banner.index')}}">Banner</a></li>
                <li><a href="{{route('paginas.index')}}">Paginas</a></li>
                <li><a href="{{route('videos.index')}}">Vídeos</a></li>
                <li><a href="{{route('homilia.index')}}">Homilia</a></li>
                <li><a href="cadastro/usuarios">Usúarios</a></li>
            </ul>
        </li>

        <li id="galeria"><a href="{{route('galeria.index')}}"><i class="fa fa-camera"></i> Galeria</a></li>

        <li id="carpinteiro"><a href="{{route('carpinteiro.index')}}"><i class="fa fa-shopping-cart"></i>
                Carpinteiro</a></li>

    </ul>

    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}  <i
                        class="fa fa-cogs fa-lg"></i> <b class="caret"></b></a>
            <ul class="dropdown-menu" style="right: 0; left: auto; min-width:100px">
                <li><a href="#"><i class="fa fa-pencil"></i> Editar</a></li>
                <li><a href="javascript://" data-toggle="modal" data-target="#dialog"
                       onclick="chamaModal('Sair', 'null', '{{url('sistema/msg/logout')}}', '')"><i class="fa fa-power-off"></i>
                        Sair</a></li>
            </ul>
        </li>
    </ul>
</div>