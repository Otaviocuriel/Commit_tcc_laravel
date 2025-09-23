<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    // ...existing methods...

    public function like($id)
    {
        $comentario = Comentario::findOrFail($id);
        $comentario->likes = $comentario->likes + 1;
        $comentario->save();

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {   {









}    // ...existing methods...    }        return redirect()->route('comentarios');        $comentario->save();        $comentario->texto = $request->input('texto');        $comentario = Comentario::findOrFail($id);        $comentario = Comentario::findOrFail($id);
        return view('pages.editar_comentario', compact('comentario'));
    }

    public function destroy($id)
    {
        $comentario = Comentario::findOrFail($id);
        $comentario->delete();
        return redirect()->route('comentarios');
    }
}