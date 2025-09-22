@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 text-green-600">Mapa de Energia Sustentável - Região de Araras (SP)</h1>
    <div id="map" class="w-full h-96 rounded-lg shadow mb-8"></div>
    <h2 class="text-2xl font-semibold mb-4 text-green-500">Empresas de Energia</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow p-4 text-gray-900">
            <h3 class="font-bold text-lg">Araras Solar</h3>
            <p>Cidade: Araras</p>
            <p>Tipo: Solar</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 text-gray-900">
            <h3 class="font-bold text-lg">Energia Limpa Leme</h3>
            <p>Cidade: Leme</p>
            <p>Tipo: Solar/Eólica</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 text-gray-900">
            <h3 class="font-bold text-lg">Rio Claro Sustentável</h3>
            <p>Cidade: Rio Claro</p>
            <p>Tipo: Solar</p>
        </div>
    </div>
</div>
<!-- Leaflet.js CDN -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var map = L.map('map').setView([-22.3572, -47.3842], 10); // Araras
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap'
        }).addTo(map);
        // Cidades
        var cidades = [
            {nome: 'Araras', coords: [-22.3572, -47.3842], empresa: 'Araras Solar'},
            {nome: 'Leme', coords: [-22.1807, -47.3841], empresa: 'Energia Limpa Leme'},
            {nome: 'Rio Claro', coords: [-22.4149, -47.5606], empresa: 'Rio Claro Sustentável'}
        ];
        cidades.forEach(function(cidade) {
            L.marker(cidade.coords).addTo(map)
                .bindPopup('<b>' + cidade.nome + '</b><br>' + cidade.empresa);
        });
    });
</script>
@endsection
