@foreach($comentarios as $comentario)
  <div class="border-b py-2 flex justify-between items-center">
    <span>{{ $comentario->texto }}</span>
    @if(auth()->check() && auth()->user()->role === 'admin')
      <form method="POST" action="/admin/comentario/{{ $comentario->id }}" onsubmit="return confirm('Excluir este comentário?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded text-xs">Excluir</button>
      </form>
    @endif
  </div>
@endforeach