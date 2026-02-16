@extends('layouts.app')

@section('title', 'Código QR - ' . $lote->codigo_lote)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-emerald-100">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-green-600 to-emerald-700 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('caficultor.dashboard') }}" class="bg-white/20 p-2 rounded-lg hover:bg-white/30 transition">
                        <i class="fas fa-arrow-left text-xl"></i>
                    </a>
                    <div>
                        <h1 class="text-xl font-bold">Código QR - {{ $lote->codigo_lote }}</h1>
                        <p class="text-sm text-green-100">{{ auth()->user()->name }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-green-700 hover:bg-green-900 px-4 py-2 rounded-lg transition">
                        <i class="fas fa-sign-out-alt mr-2"></i> Salir
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header con info del lote -->
            <div class="bg-white rounded-2xl shadow-xl p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $lote->variedad }}</h2>
                        <p class="text-gray-600">{{ $lote->codigo_lote }}</p>
                    </div>
                    @if($lote->imagenes->first())
                        <img src="{{ asset('storage/' . $lote->imagenes->first()->ruta_imagen) }}" 
                             alt="{{ $lote->codigo_lote }}"
                             class="w-20 h-20 object-cover rounded-lg shadow">
                    @endif
                </div>
                
                <div class="grid md:grid-cols-3 gap-4">
                    <div class="bg-green-50 p-3 rounded-lg">
                        <p class="text-xs text-green-700">Peso</p>
                        <p class="text-lg font-bold text-green-800">{{ number_format($lote->peso_kg, 0) }} kg</p>
                    </div>
                    <div class="bg-blue-50 p-3 rounded-lg">
                        <p class="text-xs text-blue-700">Altura</p>
                        <p class="text-lg font-bold text-blue-800">{{ number_format($lote->altura_msnm, 0) }} msnm</p>
                    </div>
                    <div class="bg-amber-50 p-3 rounded-lg">
                        <p class="text-xs text-amber-700">Cosecha</p>
                        <p class="text-lg font-bold text-amber-800">{{ $lote->fecha_cosecha->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- QR Code -->
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">
                        <i class="fas fa-qrcode text-green-600 mr-2"></i>
                        Código QR
                    </h3>
                    
                    <div class="bg-gray-50 p-6 rounded-xl mb-6 flex items-center justify-center">
                        {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(250)->margin(2)->errorCorrection('H')->generate(route('trazabilidad.lote', $lote->codigo_lote)) !!}
                    </div>

                    <div class="space-y-3">
                        <a href="{{ route('caficultor.lotes.qr.descargar', $lote->id) }}" 
                           class="w-full bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-lg transition flex items-center justify-center font-semibold">
                            <i class="fas fa-download mr-2"></i>
                            Descargar QR (PNG)
                        </a>

                        <a href="{{ route('caficultor.lotes.qr.etiqueta', $lote->id) }}" 
                           class="w-full bg-amber-600 hover:bg-amber-700 text-white py-3 px-4 rounded-lg transition flex items-center justify-center font-semibold">
                            <i class="fas fa-file-pdf mr-2"></i>
                            Descargar Etiqueta (PDF)
                        </a>

                        <a href="{{ route('trazabilidad.lote', $lote->codigo_lote) }}" 
                           target="_blank"
                           class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg transition flex items-center justify-center font-semibold">
                            <i class="fas fa-external-link-alt mr-2"></i>
                            Ver Trazabilidad
                        </a>
                    </div>
                </div>

                <!-- Instrucciones -->
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">
                        <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                        ¿Cómo usar el QR?
                    </h3>

                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="bg-green-100 rounded-full w-8 h-8 flex items-center justify-center text-green-700 font-bold mr-3 flex-shrink-0">
                                1
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 mb-1">Descarga el QR</h4>
                                <p class="text-sm text-gray-600">Descarga la imagen PNG o el PDF con la etiqueta completa</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-green-100 rounded-full w-8 h-8 flex items-center justify-center text-green-700 font-bold mr-3 flex-shrink-0">
                                2
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 mb-1">Imprime</h4>
                                <p class="text-sm text-gray-600">Imprime el QR en etiquetas adhesivas o directamente en tus empaques</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-green-100 rounded-full w-8 h-8 flex items-center justify-center text-green-700 font-bold mr-3 flex-shrink-0">
                                3
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 mb-1">Pega en tus productos</h4>
                                <p class="text-sm text-gray-600">Coloca el QR en las bolsas de café para que tus clientes puedan verificar la trazabilidad</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-green-100 rounded-full w-8 h-8 flex items-center justify-center text-green-700 font-bold mr-3 flex-shrink-0">
                                4
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 mb-1">Verificación instantánea</h4>
                                <p class="text-sm text-gray-600">Cualquier persona puede escanear el QR y ver toda la información de trazabilidad</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 rounded-lg p-4">
                        <p class="text-sm text-gray-700">
                            <i class="fas fa-lightbulb text-amber-600 mr-2"></i>
                            <strong>Tip:</strong> El QR apunta directamente a la página de trazabilidad pública de este lote
                        </p>
                    </div>
                </div>
            </div>

            <!-- URL del QR -->
            <div class="bg-white rounded-2xl shadow-xl p-6 mt-6">
                <h3 class="text-lg font-bold text-gray-800 mb-3">
                    <i class="fas fa-link text-gray-600 mr-2"></i>
                    URL de Trazabilidad
                </h3>
                <div class="flex items-center gap-3">
                    <input type="text" 
                           value="{{ route('trazabilidad.lote', $lote->codigo_lote) }}" 
                           readonly
                           id="urlTrazabilidad"
                           class="flex-1 bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 text-sm">
                    <button onclick="copiarURL()" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                        <i class="fas fa-copy mr-2"></i>Copiar
                    </button>
                </div>
                <p class="text-xs text-gray-500 mt-2">
                    <i class="fas fa-info-circle mr-1"></i>
                    Esta URL también puede compartirse manualmente sin necesidad del QR
                </p>
            </div>
        </div>
    </div>
</div>

<script>
function copiarURL() {
    const input = document.getElementById('urlTrazabilidad');
    input.select();
    document.execCommand('copy');
    
    alert('✓ URL copiada al portapapeles');
}
</script>
@endsection