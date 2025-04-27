<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class pedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pedidos')->insert([
            'compra_id' => 1,
            'camiseta_id' => 1,
            'nombre_a_estampar' => 'Martin Palermo',
            'numero_a_estampar' => '9',
            'talle_elegido' => 'L' ,
            'precio' => 100.0,
        ]);
        DB::table('pedidos')->insert([
            'compra_id' => 1,
            'camiseta_id' => 1,
            'nombre_a_estampar' => 'Juan Roman Riquelme',
            'numero_a_estampar' => '10',
            'talle_elegido' => 'M' ,
            'precio' => 100.0,
        ]);
        DB::table('pedidos')->insert([
            'compra_id' => 2,
            'camiseta_id' => 2,
            'nombre_a_estampar' => 'Marcelo Gallardo',
            'numero_a_estampar' => '10',
            'talle_elegido' => 'S' ,
            'precio' => 300.0,
        ]);
        DB::table('pedidos')->insert([
            'compra_id' => 3,
            'camiseta_id' => 1,
            'nombre_a_estampar' => 'Nestor Ortigoza',
            'numero_a_estampar' => '9',
            'talle_elegido' => 'XL' ,
            'precio' => 100.0,
        ]);
        DB::table('pedidos')->insert([
            'compra_id' => 4,
            'camiseta_id' => 2,
            'nombre_a_estampar' => 'Ricardo Bochini',
            'numero_a_estampar' => '10',
            'talle_elegido' => 'M' ,
            'precio' => 100.0,
        ]);
        DB::table('pedidos')->insert([
            'compra_id' => 5,
            'camiseta_id' => 3,
            'nombre_a_estampar' => 'Lionel Messi',
            'numero_a_estampar' => '30',
            'talle_elegido' => 'M' ,
            'precio' => 200.0,
        ]);
        DB::table('pedidos')->insert([
            'compra_id' => 6,
            'camiseta_id' => 4,
            'nombre_a_estampar' => 'Karim Benzema',
            'numero_a_estampar' => '9',
            'talle_elegido' => 'L',
            'precio' => 1000.0, 
        ]);
        DB::table('pedidos')->insert([
            'compra_id' => 7,
            'camiseta_id' => 4,
            'nombre_a_estampar' => 'Bukayo Saka',
            'numero_a_estampar' => '7',
            'talle_elegido' => 'M',
            'precio' => 15000.50, 
        ]);
        DB::table('pedidos')->insert([
            'compra_id' => 7,
            'camiseta_id' => 1,
            'nombre_a_estampar' => 'Jack Grealish',
            'numero_a_estampar' => '66',
            'talle_elegido' => 'S',
            'precio' => 10000.0, 
        ]);
    }
}
