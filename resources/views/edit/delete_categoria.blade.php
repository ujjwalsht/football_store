@extends('layouts.app')

@section('content')
    {{-- ver si se queda --}}
    <div class="bg-white shadow p-3 rounded-lg"> 
        <h1>Advertencia</h1>
        <hr>
        <h3>¿Estas seguro de eliminar la categoria '<b>{{$categoria->name}}</b>' asociada a <b>{{count($categoria->camisetas)}}</b> camisetas?</h3><br>
        <form action="/categorias/{{$categoria->id}}/delete" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger ">Eliminar</button>
            <a href="/categorias" type="button" class="btn btn-outline-primary">Cancelar</a>
        </form>
    </div>
@endsection
