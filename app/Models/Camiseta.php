<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/** @OA\Schema(
 *      schema="Camiseta",
 *      type="object",
 *      @OA\Property(property="nombre", type="string", example="Camiseta argentina"),
 *      @OA\Property(property="descripcion", type="string", example="Descripcion de prueba"),
 *      @OA\Property(property="precio", type="number", example=45999.99),
 *      @OA\Property(property="imagen_frente", type="string", format="base64", example="data:base64/png:testwaeaw"),
 *      @OA\Property(property="imagen_atras", type="string", format="base64", example="data:base64/png:testwaeaw"),
 *      @OA\Property(property="talles_disponibles", type="string", example="XS,S,XL"),
 *      @OA\Property(property="activo", type="boolean", example=true),
 *      @OA\Property(property="categorias", type="array", 
 *          @OA\Items(ref="#/components/schemas/Categoria")
 *      ),
 * )
 */
class Camiseta extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function categorias(): BelongsToMany
    {
        return $this->belongsToMany(Categoria::class);
    }
}
