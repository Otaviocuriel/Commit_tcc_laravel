@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">
  <h1 class="text-3xl font-bold mb-6 text-green-700">Empresas Cadastradas</h1>
  <div class="grid gap-6">
    @forelse($empresas as $empresa)
      <div class="bg-white dark:bgs-gray-900 rounded-lg shadow p-6">
        <h2 class="font-bold text-lg text-green-700">{{ $empresa->name }}</h2>
        <p><strong>Email:</strong> {{ $empresa->email }}</p>
        <p><strong>CNPJ:</strong> {{ $empresa->cnpj }}</p>
        <p><strong>Telefone:</strong> {{ $empresa->telefone }}</p>
        <p><strong>CEP:</strong> {{ $empresa->cep }}</p>
        <p><strong>Cargo:</strong> {{ $empresa->cargo }}</p>
      </div>
    @empty
      <p class="text-gray-500">Nenhuma empresa cadastrada.</p>
    @endforelse
  </div>
</div>
@endsection