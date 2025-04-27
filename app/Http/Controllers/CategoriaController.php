<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view('tables.categorias', ['categorias' => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create.new_categoria');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nombre' => ['required', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/', 'unique:categorias,name'],
            ],
            [
                'nombre.required' => 'Una categoría debe tener nombre',
                'nombre.regex' => 'Una categoría no puede tener caracteres especiales ni números',
                'nombre.unique' => 'Ya existe una categoría con este nombre',
            ]
        );

        $newCategoria = new Categoria();
        $newCategoria->name = $request->nombre;

        $newCategoria->save();

        return redirect('/categorias')->with('success', "La categoría '" . $newCategoria->name . "' fue creada con éxito");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Show the delete confirmation
     */
    public function delete(string $id)
    {
        $validator = Validator::make(['id' => $id], ['id' => 'integer',]);
        if ($validator->fails())
            abort(404);
        $categoria = Categoria::find($id);
        if ($categoria == null) {
            abort(404);
        }

        return view('edit.delete_categoria', ['categoria' => $categoria]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $validator = Validator::make(['id' => $id], ['id' => 'integer',]);
        if ($validator->fails())
            abort(404);
        $categoria = Categoria::find($id);
        if ($categoria == null) {
            abort(404);
        }
        $nombre = $categoria->name;

        $categoria->camisetas()->detach(); // Borra la relacion camiseta_categoria para todas las camisetas asociadas a esta categoria
        $categoria->delete();

        return redirect('/categorias')->with("deleted", "La categoría " . $nombre . ' fue eliminada con éxito');

    }
}