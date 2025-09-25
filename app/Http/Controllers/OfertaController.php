<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use Illuminate\Http\Request;

class OfertaController extends Controller
{
    public function index()
    {
        $ofertas = Oferta::with('empresa')
            ->where('ativa', true)
            ->where('data_fim', '>=', now())
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        
        return view('ofertas.index', compact('ofertas'));
    }

    public function contratar(Oferta $oferta)
    {
        $empresa = $oferta->empresa;
        
        if (!$empresa->website) {
            return back()->with('error', 'Esta empresa não possui um site cadastrado.');
        }
        
        // Garantir que a URL tenha protocolo
        $website = $empresa->website;
        if (!str_starts_with($website, 'http://') && !str_starts_with($website, 'https://')) {
            $website = 'https://' . $website;
        }
        
        return response()->json([
            'website' => $website,
            'empresa' => $empresa->name
        ]);
    }
}
