@extends('layouts.app')
@section('content')
<div class="max-w-xl mx-auto py-10 px-4 bg-gray-900 text-white rounded-xl shadow-lg">
  <h1 class="text-2xl font-bold mb-6 text-green-700">Confirmar Contratação</h1>
  @if(isset($mensagem))
    <div class="bg-green-900 border border-green-400 text-green-200 px-4 py-3 rounded mb-6">
      <strong>{{ $mensagem }}</strong>
    </div>
  @endif
  @if(isset($servico) && is_array($servico))
    <div class="bg-gray-800 rounded-lg shadow p-6 mb-6">
      <h2 class="font-bold text-lg text-green-700 mb-2">{{ $servico['empresa'] }}</h2>
      <div class="mb-6">
        <p><strong>Cidade:</strong> {{ $servico['cidade'] ?? 'N/A' }}</p>
        <p><strong>Tipo de Energia:</strong> {{ $servico['tipo'] ?? 'N/A' }}</p>
        <p><strong>Preço:</strong> R$ {{ $servico['preco'] ?? 'N/A' }}</p>
        <p><strong>Destino:</strong> {{ $servico['destino'] ?? 'N/A' }}</p>
        @if(auth()->check() && auth()->user()->role === 'admin' && isset($servico['empresa_id']))
          <form method="POST" action="/admin/empresa/{{ $servico['empresa_id'] }}" onsubmit="return confirm('Excluir esta empresa?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="mt-2 px-4 py-2 bg-red-600 text-white rounded">Excluir Empresa</button>
          </form>
        @endif
      </div>
      @if(isset($servico['id']))
        <form method="POST" action="{{ route('contratar.confirmar', $servico['id']) }}">
          @csrf
          <button type="submit" class="w-full py-3 rounded-md bg-green-600 hover:bg-green-700 text-white font-semibold shadow">Confirmar Contratação</button>
        </form>
      @else
        <p class="text-red-500">ID do serviço não encontrado. Não é possível contratar.</p>
      @endif
    </div>
  @else
    <p class="text-red-500">Serviço não encontrado.</p>
  @endif
</div>
@endsection
