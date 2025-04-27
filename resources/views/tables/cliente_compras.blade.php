@extends('layouts.app')

@section('content')
    <div class="bg-white shadow p-3 rounded-lg"> 
      <h1>Cliente</h1>
      <div class="lead">
        <h3>Información personal</h3>
        Email: {{ $cliente->email}}<br>
        ID: {{$cliente->id}}
      </div>
      <hr><br>
      <h3>Compras realizadas</h3><br>
      @include('components.alert.success')
      <table id="comprasTable" class="display">
        <thead>
            <tr>
              <th>ID</th>
              <th>Precio</th>
              <th>Cantidad items</th>
              <th>Forma de Pago</th>
              <th>Direccion</th>
              <th>Hora y Fecha</th>
              <th>Estado</th>
              <th class="nosort">Acciones</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($compras as $compra) 
            <tr>
                <td>{{ $compra->id }}</td>
                <td>{{ "$".number_format($compra->precio_total,2) }}</td>
                <td>{{ count($compra->pedidos) }}</td>
                <td>{{ $compra->forma_de_pago }}</td>
                <td>{{ str_replace("|", ", ", $compra->direccion_de_entrega) }}</td>
                <td>{{ $compra->fecha_hora }}</td>
                <td>{{ $compra->estado }}</td>
                <td>
                  <span>
                    <a type="button" href="/compras/{{$compra->id}}" class="btn btn-primary">Ver detalle</a>
                    <a type="button" href="/compras/{{$compra->id}}/edit" class="btn btn-warning">Actualizar estado</a>
                  </span>
                </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Datatables JS -->
    <script>
      $(document).ready(function () {
        $('#comprasTable').DataTable({
          'lengthMenu': [5, 10, 20, 50],
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
@endsection
