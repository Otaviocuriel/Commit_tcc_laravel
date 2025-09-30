<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;

class PageController extends Controller
{
    // Adicione o array de serviços com websites como um atributo da classe
    private $servicos = [
        'Araras Solar' => [
            'empresa' => 'Araras Solar',
            'cidade' => 'Araras',
            'tipo' => 'Solar',
            'preco' => '320,00',
            'destino' => 'Residencial - Bairro Centro',
            'website' => 'https://www.solararas.com.br/'
        ],
        'EletroBidu' => [
            'empresa' => 'EletroBidu',
            'cidade' => 'Leme',
            'tipo' => 'Solar/Eólica',
            'preco' => '295,00',
            'destino' => 'Comercial - Av. Brasil',
            'website' => 'https://energiasolar.eletrobidu.com.br/lpm-02/?social=1&utm_source=google&utm_medium=cpc&utm_campaign=[pesquisa]-Indaiatuba-Beta-202304&utm_term=c;g;b&utm_content=or%C3%A7amento%20energia%20solar&campanha=[pesquisa]-Indaiatuba-Beta-202304&criativo=pesquisa&gad_source=1&gad_campaignid=19965561813&gbraid=0AAAAAC-GuTs8w9-4mHLGmkmooOLNzSdm2&gclid=CjwKCAjw_-3GBhAYEiwAjh9fUHodAKtT2S7zl3OexeU0Asg58jrHJloms5uVBbddck6nnWwPgMh2aRoCOZgQAvD_BwE'
        ],
        'Evosolar' => [
            'empresa' => 'Evosolar',
            'cidade' => 'Rio Claro',
            'tipo' => 'Solar',
            'preco' => '310,00',
            'destino' => 'Industrial - Distrito 1',
            'website' => 'https://evosolar.com.br/unidades/energia-solar-em-rio-claro-sp/'
        ],
    ];

    public function contratarPost(Request $request, $empresa)
    {
        $servico = $this->servicos[$empresa] ?? null;
        $mensagem = 'Serviço contratado com sucesso!';
        return view('pages.contratar', compact('servico', 'mensagem'));
    }

    public function contratar($empresa)
    {
        $servico = $this->servicos[$empresa] ?? null;
        return view('pages.contratar', compact('servico'));
    }

    public function home()
    {
        return view('pages.home');
    }

    public function comentarios()
    {
        $comentarios = Comentario::whereNull('parent_id')->with(['user','respostas.user'])->orderByDesc('created_at')->get();
        return view('pages.comentarios', compact('comentarios'));
    }

    public function comentariosPost(Request $request)
    {
        $request->validate(['comentario' => 'required|string|max:500']);
        Comentario::create([
            'user_id' => auth()->id(),
            'texto' => $request->comentario,
            'parent_id' => $request->parent_id ?? null,
        ]);
        return redirect()->route('comentarios');
    }

    public function comentariosDelete($id)
    {
        $comentario = Comentario::findOrFail($id);
        if ($comentario->user_id === auth()->id()) {
            $comentario->delete();
        }
        return redirect()->route('comentarios');
    }

    public function servicos()
    {
        // Passe os serviços para a view
        $servicos = $this->servicos;
        return view('pages.servicos', compact('servicos'));
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
        $empresas = \App\Models\User::where('role', 'company')->get();
        return view('pages.empresas', compact('empresas'));
    }

    public function usuario()
    {
        $usuarios = \App\Models\User::where('role', 'user')->get();
        return view('pages.usuario', compact('usuarios'));
    }

    public function energia()
    {
        return view('pages.energia');
    }
}