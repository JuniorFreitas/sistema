<?php

namespace ptb\Http\Controllers;

use Illuminate\Http\Request;

use ptb\Http\Requests;

class MsgController extends Controller
{
    public function sair()
    {
        return view('sistema.msg.logout');
    }

    public function excluir()
    {
        return view('sistema.msg.excluir');
    }

    public function excluirBanner()
    {
        return view('sistema.msg.excluirBanner');
    }

    public function excluirPagina()
    {
        return view('sistema.msg.excluirPagina');
    }

    public function excluirVideo()
    {
        return view('sistema.msg.excluirVideo');
    }

    public function excluirHomilia()
    {
        return view('sistema.msg.excluirHomilia');
    }

    public function excluirGaleria()
    {
        return view('sistema.msg.excluirGaleria');
    }
    public function excluirCarpinteiro()
    {
        return view('sistema.msg.excluirCarpinteiro');
    }
}
