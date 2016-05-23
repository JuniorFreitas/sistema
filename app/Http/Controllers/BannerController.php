<?php

namespace ptb\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ptb\Banner;
use ptb\Helper\Canvas;
use ptb\Helper\DataHora;
use ptb\Http\Requests;
use ptb\Http\Requests\BannerRequest;

class BannerController extends Controller
{

    /**
     * @var Banner
     */
    private $banner;

    public function __construct(Banner $banner)
    {
        $this->banner = $banner;
        $this->middleware('auth');
    }

    public function index()
    {
        $banners = $this->banner->select()->orderBy('data_banner', 'desc')->paginate(25);
        return view('sistema.modulos.cadastro.banner.index', compact('banners'));
    }

    public function formCadastro()
    {
        return view('sistema.modulos.cadastro.banner.formCadastro');
    }

    public function formEditar($id)
    {
        $banner = $this->banner->find($id);
        return view('sistema.modulos.cadastro.banner.formEditarCadastro', compact('banner'));
    }

    public function cadastrar(BannerRequest $request, Canvas $Canvas)
    {

        $DataHora = new DataHora(null);
        $file = $request->file('imagem');
        $temp = $DataHora->nomeUnico() . '_cadastrado' . rand(1, 5000) . '.' . $file->getClientOriginalExtension();

        if ($request->hasFile('imagem')):
            $file->move('uploads', $temp);
            $nomeI = asset('uploads/' . $temp);
            $novoNome = "__" . $temp;
            $pasta = 'uploads/' . $novoNome;
            $Canvas->carregaUrl($nomeI)->hexa('#FFFFFF')->redimensiona(800, 390)->grava($pasta, 90);
            unlink('uploads/' . $temp);
        endif;


        $this->banner->usuarios_id = Auth::user()->id;
        $this->banner->titulo_banner = $request->input('titulo');
        $this->banner->url_banner = $request->input('url');
        $this->banner->img_banner = $novoNome;
        $this->banner->data_banner = $DataHora->dataHoraInsert();
        $this->banner->ativo_banner = $request->input('ativo');
        $this->banner->contador_banner = 0;
        $this->banner->qnt_banner = 0;
        $this->banner->save();

        return redirect()->route('banner.index');
    }

    public function exclui($id)
    {
        $query = $this->banner->find($id);
        unlink('uploads/' . $query->img_banner);
        $query->delete();
    }

    public function atualiza(BannerRequest $request, $id,Canvas $Canvas)
    {

        $DataHora = new DataHora(null);
        $query = $this->banner->find($id);

        if (!empty($_FILES['imagem']['tmp_name'])):
            unlink('uploads/' . $query->img_banner);
            $file = $request->file('imagem');
            $temp = $DataHora->nomeUnico() . '_cadastrado' . rand(1, 5000) . '.' . $file->getClientOriginalExtension();
            $file->move('uploads', $temp);
            $nomeI = asset('uploads/' . $temp);
            $novoNome = "__" . $temp;
            $pasta = 'uploads/__' . $temp;
            $Canvas->carregaUrl($nomeI)->hexa('#FFFFFF')->redimensiona(800, 390)->grava($pasta, 90);
            unlink('uploads/' . $temp);
        else:
            echo $novoNome = $query->img_banner;
        endif;


        $query->update([
            'titulo_banner' => $request->input('titulo'),
            'url_banner' => $request->input('url'),
            'img_banner' => $novoNome,
            'ativo_banner' => $request->input('ativo'),
        ]);

        return redirect()->route('banner.index');
    }

}
