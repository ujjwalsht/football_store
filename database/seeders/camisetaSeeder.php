<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class camisetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $front = file_get_contents('database/seed_images/boca_frente.jpg');
        $front = base64_encode($front);
        $back = file_get_contents('database/seed_images/boca_atras.jpg');
        $back = base64_encode($back);
        DB::table('camisetas')->insert([
            'nombre' => 'Camiseta Titular Boca',
            'descripcion' => 'Camiseta Titular Boca temporada 22/23',
            'precio' => 34999,
            'imagen_frente' => $front,
            'imagen_atras' => $back,
            'talles_disponibles' => 'S, M, L, XL',
            'activo' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $front = file_get_contents('database/seed_images/river_frente.png');
        $front = base64_encode($front);
        $back = file_get_contents('database/seed_images/river_atras.png');
        $back = base64_encode($back);
        DB::table('camisetas')->insert([
            'nombre' => 'Camiseta Titular River',
            'descripcion' => 'Camiseta Titular River temporada 22/23',
            'precio' => 34999,
            'imagen_frente' => $front,
            'imagen_atras' => $back,
            'talles_disponibles' => 'S, M, L, XL',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $front = file_get_contents('database/seed_images/argentina_frente.webp');
        $front = base64_encode($front);
        $back = file_get_contents('database/seed_images/argentina_atras.webp');
        $back = base64_encode($back);
        DB::table('camisetas')->insert([
            'nombre' => 'Camiseta Titular Argentina',
            'descripcion' => 'Camiseta Titular Argentina campeón del mundo 2022 con 3 estrellas y parche',
            'precio' => 24999,
            'imagen_frente' => $front,
            'imagen_atras' => $back,
            'talles_disponibles' => 'S, M, L, XL',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $front = file_get_contents('database/seed_images/alemania_frente.webp');
        $front = base64_encode($front);
        $back = file_get_contents('database/seed_images/alemania_atras.webp');
        $back = base64_encode($back);
        DB::table('camisetas')->insert([
            'nombre' => 'Camiseta Titular Alemania',
            'descripcion' => 'Camiseta Titular Alemania',
            'precio' => 1,
            'imagen_frente' => $front,
            'imagen_atras' => $back,
            'talles_disponibles' => 'S, M, L, XL',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
    }
}
