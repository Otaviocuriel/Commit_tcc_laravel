<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function contratarPost(Request $request, $empresa)
    {
        // Aqui você pode salvar a contratação no banco, enviar email, etc.
        // Exemplo: apenas exibe mensagem de sucesso
        $servicos = [
            'Araras Solar' => [
                'empresa' => 'Araras Solar',
                'cidade' => 'Araras',
                'tipo' => 'Solar',
                'preco' => '320,00',
                'destino' => 'Residencial - Bairro Centro',
            ],
            'Energia Limpa Leme' => [
                'empresa' => 'Energia Limpa Leme',
                'cidade' => 'Leme',
                'tipo' => 'Solar/Eólica',
                'preco' => '295,00',
                'destino' => 'Comercial - Av. Brasil',
            ],
            'Rio Claro Sustentável' => [
                'empresa' => 'Rio Claro Sustentável',
                'cidade' => 'Rio Claro',
                'tipo' => 'Solar',
                'preco' => '310,00',
                'destino' => 'Industrial - Distrito 1',
            ],
        ];
        $servico = $servicos[$empresa] ?? null;
        $mensagem = 'Serviço contratado com sucesso!';
        return view('pages.contratar', compact('servico', 'mensagem'));
    }
    public function contratar($empresa)
    {
        // Dados simulados, pode ser melhorado para buscar de um banco
        $servicos = [
            'Araras Solar' => [
                'empresa' => 'Araras Solar',
                'cidade' => 'Araras',
                'tipo' => 'Solar',
                'preco' => '320,00',
                'destino' => 'Residencial - Bairro Centro',
            ],
            'Energia Limpa Leme' => [
                'empresa' => 'Energia Limpa Leme',
                'cidade' => 'Leme',
                'tipo' => 'Solar/Eólica',
                'preco' => '295,00',
                'destino' => 'Comercial - Av. Brasil',
            ],
            'Rio Claro Sustentável' => [
                'empresa' => 'Rio Claro Sustentável',
                'cidade' => 'Rio Claro',
                'tipo' => 'Solar',
                'preco' => '310,00',
                'destino' => 'Industrial - Distrito 1',
            ],
        ];
        $servico = $servicos[$empresa] ?? null;
        return view('pages.contratar', compact('servico'));
    }
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
