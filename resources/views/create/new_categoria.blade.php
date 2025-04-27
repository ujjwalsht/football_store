@extends('layouts.app')

@section('content')
    <div class="bg-white shadow p-3 rounded-lg"> 
        <h1>Nueva categoría</h1>
        <hr>
        <form action="/categorias/new" method="post" enctype="multipart/form-data">
            @csrf
            <label for="exampleInputEmail1">Nombre</label>
            <input type="text" name="nombre" class="form-control" value={{old('nombre')}}>
            @error('nombre')
            <div class="invalid-feedback d-block" role="alert">
                {{ $message }}
            </div>
            @enderror
            <br>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a class="btn btn-danger" href="/categorias" >Cancelar</a>
        </form>
    </div>
    
@endsection
