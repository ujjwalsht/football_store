@extends('layouts.app')

@section('content')
    <div class="bg-white shadow p-3 rounded-lg"> 
      <h1>Compras</h1>
      <hr>
      <br>
      @include('components.alert.success')
      <table id="comprasTable" class="display" >
        <thead>
            <tr>
              <th>ID</th>
              <th>Cliente</th>
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
                <td>{{ $compra->cliente->email }}</td>
                <td>{{ "$".number_format($compra->precio_total,2) }}</td>
                <td>{{ count($compra->pedidos) }}</td>
                <td>{{ $compra->forma_de_pago }}</td>
                <td>{{ str_replace("|", ", ", $compra->direccion_de_entrega) }}</td>
                <td>{{ $compra->fecha_hora }}</td>
                <td>{{ $compra->estado }}</td>
                <td>
                  <span>
                    <a href="/compras/{{$compra->id}}" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Ver detalle">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-square" viewBox="0 0 16 16">
                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                      </svg>
                    </a>
                    <a type="button" href="/compras/{{$compra->id}}/edit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Actualizar estado">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-check" viewBox="0 0 16 16">
                        <path d="M11.354 6.354a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                      </svg>
                    </a>
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
            { "width": "5%", "targets": [3] }
          ]
        });
        $(".dataTables_length select").addClass("px-4");
      });
      $(function () {
      $('[data-toggle="tooltip"]').tooltip()
      })
    </script>
@endsection
