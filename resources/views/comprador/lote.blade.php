@extends('layouts.app')

@section('title', 'Detalle del Lote - ' . $lote->codigo_lote)

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Navbar del Comprador -->
    <nav class="bg-gradient-to-r from-amber-600 to-orange-700 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('comprador.marketplace') }}" class="bg-white/20 p-2 rounded-lg hover:bg-white/30 transition">
                        <i class="fas fa-arrow-left text-xl"></i>
                    </a>
                    <div>
                        <h1 class="text-xl font-bold">Detalle del Lote</h1>
                        <p class="text-sm text-amber-100">{{ $lote->codigo_lote }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-amber-700 hover:bg-amber-800 px-4 py-2 rounded-lg transition">
                        <i class="fas fa-sign-out-alt mr-2"></i> Salir
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Columna Principal (2/3) -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Galería de Imágenes -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    @if($lote->imagenes->count() > 0)
                        <!-- Imagen Principal -->
                        <div class="relative h-96 bg-gray-200">
                            <img id="imagenPrincipal" 
                                 src="{{ asset('storage/' . $lote->imagenes->first()->ruta_imagen) }}" 
                                 alt="Lote {{ $lote->codigo_lote }}"
                                 class="w-full h-full object-cover">
                            
                            <!-- Badges sobre la imagen -->
                            <div class="absolute top-4 right-4 flex flex-col gap-2">
                                @if($lote->es_organico)
                                    <span class="bg-green-500 text-white text-sm px-3 py-1 rounded-full font-bold shadow-lg">
                                        <i class="fas fa-leaf"></i> Orgánico
                                    </span>
                                @endif
                                @if($lote->comercio_justo)
                                    <span class="bg-blue-500 text-white text-sm px-3 py-1 rounded-full font-bold shadow-lg">
                                        <i class="fas fa-handshake"></i> Comercio Justo
                                    </span>
                                @endif
                                @if($lote->puntaje_calidad)
                                    <span class="bg-amber-500 text-white text-sm px-3 py-1 rounded-full font-bold shadow-lg">
                                        <i class="fas fa-star"></i> {{ $lote->puntaje_calidad }}/100
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Miniaturas -->
                        @if($lote->imagenes->count() > 1)
                            <div class="p-4 bg-gray-50 border-t border-gray-200">
                                <div class="grid grid-cols-4 md:grid-cols-6 gap-2">
                                    @foreach($lote->imagenes as $imagen)
                                        <div class="relative aspect-square cursor-pointer rounded-lg overflow-hidden border-2 border-transparent hover:border-amber-500 transition"
                                             onclick="cambiarImagen('{{ asset('storage/' . $imagen->ruta_imagen) }}')">
                                            <img src="{{ asset('storage/' . $imagen->ruta_imagen) }}" 
                                                 alt="{{ $imagen->tipo }}"
                                                 class="w-full h-full object-cover">
                                            @if($imagen->tipo)
                                                <div class="absolute bottom-0 left-0 right-0 bg-black/70 text-white text-xs px-1 py-0.5 text-center">
                                                    {{ ucfirst($imagen->tipo) }}
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @else
                        <!-- Sin imágenes -->
                        <div class="h-96 flex items-center justify-center bg-gradient-to-br from-amber-400 to-orange-600">
                            <div class="text-center text-white">
                                <i class="fas fa-coffee text-8xl mb-4 opacity-50"></i>
                                <p class="text-xl font-semibold">Sin imágenes disponibles</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Información del Lote -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <span class="text-sm font-semibold text-gray-500 uppercase tracking-wide">
                                {{ $lote->codigo_lote }}
                            </span>
                            <h1 class="text-3xl font-bold text-gray-900 mt-1">
                                Café {{ $lote->variedad }}
                            </h1>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Precio por kg</p>
                            <p class="text-4xl font-bold text-amber-600">
                                ${{ number_format($lote->precio_por_kg, 0) }}
                            </p>
                        </div>
                    </div>

                    <!-- Descripción -->
                    @if($lote->descripcion)
                        <div class="mb-6 pb-6 border-b border-gray-200">
                            <h3 class="text-lg font-bold text-gray-800 mb-3">
                                <i class="fas fa-info-circle text-amber-600 mr-2"></i>Descripción
                            </h3>
                            <p class="text-gray-700 leading-relaxed">{{ $lote->descripcion }}</p>
                        </div>
                    @endif

                    <!-- Características Principales -->
                    <div class="grid md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-gradient-to-br from-green-50 to-green-100 p-4 rounded-lg border border-green-200">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-weight-hanging text-2xl text-green-600 mr-3"></i>
                                <div>
                                    <p class="text-xs text-green-700 font-medium">Disponible</p>
                                    <p class="text-2xl font-bold text-green-800">{{ number_format($lote->peso_disponible, 0) }} kg</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-lg border border-blue-200">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-mountain text-2xl text-blue-600 mr-3"></i>
                                <div>
                                    <p class="text-xs text-blue-700 font-medium">Altura</p>
                                    <p class="text-2xl font-bold text-blue-800">{{ number_format($lote->altura_msnm, 0) }} msnm</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-amber-50 to-amber-100 p-4 rounded-lg border border-amber-200">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-calendar text-2xl text-amber-600 mr-3"></i>
                                <div>
                                    <p class="text-xs text-amber-700 font-medium">Cosecha</p>
                                    <p class="text-lg font-bold text-amber-800">{{ $lote->fecha_cosecha->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Proceso de Trazabilidad -->
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">
                            <i class="fas fa-route text-amber-600 mr-2"></i>Trazabilidad del Proceso
                        </h3>
                        
                        <div class="relative">
                            <!-- Línea vertical conectora -->
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
            </div>

            <!-- Columna Lateral (1/3) -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Información del Caficultor -->
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-4">
                    <div class="text-center mb-6 pb-6 border-b border-gray-200">
                        <div class="w-20 h-20 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <i class="fas fa-user text-3xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">{{ $lote->caficultor->name }}</h3>
                        <p class="text-sm text-gray-600">Caficultor</p>
                    </div>

                    <!-- Detalles de la Finca -->
                    @if($lote->caficultor->nombre_finca)
                        <div class="mb-4 flex items-start">
                            <i class="fas fa-home text-green-600 mr-3 mt-1"></i>
                            <div>
                                <p class="text-xs text-gray-500 font-medium">Finca</p>
                                <p class="font-semibold text-gray-800">{{ $lote->caficultor->nombre_finca }}</p>
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

                    @if($lote->caficultor->telefono)
                        <div class="mb-6 flex items-start">
                            <i class="fas fa-phone text-green-600 mr-3 mt-1"></i>
                            <div>
                                <p class="text-xs text-gray-500 font-medium">Teléfono</p>
                                <p class="font-semibold text-gray-800">{{ $lote->caficultor->telefono }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Botones de Acción -->
                  <div class="bg-white rounded-2xl shadow-xl p-6 sticky top-6">
    <h3 class="text-xl font-bold text-gray-800 mb-4">
        <i class="fas fa-shopping-cart text-amber-600 mr-2"></i>
        Realizar Compra
    </h3>

    <form method="POST" action="{{ route('comprador.carrito.agregar', $lote->id) }}">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Cantidad (kg)
            </label>
            <input type="number" 
                   name="cantidad_kg" 
                   min="1" 
                   max="{{ $lote->peso_disponible }}" 
                   value="1"
                   step="0.01"
                   required
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-amber-500 focus:border-transparent">
            <p class="text-xs text-gray-500 mt-1">
                Disponible: {{ number_format($lote->peso_disponible, 2) }} kg
            </p>
        </div>

        <div class="bg-amber-50 p-4 rounded-lg mb-4">
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm text-gray-600">Precio por kg:</span>
                <span class="font-bold text-gray-800">${{ number_format($lote->precio_por_kg, 0) }}</span>
            </div>
            <div class="flex justify-between items-center pt-2 border-t border-amber-200">
                <span class="text-sm font-bold text-gray-800">Subtotal estimado:</span>
                <span class="text-xl font-bold text-amber-600" id="subtotal">
                    ${{ number_format($lote->precio_por_kg, 0) }}
                </span>
            </div>
        </div>

        <button type="submit" 
                class="w-full bg-amber-600 hover:bg-amber-700 text-white py-3 rounded-lg font-bold transition shadow-lg">
            <i class="fas fa-cart-plus mr-2"></i>
            Agregar al Carrito
        </button>
    </form>

    <a href="{{ route('comprador.carrito') }}" 
       class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-bold transition shadow-lg mt-3 block text-center">
        <i class="fas fa-shopping-cart mr-2"></i>
        Ver Carrito
    </a>

    <div class="mt-4 pt-4 border-t border-gray-200">
        <h4 class="font-bold text-gray-800 mb-2 text-sm">
            <i class="fas fa-shield-alt text-green-600 mr-2"></i>
            Compra Segura
        </h4>
        <ul class="text-xs text-gray-600 space-y-1">
            <li><i class="fas fa-check text-green-500 mr-1"></i> Trazabilidad verificada</li>
            <li><i class="fas fa-check text-green-500 mr-1"></i> Pago protegido</li>
            <li><i class="fas fa-check text-green-500 mr-1"></i> Información auténtica</li>
        </ul>
    </div>
</div>

<script>
// Calcular subtotal en tiempo real
document.querySelector('input[name="cantidad_kg"]').addEventListener('input', function() {
    const cantidad = parseFloat(this.value) || 0;
    const precioPorKg = {{ $lote->precio_por_kg }};
    const subtotal = cantidad * precioPorKg;
    document.getElementById('subtotal').textContent = '$' + subtotal.toLocaleString('es-CO', {maximumFractionDigits: 0});
});
</script>
                </div>

                <!-- Información Adicional -->
                <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl shadow-lg p-6 border border-amber-200">
                    <h4 class="font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-shield-alt text-amber-600 mr-2"></i>
                        Garantía CaféTrace
                    </h4>
                    <ul class="space-y-3 text-sm text-gray-700">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                            <span>100% trazabilidad verificada</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                            <span>Transacciones seguras</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                            <span>Soporte directo</span>
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