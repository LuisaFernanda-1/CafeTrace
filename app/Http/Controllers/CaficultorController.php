<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoteCafe;
use App\Models\ImagenLote;
use App\Models\Transaccion;  
use App\Models\Carrito;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CaficultorController extends Controller
{
    public function dashboard()
{
    $totalLotes = LoteCafe::where('caficultor_id', auth()->id())->count();
    
    $kgDisponibles = LoteCafe::where('caficultor_id', auth()->id())
        ->sum('peso_disponible');
    
    $kgVendidos = LoteCafe::where('caficultor_id', auth()->id())
        ->get()
        ->sum(function($lote) {
            return $lote->peso_kg - $lote->peso_disponible;
        });
    
    // Obtener ventas realizadas
    $totalVentas = Transaccion::where('caficultor_id', auth()->id())->count();
    
    $ingresosNetos = Transaccion::where('caficultor_id', auth()->id())
        ->sum('total_caficultor');
    
    $lotesRecientes = LoteCafe::where('caficultor_id', auth()->id())
        ->with('imagenes')
        ->latest()
        ->take(6)
        ->get();
    
    return view('caficultor.dashboard', compact(
        'totalLotes', 
        'kgDisponibles', 
        'kgVendidos',
        'totalVentas',
        'ingresosNetos',
        'lotesRecientes'
    ));
}

    public function lotes()
    {
        $lotes = LoteCafe::where('caficultor_id', auth()->id())
            ->with('imagenes')
            ->latest()
            ->paginate(12);
        
        return view('caficultor.lotes.index', compact('lotes'));
    }

    public function crearLote()
    {
        return view('caficultor.lotes.crear');
    }

    public function guardarLote(Request $request)
{
    // Validación
    $validated = $request->validate([
        'peso_kg' => 'required|numeric|min:1',
        'variedad' => 'required|string|max:100',
        'altura_msnm' => 'required|integer|min:800|max:2500',
        'fecha_cosecha' => 'required|date|before_or_equal:today',
        'descripcion' => 'nullable|string|max:1000',
        'fecha_despulpado' => 'nullable|date',
        'fecha_fermentacion' => 'nullable|date',
        'fecha_lavado' => 'nullable|date',
        'fecha_secado' => 'nullable|date',
        'precio_por_kg' => 'required|numeric|min:1000',
        'imagenes.*' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
    ]);

    try {
        // Generar código único del lote
        $codigoLote = 'LOT-' . strtoupper(Str::random(8)) . '-' . date('Ymd');

        // Crear el lote
        $lote = LoteCafe::create([
            'caficultor_id' => auth()->id(),
            'codigo_lote' => $codigoLote,
            'peso_kg' => $validated['peso_kg'],
            'peso_disponible' => $validated['peso_kg'],
            'variedad' => $validated['variedad'],
            'altura_msnm' => $validated['altura_msnm'],
            'fecha_cosecha' => $validated['fecha_cosecha'],
            'descripcion' => $request->input('descripcion'),
            'fecha_despulpado' => $request->input('fecha_despulpado'),
            'fecha_fermentacion' => $request->input('fecha_fermentacion'),
            'fecha_lavado' => $request->input('fecha_lavado'),
            'fecha_secado' => $request->input('fecha_secado'),
            'es_organico' => $request->has('es_organico') ? true : false,
            'comercio_justo' => $request->has('comercio_justo') ? true : false,
            'precio_por_kg' => $validated['precio_por_kg'],
            'estado' => 'disponible',
            'hash_blockchain' => hash('sha256', $codigoLote . time()),
            'fecha_registro_blockchain' => now(),
        ]);

        // Generar código QR con Google Charts API (más confiable)
try {
    // Crear la URL del QR usando Google Charts
    $urlLote = url('/lote/' . $lote->id);
    
    // Guardar solo la URL del lote, el QR se generará dinámicamente
    $lote->update([
        'codigo_qr' => 'qr-google-' . $lote->id  // Solo guardamos un identificador
    ]);
    
} catch (\Exception $e) {
    \Log::error('Error configurando QR: ' . $e->getMessage());
}

        // Guardar imágenes
        if ($request->hasFile('imagenes')) {
            $imagenes = $request->file('imagenes');
            $tipos = $request->input('tipos_imagenes', []);
            
            foreach ($imagenes as $index => $imagen) {
                try {
                    $path = $imagen->store('lotes/' . $lote->id, 'public');
                    
                    ImagenLote::create([
                        'lote_id' => $lote->id,
                        'ruta_imagen' => $path,
                        'tipo' => $tipos[$index] ?? 'general',
                        'orden' => $index + 1,
                    ]);
                } catch (\Exception $e) {
                    \Log::error('Error guardando imagen: ' . $e->getMessage());
                }
            }
        }

        return redirect()->route('caficultor.lotes')
            ->with('success', '¡Lote registrado exitosamente! Código: ' . $codigoLote);

    } catch (\Exception $e) {
        \Log::error('Error creando lote: ' . $e->getMessage());
        
        return back()
            ->withInput()
            ->withErrors(['error' => 'Hubo un error al crear el lote. Por favor intenta nuevamente.']);
    }
}

    public function verLote($id)
    {
        $lote = LoteCafe::with(['imagenes', 'caficultor'])
            ->where('caficultor_id', auth()->id())
            ->findOrFail($id);
        
        return view('caficultor.lotes.ver', compact('lote'));
    }

    public function editarLote($id)
    {
        $lote = LoteCafe::where('caficultor_id', auth()->id())
            ->findOrFail($id);
        
        return view('caficultor.lotes.editar', compact('lote'));
    }

    public function actualizarLote(Request $request, $id)
    {
        $lote = LoteCafe::where('caficultor_id', auth()->id())
            ->findOrFail($id);

        $validated = $request->validate([
            'descripcion' => 'nullable|string|max:1000',
            'precio_por_kg' => 'required|numeric|min:1000',
            'estado' => 'required|in:disponible,reservado,en_proceso',
        ]);

        $lote->update($validated);

        return redirect()->route('caficultor.lotes.ver', $lote->id)
            ->with('success', 'Lote actualizado exitosamente.');
    }

    public function eliminarLote($id)
    {
        $lote = LoteCafe::where('caficultor_id', auth()->id())
            ->findOrFail($id);

        // Eliminar imágenes del storage
        foreach ($lote->imagenes as $imagen) {
            Storage::disk('public')->delete($imagen->ruta_imagen);
        }

        // Eliminar QR
        if ($lote->codigo_qr) {
            Storage::disk('public')->delete($lote->codigo_qr);
        }

        $lote->delete();

        return redirect()->route('caficultor.lotes')
            ->with('success', 'Lote eliminado correctamente.');
    }
    // Generar QR del lote
    public function generarQR($id)
    {
        $lote = LoteCafe::where('caficultor_id', auth()->id())
            ->findOrFail($id);

        $url = route('trazabilidad.lote', $lote->codigo_lote);

        // Generar como SVG primero
        $qrSvg = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
            ->size(500)
            ->margin(2)
            ->errorCorrection('H')
            ->generate($url);

        return response($qrSvg, 200, [
            'Content-Type' => 'image/svg+xml',
            'Content-Disposition' => 'attachment; filename="QR-' . $lote->codigo_lote . '.svg"',
        ]);
    }

    // Ver QR del lote
    public function verQR($id)
    {
        $lote = LoteCafe::where('caficultor_id', auth()->id())
            ->with(['imagenes'])
            ->findOrFail($id);

        return view('caficultor.qr', compact('lote'));
    }

    // Descargar etiqueta PDF con QR
    public function descargarEtiquetaQR($id)
    {
        $lote = LoteCafe::where('caficultor_id', auth()->id())
            ->with(['caficultor', 'imagenes'])
            ->findOrFail($id);

        $url = route('trazabilidad.lote', $lote->codigo_lote);
        
        // Generar QR en base64 usando SVG
        $qrCodeSvg = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
            ->size(300)
            ->margin(1)
            ->errorCorrection('H')
            ->generate($url);

        // Convertir SVG a base64
        $qrCode = base64_encode($qrCodeSvg);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('caficultor.etiqueta-pdf', [
            'lote' => $lote,
            'qrCode' => $qrCode,
            'url' => $url,
            'useSvg' => true
        ]);

        return $pdf->download('Etiqueta-' . $lote->codigo_lote . '.pdf');
    }
}