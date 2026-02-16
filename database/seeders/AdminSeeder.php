<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('nombre', 'Admin')->first();

        if (!$adminRole) {
            throw new \Exception('❌ El rol Admin no existe. Ejecuta primero el RoleSeeder.');
        }

        User::firstOrCreate(
            ['email' => 'admin@cafetrace.com'],
            [
                'name' => 'Administrador Principal',
                'password' => Hash::make('admin123'),
                'role_id' => $adminRole->id,
                'estado' => 'activo',
                'email_verified_at' => now(),
            ]
        );
    }
}
