@extends('layouts.app')
@section('content')
<div class="max-w-xl mx-auto py-10 px-4">
  <h1 class="text-2xl font-bold mb-6 text-green-700">Confirmar Contratação</h1>
  @if(isset($mensagem))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
      <strong>{{ $mensagem }}</strong>
    </div>
  @endif
  @if($servico)
    <div class="bg-white dark:bg-gray-900 rounded-lg shadow p-6 mb-6">
      <h2 class="font-bold text-lg text-green-700 mb-2">{{ $servico['empresa'] }}</h2>
      <p><strong>Cidade:</strong> {{ $servico['cidade'] }}</p>
      <p><strong>Tipo de Energia:</strong> {{ $servico['tipo'] }}</p>
      <p><strong>Preço:</strong> R$ {{ $servico['preco'] }}</p>
      <p><strong>Destino:</strong> {{ $servico['destino'] }}</p>
    </div>
  <form method="POST" action="{{ route('contratar.post', ['empresa' => $servico['empresa']]) }}">
      @csrf
      <button type="submit" class="w-full py-3 rounded-md bg-green-600 hover:bg-green-700 text-white font-semibold shadow">Confirmar Contratação</button>
    </form>
  @else
    <p class="text-red-500">Serviço não encontrado.</p>
  @endif
</div>
@endsection
