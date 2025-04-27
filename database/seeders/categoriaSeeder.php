<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class categoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias')->insert([
            'name' => 'Selecciones'
        ]);
        DB::table('categorias')->insert([
            'name' => 'Clubes'
        ]);

        DB::table('categorias')->insert([
            'name' => 'Argentina'
        ]);
        DB::table('categorias')->insert([
            'name' => 'Inglaterra'
        ]);
        DB::table('categorias')->insert([
            'name' => 'España'
        ]);
        DB::table('categorias')->insert([
            'name' => 'Francia'
        ]);
        DB::table('categorias')->insert([
            'name' => 'Alemania'
        ]);
        DB::table('categorias')->insert([
            'name' => 'Colombia'
        ]);

        DB::table('categorias')->insert([
            'name' => 'Boca'
        ]);
        DB::table('categorias')->insert([
            'name' => 'River'
        ]);
        DB::table('categorias')->insert([
            'name' => 'Barcelona'
        ]);
        DB::table('categorias')->insert([
            'name' => 'Real Madrid'
        ]);
        DB::table('categorias')->insert([
            'name' => 'Bayern Munchen'
        ]);
        DB::table('categorias')->insert([
            'name' => 'Olimpo'
        ]);
        DB::table('categorias')->insert([
            'name' => 'Villa Mitre'
        ]);
        DB::table('categorias')->insert([
            'name' => 'Paris Saint Germain'
        ]);
    }
}
