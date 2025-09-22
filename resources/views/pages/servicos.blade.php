@extends('layouts.app')
@section('content')
<div class="max-w-5xl mx-auto py-10 px-4">
  <h1 class="text-3xl font-bold mb-6 text-green-700">Tabela de Preços e Destinos de Energia</h1>
  <p class="mb-8 text-gray-700">Veja as empresas fornecedoras, valores e para onde está indo a energia contratada. Contrate diretamente e acompanhe o destino!</p>
  <div class="overflow-x-auto">
    <table class="min-w-full bg-white dark:bg-gray-900 rounded-lg shadow">
      <thead class="bg-green-600 text-white">
        <tr>
          <th class="py-3 px-4 text-left">Empresa</th>
          <th class="py-3 px-4 text-left">Cidade</th>
          <th class="py-3 px-4 text-left">Tipo de Energia</th>
          <th class="py-3 px-4 text-left">Preço (R$/MWh)</th>
          <th class="py-3 px-4 text-left">Destino</th>
          <th class="py-3 px-4 text-left">Ação</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
        <tr>
          <td class="py-3 px-4 font-semibold">Araras Solar</td>
          <td class="py-3 px-4">Araras</td>
          <td class="py-3 px-4">Solar</td>
          <td class="py-3 px-4">320,00</td>
          <td class="py-3 px-4">Residencial - Bairro Centro</td>
          <td class="py-3 px-4">
            <a href="{{ route('contratar', ['empresa' => 'Araras Solar']) }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition">Contratar</a>
          </td>
        </tr>
        <tr>
          <td class="py-3 px-4 font-semibold">Energia Limpa Leme</td>
          <td class="py-3 px-4">Leme</td>
          <td class="py-3 px-4">Solar/Eólica</td>
          <td class="py-3 px-4">295,00</td>
          <td class="py-3 px-4">Comercial - Av. Brasil</td>
          <td class="py-3 px-4">
            <a href="{{ route('contratar', ['empresa' => 'Energia Limpa Leme']) }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition">Contratar</a>
          </td>
        </tr>
        <tr>
          <td class="py-3 px-4 font-semibold">Rio Claro Sustentável</td>
          <td class="py-3 px-4">Rio Claro</td>
          <td class="py-3 px-4">Solar</td>
          <td class="py-3 px-4">310,00</td>
          <td class="py-3 px-4">Industrial - Distrito 1</td>
          <td class="py-3 px-4">
            <a href="{{ route('contratar', ['empresa' => 'Rio Claro Sustentável']) }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition">Contratar</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
