@extends('layouts.app')
@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">
  <h1 class="text-3xl font-bold mb-4">Bem-vindo, {{ $user->name }}</h1>
  <p class="mb-6 text-gray-600 dark:text-gray-300">Você está autenticado como <strong>Usuário Comprador</strong>.</p>
  <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="p-5 bg-white dark:bg-gray-800 rounded shadow">
      <h2 class="font-semibold mb-2">Explorar Ofertas</h2>
      <p class="text-sm">Listagem futura de ofertas de energia.</p>
    </div>
    <div class="p-5 bg-white dark:bg-gray-800 rounded shadow">
      <h2 class="font-semibold mb-2">Pedidos</h2>
      <p class="text-sm">Acompanhe pedidos enviados (em breve).</p>
    </div>
    <div class="p-5 bg-white dark:bg-gray-800 rounded shadow">
      <h2 class="font-semibold mb-2">Comentários</h2>
      <p class="text-sm">Interaja com fornecedores.</p>
    </div>
  </div>
</div>
@endsection
