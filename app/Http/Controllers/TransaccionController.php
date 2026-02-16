<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\Transaccion;
use App\Models\LoteCafe;
use Illuminate\Support\Facades\DB;

class TransaccionController extends Controller
{
    // Agregar al carrito
    public function agregarAlCarrito(Request $request, $loteId)
    {
        $request->validate([
            'cantidad_kg' => 'required|numeric|min:1',
        ]);

        $lote = LoteCafe::findOrFail($loteId);

        // Verificar que haya suficiente disponibilidad
        if ($request->cantidad_kg > $lote->peso_disponible) {
            return back()->with('error', 'No hay suficiente disponibilidad. Solo quedan ' . $lote->peso_disponible . ' kg.');
        }

        // Verificar si ya existe en el carrito
        $itemCarrito = Carrito::where('comprador_id', auth()->id())
            ->where('lote_id', $loteId)
            ->first();

        if ($itemCarrito) {
            // Actualizar cantidad
            $nuevaCantidad = $itemCarrito->cantidad_kg + $request->cantidad_kg;
            
            if ($nuevaCantidad > $lote->peso_disponible) {
                return back()->with('error', 'No puedes agregar más. Total solicitado excede disponibilidad.');
            }

            $itemCarrito->update(['cantidad_kg' => $nuevaCantidad]);
            return back()->with('success', 'Cantidad actualizada en el carrito');
        } else {
            // Crear nuevo item
            Carrito::create([
                'comprador_id' => auth()->id(),
                'lote_id' => $loteId,
                'cantidad_kg' => $request->cantidad_kg,
            ]);
            return back()->with('success', 'Lote agregado al carrito');
        }
    }

    // Ver carrito
    public function verCarrito()
    {
        $items = Carrito::where('comprador_id', auth()->id())
            ->with(['lote.caficultor', 'lote.imagenes'])
            ->get();

        $total = $items->sum(function($item) {
            return $item->subtotal;
        });

        return view('comprador.carrito', compact('items', 'total'));
    }

    // Eliminar del carrito
    public function eliminarDelCarrito($id)
    {
        $item = Carrito::where('comprador_id', auth()->id())->findOrFail($id);
        $item->delete();

        return back()->with('success', 'Producto eliminado del carrito');
    }

    // Actualizar cantidad en carrito
    public function actualizarCarrito(Request $request, $id)
    {
        $request->validate([
            'cantidad_kg' => 'required|numeric|min:1',
        ]);

        $item = Carrito::where('comprador_id', auth()->id())->findOrFail($id);

        if ($request->cantidad_kg > $item->lote->peso_disponible) {
            return back()->with('error', 'No hay suficiente disponibilidad');
        }

        $item->update(['cantidad_kg' => $request->cantidad_kg]);

        return back()->with('success', 'Cantidad actualizada');
    }

    // Procesar checkout
    public function checkout()
    {
        $items = Carrito::where('comprador_id', auth()->id())
            ->with(['lote.caficultor', 'lote.imagenes'])
            ->get();

        if ($items->isEmpty()) {
            return redirect()->route('comprador.carrito')->with('error', 'Tu carrito está vacío');
        }

        $subtotal = $items->sum('subtotal');
        $comision = Transaccion::calcularComision($subtotal);
        $total = $subtotal;

        return view('comprador.checkout', compact('items', 'subtotal', 'comision', 'total'));
    }

    // Confirmar compra
    public function confirmarCompra(Request $request)
    {
        $request->validate([
            'notas' => 'nullable|string|max:500',
        ]);

        DB::beginTransaction();

        try {
            $items = Carrito::where('comprador_id', auth()->id())
                ->with('lote')
                ->get();

            if ($items->isEmpty()) {
                return redirect()->route('comprador.carrito')->with('error', 'Tu carrito está vacío');
            }

            $transacciones = [];

            foreach ($items as $item) {
                // Verificar disponibilidad
                if ($item->cantidad_kg > $item->lote->peso_disponible) {
                    DB::rollBack();
                    return back()->with('error', 'No hay suficiente disponibilidad para ' . $item->lote->codigo_lote);
                }

                $precioTotal = $item->cantidad_kg * $item->lote->precio_por_kg;
                $comision = Transaccion::calcularComision($precioTotal);

                // Crear transacción
                $transaccion = Transaccion::create([
                    'codigo_transaccion' => Transaccion::generarCodigo(),
                    'comprador_id' => auth()->id(),
                    'caficultor_id' => $item->lote->caficultor_id,
                    'lote_id' => $item->lote_id,
                    'cantidad_kg' => $item->cantidad_kg,
                    'precio_por_kg' => $item->lote->precio_por_kg,
                    'precio_total' => $precioTotal,
                    'comision_plataforma' => $comision,
                    'total_caficultor' => $precioTotal - $comision,
                    'estado' => 'pendiente',
                    'notas_comprador' => $request->notas,
                    'fecha_confirmacion' => now(),
                ]);

                // Actualizar peso disponible del lote
                $item->lote->decrement('peso_disponible', $item->cantidad_kg);

                // Si el peso disponible llega a 0, cambiar estado a vendido
                if ($item->lote->peso_disponible <= 0) {
                    $item->lote->update(['estado' => 'vendido']);
                }

                $transacciones[] = $transaccion;

                // Eliminar del carrito
                $item->delete();
            }

            DB::commit();

            return redirect()->route('comprador.mis-compras')->with('success', 'Compra realizada exitosamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al procesar la compra: ' . $e->getMessage());
        }
    }

    // Historial de compras del comprador
    public function misCompras()
    {
        $compras = Transaccion::where('comprador_id', auth()->id())
            ->with(['lote', 'caficultor'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('comprador.mis-compras', compact('compras'));
    }

    // Historial de ventas del caficultor
    public function misVentas()
    {
        $ventas = Transaccion::where('caficultor_id', auth()->id())
            ->with(['lote', 'comprador'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('caficultor.mis-ventas', compact('ventas'));
    }
}