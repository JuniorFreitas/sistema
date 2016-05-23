<?php
//Rotas do Sistema
Route::auth();
Route::group(['prefix' => 'sistema', 'middleware' => ['web']], function () {

    Route::get('home', ['as' => 'sistema.home', 'uses' => 'HomeController@index']);
    Route::get('', function () {
        return redirect()->route('sistema.home');
    });

    //Rotas de Mensagens AJAX
    Route::group(['prefix' => 'msg'], function () {
        Route::match(['get', 'post'], 'logout', ['as' => 'logout', 'uses' => 'MsgController@sair']);
        Route::match(['get', 'post'], 'excluir', ['as' => 'excluir', 'uses' => 'MsgController@excluir']);
        Route::match(['get', 'post'], 'excluirBanner', ['as' => 'excluirBanner', 'uses' => 'MsgController@excluirBanner']);
        Route::match(['get', 'post'], 'excluirPagina', ['as' => 'excluirPagina', 'uses' => 'MsgController@excluirPagina']);
        Route::match(['get', 'post'], 'excluirVideo', ['as' => 'excluirVideo', 'uses' => 'MsgController@excluirVideo']);
        Route::match(['get', 'post'], 'excluirHomilia', ['as' => 'excluirHomilia', 'uses' => 'MsgController@excluirHomilia']);
        Route::match(['get', 'post'], 'excluirGaleria', ['as' => 'excluirGaleria', 'uses' => 'MsgController@excluirGaleria']);
        Route::match(['get', 'post'], 'excluirCarpinteiro', ['as' => 'excluirCarpinteiro', 'uses' => 'MsgController@excluirCarpinteiro']);
    });

    //Rotas de Cadastros
    Route::group(['prefix' => 'cadastro'], function () {

        Route::group(['as' => 'noticia.', 'prefix' => 'noticias', 'middleware' => ['web']], function () {
            Route::get('', ['as' => 'index', 'uses' => 'NoticiaController@index']);
            Route::get('adicionar', ['as' => 'formCadastro', 'uses' => 'NoticiaController@formCadastro']);
            Route::post('cadastrar', ['as' => 'cadastrar', 'uses' => 'NoticiaController@cadastrar']);
            Route::get('editar/{id}', ['as' => 'editar', 'uses' => 'NoticiaController@formEditar']);
            Route::post('atualiza/{id}', ['as' => 'atualiza', 'uses' => 'NoticiaController@atualiza']);
            Route::get('exclui/{id}', ['as' => 'exclui', 'uses' => 'NoticiaController@exclui']);
        });

        Route::group(['as' => 'categoria.', 'prefix' => 'categoria', 'middleware' => ['web']], function () {
            Route::get('', ['as' => 'index', 'uses' => 'CategoriaController@listar']);
            Route::post('cadastrar', 'CategoriaController@cadastrar');
        });


        Route::group(['as' => 'banner.', 'prefix' => 'banner', 'middleware' => ['web']], function () {
            Route::get('', ['as' => 'index', 'uses' => 'BannerController@index']);
            Route::get('adicionar', ['as' => 'formCadastro', 'uses' => 'BannerController@formCadastro']);
            Route::post('cadastrar', ['as' => 'cadastrar', 'uses' => 'BannerController@cadastrar']);
            Route::get('editar/{id}', ['as' => 'editar', 'uses' => 'BannerController@formEditar']);
            Route::get('exclui/{id}', ['as' => 'exclui', 'uses' => 'BannerController@exclui']);
            Route::post('atualiza/{id}', ['as' => 'atualiza', 'uses' => 'BannerController@atualiza']);
        });

        Route::group(['as' => 'paginas.', 'prefix' => 'paginas', 'middleware' => ['web']], function () {
            Route::get('', ['as' => 'index', 'uses' => 'PaginaController@index']);
            Route::get('adicionar', ['as' => 'formCadastro', 'uses' => 'PaginaController@formCadastro']);
            Route::post('cadastrar', ['as' => 'cadastrar', 'uses' => 'PaginaController@cadastrar']);
            Route::get('editar/{id}', ['as' => 'editar', 'uses' => 'PaginaController@formEditar']);
            Route::get('exclui/{id}', ['as' => 'exclui', 'uses' => 'PaginaController@exclui']);
            Route::post('atualiza/{id}', ['as' => 'atualiza', 'uses' => 'PaginaController@atualiza']);
        });

        Route::group(['as' => 'videos.', 'prefix' => 'videos', 'middleware' => ['web']], function () {
            Route::get('', ['as' => 'index', 'uses' => 'VideosController@index']);
            Route::get('adicionar', ['as' => 'formCadastro', 'uses' => 'VideosController@formCadastro']);
            Route::post('cadastrar', ['as' => 'cadastrar', 'uses' => 'VideosController@cadastrar']);
            Route::get('editar/{id}', ['as' => 'editar', 'uses' => 'VideosController@formEditar']);
            Route::get('exclui/{id}', ['as' => 'exclui', 'uses' => 'VideosController@exclui']);
            Route::post('atualiza/{id}', ['as' => 'atualiza', 'uses' => 'VideosController@atualiza']);
        });

        Route::group(['as' => 'homilia.', 'prefix' => 'homilia', 'middleware' => ['web']], function () {
            Route::get('', ['as' => 'index', 'uses' => 'HomiliaController@index']);
            Route::get('adicionar', ['as' => 'formCadastro', 'uses' => 'HomiliaController@formCadastro']);
            Route::post('cadastrar', ['as' => 'cadastrar', 'uses' => 'HomiliaController@cadastrar']);
            Route::get('editar/{id}', ['as' => 'editar', 'uses' => 'HomiliaController@formEditar']);
            Route::get('exclui/{id}', ['as' => 'exclui', 'uses' => 'HomiliaController@exclui']);
            Route::post('atualiza/{id}', ['as' => 'atualiza', 'uses' => 'HomiliaController@atualiza']);
        });

    });

    //Rotas Galeria
    Route::group(['as' => 'galeria.', 'prefix' => 'galeria', 'middleware' => ['web']], function () {
        Route::get('', ['as' => 'index', 'uses' => 'GaleriaController@index']);
        Route::get('adicionar', ['as' => 'formCadastro', 'uses' => 'GaleriaController@formCadastro']);
        Route::post('cadastrar', ['as' => 'cadastrar', 'uses' => 'GaleriaController@cadastrar']);
        Route::get('editar/{id}', ['as' => 'editar', 'uses' => 'GaleriaController@formEditar']);
        Route::post('atualiza/{id}', ['as' => 'atualiza', 'uses' => 'GaleriaController@atualiza']);
        Route::get('exclui/{id}', ['as' => 'exclui', 'uses' => 'GaleriaController@exclui']);
    });

    //Rotas Carpinteiro
    Route::group(['as' => 'carpinteiro.', 'prefix' => 'carpinteiro', 'middleware' => ['web']], function () {
        Route::get('', ['as' => 'index', 'uses' => 'CarpinteiroController@index']);
        Route::get('adicionar', ['as' => 'formCadastro', 'uses' => 'CarpinteiroController@formCadastro']);
        Route::post('cadastrar', ['as' => 'cadastrar', 'uses' => 'CarpinteiroController@cadastrar']);
        Route::get('editar/{id}', ['as' => 'editar', 'uses' => 'CarpinteiroController@formEditar']);
        Route::post('atualiza/{id}', ['as' => 'atualiza', 'uses' => 'CarpinteiroController@atualiza']);
        Route::get('exclui/{id}', ['as' => 'exclui', 'uses' => 'CarpinteiroController@exclui']);
    });

});

//Rotas do SITE

Route::group(['middleware' => ['web']], function () {
    Route::get('', ['as' => 'site.index', 'uses' => 'SiteController@index']);

    Route::group(['as' => 'site.', 'prefix' => 'noticias'], function () {
        Route::get('', ['as' => 'allNoticias', 'uses' => 'SiteController@getAllNoticias']);
        Route::get('{slug}', ['as' => 'noticias', 'uses' => 'SiteController@getNoticia']);
    });
    Route::get('contato', ['as' => 'site.contato', 'uses' => 'SiteController@contato']);

    Route::group(['as' => 'site.', 'prefix' => 'partido'], function () {
        Route::get('quemequem', ['as' => 'quemequem', function () {
            return 'Quem é quem';
        }]);
        Route::get('historia', ['as' => 'historia', function () {
            return 'historia';
        }]);
        Route::get('estatuto', ['as' => 'estatuto', function () {
            return 'estatuto';
        }]);
    });
});

