var elixir = require('laravel-elixir');

elixir(function (mix) {

    mix.styles([
        'bootstrap.min.css',
        'datepicker.css',
        'fileinput.css',
        'jquery-ui.min.css',
    ], 'public/css/sistema.css');

    mix.styles([
        'bootstrap.min.css',
        'estiloSite.css',
        'flexslider.css',
    ], 'public/css/site.css');


    mix.scripts([
        'jquery.min.js',
        'bootstrap.min.js',
        'jquery-ui.min.js',
        'jquery.ui.datepicker-pt-BR.js',
        'mascara.js',
        'fileinput.js',
        'funcoes.js'
    ], 'public/js/sistema.js');

    mix.scripts([
        'jquery.min.js',
        'bootstrap.min.js',
        'jquery.flexslider-min.js',
    ], 'public/js/site.js');

    mix.version(['css/sistema.css', 'js/sistema.js', 'css/site.css', 'js/site.js'])

    /* mix.copy('resources/assets/filemanager', 'public/build/filemanager');
     mix.copy('resources/assets/fonts', 'public/build/fonts');

     mix.copy('resources/assets/imagens', 'public/build/imagens');

     */
});
