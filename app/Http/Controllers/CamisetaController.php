<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Camiseta;
use App\Models\Categoria;
use App\Models\RelacionCamisetaCategoria;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class CamisetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $camisetas = Camiseta::all();
        $camisetas = $this->loadImages($camisetas);
        return view('tables.camisetas', ['camisetas' => $camisetas]);
    }

    /**
     * Display a listing of the resource in a category
     */
    public function indexByCategory(string $id)
    {

        $validator = Validator::make(['id' => $id], ['id' => 'integer',]);
        if ($validator->fails())
            abort(404);
        $categoria = Categoria::find($id);
        if ($categoria == null) {
            abort(404);
        }

        $camisetas = $categoria->camisetas;
        $camisetas = $this->loadImages($camisetas);
        return view('tables.camisetas', ['camisetas' => $camisetas, 'categoria' => $categoria]);
    }

    private function loadImages($camisetas)
    {
        foreach ($camisetas as $camiseta) {
            $camiseta->imagen_frente = stream_get_contents($camiseta->imagen_frente);
            $camiseta->imagen_atras = stream_get_contents($camiseta->imagen_atras);
        }
        return $camisetas;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all()->pluck('name');
        return view('create.new_camiseta', ['categorias' => $categorias]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nombre' => ['required', 'regex:/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s\/]+$/', 'unique:camisetas,nombre'],
                'descripcion' => ["required", 'regex:/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ.,\s\/]+$/'],
                'precio' => ["required", 'decimal:0,2', 'min:0'],
                'talles' => ["required", "array", "min:1"],
                'tags' => ["required", "array", "min:1"],
                'tags.*' => ['regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/'],
                'imagen_frente' => ["required", "image"],
                'imagen_atras' => ["required", "image"],
            ],
            [
                'nombre.required' => 'Este campo no puede estar vacío',
                'nombre.regex' => 'Este campo no puedo contener caracteres especiales',
                'nombre.unique' => 'No puede haber camisetas con nombres repetidos',
                'descripcion.required' => 'Este campo no puede estar vacío',
                'descripcion.regex' => 'Este campo no puedo contener caracteres especiales',
                'precio.required' => 'Este campo no puede estar vacío',
                'precio.min' => 'El precio no puede ser negativo',
                'precio' => 'El precio debe ser un numero decimal positivo, con maximo 2 cifras de centavos',
                'talles.required' => 'La camiseta debe tener al menos un talle',
                'tags.required' => 'Completar con al menos una categoría',
                'tags.*.regex' => 'Una categoría no puede tener caracteres especiales o números',
                'imagen_frente.required' => 'Una camiseta necesita una imágen de frente',
                'imagen_atras.required' => 'Una camiseta necesita una imágen de atrás',
                'imagen_frente.image' => 'La imágen subida debe estar en un formato permitido: jpg, png, webp',
                'imagen_atras.image' => 'La imágen subida debe estar en un formato permitido: jpg, png, webp',
            ]
        );

        $camiseta = new Camiseta();

        $camiseta->nombre = $request->get('nombre');
        $camiseta->descripcion = $request->get('descripcion');
        $camiseta->precio = $request->get('precio');

        $talles = "";
        foreach ($request->get('talles') as $talle) {
            $talles .= $talle . ", ";
        }
        $talles = substr($talles, 0, -2);
        $camiseta->talles_disponibles = $talles;

        $atras = $request->file('imagen_atras');
        $atras = base64_encode($atras->get());

        $frente = $request->file('imagen_frente');
        $frente = base64_encode($frente->get());

        $camiseta->imagen_frente = $frente;
        $camiseta->imagen_atras = $atras;

        $camiseta->save();

        // Categorias asignadas a la camiseta
        $categorias = $request->get('tags');
        $id_categorias = array();

        foreach ($categorias as $categoria) {
            $existe = Categoria::where('name', $categoria)->first();
            if ($existe != null) {
                array_push($id_categorias, $existe);
            } else {
                $existe = new Categoria();
                $existe->name = $categoria;
                $existe->save();
                array_push($id_categorias, $existe);
            }
        }

        foreach ($id_categorias as $id_categoria) {
            $camiseta->categorias()->attach($id_categoria);
        }

        return redirect('/camisetas')->with("success", "La camiseta " . $camiseta->nombre . ' fue creada con éxito');
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
        $validator = Validator::make(['id' => $id], ['id' => 'integer',]);
        if ($validator->fails())
            abort(404);
        $camiseta = Camiseta::find($id);

        if ($camiseta == null) {
            abort(404);
        }

        $categorias = Categoria::all()->pluck('name');

        return view('edit.edit_camiseta', ['camiseta' => $camiseta, 'categorias' => $categorias]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make(['id' => $id], ['id' => 'integer',]);
        if ($validator->fails())
            abort(404);
        $camiseta = Camiseta::find($id);
        if ($camiseta == null) {
            abort(404);
        }

        // valida campos form
        $request->validate(
            [
                'nombre' => ['required', 'regex:/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s\/]+$/', Rule::unique('camisetas', 'nombre')->ignore($id)],
                'descripcion' => ["required", 'regex:/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ.,\s\/]+$/'],
                'precio' => ["required", 'decimal:0,2', 'min:1'],
                'talles' => ["required", "array", "min:1"],
                'tags' => ["required", "array", "min:1"],
                'tags.*' => ['regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/'],
                'imagen_atras' => ["nullable", "image"],
                'imagen_frente' => ["nullable", "image"],
            ],
            [
                'nombre.required' => 'Este campo no puede estar vacío',
                'nombre.regex' => 'Este campo no puedo contener caracteres especiales',
                'nombre.unique' => 'No puede haber camisetas con nombres repetidos',
                'descripcion.required' => 'Este campo no puede estar vacío',
                'descripcion.regex' => 'Este campo no puedo contener caracteres especiales',
                'precio.required' => 'Este campo no puede estar vacío',
                'precio.min' => 'El precio no puede ser negativo',
                'precio' => 'El precio debe ser un numero decimal positivo, con maximo 2 cifras de centavos',
                'talles.required' => 'La camiseta debe tener al menos un talle',
                'tags.required' => 'Completar con al menos una categoría',
                'tags.*.regex' => 'Una categoría no puede tener caracteres especiales o números',
                'imagen_atras.image' => 'La imágen subida debe estar en un formato permitido: jpg, png, webp',
                'imagen_frente.image' => 'La imágen subida debe estar en un formato permitido: jpg, png, webp',
            ]
        );
        $camiseta = Camiseta::where('id', $id)->first();

        $camiseta->nombre = $request->get('nombre');
        $camiseta->descripcion = $request->get('descripcion');
        $camiseta->precio = $request->get('precio');

        $talles = "";
        foreach ($request->get('talles') as $talle) {
            $talles .= $talle . ", ";
        }
        $talles = substr($talles, 0, -2);
        $camiseta->talles_disponibles = $talles;

        $atras = $request->file('imagen_atras');
        $frente = $request->file('imagen_frente');
        if ($atras != null) {
            $atras = base64_encode($atras->get());
            $camiseta->imagen_atras = $atras;
        }
        if ($frente != null) {
            $frente = base64_encode($frente->get());
            $camiseta->imagen_frente = $frente;
        }

        $camiseta->update();

        $camiseta->categorias()->detach();

        $categorias = $request->get('tags');
        $id_categorias = array();
        foreach ($categorias as $categoria) {
            $existe = Categoria::where('name', $categoria)->first();
            if ($existe != null) {
                array_push($id_categorias, $existe);
            } else {
                $existe = new Categoria();
                $existe->name = $categoria;
                $existe->save();
                array_push($id_categorias, $existe);
            }
        }

        foreach ($id_categorias as $id_categoria) {
            $camiseta->categorias()->attach($id_categoria);
        }

        return redirect('/camisetas')->with("success", "La camiseta '" . $camiseta->nombre . "' fue actualizada con éxito");
    }

    /**
     * Update the Activo column that represents stock
     */
    public function updateStock(string $id)
    {
        $validator = Validator::make(['id' => $id], ['id' => 'integer',]);
        if ($validator->fails())
            abort(404);
        $camiseta = Camiseta::find($id);

        if ($camiseta == null) {
            abort(404);
        }

        $nuevo = 0;
        if ($camiseta->activo == 0)
            $nuevo = 1;

        $camiseta->activo = $nuevo;
        $camiseta->update();

        return redirect()->back()->with("success", "El stock de la camiseta '" . $camiseta->nombre . "' fue actualizado con éxito");
    }

    /**
     * Show the delete confirmation
     */
    public function delete(string $id)
    {
        $validator = Validator::make(['id' => $id], ['id' => 'integer',]);
        if ($validator->fails())
            abort(404);
        $camiseta = Camiseta::find($id);
        if ($camiseta == null) {
            abort(404);
        }

        return view('edit.delete_camiseta', ['camiseta' => $camiseta]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $validator = Validator::make(['id' => $id], ['id' => 'integer',]);
        if ($validator->fails())
            abort(404);
        $camiseta = Camiseta::find($id);


        if ($camiseta == null) {
            abort(404);
        }

        $nombre = $camiseta->nombre;
        $camiseta->delete();
        return redirect('/camisetas')->with("deleted", "La camiseta '" . $nombre . "' fue eliminada con éxito");
    }
}