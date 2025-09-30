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
      </div>
      @if(!empty($servico['website']))
        <a href="{{ $servico['website'] }}" target="_blank" class="w-full block py-3 rounded-md bg-green-600 hover:bg-green-700 text-white font-semibold shadow text-center">
          Ir para o site da empresa
        </a>
      @else
        <p class="text-red-500">Esta empresa não possui site cadastrado.</p>
      @endif
    </div>
  @else
    <p class="text-red-500">Serviço não encontrado.</p>
  @endif
</div>
@endsection