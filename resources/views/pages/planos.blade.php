@extends('layouts.app')
@section('content')
<div class="container py-5">
  <h1 class="text-2xl font-bold mb-4">Planos de Energia</h1>
  <div class="grid md:grid-cols-2 gap-6">
    <div class="p-5 bg-white rounded shadow">
      <h2 class="font-semibold mb-2">Plano Básico</h2>
      <p class="text-sm">Energia solar rastreada. Ideal para residências.</p>
    </div>
    <div class="p-5 bg-white rounded shadow">
      <h2 class="font-semibold mb-2">Plano Empresarial</h2>
      <p class="text-sm">Energia eólica e solar, com relatório de origem.</p>
    </div>
  </div>
</div>
@endsection