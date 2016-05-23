<?php

namespace ptb\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use ptb\Helper\DataHora;
use ptb\Homilia;
use ptb\Http\Requests;
use ptb\Http\Requests\HomiliaRequest;
use ptb\Video;

class HomiliaController extends Controller
{
    private $video;

    public function __construct(Homilia $homilia)
    {
        $this->homilia = $homilia;
        $this->middleware('auth');
    }

    public function index()
    {
        $homilias = $this->homilia->select()->orderBy('cadastro', 'desc')->paginate(20);
        return view('sistema.modulos.cadastro.homilia.index', compact('homilias'));
    }

    public function formCadastro()
    {
        return view('sistema.modulos.cadastro.homilia.formCadastro');
    }

    public function formEditar($id)
    {
        $homilia = $this->homilia->find($id);
        return view('sistema.modulos.cadastro.homilia.formEditaCadastro', compact('homilia'));
    }

    public function cadastrar(HomiliaRequest $request)
    {

        $DataHora = new DataHora(null);

        $this->homilia->usuario = Auth::user()->id;
        $this->homilia->titulo = $request->input('titulo');
        $this->homilia->url = $request->input('url');
        $this->homilia->cadastro = $DataHora->dataHoraInsert();
        $this->homilia->ativo = $request->input('ativo');
        $this->homilia->slug = str_slug($request->input('titulo'));
        $this->homilia->save();

        return redirect()->route('homilia.index');
    }

    public function exclui($id)
    {
        $query = $this->homilia->find($id);
        $query->delete();
    }

    public function atualiza(HomiliaRequest $request, $id)
    {

        $query = $this->homilia->find($id);
        $query->update([
            'titulo' => $request->input('titulo'),
            'url' => $request->input('url'),
            'ativo' => $request->input('ativo'),
            'slug' => str_slug($request->input('titulo')),
        ]);

        return redirect()->route('homilia.index');
    }
}
