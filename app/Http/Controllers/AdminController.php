<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LoteCafe;
use App\Models\Transaccion;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Estadísticas generales
        $totalUsuarios = User::count();
        $usuariosPendientes = User::where('estado', 'pendiente')->count();
        $totalCaficultores = User::where('role_id', 2)->count();
        $totalCompradores = User::where('role_id', 3)->count();
        
        $totalLotes = LoteCafe::count();
        $lotesDisponibles = LoteCafe::where('estado', 'disponible')->count();
        $totalKgRegistrados = LoteCafe::sum('peso_kg');
        $totalKgDisponibles = LoteCafe::where('estado', 'disponible')->sum('peso_disponible');
        
        $totalTransacciones = Transaccion::count();
        $ingresosTotales = Transaccion::sum('precio_total');
        $comisionesTotales = Transaccion::sum('comision_plataforma');
        
        // Usuarios pendientes de aprobación
        $usuariosPendientesLista = User::where('estado', 'pendiente')
            ->with('role')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        
        // Últimos lotes registrados
        $ultimosLotes = LoteCafe::with(['caficultor', 'imagenes'])
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsuarios',
            'usuariosPendientes',
            'totalCaficultores',
            'totalCompradores',
            'totalLotes',
            'lotesDisponibles',
            'totalKgRegistrados',
            'totalKgDisponibles',
            'totalTransacciones',
            'ingresosTotales',
            'comisionesTotales',
            'usuariosPendientesLista',
            'ultimosLotes'
        ));
    }

   public function usuarios(Request $request)
{
    $query = User::with('role')
        ->where('role_id', '!=', 1); // Excluir admins

    // Filtro por estado
    if ($request->filled('estado')) {
        $query->where('estado', $request->estado);
    }

    $usuarios = $query->orderBy('created_at', 'desc')->paginate(20);

    return view('admin.usuarios', compact('usuarios'));
}

    public function aprobarUsuario($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->estado = 'activo';
        $usuario->save();

        return redirect()->back()->with('success', 'Usuario aprobado exitosamente');
    }

    public function rechazarUsuario($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->estado = 'inactivo';
        $usuario->save();

        return redirect()->back()->with('success', 'Usuario rechazado');
    }

    public function lotes()
    {
        $lotes = LoteCafe::with(['caficultor', 'imagenes'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.lotes', compact('lotes'));
    }

   public function eliminarLote($id)
{
    $lote = LoteCafe::withTrashed()->findOrFail($id);
    
    // Eliminar imágenes físicas del storage
    foreach ($lote->imagenes as $imagen) {
        $rutaCompleta = storage_path('app/public/' . $imagen->ruta_imagen);
        if (file_exists($rutaCompleta)) {
            unlink($rutaCompleta);
        }
        // Eliminar registro de la imagen de la base de datos
        $imagen->delete();
    }
    
    // Forzar eliminación permanente (no soft delete)
    $lote->forceDelete();

    return redirect()->back()->with('success', 'Lote eliminado permanentemente');
}
}