<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CaficultorController;
use App\Http\Controllers\CompradorController;

// Página de inicio
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas de autenticación
Route::get('/login/{role}', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas de registro
Route::get('/register/{role}', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Dashboard Administrador
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/usuarios', [AdminController::class, 'usuarios'])->name('usuarios');
    Route::post('/usuarios/{id}/aprobar', [AdminController::class, 'aprobarUsuario'])->name('usuarios.aprobar');
    Route::post('/usuarios/{id}/rechazar', [AdminController::class, 'rechazarUsuario'])->name('usuarios.rechazar');
    Route::get('/lotes', [AdminController::class, 'lotes'])->name('lotes');
    Route::delete('/lotes/{id}', [AdminController::class, 'eliminarLote'])->name('lotes.eliminar');
});

// Dashboard Caficultor
Route::middleware(['auth'])->prefix('caficultor')->name('caficultor.')->group(function () {
    Route::get('/dashboard', [CaficultorController::class, 'dashboard'])->name('dashboard');
    Route::get('/lotes/crear', [CaficultorController::class, 'crearLote'])->name('lotes.crear');
    Route::post('/lotes', [CaficultorController::class, 'guardarLote'])->name('lotes.guardar');
    Route::get('/lotes/{id}', [CaficultorController::class, 'verLote'])->name('lotes.ver');
    Route::get('/lotes/{id}/editar', [CaficultorController::class, 'editarLote'])->name('lotes.editar');
    Route::put('/lotes/{id}', [CaficultorController::class, 'actualizarLote'])->name('lotes.actualizar');
    Route::delete('/lotes/{id}', [CaficultorController::class, 'eliminarLote'])->name('lotes.eliminar');
    
    // Rutas QR
    Route::get('/lotes/{id}/qr', [CaficultorController::class, 'verQR'])->name('lotes.qr');
    Route::get('/lotes/{id}/qr/descargar', [CaficultorController::class, 'generarQR'])->name('lotes.qr.descargar');
    Route::get('/lotes/{id}/qr/etiqueta', [CaficultorController::class, 'descargarEtiquetaQR'])->name('lotes.qr.etiqueta');
    // NUEVA RUTA DE VENTAS
    Route::get('/mis-ventas', [App\Http\Controllers\TransaccionController::class, 'misVentas'])->name('mis-ventas');

});

// Dashboard Comprador
Route::middleware(['auth'])->prefix('comprador')->name('comprador.')->group(function () {
    Route::get('/dashboard', [CompradorController::class, 'dashboard'])->name('dashboard');
    Route::get('/marketplace', [CompradorController::class, 'marketplace'])->name('marketplace');
    Route::get('/lote/{id}', [CompradorController::class, 'verLote'])->name('lote.ver');

     // NUEVAS RUTAS DE TRANSACCIONES
    Route::post('/carrito/agregar/{loteId}', [App\Http\Controllers\TransaccionController::class, 'agregarAlCarrito'])->name('carrito.agregar');
    Route::get('/carrito', [App\Http\Controllers\TransaccionController::class, 'verCarrito'])->name('carrito');
    Route::delete('/carrito/{id}', [App\Http\Controllers\TransaccionController::class, 'eliminarDelCarrito'])->name('carrito.eliminar');
    Route::put('/carrito/{id}', [App\Http\Controllers\TransaccionController::class, 'actualizarCarrito'])->name('carrito.actualizar');
    Route::get('/checkout', [App\Http\Controllers\TransaccionController::class, 'checkout'])->name('checkout');
    Route::post('/confirmar-compra', [App\Http\Controllers\TransaccionController::class, 'confirmarCompra'])->name('confirmar-compra');
    Route::get('/mis-compras', [App\Http\Controllers\TransaccionController::class, 'misCompras'])->name('mis-compras');
});

// Ruta pública de trazabilidad
Route::get('/trazabilidad/{codigo_lote}', [App\Http\Controllers\TrazabilidadController::class, 'ver'])->name('trazabilidad.lote');
        

