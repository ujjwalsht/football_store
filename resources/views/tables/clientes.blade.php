@extends('layouts.app')

@section('content')
    <div class="bg-white shadow p-3 rounded-lg"> 
      <h1>Clientes</h1>
      <hr><br>
      <table id="clientesTable" class="display" >
        <thead>
            <tr>
              <th>ID</th>
              <th>E-mail cliente</th>
              <th>Cantidad de Compras</th>
              <th class="nosort">Acciones</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($clientes as $cliente) 
            <tr>
                <td>{{ $cliente->id }}</td>
                <td>{{ $cliente->email }}</td>
                <td>{{ count($cliente->compras) }}</td>
                <td>
                  <span>
                    <a type="button" href="/clientes/{{$cliente->id}}" class="btn btn-primary">Ver compras</a>
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
        $('#clientesTable').DataTable({
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
