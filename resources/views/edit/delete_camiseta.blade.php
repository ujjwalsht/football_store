@extends('layouts.app')

@section('content')
    {{-- ver si se queda --}}
    <div class="bg-white shadow p-3 rounded-lg"> 
        <h1>Advertencia</h1>
        <hr>
        <h3>¿Estas seguro de eliminar PERMANENTEMENTE la camiseta '<b>{{$camiseta->nombre}}</b>' con código <b>{{$camiseta->id}}</b>?</h3>
        <h6>Existe la opción de darla de baja temporalmente por stock</h6><br>
        <form action="/camisetas/{{$camiseta->id}}/delete" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar</button>
            <a href="/camisetas" type="button" class="btn btn-outline-primary">Cancelar</a>
        </form>
    </div>
@endsection
