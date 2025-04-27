<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class clienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clientes')->insert([
            'email' => Str::random(10).'@gmail.com'
        ]);
        DB::table('clientes')->insert([
            'email' => Str::random(10).'@gmail.com'
        ]);
        DB::table('clientes')->insert([
            'email' => Str::random(10).'@gmail.com'
        ]);
        DB::table('clientes')->insert([
            'email' => Str::random(10).'@gmail.com'
        ]);
        DB::table('clientes')->insert([
            'email' => Str::random(10).'@gmail.com'
        ]);
        DB::table('clientes')->insert([
            'email' => Str::random(10).'@gmail.com'
        ]);
        DB::table('clientes')->insert([
            'email' => Str::random(10).'@gmail.com'
        ]);
        DB::table('clientes')->insert([
            'email' => Str::random(10).'@gmail.com'
        ]);
        DB::table('clientes')->insert([
            'email' => Str::random(10).'@gmail.com'
        ]);
        DB::table('clientes')->insert([
            'email' => Str::random(10).'@gmail.com'
        ]);
        DB::table('clientes')->insert([
            'email' => Str::random(10).'@gmail.com'
        ]);
        DB::table('clientes')->insert([
            'email' => Str::random(10).'@gmail.com'
        ]);
        DB::table('clientes')->insert([
            'email' => Str::random(10).'@gmail.com'
        ]);
        DB::table('clientes')->insert([
            'email' => Str::random(10).'@gmail.com'
        ]);
        DB::table('clientes')->insert([
            'email' => Str::random(10).'@gmail.com'
        ]);

    }
}
