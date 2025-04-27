@extends('layouts.app')

@section('content')
    <div class="bg-white shadow p-3 rounded-lg"> 
      <h1>Editando Compra Código {{$compra->id}}</h1>
      <hr><br>
      <div class="flex flex-row">
        <div class="lead w-full">
          <h3>Ticket</h3><br>
          E-mail: {{ $compra->cliente->email }}
          <br>
          Precio Total: {{ "$".number_format($compra->precio_total,2) }} 
          <br>
          Cantidad Items: {{ count($compra->pedidos) }}
          <br>
          Forma de pago: {{ $compra->forma_de_pago }} 
          <br>
          Dirección entrega: {{ str_replace("|", ", ", $compra->direccion_de_entrega) }}
          <br>
          Fecha y Hora de Compra: {{ $compra->fecha_hora }}
          <br><br>
          <form action="/compras/{{$compra->id}}/edit" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PATCH')
              <label for="estado">Seleccioná Estado:</label>
              <select id="estado" name="estado">
                  <option value="Entregado" @if($compra->estado == "Entregado") selected @endif >Entregado</option>
                  <option value="En viaje" @if($compra->estado == "En viaje") selected @endif>En viaje</option>
                  <option value="En preparacion" @if($compra->estado == "En preparacion") selected @endif>En preparacion</option>
                  <option value="Esperando pago" @if($compra->estado == "Esperando pago") selected @endif>Esperando pago</option>
                  <option value="Cancelado" @if($compra->estado == "Cancelado") selected @endif>Cancelado</option>
              </select> 
              <br><br>
              <button type="submit" class="btn btn-outline-primary">Guardar</button>
          </form>
        </div>
        <div id="map-cont" class="lead map-cont w-full">
          <h3>Mapa</h3><br>
          <div id="map" class="mapa"></div>
        </div>
      </div>

    </div>

    <!-- Leaflet -->
    <script>
      @if(isset($lat) && isset($lon))
        var lat = @json($lat);
        var lon = @json($lon);

        var map = L.map('map').setView([lat, lon], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([lat, lon]).addTo(map)
            .bindPopup('Dirección de entrega');
      @else
        var element = document.getElementById("map-cont");

        if (element) {
            element.parentNode.removeChild(element);
        }
      @endif
    </script>

@endsection
