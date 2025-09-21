<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function comentarios()
    {
        return view('pages.comentarios');
    }

    public function servicos()
    {
        return view('pages.servicos');
    }

    public function contato()
    {
        return view('pages.contato');
    }

    public function mapa()
    {
        return view('pages.mapa');
    }

    public function planos()
    {
        return view('pages.planos');
    }

    public function empresas()
    {
        return view('pages.empresas');
    }

    public function usuario()
    {
        return view('pages.usuario');
    }
}
