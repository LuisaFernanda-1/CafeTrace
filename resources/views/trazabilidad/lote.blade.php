@extends('layouts.app')

@section('title', 'Trazabilidad - ' . $lote->codigo_lote)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-amber-50 to-orange-100">
    <!-- Header -->
    <header class="bg-gradient-to-r from-amber-600 to-orange-700 text-white shadow-lg">
        <div class="container mx-auto px-4 py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-coffee text-4xl"></i>
                    <div>
                        <h1 class="text-2xl font-bold">CaféTrace</h1>
                        <p class="text-sm text-amber-100">Trazabilidad Verificada</p>
                    </div>
                </div>
                <a href="/" class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg transition">
                    <i class="fas fa-home mr-2"></i>Inicio
                </a>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        <!-- Código del Lote -->
        <div class="bg-white rounded-2xl shadow-xl p-6 mb-6 text-center">
            <p class="text-gray-600 mb-2">Código de Trazabilidad</p>
            <h2 class="text-3xl font-bold text-amber-600">{{ $lote->codigo_lote }}</h2>
        </div>

        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Columna Principal -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Galería -->
                @if($lote->imagenes->count() > 0)
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="relative h-96 bg-gray-200">
                            <img id="imagenPrincipal" 
                                 src="{{ asset('storage/' . $lote->imagenes->first()->ruta_imagen) }}" 
                                 alt="{{ $lote->codigo_lote }}"
                                 class="w-full h-full object-cover">
                            
                            <div class="absolute top-4 right-4 flex flex-col gap-2">
                                @if($lote->es_organico)
                                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                                        <i class="fas fa-leaf"></i> Orgánico
                                    </span>
                                @endif
                                @if($lote->comercio_justo)
                                    <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                                        <i class="fas fa-handshake"></i> Comercio Justo
                                    </span>
                                @endif
                            </div>
                        </div>

                        @if($lote->imagenes->count() > 1)
                            <div class="p-4 bg-gray-50">
                                <div class="grid grid-cols-4 md:grid-cols-6 gap-2">
                                    @foreach($lote->imagenes as $imagen)
                                        <div class="aspect-square cursor-pointer rounded-lg overflow-hidden border-2 border-transparent hover:border-amber-500 transition"
                                             onclick="cambiarImagen('{{ asset('storage/' . $imagen->ruta_imagen) }}')">
                                            <img src="{{ asset('storage/' . $imagen->ruta_imagen) }}" 
                                                 class="w-full h-full object-cover">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Información del Lote -->
                <div class="bg-white rounded-2xl shadow-xl p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">
                        Café {{ $lote->variedad }}
                    </h3>

                    @if($lote->descripcion)
                        <p class="text-gray-700 mb-6">{{ $lote->descripcion }}</p>
                    @endif

                    <div class="grid md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                            <p class="text-xs text-green-700 font-medium">Peso</p>
                            <p class="text-2xl font-bold text-green-800">{{ number_format($lote->peso_kg, 0) }} kg</p>
                        </div>
                        <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                            <p class="text-xs text-blue-700 font-medium">Altura</p>
                            <p class="text-2xl font-bold text-blue-800">{{ number_format($lote->altura_msnm, 0) }} msnm</p>
                        </div>
                        <div class="bg-amber-50 p-4 rounded-lg border border-amber-200">
                            <p class="text-xs text-amber-700 font-medium">Cosecha</p>
                            <p class="text-lg font-bold text-amber-800">{{ $lote->fecha_cosecha->format('d/m/Y') }}</p>
                        </div>
                    </div>

                    <!-- Proceso de Trazabilidad -->
                    <h4 class="text-lg font-bold text-gray-800 mb-4">
                        <i class="fas fa-route text-amber-600 mr-2"></i>Proceso de Producción
                    </h4>
                    
                    <div class="relative">
                        <div class="absolute left-4 top-8 bottom-8 w-0.5 bg-gradient-to-b from-green-400 to-amber-600"></div>
                        
                        <div class="space-y-4">
                            @php
                                $pasos = [
                                    ['icono' => 'seedling', 'titulo' => 'Cosecha', 'fecha' => $lote->fecha_cosecha, 'color' => 'green'],
                                    ['icono' => 'tint', 'titulo' => 'Despulpado', 'fecha' => $lote->fecha_despulpado, 'color' => 'blue'],
                                    ['icono' => 'flask', 'titulo' => 'Fermentación', 'fecha' => $lote->fecha_fermentacion, 'color' => 'purple'],
                                    ['icono' => 'water', 'titulo' => 'Lavado', 'fecha' => $lote->fecha_lavado, 'color' => 'cyan'],
                                    ['icono' => 'sun', 'titulo' => 'Secado', 'fecha' => $lote->fecha_secado, 'color' => 'amber'],
                                ];
                            @endphp

                            @foreach($pasos as $paso)
                                @if($paso['fecha'])
                                    <div class="flex items-center relative">
                                        <div class="w-8 h-8 rounded-full bg-{{ $paso['color'] }}-500 flex items-center justify-center text-white z-10 shadow-lg">
                                            <i class="fas fa-{{ $paso['icono'] }}"></i>
                                        </div>
                                        <div class="ml-4 bg-{{ $paso['color'] }}-50 px-4 py-2 rounded-lg border border-{{ $paso['color'] }}-200 flex-1">
                                            <p class="font-bold text-{{ $paso['color'] }}-800">{{ $paso['titulo'] }}</p>
                                            <p class="text-sm text-{{ $paso['color'] }}-600">{{ $paso['fecha']->format('d/m/Y') }}</p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Columna Lateral -->
            <div class="lg:col-span-1">
                <!-- Info del Caficultor -->
                <div class="bg-white rounded-2xl shadow-xl p-6 mb-6">
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <i class="fas fa-user text-3xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">{{ $lote->caficultor->name }}</h3>
                        <p class="text-sm text-gray-600">Caficultor</p>
                    </div>

                    @if($lote->caficultor->nombre_finca)
                        <div class="mb-4 flex items-start">
                            <i class="fas fa-home text-green-600 mr-3 mt-1"></i>
                            <div>
                                <p class="text-xs text-gray-500 font-medium">Finca</p>
                                <p class="font-semibold text-gray-800">{{ $lote->caficultor->nombre_finca }}</p>
                            </div>
                        </div>
                    @endif

                    @if($lote->caficultor->departamento)
                        <div class="mb-4 flex items-start">
                            <i class="fas fa-map-marker-alt text-green-600 mr-3 mt-1"></i>
                            <div>
                                <p class="text-xs text-gray-500 font-medium">Ubicación</p>
                                <p class="font-semibold text-gray-800">
                                    {{ $lote->caficultor->municipio ? $lote->caficultor->municipio . ', ' : '' }}{{ $lote->caficultor->departamento }}
                                </p>
                            </div>
                        </div>
                    @endif

                    @if($lote->caficultor->hectareas)
                        <div class="mb-4 flex items-start">
                            <i class="fas fa-expand-arrows-alt text-green-600 mr-3 mt-1"></i>
                            <div>
                                <p class="text-xs text-gray-500 font-medium">Extensión</p>
                                <p class="font-semibold text-gray-800">{{ $lote->caficultor->hectareas }} hectáreas</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Garantía -->
                <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl shadow-xl p-6 border border-amber-200">
                    <h4 class="font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-shield-alt text-amber-600 mr-2"></i>
                        Verificación CaféTrace
                    </h4>
                    <ul class="space-y-3 text-sm text-gray-700">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                            <span>Trazabilidad 100% verificada</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                            <span>Información auténtica del productor</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                            <span>Proceso documentado</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                            <span>Calidad garantizada</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function cambiarImagen(url) {
    document.getElementById('imagenPrincipal').src = url;
}
</script>
@endsection