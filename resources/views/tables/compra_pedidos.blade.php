@extends('layouts.app')

@section('content')
    <div class="bg-white shadow p-3 rounded-lg"> 
      <h1>Compra Código {{$compra->id}}</h1>
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
          <br>
          Estado: {{ $compra->estado }}
          <br><br>
          <a type="button" href="/compras/{{$compra->id}}/edit" class="btn btn-warning">Actualizar estado</a>
          <br><br>
        </div>
        <div id="map-cont" class="lead map-cont w-full">
          <h3>Mapa</h3><br>
          <div id="map" class="mapa"></div>
        </div>
      </div>
      @include('components.alert.success')
      <hr>
      <div>
        <h3>Detalle con todos los pedidos</h3><br>
        <table id="pedidosTable" class="display">
        <thead>
            <tr>
              <th>Cód Producto</th>
              <th>Nombre Producto</th>
              <th>Nombre a Estampar</th>
              <th>Numero a Estampar</th>
              <th>Talle Elegido</th>
              <th>Precio Unitario</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($pedidos as $pedido) 
            <tr>
              <td>{{ $pedido->camiseta->id }}</td>
              <td>{{ $pedido->camiseta->nombre }}</td>
              <td>{{ $pedido->nombre_a_estampar }}</td>
              <td>{{ $pedido->numero_a_estampar }}</td>
              <td>{{ $pedido->talle_elegido }}</td>
              <td>{{ "$".number_format($pedido->precio,2) }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      </div>

    </div>

    <!-- Datatables JS -->
    <script>
      $(document).ready(function () {
        $('#pedidosTable').DataTable({  
          'responsive': true,
          'columnDefs': [
            { orderable: false, targets: [] }
          ],
          "columnDefs": [
            { "width": "15%", "targets": [] }
          ]
        });
        $(".dataTables_length select").addClass("px-4");
      });
    </script>

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
