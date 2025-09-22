<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->merge([
            'cpf' => $request->cpf ? preg_replace('/\D/','',$request->cpf) : null,
            'cnpj' => $request->cnpj ? preg_replace('/\D/','',$request->cnpj) : null,
            'cep' => $request->cep ? preg_replace('/\D/','',$request->cep) : null,
            'telefone' => $request->telefone ? preg_replace('/\D/','',$request->telefone) : null,
        ]);

        $rules = [
            'role' => ['required','in:user,company'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', 'min:6'],
            'telefone' => ['nullable','string','max:20'],
            'cep' => ['nullable','string','max:10'],
        ];

        if ($request->role === 'user') {
            $rules['cpf'] = ['nullable','string','max:14'];
            $rules['data_nascimento'] = ['nullable','date'];
        } else {
            $rules['cnpj'] = ['nullable','string','max:18'];
            $rules['cargo'] = ['nullable','string','max:50'];
        }

        $validated = $request->validate($rules);

        $user = User::create([
            'role' => $validated['role'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'cpf' => $validated['role']==='user' ? ($validated['cpf'] ?? null) : null,
            'data_nascimento' => $validated['role']==='user' ? ($validated['data_nascimento'] ?? null) : null,
            'cnpj' => $validated['role']==='company' ? ($validated['cnpj'] ?? null) : null,
            'cargo' => $validated['role']==='company' ? ($validated['cargo'] ?? null) : null,
            'telefone' => $validated['telefone'] ?? null,
            'cep' => $validated['cep'] ?? null,
        ]);

        event(new Registered($user));

    // Não autentica automaticamente, apenas salva e redireciona para login
    return redirect()->route('login')->with('status', 'Cadastro realizado com sucesso! Faça login para continuar.');
    }
}
