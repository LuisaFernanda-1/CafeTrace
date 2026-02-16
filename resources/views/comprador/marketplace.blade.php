@extends('layouts.app')

@section('title', 'Marketplace - Comprador')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Navbar del Comprador -->
    <nav class="bg-gradient-to-r from-amber-600 to-orange-700 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="bg-white/20 p-2 rounded-lg">
                        <i class="fas fa-store text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">Marketplace</h1>
                        <p class="text-sm text-amber-100">{{ auth()->user()->name }}</p>
                    </div>
                </div>
                <!-- Menu Desktop -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('comprador.dashboard') }}" class="hover:text-amber-200 transition">
                        <i class="fas fa-home mr-2"></i> Dashboard
                    </a>
                    <a href="{{ route('comprador.marketplace') }}" class="bg-white/20 px-4 py-2 rounded-lg">
                        <i class="fas fa-store mr-2"></i> Marketplace
                    </a>
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

    <!-- Menu Mobile -->
    <div class="md:hidden bg-amber-600 border-t border-amber-500">
        <div class="container mx-auto px-4 py-3 flex justify-around text-white text-sm">
            <a href="{{ route('comprador.dashboard') }}" class="flex flex-col items-center">
                <i class="fas fa-home text-xl mb-1"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('comprador.marketplace') }}" class="flex flex-col items-center text-amber-200">
                <i class="fas fa-store text-xl mb-1"></i>
                <span>Marketplace</span>
            </a>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Sidebar de Filtros (Desktop) -->
            <div class="lg:w-1/4">
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-4">
                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-filter text-amber-600 mr-3"></i>
                        Filtros
                    </h3>

                    <form method="GET" action="{{ route('comprador.marketplace') }}" id="filtrosForm">
                        <!-- Búsqueda por texto -->
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                <i class="fas fa-search mr-2"></i>Buscar
                            </label>
                            <input type="text" 
                                   name="buscar" 
                                   value="{{ request('buscar') }}"
                                   placeholder="Código, variedad, región..."
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                        </div>

                        <!-- Variedad -->
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                <i class="fas fa-leaf mr-2"></i>Variedad
                            </label>
                            <select name="variedad" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500">
                                <option value="">Todas</option>
                                @foreach($variedades as $variedad)
                                    <option value="{{ $variedad }}" {{ request('variedad') == $variedad ? 'selected' : '' }}>
                                        {{ $variedad }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Precio -->
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                <i class="fas fa-dollar-sign mr-2"></i>Precio por Kg
                            </label>
                            <div class="flex gap-2">
                                <input type="number" 
                                       name="precio_min" 
                                       value="{{ request('precio_min') }}"
                                       placeholder="Min"
                                       class="w-1/2 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500">
                                <input type="number" 
                                       name="precio_max" 
                                       value="{{ request('precio_max') }}"
                                       placeholder="Max"
                                       class="w-1/2 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500">
                            </div>
                        </div>

                        <!-- Altura -->
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                <i class="fas fa-mountain mr-2"></i>Altura Mínima (msnm)
                            </label>
                            <input type="number" 
                                   name="altura_min" 
                                   value="{{ request('altura_min') }}"
                                   placeholder="Ej: 1500"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500">
                        </div>

                        <!-- Departamento -->
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                <i class="fas fa-map-marker-alt mr-2"></i>Departamento
                            </label>
                            <select name="departamento" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500">
                                <option value="">Todos</option>
                                @foreach($departamentos as $depto)
                                    <option value="{{ $depto }}" {{ request('departamento') == $depto ? 'selected' : '' }}>
                                        {{ $depto }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Certificaciones -->
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-3">
                                <i class="fas fa-certificate mr-2"></i>Certificaciones
                            </label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" 
                                           name="organico" 
                                           value="1"
                                           {{ request('organico') ? 'checked' : '' }}
                                           class="mr-2 text-amber-600 focus:ring-amber-500">
                                    <span class="text-sm">Orgánico</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" 
                                           name="comercio_justo" 
                                           value="1"
                                           {{ request('comercio_justo') ? 'checked' : '' }}
                                           class="mr-2 text-amber-600 focus:ring-amber-500">
                                    <span class="text-sm">Comercio Justo</span>
                                </label>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="space-y-2">
                            <button type="submit" class="w-full bg-amber-600 hover:bg-amber-700 text-white font-bold py-3 px-4 rounded-lg transition">
                                <i class="fas fa-search mr-2"></i>Buscar
                            </button>
                            <a href="{{ route('comprador.marketplace') }}" 
                               class="block w-full text-center bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-3 px-4 rounded-lg transition">
                                <i class="fas fa-redo mr-2"></i>Limpiar
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Contenido Principal -->
            <div class="lg:w-3/4">
                <!-- Header con ordenamiento -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">
                                Lotes Disponibles
                            </h2>
                            <p class="text-gray-600 mt-1">
                                {{ $lotes->total() }} {{ $lotes->total() == 1 ? 'lote encontrado' : 'lotes encontrados' }}
                            </p>
                        </div>
                        
                        <!-- Ordenamiento -->
                        <div class="flex items-center gap-2">
                            <label class="text-sm text-gray-600 font-medium">Ordenar por:</label>
                            <select onchange="window.location.href=this.value" 
                                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500">
                                <option value="{{ route('comprador.marketplace', array_merge(request()->except('orden'), ['orden' => 'reciente'])) }}" 
                                        {{ request('orden', 'reciente') == 'reciente' ? 'selected' : '' }}>
                                    Más reciente
                                </option>
                                <option value="{{ route('comprador.marketplace', array_merge(request()->except('orden'), ['orden' => 'precio_asc'])) }}"
                                        {{ request('orden') == 'precio_asc' ? 'selected' : '' }}>
                                    Precio: Menor a Mayor
                                </option>
                                <option value="{{ route('comprador.marketplace', array_merge(request()->except('orden'), ['orden' => 'precio_desc'])) }}"
                                        {{ request('orden') == 'precio_desc' ? 'selected' : '' }}>
                                    Precio: Mayor a Menor
                                </option>
                                <option value="{{ route('comprador.marketplace', array_merge(request()->except('orden'), ['orden' => 'peso_desc'])) }}"
                                        {{ request('orden') == 'peso_desc' ? 'selected' : '' }}>
                                    Mayor Cantidad
                                </option>
                                <option value="{{ route('comprador.marketplace', array_merge(request()->except('orden'), ['orden' => 'altura_desc'])) }}"
                                        {{ request('orden') == 'altura_desc' ? 'selected' : '' }}>
                                    Mayor Altura
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Grid de Lotes -->
                @if($lotes->count() > 0)
                    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
                        @foreach($lotes as $lote)
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition group">
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
                                    <div class="absolute top-3 right-3 flex flex-col gap-2">
                                        @if($lote->es_organico)
                                            <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full font-bold shadow-lg">
                                                <i class="fas fa-leaf"></i> Orgánico
                                            </span>
                                        @endif
                                        @if($lote->comercio_justo)
                                            <span class="bg-blue-500 text-white text-xs px-2 py-1 rounded-full font-bold shadow-lg">
                                                <i class="fas fa-handshake"></i> Comercio Justo
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Contenido -->
                                <div class="p-5">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">
                                            {{ $lote->codigo_lote }}
                                        </span>
                                        @if($lote->puntaje_calidad)
                                            <span class="text-xs font-bold text-amber-600">
                                                <i class="fas fa-star"></i> {{ $lote->puntaje_calidad }}/100
                                            </span>
                                        @endif
                                    </div>

                                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                                        {{ $lote->variedad }}
                                    </h3>

                                    <!-- Info del caficultor -->
                                    <div class="flex items-center text-sm text-gray-600 mb-3 pb-3 border-b border-gray-200">
                                        <i class="fas fa-user text-amber-600 mr-2"></i>
                                        <span class="truncate">{{ $lote->caficultor->name }}</span>
                                    </div>

                                    <!-- Detalles -->
                                    <div class="space-y-2 text-sm text-gray-600 mb-4">
                                        <div class="flex items-center">
                                            <i class="fas fa-weight-hanging w-5 text-amber-600"></i>
                                            <span><strong>{{ number_format($lote->peso_disponible, 0) }} kg</strong> disponibles</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-mountain w-5 text-amber-600"></i>
                                            <span>{{ number_format($lote->altura_msnm, 0) }} msnm</span>
                                        </div>
                                        @if($lote->caficultor->departamento)
                                            <div class="flex items-center">
                                                <i class="fas fa-map-marker-alt w-5 text-amber-600"></i>
                                                <span>{{ $lote->caficultor->departamento }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Precio y Acción -->
                                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                        <div>
                                            <p class="text-xs text-gray-500">Precio por kg</p>
                                            <p class="text-2xl font-bold text-amber-600">
                                                ${{ number_format($lote->precio_por_kg, 0) }}
                                            </p>
                                        </div>
                                        <a href="{{ route('comprador.lote.ver', $lote->id) }}" 
                                           class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-lg transition text-sm font-semibold shadow-lg hover:shadow-xl">
                                            Ver Detalles
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Paginación -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        {{ $lotes->appends(request()->except('page'))->links() }}
                    </div>
                @else
                    <!-- Sin resultados -->
                    <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                        <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">
                            No se encontraron lotes
                        </h3>
                        <p class="text-gray-600 mb-6">
                            Intenta ajustar los filtros de búsqueda
                        </p>
                        <a href="{{ route('comprador.marketplace') }}" 
                           class="inline-block bg-amber-600 hover:bg-amber-700 text-white font-bold py-3 px-6 rounded-lg transition">
                            <i class="fas fa-redo mr-2"></i>Ver todos los lotes
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection