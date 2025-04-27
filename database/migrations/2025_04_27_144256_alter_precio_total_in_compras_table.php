<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('compras', function (Blueprint $table) {
            $table->decimal('precio_total', 12, 2)->change();  // Update the column
        });
    }
    
    public function down()
    {
        Schema::table('compras', function (Blueprint $table) {
            $table->decimal('precio_total', 8, 2)->change();  // Revert the change
        });
    }
    
  
};
