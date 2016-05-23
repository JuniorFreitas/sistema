<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistema de Conteudo</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"
          integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="{{elixir('css/sistema.css')}}">
    <script src="{{ elixir('js/sistema.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.0-rc.2/jquery-ui.min.js"></script>
    <!-- JavaScripts -->
    @yield('scripts')

    <style>
        body {
            font-family: 'Lato';
        }
        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
<div class="modal fade" id="dialog" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Fechar</span></button>
                <h4 class="modal-title" id="tituloModal">Titulo</h4>
            </div>
            <div class="modal-body" id="conteudoModal"></div>
        </div>
    </div>
</div>

@if (Auth::guest())
@else
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            @include('sistema.menu.adm')
        </div>
    </nav>
@endif
<div class="container">
    @yield('content')
</div>
@if (Auth::guest())
@else
    <footer class="well well-sm text-right" style="background: #000; color:#fff">
        <div class="container">
            Desenvolvido Por <img src="http://www.laune.com.br/imagens/logoij.png" alt="">
        </div>
    </footer>
@endif
</body>
</html>
