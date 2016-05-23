<?php

namespace ptb\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use ptb\Helper\DataHora;
use ptb\Http\Requests;
use ptb\Http\Requests\VideoRequest;
use ptb\Video;

class VideosController extends Controller
{
    private $video;

    public function __construct(Video $video)
    {
        $this->video = $video;
        $this->middleware('auth');
    }

    public function index()
    {
        $videos = $this->video->select()->orderBy('data_video', 'desc')->paginate(20);
        return view('sistema.modulos.cadastro.videos.index', compact('videos'));
    }

    public function formCadastro()
    {
        return view('sistema.modulos.cadastro.videos.formCadastro');
    }

    public function formEditar($id)
    {
        $video = $this->video->find($id);
        return view('sistema.modulos.cadastro.videos.formEditaCadastro', compact('video'));
    }

    public function cadastrar(VideoRequest $request)
    {

        $DataHora = new DataHora(null);

        $this->video->usuarios_id = Auth::user()->id;
        $this->video->nome_video = $request->input('titulo');
        $this->video->url_video = $request->input('url');
        $this->video->data_video = $DataHora->dataHoraInsert();
        $this->video->visto_video = 0;
        $this->video->ativo_video = $request->input('ativo');
        $this->video->slug_video = str_slug($request->input('titulo'));
        $this->video->save();

        return redirect()->route('videos.index');
    }

    public function exclui($id)
    {
        $query = $this->video->find($id);
        $query->delete();
    }

    public function atualiza(VideoRequest $request, $id)
    {

        $DataHora = new DataHora(null);
        $query = $this->video->find($id);
        $query->update([
            'nome_video' => $request->input('titulo'),
            'url_video' => $request->input('url'),
            'ativo_video' => $request->input('ativo'),
            'slug_video' => str_slug($request->input('titulo')),
        ]);

        return redirect()->route('videos.index');
    }
}
