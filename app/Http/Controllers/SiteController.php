<?php

namespace ptb\Http\Controllers;

use Illuminate\Http\Request;

use Mockery\CountValidator\Exception;
use ptb\Http\Requests;
use ptb\Noticias;
use ptb\Helper\Minifer;

class SiteController extends Controller
{

    /**
     * SiteController constructor.
     */
    private $ModelNoticias;

    public function __construct(Noticias $ModelNoticias)
    {
        $this->ModelNoticias = $ModelNoticias;
    }

    public function index()
    {
        $carousel = $this->ModelNoticias->orderBy('dataAtualizado', 'desc')->skip(0)->take(5)->get();
        $unNot = $this->ModelNoticias->orderBy('dataAtualizado', 'desc')->skip(5)->take(1)->get();
        $noticias = $this->ModelNoticias->orderBy('dataAtualizado', 'desc')->skip(6)->take(3)->get();
        return view('site.pag.home', compact('carousel', 'unNot', 'noticias'));
    }

    public function getNoticia($slug)
    {
        $linha = $this->ModelNoticias->where('slug', $slug)->get();
        return view('site.pag.noticia', compact('linha'));
      
    }

    public function getAllNoticias()
    {
        $noticias = $this->ModelNoticias->all();
        return view('site.pag.AllNoticias', compact('noticias'));
    }

    public function contato()
    {
        return view('site.pag.contato');
    }
}
