@extends('layouts.app')

@section('content')
    <div class="bg-white shadow p-3 rounded-lg"> 
      @if (isset($categoria))
        <h1>Camisetas de {{$categoria->name}}</h1>
        <hr>
      @else
        <h1>Camisetas</h1>
        <hr>
        <a href="/camisetas/new" type="button" class="btn btn-success my-3">Nueva Camiseta</a><br>
      @endif
      @include('components.alert.success')
      @include('components.alert.deleted')
      <table id="camisetasTable" class="display">
        <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th class="nosort">Descripción</th>
              <th>Precio</th>
              <th class="nosort">Frente</th>
              <th class="nosort">Atras</th>
              <th>Talles Disponibles</th>
              <th>En Stock</th>
              <th class="nosort">Categorías</th>
              <th class="nosort">Acciones</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($camisetas as $camiseta) 
            <tr>
                <td>{{$camiseta->id}}</td>
                <td>{{mb_strimwidth($camiseta->nombre, 0, 40, "...")}}</td>
                <td>{{mb_strimwidth($camiseta->descripcion, 0, 40, "...")}}</td>
                <td>${{number_format($camiseta->precio,2)}}</td>
                <td><img src={{"data:image/png;base64,".$camiseta->imagen_frente}} width=75/></td>
                <td><img src={{"data:image/png;base64,".$camiseta->imagen_atras}} width=75/></td>
                <td>{{$camiseta->talles_disponibles}}</td>
                @if ($camiseta->activo == 1)
                  <td class="text-center">✅</td>
                @else
                  <td class="text-center">🚫</td>
                @endif
                <td>
                  @php
                    $categoriesName = array();
                    foreach($camiseta->categorias as $category){
                      array_push($categoriesName, $category->name);
                    }
                    $categorias = implode(', ', $categoriesName);
                  @endphp
                  {{mb_strimwidth($categorias, 0, 40, "...")}}
                </td>
                <td>
                  <span>
                    <form action="/camisetas/{{$camiseta->id}}/stock" method="POST">
                      @csrf
                      @method('PATCH')
                      <a href="/camisetas/{{$camiseta->id}}/edit" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                      </a>
                      <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Actualizar stock">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-archive" viewBox="0 0 16 16">
                          <path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                      </button>
                      <a href="/camisetas/{{$camiseta->id}}/delete" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                          <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                        </svg>  
                      </a>
                    </form>
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
        $('#camisetasTable').DataTable({
          'lengthMenu': [5, 10, 20, 50],
          'responsive': true,
          'columnDefs': [
            { orderable: false, targets: [2,4,5,8,9] }
          ],
          "columnDefs": [
            { "width": "12%", "targets": [1] },
            { "width": "15%", "targets": [2] },
            { "width": "6%", "targets": [4,5] },
            { "width": "10%", "targets": [6] },
            { "width": "5%", "targets": [7] },
          ]
        });
        $(".dataTables_length select").addClass("px-4");
      });

      $(function () {
      $('[data-toggle="tooltip"]').tooltip()
      })
    </script>
@endsection
