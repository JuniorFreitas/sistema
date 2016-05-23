<?php
namespace ptb\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use ptb\Categoria;
use ptb\Helper\Canvas;
use ptb\Helper\DataHora;
use ptb\Http\Requests;
use ptb\Http\Requests\ImgnotRequest;
use ptb\Http\Requests\NoticiasRequest;
use ptb\Imgnot;
use ptb\Noticias;


class NoticiaController extends Controller
{
    private $noticia;

    public function __construct(Noticias $noticia)
    {
        $this->noticia = $noticia;
        $this->middleware('auth');
    }

    public function index()
    {
        $noticias = $this->noticia->select()->orderBy('dataProgramada_noticias', 'desc')->paginate(50);
        return view('sistema.modulos.cadastro.noticias.noticias', compact('noticias'));
    }

    public function formCadastro()
    {
        $categorias = Categoria::all();
        return view('sistema.modulos.cadastro.noticias.formCadastro', compact('categorias'));
    }

    public function formEditar($id)
    {
        $noticia = $this->noticia->find($id);
        $categorias = Categoria::all();
        return view('sistema.modulos.cadastro.noticias.formEditar', compact('noticia', 'categorias'));
    }

    public function cadastrar(NoticiasRequest $request, Canvas $canvas)
    {
        $DataHora = new DataHora(null);
        $novaData = new DataHora($request->input('data'));
        $file = $request->file('imagem');
        $temp = $DataHora->nomeUnico() . '_cadastrado' . rand(1, 5000) . '.' . $file->getClientOriginalExtension();

        if ($request->hasFile('imagem')):
            $file->move('uploads', $temp);
            $nomeI = asset('uploads/' . $temp);
            $novoNome = "__" . $temp;
            $pasta = 'uploads/' . $novoNome;
            $canvas->carregaUrl($nomeI)->hexa('#FFFFFF')->redimensiona(658, 480, 'preenchimento')->grava($pasta, 90);
            unlink('uploads/' . $temp);
        endif;

        $this->noticia->usuarios_id = Auth::user()->id;
        $this->noticia->tipos_id = $request->input('categoria');
        $this->noticia->titulo_noticias = $request->input('titulo');
        $this->noticia->descricao_noticias = $request->input('descricao');
        $this->noticia->materia_noticias = $request->input('materia');
        $this->noticia->data_noticias = $DataHora->dataHoraInsert();
        $this->noticia->slug_noticias = str_slug($request->input('titulo'));
        $this->noticia->fonte_noticias = str_slug($request->input('fonte'));
        $this->noticia->ativo_noticias = $request->input('ativo');
        $this->noticia->contador_noticias = 0;
        $this->noticia->usuarioAtualiza_noticias = Auth::user()->id;
        $this->noticia->dataProgramada_noticias = (empty($request->input('data'))) ? $DataHora->dataHoraInsert() : $novaData->dataInsert() . ' ' . $DataHora->horaInsert();
        $this->noticia->dataAtualizada_noticias = (empty($request->input('data'))) ? $DataHora->dataHoraInsert() : $novaData->dataInsert() . ' ' . $DataHora->horaInsert();
        $this->noticia->img_noticias = $novoNome;
        $this->noticia->save();

        return redirect()->route('noticia.index');
    }

    public function exclui($id)
    {
        $query = $this->noticia->find($id);
        unlink('uploads/' . $query->img_noticias);
        $query->delete();
    }

    public function atualiza(NoticiasRequest $request, $id, Canvas $canvas)
    {

        $DataHora = new DataHora(null);
        $query = $this->noticia->find($id);
        $novaData = new DataHora($request->input('data'));

        if (!empty($_FILES['imagem']['tmp_name'])):
            unlink('uploads/' . $query->img_noticias);
            $file = $request->file('imagem');
            $temp = $DataHora->nomeUnico() . '_cadastrado' . rand(1, 5000) . '.' . $file->getClientOriginalExtension();
            $file->move('uploads', $temp);
            $nomeI = asset('uploads/' . $temp);
            $novoNome = "__" . $temp;
            $pasta = 'uploads/__' . $temp;
            $canvas->carregaUrl($nomeI)->hexa('#FFFFFF')->redimensiona(658, 480, 'preenchimento')->grava($pasta, 90);
            unlink('uploads/' . $temp);
        else:
           echo $novoNome = $query->img_noticias;
        endif;

        $categoria = $request->input('categoria');
        $titulo = $request->input('titulo');
        $descricao = $request->input('descricao');
        $materia = $request->input('materia');
        $slug = str_slug($request->input('titulo'));
        $fonte = str_slug($request->input('fonte'));
        $ativo = $request->input('ativo');
        $userAtualiza = Auth::user()->id;
        $dataProgramada = (empty($request->input('data'))) ? $DataHora->dataHoraInsert() : $novaData->dataInsert() . ' ' . $DataHora->horaInsert();
        $dataAtualizada = (empty($request->input('data'))) ? $DataHora->dataHoraInsert() : $novaData->dataInsert() . ' ' . $DataHora->horaInsert();
        $imagem = $novoNome;

        $query->update([
            'tipos_id' => $categoria,
            'titulo_noticias' => $titulo,
            'descricao_noticias' => $descricao,
            'materia_noticias' => $materia,
            'slug_noticias' => $slug,
            'fonte_noticias' => $fonte,
            'ativo_noticias' => $ativo,
            'usuarioAtualiza_noticias' => $userAtualiza,
            'dataProgramada_noticias' => $dataProgramada,
            'dataAtualizada_noticias' => $dataAtualizada,
            'img_noticias' => $imagem,
        ]);

        return redirect()->route('noticia.index');
    }

}