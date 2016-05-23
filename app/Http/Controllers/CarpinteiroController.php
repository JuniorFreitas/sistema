<?php

namespace ptb\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use ptb\Carpinteiro;
use ptb\Helper\Canvas;
use ptb\Helper\DataHora;
use ptb\Http\Requests;
use ptb\Http\Requests\CarpinteiroRequest;

class CarpinteiroController extends Controller
{
    private $carpinteiro;

    public function __construct(Carpinteiro $carpinteiro)
    {
        $this->carpinteiro = $carpinteiro;
        $this->middleware('auth');
    }

    public function index()
    {
        $carpinteiros = $this->carpinteiro->select()->orderBy('data_carpinteiro', 'desc')->paginate(20);
        return view('sistema.modulos.carpinteiro.index', compact('carpinteiros'));
    }

    public function formCadastro()
    {
        return view('sistema.modulos.carpinteiro.formCadastro');
    }

    public function formEditar($id)
    {
        $carpinteiro = $this->carpinteiro->find($id);
        return view('sistema.modulos.carpinteiro.formEditarCadastro', compact('carpinteiro'));
    }

    public function exclui($id)
    {
        $query = $this->carpinteiro->find($id);
        unlink('carpinteiro/' . $query->arquivo_carpinteiro);
        unlink('uploads/' . $query->img_carpinteiro);
        $query->delete();
    }

    public function cadastrar(CarpinteiroRequest $request, Canvas $Canvas)
    {
        $DataHora = new DataHora(null);

        //Bloco Criando PDF
        $filePdf = $request->file('pdf');
        $criaPdf = $DataHora->nomeUnico() . '_carpinteiro' . rand(1, 5000) . '.' . $filePdf->getClientOriginalExtension();
        ($request->hasFile('pdf') ? $filePdf->move('carpinteiro', $criaPdf) : "");
        $file = $request->file('imagem');
        $temp = $DataHora->nomeUnico() . '_carpinteiro' . rand(1, 5000) . '.' . $file->getClientOriginalExtension();
        if ($request->hasFile('imagem')):
            $file->move('uploads', $temp);
            $nomeI = asset('uploads/' . $temp);
            $novoNome = "__" . $temp;
            $pasta = 'uploads/' . $novoNome;
            $Canvas->carregaUrl($nomeI)->hexa('#FFFFFF')->redimensiona(800, 390)->grava($pasta, 90);
            unlink('uploads/' . $temp);
        endif;
        $this->carpinteiro->titulo_carpinteiro = $request->input('titulo');
        $this->carpinteiro->arquivo_carpinteiro = $criaPdf;
        $this->carpinteiro->data_carpinteiro = $DataHora->dataHoraInsert();
        $this->carpinteiro->img_carpinteiro = $novoNome;
        $this->carpinteiro->ativo_carpinteiro = $request->input('ativo');
        $this->carpinteiro->usuario_carpinteiro = Auth::user()->id;
        $this->carpinteiro->save();

        return redirect()->route('carpinteiro.index');
    }

    public function atualiza(CarpinteiroRequest $request, $id, Canvas $Canvas)
    {
        $DataHora = new DataHora(null);
        $query = $this->carpinteiro->find($id);
        if (!empty($_FILES['pdf']['tmp_name'])):
            unlink('carpinteiro/' . $query->arquivo_carpinteiro);
            $filePdf = $request->file('pdf');
            $criaPdf = $DataHora->nomeUnico() . '_carpinteiro' . rand(1, 5000) . '.' . $filePdf->getClientOriginalExtension();
            $filePdf->move('carpinteiro', $criaPdf);
        else:
            $criaPdf = $query->arquivo_carpinteiro;
        endif;

        if (!empty($_FILES['imagem']['tmp_name'])):
            unlink('uploads/' . $query->img_carpinteiro);
            $file = $request->file('imagem');
            $temp = $DataHora->nomeUnico() . '_carpinteiro' . rand(1, 5000) . '.' . $file->getClientOriginalExtension();
            $file->move('uploads', $temp);
            $nomeI = asset('uploads/' . $temp);
            $novoNome = "__" . $temp;
            $pasta = 'uploads/__' . $temp;
            $Canvas->carregaUrl($nomeI)->hexa('#FFFFFF')->redimensiona(800, 390)->grava($pasta, 90);
            unlink('uploads/' . $temp);
        else:
            $novoNome = $query->img_carpinteiro;
        endif;

        $query->update([
            'titulo_carpinteiro' => $request->input('titulo'),
            'arquivo_carpinteiro' => $criaPdf,
            'img_carpinteiro' => $novoNome,
            'ativo_fotos' => $request->input('ativo'),
        ]);
        return redirect()->route('carpinteiro.index');
    }
}
