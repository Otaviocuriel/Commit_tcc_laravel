@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-100 mb-2">Ofertas de Energia Renovável</h1>
        <p class="text-lg text-gray-600 dark:text-gray-300">Encontre ofertas de energia limpa diretamente das empresas fornecedoras</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($ofertas as $oferta)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                            {{ ucfirst($oferta->tipo_energia) }}
                        </span>
                        <span class="text-2xl font-bold text-emerald-600">
                            R$ {{ number_format($oferta->preco_kwh, 2, ',', '.') }}/kWh
                        </span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-2">{{ $oferta->titulo }}</h3>
                    
                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-3">{{ $oferta->descricao }}</p>
                    
                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">Empresa:</span>
                            <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $oferta->empresa->name }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">Disponível:</span>
                            <span class="font-semibold text-gray-800 dark:text-gray-200">{{ number_format($oferta->quantidade_disponivel) }} kWh</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">Válido até:</span>
                            <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $oferta->data_fim->format('d/m/Y') }}</span>
                        </div>
                    </div>
                    
                    @auth
                        <button 
                            onclick="contratarOferta({{ $oferta->id }})"
                            class="w-full py-3 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg transition-colors duration-200"
                        >
                            Fazer Contratação
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="block w-full py-3 px-4 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg text-center transition-colors duration-200">
                            Entre para Contratar
                        </a>
                    @endauth
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <div class="text-6xl mb-4">🌱</div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-2">Nenhuma oferta disponível</h3>
                <p class="text-gray-600 dark:text-gray-300">No momento não há ofertas de energia renovável disponíveis.</p>
            </div>
        @endforelse
    </div>

    @if($ofertas->hasPages())
        <div class="mt-8">
            {{ $ofertas->links() }}
        </div>
    @endif
</div>

@auth
<script>
async function contratarOferta(ofertaId) {
    try {
        const response = await fetch(`/ofertas/${ofertaId}/contratar`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });

        const data = await response.json();

        if (response.ok && data.website) {
            // Confirmar antes de redirecionar
            if (confirm(`Você será redirecionado para o site da empresa ${data.empresa}. Deseja continuar?`)) {
                window.open(data.website, '_blank');
            }
        } else {
            alert(data.message || 'Esta empresa não possui um site cadastrado para contratação.');
        }
    } catch (error) {
        console.error('Erro ao processar contratação:', error);
        alert('Erro ao processar a solicitação. Tente novamente.');
    }
}
</script>
@endauth
@endsection
