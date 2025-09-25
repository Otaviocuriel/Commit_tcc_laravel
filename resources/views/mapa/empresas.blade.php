@extends('layouts.app')
@section('content')
<div class="max-w-5xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold mb-6">Mapa das Empresas</h1>
    <div id="map" style="height: 500px; width: 100%;" class="rounded-lg shadow"></div>
</div>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var map = L.map('map').setView([-14.2350, -51.9253], 4); // Brasil
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    @foreach($empresas as $empresa)
      @if($empresa->latitude && $empresa->longitude)
        var marker = L.marker([{{ $empresa->latitude }}, {{ $empresa->longitude }}]).addTo(map);
        var popupContent = `<strong>{{ $empresa->name }}</strong><br>{{ $empresa->endereco }}`;
        marker.bindPopup(popupContent);
      @endif
    @endforeach
});

function excluirEmpresa(id) {
    if(confirm('Excluir esta empresa?')) {
        fetch('/admin/empresa/' + id, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(response => {
            if(response.ok) {
                location.reload();
            } else {
                alert('Erro ao excluir empresa.');
            }
        });
    }
}
</script>
@endsection
}
</script>
@endsection
