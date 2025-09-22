@extends('layouts.app')
@section('content')
<div class="max-w-xl mx-auto py-10 px-4 bg-black text-white rounded-xl shadow-lg">
  <h1 class="text-2xl font-bold mb-6">Editar Comentário</h1>
  <form method="POST" action="">
    @csrf
    <label for="comentario" class="block mb-2 font-semibold">Comentário:</label>
    <textarea name="comentario" id="comentario" rows="3" class="w-full p-3 rounded bg-gray-900 text-white border border-white/10 mb-4" required>{{ $comentario->texto }}</textarea>
    <button type="submit" class="px-6 py-2 rounded bg-gradient-to-r from-green-600 to-green-400 text-white font-bold shadow hover:from-green-700 hover:to-green-500 transition">Salvar</button>
    <a href="{{ route('comentarios') }}" class="ml-4 underline text-white/70">Cancelar</a>
  </form>
</div>
@endsection
