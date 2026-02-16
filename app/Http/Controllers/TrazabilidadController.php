<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoteCafe;

class TrazabilidadController extends Controller
{
    public function ver($codigo_lote)
    {
        $lote = LoteCafe::where('codigo_lote', $codigo_lote)
            ->with(['caficultor', 'imagenes'])
            ->firstOrFail();

        return view('trazabilidad.lote', compact('lote'));
    }
}