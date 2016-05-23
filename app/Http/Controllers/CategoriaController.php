<?php

namespace ptb\Http\Controllers;

use ptb\Http\Requests;
use ptb\Http\Requests\CategoriaRequest;
use ptb\Categoria;


class CategoriaController extends Controller
{
    public function formCategoria()
    {
        $Categoria = Categoria::all();
        return view('cadastro.categorias.formCadastro', ['linha' => $Categoria]);
    }

    public function listar()
    {
        $categorias = Categoria::all();
        return view('sistema.modulos.categoria.todas', compact('categorias'));
    }

    public function cadastrar(CategoriaRequest $request)
    {
        $Categoria = Categoria::all();
        return view('categoria.todas')->withInput($request->only('nome'));
    }
}
