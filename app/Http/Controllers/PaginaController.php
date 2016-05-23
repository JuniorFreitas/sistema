<?php

namespace ptb\Http\Controllers;

use Illuminate\Http\Request;

use ptb\Http\Requests;
use ptb\Http\Requests\PaginasRequest;
use ptb\Menu;
use ptb\Pagina;

class PaginaController extends Controller
{
    public function __construct(Pagina $pagina)
    {
        $this->pagina = $pagina;
        $this->middleware('auth');
    }

    public function index()
    {
        $paginas = $this->pagina->select()->orderBy('nome_pagina', 'asc')->paginate(50);
        return view('sistema.modulos.cadastro.paginas.index', compact('paginas'));
    }

    public function formCadastro()
    {
        $menus = Menu::all();
        return view('sistema.modulos.cadastro.paginas.formCadastro', compact('menus'));
    }

    public function cadastrar(PaginasRequest $request)
    {
        $this->pagina->nome_pagina = $request->input('titulo');
        $this->pagina->conteudo_pagina = $request->input('materia');
        $this->pagina->url_pagina = str_slug($request->input('titulo'));
        $this->pagina->menu_pagina = "";
        $this->pagina->ativo_pagina = $request->input('ativo');
        $this->pagina->menu_id = $request->input('categoria');
        $this->pagina->save();

        return redirect()->route('paginas.index');
    }

    public function formEditar($id)
    {
        $pagina = $this->pagina->find($id);
        $menus = Menu::all();
        return view('sistema.modulos.cadastro.paginas.formEditar', compact('pagina', 'menus'));
    }

    public function atualiza(PaginasRequest $request, $id)
    {
        $query = $this->pagina->find($id);
        $query->update([
            'nome_pagina' => $request->input('titulo'),
            'conteudo_pagina' => $request->input('materia'),
            'url_pagina' => str_slug($request->input('titulo')),
            'menu_pagina' => "",
            'ativo_pagina' => $request->input('ativo'),
            'menu_id' => $request->input('categoria'),
        ]);
        return redirect()->route('paginas.index');
    }

    public function exclui($id)
    {
        $query = $this->pagina->find($id);
        $query->delete();
    }
}
