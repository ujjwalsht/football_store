<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Validator;

class APICategoriaController extends Controller
{

    /**
     * @OA\Get(
     *     path="/_api/categorias",
     *     summary="Retorna las categorías",
     *     tags={"Categorias"},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Categoria")           
     *             )
     *         )
     *     )
     * )
     */

    public function getCategorias()
    {
        $categorias = Categoria::all();
        $categorias->setHidden(['id', 'created_at', 'updated_at']); // format json
        return response()->json($categorias);
    }
}
