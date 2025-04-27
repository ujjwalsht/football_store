<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class camiseta_categoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    // 2 -> categoria Club
    // 3 -> categoria Argentina 
    // 9 -> categoria Boca
    // 10 -> categoria River
    public function run(): void
    {
        // Camiseta Boca
        DB::table('camiseta_categoria')->insert([
            'camiseta_id' => 1,
            'categoria_id' => 2, //Categoria club
        ]);
        DB::table('camiseta_categoria')->insert([
            'camiseta_id' => 1,
            'categoria_id' => 3,
        ]);
        DB::table('camiseta_categoria')->insert([
            'camiseta_id' => 1,
            'categoria_id' => 9,
        ]);
        // Camiseta River
        DB::table('camiseta_categoria')->insert([
            'camiseta_id' => 2,
            'categoria_id' => 2,
        ]);
        DB::table('camiseta_categoria')->insert([
            'camiseta_id' => 2,
            'categoria_id' => 3,
        ]);
        DB::table('camiseta_categoria')->insert([
            'camiseta_id' => 2,
            'categoria_id' => 10,
        ]);
        // Camiseta Seleccion Argentina
        DB::table('camiseta_categoria')->insert([
            'camiseta_id' => 3,
            'categoria_id' => 1,
        ]);
        DB::table('camiseta_categoria')->insert([
            'camiseta_id' => 3,
            'categoria_id' => 3,
        ]);
        // Camiseta Seleccion Alemania
        DB::table('camiseta_categoria')->insert([
            'camiseta_id' => 4,
            'categoria_id' => 1,
        ]);
        DB::table('camiseta_categoria')->insert([
            'camiseta_id' => 4,
            'categoria_id' => 4,
        ]);
    }
}
