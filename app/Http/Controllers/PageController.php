<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
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
}
