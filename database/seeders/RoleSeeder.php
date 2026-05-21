public function run(): void
{
    DB::table('roles')->insertOrIgnore([
        [
            'nombre'      => 'Admin',
            'descripcion' => 'Administrador del sistema con acceso total',
            'created_at'  => now(),
            'updated_at'  => now(),
        ],
        [
            'nombre'      => 'caficultor',
            'descripcion' => 'Productor de café que registra y vende lotes',
            'created_at'  => now(),
            'updated_at'  => now(),
        ],
        [
            'nombre'      => 'comprador',
            'descripcion' => 'Comprador de café (cafeterías, tostadores, exportadores)',
            'created_at'  => now(),
            'updated_at'  => now(),
        ],
    ]);
}