@extends('layouts.app')

@section('content')
    {{-- ver si se queda --}}
    <div class="bg-white shadow p-3 rounded-lg"> 
      <h1>Categorias</h1>
      <hr>
      <a href="/categorias/new" type="button" class="btn btn-success my-3">Nueva Categoría</a><br>
      @include('components.alert.success')
      @include('components.alert.deleted')
      <table id="categoriasTable" class="display">
        <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Cantidad de Camisetas</th>
              <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($categorias as $categoria) 
            <tr>
                <td>{{$categoria->id}}</td>
                <td>{{$categoria->name}}</td>
                <td>{{count($categoria->camisetas)}}</td>
                <td>
                  <span>
                    <a href="/camisetas/categoria/{{$categoria->id}}" type="button" class="btn btn-primary">Ver camisetas</a>
                    <a href="/categorias/{{$categoria->id}}/delete" type="button" class="btn btn-danger">Eliminar</a>
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
        $('#categoriasTable').DataTable({
          'lengthMenu': [5, 10, 20, 50],
          'responsive': true,
          'order': [[2, 'desc']],
        });
        $(".dataTables_length select").addClass("px-4");
      });
    </script>
@endsection
