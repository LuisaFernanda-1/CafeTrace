@extends('layouts.app')

@section('title', 'Detalle del Lote - ' . $lote->codigo_lote)

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-green-600 to-emerald-700 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('caficultor.dashboard') }}" class="hover:text-green-200 transition">
                        <i class="fas fa-arrow-left mr-2"></i> Mis Lotes
                    </a>
                    <div class="border-l border-green-400 pl-4">
                        <h1 class="text-xl font-bold">{{ $lote->codigo_lote }}</h1>
                        <p class="text-sm text-green-100">{{ $lote->variedad }}</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-3">
                    <a href="{{ route('caficultor.lotes.editar', $lote->id) }}" 
                       class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg transition">
                        <i class="fas fa-edit mr-2"></i> Editar
                    </a>
                    <form method="POST" action="{{ route('caficultor.lotes.eliminar', $lote->id) }}" 
                          onsubmit="return confirm('¿Estás seguro de eliminar este lote? Esta acción no se puede deshacer.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg transition">
                            <i class="fas fa-trash mr-2"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        
        <!-- Mensajes -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center">
                <i class="fas fa-check-circle mr-3 text-xl"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Grid Principal -->
        <div class="grid lg:grid-cols-3 gap-6">
            
            <!-- Columna Izquierda: Información Principal -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Galería de Imágenes -->
                @if($lote->imagenes->count() > 0)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <!-- Imagen Principal -->
                        <div id="main-image" class="relative h-96 bg-gray-900">
                            <img src="{{ asset('storage/' . $lote->imagenes->first()->ruta_imagen) }}" 
                                 alt="Lote principal"
                                 class="w-full h-full object-contain">
                            
                            <!-- Tipo de imagen -->
                            <div class="absolute bottom-4 left-4">
                                <span id="image-type" class="bg-black/70 text-white px-4 py-2 rounded-lg text-sm font-semibold backdrop-blur-sm">
                                    {{ ucfirst($lote->imagenes->first()->tipo) }}
                                </span>
                            </div>
                        </div>

                        <!-- Thumbnails -->
                        @if($lote->imagenes->count() > 1)
                            <div class="p-4 bg-gray-50 border-t border-gray-200">
                                <div class="grid grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-2">
                                    @foreach($lote->imagenes as $index => $imagen)
                                        <div class="thumbnail cursor-pointer rounded-lg overflow-hidden border-2 {{ $index === 0 ? 'border-green-500' : 'border-transparent' }} hover:border-green-500 transition"
                                             onclick="changeImage('{{ asset('storage/' . $imagen->ruta_imagen) }}', '{{ ucfirst($imagen->tipo) }}', {{ $index }})">
                                            <img src="{{ asset('storage/' . $imagen->ruta_imagen) }}" 
                                                 alt="Thumbnail {{ $index + 1 }}"
                                                 class="w-full h-16 object-cover">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                        <i class="fas fa-image text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">No hay imágenes para este lote</p>
                    </div>
                @endif

                <!-- Información Detallada -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-info-circle text-green-600 mr-3"></i>
                        Información Detallada
                    </h3>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Peso -->
                        <div class="border-l-4 border-green-500 pl-4">
                            <p class="text-sm text-gray-500 mb-1">Peso Total</p>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($lote->peso_kg, 2) }} kg</p>
                        </div>

                        <!-- Peso Disponible -->
                        <div class="border-l-4 border-blue-500 pl-4">
                            <p class="text-sm text-gray-500 mb-1">Peso Disponible</p>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($lote->peso_disponible, 2) }} kg</p>
                        </div>

                        <!-- Variedad -->
                        <div class="border-l-4 border-purple-500 pl-4">
                            <p class="text-sm text-gray-500 mb-1">Variedad</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $lote->variedad }}</p>
                        </div>

                        <!-- Altura -->
                        <div class="border-l-4 border-amber-500 pl-4">
                            <p class="text-sm text-gray-500 mb-1">Altura</p>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($lote->altura_msnm, 0) }} msnm</p>
                        </div>

                        <!-- Precio -->
                        <div class="border-l-4 border-green-500 pl-4">
                            <p class="text-sm text-gray-500 mb-1">Precio por kg</p>
                            <p class="text-2xl font-bold text-green-600">${{ number_format($lote->precio_por_kg, 0) }}</p>
                        </div>

                        <!-- Valor Total -->
                        <div class="border-l-4 border-emerald-500 pl-4">
                            <p class="text-sm text-gray-500 mb-1">Valor Total Disponible</p>
                            <p class="text-2xl font-bold text-emerald-600">
                                ${{ number_format($lote->peso_disponible * $lote->precio_por_kg, 0) }}
                            </p>
                        </div>
                    </div>

                    <!-- Fechas del Proceso -->
                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <h4 class="text-lg font-bold text-gray-800 mb-4">Proceso de Producción</h4>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <div class="w-40 text-sm text-gray-600 font-medium">Cosecha:</div>
                                <div class="flex-1 text-gray-900 font-semibold">
                                    {{ $lote->fecha_cosecha->format('d/m/Y') }}
                                </div>
                            </div>
                            @if($lote->fecha_despulpado)
                                <div class="flex items-center">
                                    <div class="w-40 text-sm text-gray-600 font-medium">Despulpado:</div>
                                    <div class="flex-1 text-gray-900 font-semibold">
                                        {{ \Carbon\Carbon::parse($lote->fecha_despulpado)->format('d/m/Y') }}
                                    </div>
                                </div>
                            @endif
                            @if($lote->fecha_fermentacion)
                                <div class="flex items-center">
                                    <div class="w-40 text-sm text-gray-600 font-medium">Fermentación:</div>
                                    <div class="flex-1 text-gray-900 font-semibold">
                                        {{ \Carbon\Carbon::parse($lote->fecha_fermentacion)->format('d/m/Y') }}
                                    </div>
                                </div>
                            @endif
                            @if($lote->fecha_lavado)
                                <div class="flex items-center">
                                    <div class="w-40 text-sm text-gray-600 font-medium">Lavado:</div>
                                    <div class="flex-1 text-gray-900 font-semibold">
                                        {{ \Carbon\Carbon::parse($lote->fecha_lavado)->format('d/m/Y') }}
                                    </div>
                                </div>
                            @endif
                            @if($lote->fecha_secado)
                                <div class="flex items-center">
                                    <div class="w-40 text-sm text-gray-600 font-medium">Secado:</div>
                                    <div class="flex-1 text-gray-900 font-semibold">
                                        {{ \Carbon\Carbon::parse($lote->fecha_secado)->format('d/m/Y') }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Descripción -->
                    @if($lote->descripcion)
                        <div class="mt-8 pt-8 border-t border-gray-200">
                            <h4 class="text-lg font-bold text-gray-800 mb-3">Descripción</h4>
                            <p class="text-gray-700 leading-relaxed">{{ $lote->descripcion }}</p>
                        </div>
                    @endif
                </div>

            </div>

            <!-- Columna Derecha: QR y Estado -->
            <div class="space-y-6">
                
                <!-- Estado del Lote -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Estado del Lote</h3>
                    
                    <div class="text-center mb-6">
                        <span class="inline-block px-6 py-3 rounded-xl text-lg font-bold
                            {{ $lote->estado === 'disponible' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $lote->estado === 'vendido' ? 'bg-gray-100 text-gray-800' : '' }}
                            {{ $lote->estado === 'reservado' ? 'bg-amber-100 text-amber-800' : '' }}
                            {{ $lote->estado === 'en_proceso' ? 'bg-blue-100 text-blue-800' : '' }}">
                            <i class="fas fa-circle text-xs mr-2"></i>
                            {{ ucfirst($lote->estado) }}
                        </span>
                    </div>

                    <!-- Certificaciones -->
                    <div class="space-y-3">
                        @if($lote->es_organico)
                            <div class="flex items-center bg-green-50 p-3 rounded-lg">
                                <i class="fas fa-leaf text-green-600 text-xl mr-3"></i>
                                <div>
                                    <p class="font-semibold text-gray-900">Café Orgánico</p>
                                    <p class="text-xs text-gray-600">Sin químicos ni pesticidas</p>
                                </div>
                            </div>
                        @endif

                        @if($lote->comercio_justo)
                            <div class="flex items-center bg-blue-50 p-3 rounded-lg">
                                <i class="fas fa-handshake text-blue-600 text-xl mr-3"></i>
                                <div>
                                    <p class="font-semibold text-gray-900">Comercio Justo</p>
                                    <p class="text-xs text-gray-600">Prácticas sostenibles</p>
                                </div>
                            </div>
                        @endif

                        @if(!$lote->es_organico && !$lote->comercio_justo)
                            <p class="text-sm text-gray-500 text-center py-4">Sin certificaciones registradas</p>
                        @endif
                    </div>
                </div>

                <!-- Código QR -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 text-center">Código QR de Trazabilidad</h3>
                    
                    <div class="bg-gray-50 p-6 rounded-xl">
                        <div class="flex justify-center mb-4">
                            @php
                                $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode(url('/lote/' . $lote->id));
                            @endphp
                            <img src="{{ $qrUrl }}" 
                                 alt="QR Code"
                                 class="w-48 h-48 border-4 border-green-500 rounded-lg bg-white p-2">
                        </div>
                        
                        <p class="text-xs text-gray-600 text-center mb-4">
                            Escanea este código para ver la trazabilidad completa del lote
                        </p>

                        <a href="{{ $qrUrl }}" 
                           download="QR-{{ $lote->codigo_lote }}.png"
                           class="block w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg font-semibold transition text-center">
                            <i class="fas fa-download mr-2"></i> Descargar QR
                        </a>
                    </div>
                </div>

                <!-- Información Blockchain -->
                <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-xl shadow-lg p-6 text-white">
                    <h3 class="text-lg font-bold mb-4 flex items-center">
                        <i class="fas fa-link mr-2"></i>
                        Blockchain
                    </h3>
                    
                    <div class="space-y-3 text-sm">
                        <div>
                            <p class="text-slate-400 mb-1">Hash</p>
                            <p class="font-mono text-xs break-all bg-white/10 p-2 rounded">
                                {{ substr($lote->hash_blockchain, 0, 32) }}...
                            </p>
                        </div>
                        <div>
                            <p class="text-slate-400 mb-1">Registrado</p>
                            <p class="font-semibold">{{ $lote->fecha_registro_blockchain->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="flex items-center text-green-400 text-xs">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span>Verificado en blockchain</span>
                        </div>
                    </div>
                </div>

                <!-- Información del Caficultor -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Información del Productor</h3>
                    
                    <div class="flex items-center mb-4">
                        <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-user text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">{{ $lote->caficultor->name }}</p>
                            <p class="text-sm text-gray-600">Caficultor</p>
                        </div>
                    </div>

                    @if($lote->caficultor->nombre_finca)
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <p class="text-xs text-gray-500">Finca</p>
                            <p class="font-semibold text-gray-900">{{ $lote->caficultor->nombre_finca }}</p>
                        </div>
                    @endif

                    @if($lote->caficultor->departamento)
                        <div class="mt-3 text-sm text-gray-600">
                            <i class="fas fa-map-marker-alt text-green-600 mr-2"></i>
                            {{ $lote->caficultor->municipio }}, {{ $lote->caficultor->departamento }}
                        </div>
                    @endif
                </div>

            </div>

        </div>

    </div>
</div>

<script>
// Cambiar imagen principal
function changeImage(src, type, index) {
    document.getElementById('main-image').querySelector('img').src = src;
    document.getElementById('image-type').textContent = type;
    
    // Actualizar border de thumbnails
    document.querySelectorAll('.thumbnail').forEach((thumb, i) => {
        if (i === index) {
            thumb.classList.add('border-green-500');
            thumb.classList.remove('border-transparent');
        } else {
            thumb.classList.remove('border-green-500');
            thumb.classList.add('border-transparent');
        }
    });
}
</script>
@endsection