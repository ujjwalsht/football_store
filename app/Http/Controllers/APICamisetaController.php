<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Categoria;
use App\Models\Camiseta;

class APICamisetaController extends Controller
{
    /**
     * @OA\Get(
     * path="/_api/camisetas",
     * tags={"Camisetas"},
     * summary="Retorna todas las camisetas",
     * @OA\Response(
     *      response=200,
     *      description="OK",
     *      @OA\JsonContent(
     *          type="array",
     *          @OA\Items(ref="#/components/schemas/Camiseta")           
     *      )
     * )
     * )
     */
    public function getCamisetas()
    {
        $camisetas = Camiseta::all();
        $camisetas = $this->loadImages($camisetas);

        foreach($camisetas as $camiseta){
            $camiseta->categorias;
            $camiseta->categorias->setHidden(['id', 'created_at', 'updated_at','pivot']); // format json
        }

        $camisetas->setHidden(['id', 'created_at', 'updated_at', 'deleted_at', 'pivot']); // format json
        return response()->json($camisetas);
    }

    /**
     * @OA\Get(
     * path="/_api/camisetas/categoria/{categoria}",
     * tags={"Camisetas"},
     * summary="Retorna todas las camisetas que pertenezcan a una categoria",
     * @OA\Parameter(
     *      name="categoria",
     *      in="path",
     *      description="Nombre de categoria a obtener camisetas",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *          example="Selecciones"
     *      )
     * ),
     * @OA\Response(
     *      response=200,
     *      description="OK",
     *      @OA\JsonContent(
     *          type="array",
     *          @OA\Items(ref="#/components/schemas/Camiseta")           
     *      )
     * ),
     * @OA\Response(
     *      response=422,
     *      description="Error: Unprocessable Content",
     *      @OA\MediaType(
     *          mediaType="text/html",
     *          example="El nombre de la categoría tiene que ser valido"
     *      )   
     * )
     * )
     */
    public function getCamisetasByCategoria(string $categoria)
    {
        $validator = Validator::make(['categoria' => $categoria], ['categoria' => 'string']);

        if ($validator->fails()) {
            return response('El nombre de la categoría tiene que ser valido', 422);
        }

        $categoria_obj = Categoria::where('name',$categoria)->first();
        if ($categoria_obj == null) {
            return response('No existe categoría con nombre ' . $categoria, 422);
        }

        $camisetas = $categoria_obj->camisetas;
        $camisetas = $this->loadImages($camisetas);

        foreach($camisetas as $camiseta){
            $camiseta->categorias;
            $camiseta->categorias->setHidden(['id', 'created_at', 'updated_at','pivot']); // format json
        }

        $camisetas->setHidden(['id', 'created_at', 'updated_at', 'deleted_at', 'pivot']); // format json
        return response()->json($camisetas);
    }

    private function loadImages($camisetas)
    {
        foreach ($camisetas as $camiseta) {
            $camiseta->imagen_frente = stream_get_contents($camiseta->imagen_frente);
            $camiseta->imagen_atras = stream_get_contents($camiseta->imagen_atras);
        }
        return $camisetas;
    }

}
