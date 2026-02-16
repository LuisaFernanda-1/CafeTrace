@extends('layouts.app')

@section('title', 'Dashboard Comprador')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-amber-600 to-orange-700 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="bg-white/20 p-2 rounded-lg">
                        <i class="fas fa-shopping-bag text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">Panel Comprador</h1>
                        <p class="text-sm text-amber-100">{{ auth()->user()->name }}</p>
                    </div>
                </div>
                
                <!-- Menu Desktop -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('comprador.dashboard') }}" class="hover:text-amber-200 transition">
                        <i class="fas fa-home mr-2"></i> Inicio
                    </a>
                    <a href="{{ route('comprador.marketplace') }}" class="hover:text-amber-200 transition">
                        <i class="fas fa-store mr-2"></i> Marketplace
                    </a>
                    <a href="{{ route('comprador.mis-compras') }}" class="hover:text-amber-200 transition">
                        <i class="fas fa-shopping-bag mr-2"></i> Mis Compras
                    </a>
                    <a href="{{ route('comprador.carrito') }}" class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg transition relative">
                        <i class="fas fa-shopping-cart mr-2"></i> Carrito
                        @if($itemsCarrito > 0)
                            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs w-6 h-6 rounded-full flex items-center justify-center font-bold">
                                {{ $itemsCarrito }}
                            </span>
                        @endif
                    </a>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-amber-700 hover:bg-amber-900 px-4 py-2 rounded-lg transition">
                        <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Menu Mobile -->
    <div class="md:hidden bg-amber-600 border-t border-amber-500">
        <div class="container mx-auto px-4 py-3 flex justify-around text-white text-sm">
            <a href="{{ route('comprador.dashboard') }}" class="flex flex-col items-center">
                <i class="fas fa-home text-xl mb-1"></i>
                <span>Inicio</span>
            </a>
            <a href="{{ route('comprador.marketplace') }}" class="flex flex-col items-center">
                <i class="fas fa-store text-xl mb-1"></i>
                <span>Marketplace</span>
            </a>
            <a href="{{ route('comprador.mis-compras') }}" class="flex flex-col items-center">
                <i class="fas fa-shopping-bag text-xl mb-1"></i>
                <span>Compras</span>
            </a>
            <a href="{{ route('comprador.carrito') }}" class="flex flex-col items-center relative">
                <i class="fas fa-shopping-cart text-xl mb-1"></i>
                <span>Carrito</span>
                @if($itemsCarrito > 0)
                    <span class="absolute -top-1 -right-2 bg-red-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center font-bold">
                        {{ $itemsCarrito }}
                    </span>
                @endif
            </a>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="container mx-auto px-4 py-8">
        
        <!-- Mensaje de Bienvenida -->
        <div class="bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-2xl shadow-lg p-8 mb-8">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <h2 class="text-3xl font-bold mb-2">¡Bienvenido, {{ auth()->user()->name }}! 👋</h2>
                    <p class="text-amber-100">Encuentra el mejor café colombiano con trazabilidad verificada</p>
                </div>
                <a href="{{ route('comprador.marketplace') }}" 
                   class="bg-white text-amber-600 hover:bg-amber-50 px-6 py-3 rounded-xl font-bold shadow-lg transition transform hover:scale-105">
                    <i class="fas fa-store mr-2"></i> Explorar Marketplace
                </a>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="grid md:grid-cols-4 gap-6 mb-8">
            
            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Compras</p>
                        <p class="text-3xl font-bold text-green-600 mt-1">{{ $totalCompras }}</p>
                    </div>
                    <div class="bg-green-100 p-4 rounded-xl">
                        <i class="fas fa-shopping-bag text-3xl text-green-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Kg Comprados</p>
                        <p class="text-3xl font-bold text-blue-600 mt-1">{{ number_format($kgComprados, 0) }}</p>
                    </div>
                    <div class="bg-blue-100 p-4 rounded-xl">
                        <i class="fas fa-weight text-3xl text-blue-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Gastado</p>
                        <p class="text-2xl font-bold text-purple-600 mt-1">
                            ${{ number_format($totalGastado, 0) }}
                        </p>
                    </div>
                    <div class="bg-purple-100 p-4 rounded-xl">
                        <i class="fas fa-dollar-sign text-3xl text-purple-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-amber-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">En Carrito</p>
                        <p class="text-3xl font-bold text-amber-600 mt-1">{{ $itemsCarrito }}</p>
                    </div>
                    <div class="bg-amber-100 p-4 rounded-xl">
                        <i class="fas fa-shopping-cart text-3xl text-amber-600"></i>
                    </div>
                </div>
            </div>

        </div>

        <!-- Lotes Destacados -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-star text-amber-600 mr-3"></i>
                    Lotes Destacados
                </h3>
                <a href="{{ route('comprador.marketplace') }}" class="text-amber-600 hover:text-amber-700 font-semibold">
                    Ver todos <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            @if($lotesDestacados->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($lotesDestacados as $lote)
                        <div class="border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition group">
                            <!-- Imagen -->
                            <div class="relative h-48 bg-gray-200 overflow-hidden">
                                @if($lote->imagenes->first())
                                    <img src="{{ asset('storage/' . $lote->imagenes->first()->ruta_imagen) }}" 
                                         alt="Lote {{ $lote->codigo_lote }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-amber-400 to-orange-600">
                                        <i class="fas fa-coffee text-6xl text-white opacity-50"></i>
                                    </div>
                                @endif
                                
                                <!-- Badges -->
                                <div class="absolute top-3 left-3 flex flex-col gap-2">
                                    @if($lote->es_organico)
                                        <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full font-bold">
                                            <i class="fas fa-leaf"></i> Orgánico
                                        </span>
                                    @endif
                                    @if($lote->comercio_justo)
                                        <span class="bg-blue-500 text-white text-xs px-2 py-1 rounded-full font-bold">
                                            <i class="fas fa-handshake"></i> C. Justo
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Contenido -->
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">
                                        {{ $lote->codigo_lote }}
                                    </span>
                                    @if($lote->puntaje_calidad)
                                        <span class="text-xs bg-amber-100 text-amber-800 px-2 py-1 rounded-full font-bold">
                                            <i class="fas fa-star"></i> {{ $lote->puntaje_calidad }}/100
                                        </span>
                                    @endif
                                </div>

                                <h4 class="text-lg font-bold text-gray-900 mb-2">
                                    {{ $lote->variedad }}
                                </h4>

                                <p class="text-sm text-gray-600 mb-3">
                                    <i class="fas fa-user text-amber-600 mr-1"></i>
                                    {{ $lote->caficultor->name }}
                                </p>

                                <div class="space-y-2 text-sm text-gray-600 mb-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-weight-hanging w-5 text-amber-600"></i>
                                        <span>{{ number_format($lote->peso_disponible, 0) }} kg disponibles</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-mountain w-5 text-amber-600"></i>
                                        <span>{{ number_format($lote->altura_msnm, 0) }} msnm</span>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                    <div>
                                        <p class="text-xs text-gray-500">Precio por kg</p>
                                        <p class="text-xl font-bold text-amber-600">
                                            ${{ number_format($lote->precio_por_kg, 0) }}
                                        </p>
                                    </div>
                                    <a href="{{ route('comprador.lote.ver', $lote->id) }}" 
                                       class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-lg transition text-sm font-semibold">
                                        Ver Detalles
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-4">
                        <i class="fas fa-coffee text-4xl text-gray-400"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-700 mb-2">No hay lotes disponibles</h4>
                    <p class="text-gray-500 mb-6">Revisa más tarde o explora el marketplace</p>
                </div>
            @endif
        </div>

        <!-- Ventajas de Comprar -->
        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl shadow-lg p-8 border border-green-200">
            <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-shield-alt text-green-600 mr-3"></i>
                ¿Por qué comprar en CaféTrace?
            </h3>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="flex items-start space-x-4">
                    <div class="bg-green-500 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold flex-shrink-0">
                        <i class="fas fa-check"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-1">Trazabilidad 100%</h4>
                        <p class="text-sm text-gray-600">Conoce el origen exacto de tu café, desde la finca hasta tu taza</p>
                    </div>
                </div>
                <div class="flex items-start space-x-4">
                    <div class="bg-green-500 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold flex-shrink-0">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-1">Directo del Productor</h4>
                        <p class="text-sm text-gray-600">Compra directamente a los caficultores colombianos sin intermediarios</p>
                    </div>
                </div>
                <div class="flex items-start space-x-4">
                    <div class="bg-green-500 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold flex-shrink-0">
                        <i class="fas fa-award"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-1">Calidad Verificada</h4>
                        <p class="text-sm text-gray-600">Café de alta calidad con información completa del proceso productivo</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection