@extends('layouts.app')
@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">
  <h1 class="text-3xl font-bold mb-4">Painel Empresa: {{ $user->name }}</h1>
  <p class="mb-6 text-gray-600 dark:text-gray-300">Você está autenticado como <strong>Empresa Fornecedora</strong>.</p>
  <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="p-5 bg-white dark:bg-gray-800 rounded shadow border-l-4 border-emerald-500">
      <h2 class="font-semibold mb-2">Publicar Oferta</h2>
      <p class="text-sm">Cadastro de novas ofertas (futuro).</p>
    </div>
    <div class="p-5 bg-white dark:bg-gray-800 rounded shadow border-l-4 border-indigo-500">
      <h2 class="font-semibold mb-2">Pedidos</h2>
      <p class="text-sm">Gerencie pedidos recebidos.</p>
    </div>
    <div class="p-5 bg-white dark:bg-gray-800 rounded shadow border-l-4 border-yellow-500">
      <h2 class="font-semibold mb-2">Comentários</h2>
      <p class="text-sm">Interaja com compradores.</p>
    </div>
    <div class="p-5 bg-white dark:bg-gray-800 rounded shadow border-l-4 border-pink-500">
      <h2 class="font-semibold mb-2">Relatórios</h2>
      <p class="text-sm">Acompanhe desempenho (em breve).</p>
    </div>
  </div>
</div>
@endsection
