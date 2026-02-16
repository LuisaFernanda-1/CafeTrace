@extends('layouts.app')

@section('title', 'Trazabilidad - ' . $lote->codigo_lote)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900">
    
    <!-- Header -->
    <div class="bg-white/10 backdrop-blur-md border-b border-white/10 sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="bg-gradient-to-br from-amber-600 to-orange-600 p-2 rounded-lg">
                        <i class="fas fa-coffee text-2xl text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-white">CaféTrace</h1>
                        <p class="text-xs text-white/70">Trazabilidad Blockchain</p>
                    </div>
                </div>
                <a href="{{ route('home') }}" class="text-white/80 hover:text-white transition">
                    <i class="fas fa-home mr-2"></i> Inicio
                </a>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="container mx-auto px-4 py-12">
        
        <!-- Badge de Verificado -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center bg-green-500/20 border border-green-500/50 backdrop-blur-sm text-green-300 px-6 py-3 rounded-full">
                <i class="fas fa-check-circle mr-3 text-xl"></i>
                <span class="font-bold">Lote Verificado en Blockchain</span>
            </div>
        </div>

        <!-- Card Principal -->
        <div class="max-w-6xl mx-auto bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20">
            
            <!-- Header del Lote -->
            <div class="bg-gradient-to-r from-green-500 via-emerald-600 to-green-700 p-8 text-white">
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl mb-4">
                        <i class="fas fa-coffee text-4xl"></i>
                    </div>
                    <h2 class="text-4xl font-bold mb-2">{{ $lote->variedad }}</h2>
                    <p class="text-green-100 text-lg">{{ $lote->codigo_lote }}</p>
                </div>

                <!-- Estadísticas Rápidas -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center">
                        <i class="fas fa-weight-hanging text-2xl mb-2"></i>
                        <p class="text-2xl font-bold">{{ number_format($lote->peso_kg, 0) }}</p>
                        <p class="text-sm text-green-100">Kg Totales</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center">
                        <i class="fas fa-mountain text-2xl mb-2"></i>
                        <p class="text-2xl font-bold">{{ number_format($lote->altura_msnm, 0) }}</p>
                        <p class="text-sm text-green-100">msnm</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center">
                        <i class="fas fa-calendar text-2xl mb-2"></i>
                        <p class="text-2xl font-bold">{{ $lote->fecha_cosecha->format('d/m/Y') }}</p>
                        <p class="text-sm text-green-100">Cosecha</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center">
                        <i class="fas fa-dollar-sign text-2xl mb-2"></i>
                        <p class="text-2xl font-bold">${{ number_format($lote->precio_por_kg, 0) }}</p>
                        <p class="text-sm text-green-100">Por Kg</p>
                    </div>
                </div>
            </div>

            <!-- Contenido -->
            <div class="p-8">
                
                <!-- Timeline del Proceso -->
                <div class="mb-12">
                    <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-stream text-green-500 mr-3"></i>
                        Proceso de Producción
                    </h3>

                    <div class="relative">
                        <!-- Línea vertical -->
                        <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-green-500/30"></div>

                        <!-- Items del timeline -->
                        <div class="space-y-6">
                            @php
                                $procesos = [
                                    ['fecha' => $lote->fecha_cosecha, 'titulo' => 'Cosecha', 'icon' => 'fa-seedling', 'obligatorio' => true],
                                    ['fecha' => $lote->fecha_despulpado, 'titulo' => 'Despulpado', 'icon' => 'fa-cog'],
                                    ['fecha' => $lote->fecha_fermentacion, 'titulo' => 'Fermentación', 'icon' => 'fa-flask'],
                                    ['fecha' => $lote->fecha_lavado, 'titulo' => 'Lavado', 'icon' => 'fa-tint'],
                                    ['fecha' => $lote->fecha_secado, 'titulo' => 'Secado', 'icon' => 'fa-sun'],
                                ];
                            @endphp

                            @foreach($procesos as $proceso)
                                @if($proceso['fecha'] || isset($proceso['obligatorio']))
                                    <div class="relative flex items-start">
                                        <div class="absolute left-0 flex items-center justify-center w-12 h-12 bg-green-500 rounded-full border-4 border-slate-900">
                                            <i class="fas {{ $proceso['icon'] }} text-white"></i>
                                        </div>
                                        <div class="ml-20 bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4 flex-1">
                                            <h4 class="text-lg font-bold text-white">{{ $proceso['titulo'] }}</h4>
                                            <p class="text-green-400">
                                                {{ $proceso['fecha'] ? \Carbon\Carbon::parse($proceso['fecha'])->format('d/m/Y') : 'Fecha no registrada' }}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Galería de Imágenes -->
                @if($lote->imagenes->count() > 0)
                    <div class="mb-12">
                        <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                            <i class="fas fa-images text-green-500 mr-3"></i>
                            Galería del Proceso
                        </h3>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($lote->imagenes as $imagen)
                                <div class="group relative rounded-xl overflow-hidden cursor-pointer" 
                                     onclick="openImageModal('{{ asset('storage/' . $imagen->ruta_imagen) }}', '{{ ucfirst($imagen->tipo) }}')">
                                    <img src="{{ asset('storage/' . $imagen->ruta_imagen) }}" 
                                         alt="{{ $imagen->tipo }}"
                                         class="w-full h-48 object-cover group-hover:scale-110 transition duration-300">
                                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                        <i class="fas fa-search-plus text-white text-3xl"></i>
                                    </div>
                                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-3">
                                        <p class="text-white text-sm font-semibold">{{ ucfirst($imagen->tipo) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Descripción -->
                @if($lote->descripcion)
                    <div class="mb-12">
                        <h3 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <i class="fas fa-file-alt text-green-500 mr-3"></i>
                            Descripción
                        </h3>
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-6">
                            <p class="text-white/80 leading-relaxed">{{ $lote->descripcion }}</p>
                        </div>
                    </div>
                @endif

                <!-- Certificaciones -->
                @if($lote->es_organico || $lote->comercio_justo)
                    <div class="mb-12">
                        <h3 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <i class="fas fa-certificate text-green-500 mr-3"></i>
                            Certificaciones
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            @if($lote->es_organico)
                                <div class="bg-green-500/10 border border-green-500/30 rounded-xl p-6 flex items-center">
                                    <i class="fas fa-leaf text-green-400 text-4xl mr-4"></i>
                                    <div>
                                        <h4 class="text-lg font-bold text-white">Café Orgánico</h4>
                                        <p class="text-sm text-green-300">Cultivado sin químicos ni pesticidas</p>
                                    </div>
                                </div>
                            @endif

                            @if($lote->comercio_justo)
                                <div class="bg-blue-500/10 border border-blue-500/30 rounded-xl p-6 flex items-center">
                                    <i class="fas fa-handshake text-blue-400 text-4xl mr-4"></i>
                                    <div>
                                        <h4 class="text-lg font-bold text-white">Comercio Justo</h4>
                                        <p class="text-sm text-blue-300">Prácticas justas y sostenibles</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Información del Productor -->
                <div class="mb-12">
                    <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-user text-green-500 mr-3"></i>
                        Productor
                    </h3>
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-6">
                        <div class="flex items-center mb-4">
                            <div class="bg-green-500 w-16 h-16 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-user text-white text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-white">{{ $lote->caficultor->name }}</h4>
                                <p class="text-green-400">Caficultor Certificado</p>
                            </div>
                        </div>

                        @if($lote->caficultor->nombre_finca)
                            <div class="bg-white/5 rounded-lg p-4 mb-3">
                                <p class="text-sm text-white/60">Finca</p>
                                <p class="text-lg font-semibold text-white">{{ $lote->caficultor->nombre_finca }}</p>
                            </div>
                        @endif

                        @if($lote->caficultor->hectareas)
                            <div class="bg-white/5 rounded-lg p-4 mb-3">
                                <p class="text-sm text-white/60">Extensión</p>
                                <p class="text-lg font-semibold text-white">{{ $lote->caficultor->hectareas }} hectáreas</p>
                            </div>
                        @endif

                        @if($lote->caficultor->departamento)
                            <div class="flex items-center text-white">
                                <i class="fas fa-map-marker-alt text-green-500 mr-3"></i>
                                <span>{{ $lote->caficultor->municipio }}, {{ $lote->caficultor->departamento }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Blockchain Info -->
                <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-white/10 rounded-xl p-6">
                    <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                        <i class="fas fa-link text-green-500 mr-3"></i>
                        Verificación Blockchain
                    </h3>
                    <div class="space-y-3 text-sm">
                        <div>
                            <p class="text-white/60 mb-1">Hash de Verificación</p>
                            <p class="font-mono text-xs text-green-400 break-all bg-white/5 p-3 rounded">
                                {{ $lote->hash_blockchain }}
                            </p>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white/60">Registrado en Blockchain</p>
                                <p class="text-white font-semibold">{{ $lote->fecha_registro_blockchain->format('d/m/Y H:i') }}</p>
                            </div>
                            <div class="flex items-center text-green-400">
                                <i class="fas fa-check-circle mr-2"></i>
                                <span class="font-semibold">Verificado</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center mt-12">
            <p class="text-white/70 mb-4">¿Quieres vender tu café con total transparencia?</p>
            <a href="{{ route('register.form', 'caficultor') }}" 
               class="inline-flex items-center bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white px-8 py-4 rounded-xl font-bold shadow-lg transition transform hover:scale-105">
                <i class="fas fa-user-plus mr-2"></i> Únete a CaféTrace
            </a>
        </div>

    </div>
</div>

<!-- Modal para ver imágenes -->
<div id="imageModal" class="hidden fixed inset-0 bg-black/90 z-50 flex items-center justify-center p-4" onclick="closeImageModal()">
    <div class="relative max-w-5xl w-full">
        <button onclick="closeImageModal()" class="absolute top-4 right-4 bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white w-12 h-12 rounded-full flex items-center justify-center transition">
            <i class="fas fa-times text-xl"></i>
        </button>
        <img id="modalImage" src="" alt="" class="w-full h-auto rounded-xl">
        <p id="modalTitle" class="text-white text-center mt-4 text-xl font-bold"></p>
    </div>
</div>

<script>
function openImageModal(src, title) {
    document.getElementById('imageModal').classList.remove('hidden');
    document.getElementById('modalImage').src = src;
    document.getElementById('modalTitle').textContent = title;
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}
</script>
@endsection