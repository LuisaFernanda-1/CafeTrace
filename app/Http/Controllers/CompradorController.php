<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoteCafe;
use App\Models\Transaccion;
use App\Models\Carrito;      
class CompradorController extends Controller
{
   public function dashboard()
{
    $totalCompras = Transaccion::where('comprador_id', auth()->id())->count();
    
    $kgComprados = Transaccion::where('comprador_id', auth()->id())
        ->sum('cantidad_kg');
    
    $totalGastado = Transaccion::where('comprador_id', auth()->id())
        ->sum('precio_total');
    
    $itemsCarrito = Carrito::where('comprador_id', auth()->id())->count();
    
    $lotesDestacados = LoteCafe::where('estado', 'disponible')
        ->where('peso_disponible', '>', 0)
        ->with(['caficultor', 'imagenes'])
        ->latest()
        ->take(6)
        ->get();
    
    return view('comprador.dashboard', compact(
        'totalCompras',
        'kgComprados',
        'totalGastado',
        'itemsCarrito',
        'lotesDestacados'
    ));
}
    public function marketplace(Request $request)
    {
        $query = LoteCafe::where('estado', 'disponible')
            ->where('peso_disponible', '>', 0)
            ->with(['imagenes', 'caficultor']);

        // Búsqueda por texto
        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function($q) use ($buscar) {
                $q->where('codigo_lote', 'like', "%{$buscar}%")
                  ->orWhere('variedad', 'like', "%{$buscar}%")
                  ->orWhere('descripcion', 'like', "%{$buscar}%")
                  ->orWhereHas('caficultor', function($q2) use ($buscar) {
                      $q2->where('name', 'like', "%{$buscar}%")
                         ->orWhere('departamento', 'like', "%{$buscar}%")
                         ->orWhere('municipio', 'like', "%{$buscar}%");
                  });
            });
        }

        // Filtro por variedad
        if ($request->filled('variedad')) {
            $query->where('variedad', $request->variedad);
        }

        // Filtro por precio
        if ($request->filled('precio_min')) {
            $query->where('precio_por_kg', '>=', $request->precio_min);
        }
        if ($request->filled('precio_max')) {
            $query->where('precio_por_kg', '<=', $request->precio_max);
        }

        // Filtro por altura
        if ($request->filled('altura_min')) {
            $query->where('altura_msnm', '>=', $request->altura_min);
        }

        // Filtro por certificaciones
        if ($request->has('organico')) {
            $query->where('es_organico', true);
        }
        if ($request->has('comercio_justo')) {
            $query->where('comercio_justo', true);
        }

        // Filtro por departamento
        if ($request->filled('departamento')) {
            $query->whereHas('caficultor', function($q) use ($request) {
                $q->where('departamento', $request->departamento);
            });
        }

        // Ordenamiento
        $orden = $request->get('orden', 'reciente');
        switch ($orden) {
            case 'precio_asc':
                $query->orderBy('precio_por_kg', 'asc');
                break;
            case 'precio_desc':
                $query->orderBy('precio_por_kg', 'desc');
                break;
            case 'peso_desc':
                $query->orderBy('peso_disponible', 'desc');
                break;
            case 'altura_desc':
                $query->orderBy('altura_msnm', 'desc');
                break;
            default:
                $query->latest();
        }

        $lotes = $query->paginate(12);

        // Obtener variedades únicas para el filtro
        $variedades = LoteCafe::where('estado', 'disponible')
            ->distinct()
            ->pluck('variedad');

        // Obtener departamentos únicos
        $departamentos = \App\Models\User::whereHas('lotesCafe', function($q) {
            $q->where('estado', 'disponible');
        })
        ->whereNotNull('departamento')
        ->distinct()
        ->pluck('departamento');

        return view('comprador.marketplace', compact('lotes', 'variedades', 'departamentos'));
    }

    public function verLote($id)
    {
        $lote = LoteCafe::with(['imagenes', 'caficultor'])
            ->where('estado', 'disponible')
            ->findOrFail($id);
        
        return view('comprador.lote', compact('lote'));
    }
}