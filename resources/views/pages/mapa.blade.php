@extends('layouts.app')
@section('content')
<div class="container py-5">
  <h1 class="text-2xl font-bold mb-4">Mapa das Energias Renováveis</h1>
  <div id="map" style="height: 400px; width: 100%;" class="rounded shadow"></div>
  <script>
    // Exemplo Leaflet (pode ser trocado por Google Maps)
    document.addEventListener('DOMContentLoaded', function() {
      var map = L.map('map').setView([-22.3572, -47.3842], 13); // Araras, SP
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data © OpenStreetMap contributors',
        maxZoom: 18,
        minZoom: 10
      }).addTo(map);
      // Pontos de energia renovável em Araras, SP
      L.marker([-22.3572, -47.3842]).addTo(map).bindPopup('<b>Usina Solar Araras</b><br>Empresa: Energia Limpa SP');
      L.marker([-22.3600, -47.3800]).addTo(map).bindPopup('<b>Pequena Central Hidrelétrica</b><br>Empresa: HidroAraras');
      L.marker([-22.3550, -47.3900]).addTo(map).bindPopup('<b>Empresa de Energia Eólica</b><br>Empresa: Ventos do Interior');
      // Personalização visual
      map.scrollWheelZoom.enable();
      map.zoomControl.setPosition('topright');
    });
  </script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</div>
@endsection