<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id') 
                ->references('id')
                ->on('clientes'); 
            $table->float('precio_total');
            $table->string('forma_de_pago');
            $table->string('direccion_de_entrega');
            $table->dateTime('fecha_hora')->default(DB::raw('NOW()'));
            $table->string('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
