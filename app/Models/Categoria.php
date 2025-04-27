<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

/** @OA\Schema(
 *      schema="Categoria",
 *      type="object",
 *      @OA\Property(property="name", type="string", example="Selecciones")
 * )
 */
class Categoria extends Model
{
    use HasFactory;

    public function camisetas(): BelongsToMany
    {
        return $this->belongsToMany(Camiseta::class);
    }
}
