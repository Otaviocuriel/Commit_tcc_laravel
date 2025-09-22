@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">
  <h1 class="text-3xl font-bold mb-6 text-green-700">Usuários Cadastrados</h1>
  <div class="grid gap-6">
    @forelse($usuarios as $usuario)
      <div class="bg-white dark:bg-gray-900 rounded-lg shadow p-6">
        <h2 class="font-bold text-lg text-green-700">{{ $usuario->name }}</h2>
        <p><strong>Email:</strong> {{ $usuario->email }}</p>
        <p><strong>CPF:</strong> {{ $usuario->cpf }}</p>
        <p><strong>Telefone:</strong> {{ $usuario->telefone }}</p>
        <p><strong>CEP:</strong> {{ $usuario->cep }}</p>
        <p><strong>Data de Nascimento:</strong> {{ $usuario->data_nascimento }}</p>
      </div>
    @empty
      <p class="text-gray-500">Nenhum usuário cadastrado.</p>
    @endforelse
  </div>
</div>
@endsection