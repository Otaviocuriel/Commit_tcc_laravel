@extends('layouts.app')
@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">
  <h1 class="text-3xl font-bold mb-4">Painel Empresa: {{ $user->name }}</h1>
  <p class="mb-6 text-gray-600 dark:text-gray-300">Você está autenticado como <strong>Empresa Fornecedora</strong>.</p>
  
  @if(!$user->website)
  <div class="mb-6 p-4 bg-yellow-50 dark:bg-yellow-900/30 border border-yellow-200 dark:border-yellow-700 rounded-lg">
    <p class="text-yellow-800 dark:text-yellow-200">
      <strong>Importante:</strong> Para que os clientes possam fazer contratações, você precisa cadastrar o site da sua empresa no seu perfil.
    </p>
  </div>
  @endif

  <!-- Formulário para cadastrar/editar site -->
  <div class="mb-8">
    <form method="POST" action="{{ route('empresa.site.update') }}" class="flex gap-2 items-end">
      @csrf
      <label class="block text-sm text-gray-700 dark:text-gray-200">
        Site da Empresa:
        <input type="url" name="website" value="{{ old('website', $user->website) }}" class="mt-1 px-3 py-2 rounded-md bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 w-72" placeholder="https://www.suaempresa.com.br" required>
      </label>
      <button type="submit" class="px-4 py-2 rounded bg-emerald-600 text-white font-semibold">Salvar</button>
    </form>
    @if(session('success'))
      <div class="mt-2 text-green-600">{{ session('success') }}</div>
    @endif
  </div>

  <!-- Formulário para cadastrar/editar endereço -->
  <div class="mb-8">
    <form method="POST" action="{{ route('empresa.endereco.update') }}" class="flex gap-2 items-end">
      @csrf
      <label class="block text-sm text-gray-700 dark:text-gray-200">
        Endereço da Empresa:
        <input type="text" name="endereco" value="{{ old('endereco', $user->endereco) }}" class="mt-1 px-3 py-2 rounded-md bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 w-72" placeholder="Rua, número, cidade, estado" required>
      </label>
      <button type="submit" class="px-4 py-2 rounded bg-emerald-600 text-white font-semibold">Salvar</button>
    </form>
    @if(session('success'))
      <div class="mt-2 text-green-600">{{ session('success') }}</div>
    @endif
  </div>

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
