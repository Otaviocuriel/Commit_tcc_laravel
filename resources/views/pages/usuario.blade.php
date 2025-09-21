@extends('layouts.app')
@section('content')
<div class="container py-5">
  <h1 class="text-2xl font-bold mb-4">Área do Usuário</h1>
  <p class="mb-4">Acompanhe seu plano, veja a origem da energia contratada e atualize seus dados.</p>
  @auth
    <div class="bg-white p-4 rounded shadow">
      <strong>Nome:</strong> {{ Auth::user()->name }}<br>
      <strong>Email:</strong> {{ Auth::user()->email }}
    </div>
  @else
    <a href="{{ route('login') }}" class="btn btn-primary">Faça login</a>
  @endauth
</div>
@endsection