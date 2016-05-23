<?php

namespace ptb\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use ptb\Galeria;
use ptb\Helper\Canvas;
use ptb\Helper\DataHora;
use ptb\Http\Requests;
use ptb\Http\Requests\GaleriaRequest;

class GaleriaController extends Controller
{
    private $galeria;

    public function __construct(Galeria $galeria)
    {
        $this->galeria = $galeria;
        $this->middleware('auth');
    }

    public function index()
    {
        $galerias = $this->galeria->select()->orderBy('data_fotos', 'desc')->paginate(20);
        return view('sistema.modulos.galeria.index', compact('galerias'));
    }

    public function formCadastro()
    {
        return view('sistema.modulos.galeria.formCadastro');
    }

    public function formEditar($id)
    {
        $galeria = $this->galeria->find($id);
        return view('sistema.modulos.galeria.formEditarCadastro', compact('galeria'));
    }

    public function exclui($id)
    {
        $query = $this->galeria->find($id);
        unlink('uploads/' . $query->capa_fotos);
        $query->delete();
    }

    public function cadastrar(GaleriaRequest $request, Canvas $Canvas)
    {

        $DataHora = new DataHora(null);
        $file = $request->file('imagem');
        $temp = $DataHora->nomeUnico() . '_galeria' . rand(1, 5000) . '.' . $file->getClientOriginalExtension();

        if ($request->hasFile('imagem')):
            $file->move('uploads', $temp);
            $nomeI = asset('uploads/' . $temp);
            $novoNome = "__" . $temp;
            $pasta = 'uploads/' . $novoNome;
            $Canvas->carregaUrl($nomeI)->hexa('#FFFFFF')->redimensiona(800, 390)->grava($pasta, 90);
            unlink('uploads/' . $temp);
        endif;


        $this->galeria->titulo_fotos = $request->input('titulo');
        $this->galeria->capa_fotos = $novoNome;
        $this->galeria->url_fotos = $request->input('url');
        $this->galeria->data_fotos = $DataHora->dataHoraInsert();
        $this->galeria->ativo_fotos = $request->input('ativo');
        $this->galeria->usuario_cadastrado = Auth::user()->id;

        $this->galeria->save();

        return redirect()->route('galeria.index');
    }

    public function atualiza(GaleriaRequest $request, $id, Canvas $Canvas)
    {
        $DataHora = new DataHora(null);
        $query = $this->galeria->find($id);

        if (!empty($_FILES['imagem']['tmp_name'])):
            unlink('uploads/' . $query->capa_fotos);
            $file = $request->file('imagem');
            $temp = $DataHora->nomeUnico() . '_galeria' . rand(1, 5000) . '.' . $file->getClientOriginalExtension();
            $file->move('uploads', $temp);
            $nomeI = asset('uploads/' . $temp);
            $novoNome = "__" . $temp;
            $pasta = 'uploads/__' . $temp;
            $Canvas->carregaUrl($nomeI)->hexa('#FFFFFF')->redimensiona(800, 390)->grava($pasta, 90);
            unlink('uploads/' . $temp);
        else:
            echo $novoNome = $query->capa_fotos;
        endif;


        $query->update([
            'titulo_fotos' => $request->input('titulo'),
            'capa_fotos' => $novoNome,
            'url_fotos' => $request->input('url'),
            'ativo_fotos' => $request->input('ativo'),
        ]);

        return redirect()->route('galeria.index');
    }
}
