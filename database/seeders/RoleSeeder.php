<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'nombre' => 'Admin',
                'descripcion' => 'Administrador del sistema con acceso total',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'caficultor',
                'descripcion' => 'Productor de café que registra y vende lotes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'comprador',
                'descripcion' => 'Comprador de café (cafeterías, tostadores, exportadores)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}