@extends('layouts.app')
@section('content')
<div class="max-w-5xl mx-auto py-10 px-4">
  <h1 class="text-3xl font-bold mb-6 text-white">Comentários</h1>
  @auth
    <form method="POST" action="{{ route('comentarios.post') }}" class="mb-8 bg-black border border-white/10 rounded-xl shadow-xl p-6">
      @csrf
      <label for="comentario" class="block mb-2 text-white font-semibold">Deixe seu comentário:</label>
      <textarea name="comentario" id="comentario" rows="3" class="w-full p-3 rounded bg-gray-900 text-white border border-white/10 mb-4" required></textarea>
      <button type="submit" class="px-6 py-2 rounded bg-gradient-to-r from-green-600 to-green-400 text-white font-bold shadow hover:from-green-700 hover:to-green-500 transition">Enviar</button>
    </form>
  @else
    <div class="mb-8 bg-black border border-white/10 rounded-xl shadow-xl p-6 text-center text-white/80">
      <span class="font-semibold">Faça login para comentar.</span>
      <a href="{{ route('login') }}" class="ml-2 underline text-green-400">Entrar</a>
    </div>
  @endauth
  <div class="space-y-4">
    <h2 class="text-xl font-bold mb-4 text-white">Comentários recentes</h2>
    @forelse($comentarios as $comentario)
      <div class="bg-gray-900 border border-white/10 rounded-lg p-4 text-white shadow mb-2">
        <div class="flex justify-between items-center mb-2">
          <span class="block text-sm opacity-70">{{ $comentario->user->name ?? 'Usuário' }} — {{ $comentario->created_at->format('d/m/Y H:i') }}</span>
          @auth
            <div class="flex gap-2">
              <form method="POST" action="{{ route('comentarios.like', $comentario->id) }}">
                @csrf
                <button type="submit" class="text-green-400 hover:text-green-600 text-xs font-bold">Curtir ({{ $comentario->likes }})</button>
              </form>
              @if($comentario->user_id === auth()->id())
                <a href="{{ route('comentarios.edit', $comentario->id) }}" class="text-blue-400 hover:text-blue-600 text-xs font-bold">Editar</a>
                <form method="POST" action="{{ route('comentarios.delete', $comentario->id) }}" onsubmit="return confirm('Excluir este comentário?')" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-400 hover:text-red-600 text-xs font-bold">Excluir</button>
                </form>
              @endif
            </div>
          @endauth
        </div>
        <p class="text-lg mb-2">{{ $comentario->texto }}</p>
        @auth
          <button onclick="document.getElementById('responder-{{ $comentario->id }}').classList.toggle('hidden')" class="text-green-400 hover:underline text-xs mb-2">Responder</button>
          <form id="responder-{{ $comentario->id }}" class="hidden mt-2" method="POST" action="{{ route('comentarios.post') }}">
            @csrf
            <input type="hidden" name="parent_id" value="{{ $comentario->id }}">
            <textarea name="comentario" rows="2" class="w-full p-2 rounded bg-gray-800 text-white border border-white/10 mb-2" required placeholder="Digite sua resposta..."></textarea>
            <button type="submit" class="px-4 py-1 rounded bg-gradient-to-r from-green-600 to-green-400 text-white text-xs font-bold shadow">Enviar resposta</button>
          </form>
        @endauth
        @if($comentario->respostas->count())
          <div class="ml-6 mt-3 border-l border-white/10 pl-4">
            @foreach($comentario->respostas as $resposta)
              <div class="bg-gray-800 border border-white/10 rounded p-3 text-white shadow mb-2">
                <div class="flex justify-between items-center mb-1">
                  <span class="block text-xs opacity-70">{{ $resposta->user->name ?? 'Usuário' }} — {{ $resposta->created_at->format('d/m/Y H:i') }}</span>
                  @auth
                    <div class="flex gap-2">
                      <form method="POST" action="{{ route('comentarios.like', $resposta->id) }}">
                        @csrf
                        <button type="submit" class="text-green-400 hover:text-green-600 text-xs font-bold">Curtir ({{ $resposta->likes }})</button>
                      </form>
                      @if($resposta->user_id === auth()->id())
                        <a href="{{ route('comentarios.edit', $resposta->id) }}" class="text-blue-400 hover:text-blue-600 text-xs font-bold">Editar</a>
                        <form method="POST" action="{{ route('comentarios.delete', $resposta->id) }}" onsubmit="return confirm('Excluir esta resposta?')" style="display:inline;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="text-red-400 hover:text-red-600 text-xs font-bold">Excluir</button>
                        </form>
                      @endif
                    </div>
                  @endauth
                </div>
                <p class="text-sm">{{ $resposta->texto }}</p>
              </div>
            @endforeach
          </div>
        @endif
      </div>
    @empty
      <p class="text-white/70">Nenhum comentário ainda. Seja o primeiro!</p>
    @endforelse
  </div>
</div>
@endsection
