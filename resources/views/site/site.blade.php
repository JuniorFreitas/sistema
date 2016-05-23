<!doctype html>
<!--[if IE 7 ]>
<html lang="pt_BR" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>
<html lang="pt_BR" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>
<html lang="pt_BR" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="pt_BR" class="no-js">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noodp,noydir">
    <meta name="description" content="PTB/MA">
    <meta property="og:locale" content="pt_BR">
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('descricao')">
    <meta property="og:url" content="{{url()->current()}}">
    <meta property="og:site_name" content="PTB/MA">
    <meta property="og:image" content="{{url()->current()}}/imagens/logo.jpg">
    <meta property="article:publisher" content="https://www.facebook.com/ptbma">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:description" content="@yield('descricao')">
    <meta name="twitter:title" content="@yield('title')">
    <meta name="twitter:site" content="{{url()->current()}}">
    <meta name="twitter:domain" content="PTB-MA">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Inicio metas Icones -->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/icones/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Fim de metas Icones -->
    <!--[if lt IE 9]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <title>PTB/MA</title>
    <!-- Icones -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('icones/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('icones/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('icones/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('icones/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('icones/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('icones/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('icones/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('icones/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('icones/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('icones/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('icones/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('icones/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('icones/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('icones/manifest.json')}}">
    <!-- Fim Icones -->
    <link rel="stylesheet" href="{{elixir('css/site.css')}}">

    <link rel="canonical" href="{{url()->current()}}">
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if lte IE 8]>
    <script type="text/javascript" src="http://explorercanvas.googlecode.com/svn/trunk/excanvas.js"></script>
    <![endif]-->
    <script src="{{ elixir('js/site.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('.flexslider').flexslider({
                animation: "fade",
                controlNav: false,
                pauseOnAction: false,
                slideshowSpeed: 5000
            });

            var urlAtiva = "u";
            if (urlAtiva) {
                $('#' + urlAtiva).addClass('ativoo');
            } else {
                $('#home').addClass('ativoo');
            }
        });
    </script>
</head>
<body>

<header class="container-fluid hidden-xs" id="home">
    <div class="container">
        <img src="{{asset('/build/imagens/logo.png')}}" class="img-responsive" id="logo" alt="">
    </div>
</header>

<nav class="navbar navbar-inverse">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header hidden-lg hidden-sm hidden-md">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('site.index')}}"><img src="{{asset('/build/imagens/logo_mini.png')}}"
                                                                        alt="logo"
                                                                        class="img-responsive"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left" id="menu">
                <li><a href="{{action('SiteController@index')}}">ÍNICIO <span
                                class="sr-only">(current)</span></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">O PARTIDO <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('site.quemequem')}}">Quem é quem</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('site.historia')}}">História</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('site.estatuto')}}">Estatuto</a></li>
                    </ul>
                </li>

                <li><a href="#">DIRETÓRIOS</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">NÚCLEOS <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">PTB Jovem</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">PTB Mulher</a></li>
                    </ul>
                </li>

                <li><a href="#">FILIAWEB</a></li>
                <li><a href="{{action('SiteController@contato')}}">CONTATO</a></li>

            </ul>
            <form class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Pesquisar...">
                </div>
                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
            </form>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<article class="container-fluid">
    <section class="container" id="conteudo">
        @yield('conteudo')
    </section>
</article>

<footer class="container-fluid">
    <div class="container">
        <p class="text-right">Criado e Desenvolvido por: IJDESIGN sob encomenda de PTB-MA <br>
            Todos os Direitos Reservados à PTB-MA</p>
    </div>
</footer>

</body>
</html>