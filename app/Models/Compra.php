<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/** @OA\Schema(
 *      schema="Compra",
 *      type="object",
 *      @OA\Property(property="cliente", type="string", format="email", example="ematiradani@gmail.com"),
 *      @OA\Property(property="forma_de_pago", type="string", example="Mastercard"),
 *      @OA\Property(property="direccion_de_entrega", type="string", example="Segurola y La Habana"),
 *      @OA\Property(property="pedidos", type="array", 
 *          @OA\Items(ref="#/components/schemas/Pedido")
 *      )
 * )
 */
class Compra extends Model
{
    use HasFactory;

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedido::class);
    }
}
