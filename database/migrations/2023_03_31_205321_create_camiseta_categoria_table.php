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
        Schema::create('camiseta_categoria', function (Blueprint $table) {
            //$table->id();
            $table->foreignId('camiseta_id') 
                ->references('id')
                ->on('camisetas'); 
            $table->foreignId('categoria_id') 
                ->references('id')
                ->on('categorias'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camiseta_categoria');
    }
};
