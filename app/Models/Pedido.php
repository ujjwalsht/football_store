<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

/** @OA\Schema(
 *      schema="Pedido",
 *      type="object",
 *      @OA\Property(property="camiseta_id", type="string", example="Camiseta River"),
 *      @OA\Property(property="nombre_a_estampar", type="string", example="Juan Román"),
 *      @OA\Property(property="numero_a_estampar", type="string", example="8"),
 *      @OA\Property(property="precio", type="number", example=10000.50),
 *      @OA\Property(property="talle_elegido", type="string", example="XL")
 * )
 */
class Pedido extends Model
{
    use HasFactory;

    public function compra(): BelongsTo
    {
        return $this->belongsTo(Compra::class);
    }

    public function camiseta(): BelongsTo
    {
        return $this->belongsTo(Camiseta::class)->withTrashed();
    }
}
