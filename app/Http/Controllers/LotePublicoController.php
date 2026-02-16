<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoteCafe;

class LotePublicoController extends Controller
{
    public function ver($id)
    {
        $lote = LoteCafe::with(['imagenes', 'caficultor'])
            ->findOrFail($id);
        
        return view('publico.lote', compact('lote'));
    }
}