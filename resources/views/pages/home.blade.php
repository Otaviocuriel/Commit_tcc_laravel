@extends('layouts.app')
@section('content')
<div class="container py-5">
  <h1 class="text-3xl font-bold mb-4">Bem-vindo ao Blockchain Verde</h1>
  <p class="mb-6 text-gray-700">Projeto de energia renovável para rastreamento e transparência na origem da energia contratada.</p>
  <div class="grid md:grid-cols-2 gap-6">
    <div class="p-5 bg-white rounded shadow">
      <h2 class="font-semibold mb-2">Transparência</h2>
      <p class="text-sm">Saiba exatamente onde sua energia é gerada.</p>
    </div>
    <div class="p-5 bg-white rounded shadow">
      <h2 class="font-semibold mb-2">Sustentabilidade</h2>
      <p class="text-sm">Energia limpa e confiável para todos.</p>
    </div>
  </div>
</div>
@endsection