@extends('layouts.app')

@section('title', 'Gestión de Lotes - Admin')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Navbar del Admin -->
    <nav class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.dashboard') }}" class="bg-white/20 p-2 rounded-lg hover:bg-white/30 transition">
                        <i class="fas fa-arrow-left text-xl"></i>
                    </a>
                    <div>
                        <h1 class="text-xl font-bold">Gestión de Lotes</h1>
                        <p class="text-sm text-blue-100">{{ auth()->user()->name }}</p>
                    </div>
                </div>
                <!-- Menu Desktop -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-200 transition">
                        <i class="fas fa-home mr-2"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.usuarios') }}" class="hover:text-blue-200 transition">
                        <i class="fas fa-users mr-2"></i> Usuarios
                    </a>
                    <a href="{{ route('admin.lotes') }}" class="bg-white/20 px-4 py-2 rounded-lg">
                        <i class="fas fa-box mr-2"></i> Lotes
                    </a>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-blue-700 hover:bg-blue-900 px-4 py-2 rounded-lg transition">
                        <i class="fas fa-sign-out-alt mr-2"></i> Salir
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Menu Mobile -->
    <div class="md:hidden bg-blue-600 border-t border-blue-500">
        <div class="container mx-auto px-4 py-3 flex justify-around text-white text-sm">
            <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center">
                <i class="fas fa-home text-xl mb-1"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.usuarios') }}" class="flex flex-col items-center">
                <i class="fas fa-users text-xl mb-1"></i>
                <span>Usuarios</span>
            </a>
            <a href="{{ route('admin.lotes') }}" class="flex flex-col items-center text-blue-200">
                <i class="fas fa-box text-xl mb-1"></i>
                <span>Lotes</span>
            </a>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <!-- Alertas -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
        @endif

        <!-- Header -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-box text-green-600 mr-3"></i>
                        Gestión de Lotes
                    </h2>
                    <p class="text-gray-600 mt-1">
                        Total: {{ $lotes->total() }} lotes registrados
                    </p>
                </div>
            </div>
        </div>

        <!-- Grid de Lotes -->
        @if($lotes->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach($lotes as $lote)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition">
                        <!-- Imagen -->
                        <div class="relative h-48 bg-gray-200">
                            @if($lote->imagenes->first())
                                <img src="{{ asset('storage/' . $lote->imagenes->first()->ruta_imagen) }}" 
                                     alt="{{ $lote->codigo_lote }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-amber-400 to-orange-600">
                                    <i class="fas fa-coffee text-6xl text-white opacity-50"></i>
                                </div>
                            @endif
                            
                            <!-- Estado Badge -->
                            <div class="absolute top-3 right-3">
                                @if($lote->estado == 'disponible')
                                    <span class="bg-green-500 text-white text-xs px-3 py-1 rounded-full font-bold shadow-lg">
                                        <i class="fas fa-check-circle"></i> Disponible
                                    </span>
                                @elseif($lote->estado == 'vendido')
                                    <span class="bg-red-500 text-white text-xs px-3 py-1 rounded-full font-bold shadow-lg">
                                        <i class="fas fa-times-circle"></i> Vendido
                                    </span>
                                @elseif($lote->estado == 'reservado')
                                    <span class="bg-amber-500 text-white text-xs px-3 py-1 rounded-full font-bold shadow-lg">
                                        <i class="fas fa-clock"></i> Reservado
                                    </span>
                                @endif
                            </div>

                            <!-- Certificaciones -->
                            <div class="absolute top-3 left-3 flex flex-col gap-2">
                                @if($lote->es_organico)
                                    <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full font-bold shadow-lg">
                                        <i class="fas fa-leaf"></i> Orgánico
                                    </span>
                                @endif
                                @if($lote->comercio_justo)
                                    <span class="bg-blue-500 text-white text-xs px-2 py-1 rounded-full font-bold shadow-lg">
                                        <i class="fas fa-handshake"></i> C. Justo
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Contenido -->
                        <div class="p-5">
                            <!-- Header -->
                            <div class="flex items-center justify-between mb-3">
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

                            <!-- Info del Caficultor -->
                            @if($lote->caficultor)
                                <div class="flex items-center text-sm text-gray-600 mb-3 pb-3 border-b border-gray-200">
                                    <i class="fas fa-user text-green-600 mr-2"></i>
                                    <span class="truncate">{{ $lote->caficultor->name }}</span>
                                </div>
                            @endif

                            <!-- Detalles -->
                            <div class="space-y-2 text-sm text-gray-600 mb-4">
                                <div class="flex items-center justify-between">
                                    <span class="flex items-center">
                                        <i class="fas fa-weight-hanging w-5 text-amber-600"></i>
                                        Peso disponible:
                                    </span>
                                    <span class="font-bold text-gray-800">{{ number_format($lote->peso_disponible, 0) }} kg</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="flex items-center">
                                        <i class="fas fa-mountain w-5 text-amber-600"></i>
                                        Altura:
                                    </span>
                                    <span class="font-bold text-gray-800">{{ number_format($lote->altura_msnm, 0) }} msnm</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="flex items-center">
                                        <i class="fas fa-calendar w-5 text-amber-600"></i>
                                        Cosecha:
                                    </span>
                                    <span class="font-bold text-gray-800">{{ $lote->fecha_cosecha->format('d/m/Y') }}</span>
                                </div>
                                @if($lote->caficultor && $lote->caficultor->departamento)
                                    <div class="flex items-center justify-between">
                                        <span class="flex items-center">
                                            <i class="fas fa-map-marker-alt w-5 text-amber-600"></i>
                                            Ubicación:
                                        </span>
                                        <span class="font-bold text-gray-800">{{ $lote->caficultor->departamento }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Precio y Acciones -->
                            <div class="pt-4 border-t border-gray-200">
                                <div class="flex items-center justify-between mb-3">
                                    <div>
                                        <p class="text-xs text-gray-500">Precio por kg</p>
                                        <p class="text-2xl font-bold text-amber-600">
                                            ${{ number_format($lote->precio_por_kg, 0) }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs text-gray-500">Peso total</p>
                                        <p class="text-lg font-bold text-gray-800">
                                            {{ number_format($lote->peso_kg, 0) }} kg
                                        </p>
                                    </div>
                                </div>

                                <!-- Botones de Acción -->
                                <div class="flex gap-2">
                                    <a href="{{ route('trazabilidad.lote', $lote->codigo_lote) }}" 
                                       target="_blank"
                                       class="flex-1 bg-blue-500 hover:bg-blue-600 text-white text-center py-2 px-3 rounded-lg transition text-sm font-semibold">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                    <form method="POST" 
                                          action="{{ route('admin.lotes.eliminar', $lote->id) }}" 
                                          onsubmit="return confirm('¿Estás seguro de eliminar este lote permanentemente? Esta acción no se puede deshacer.')"
                                          class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="w-full bg-red-500 hover:bg-red-600 text-white py-2 px-3 rounded-lg transition text-sm font-semibold">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginación -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                {{ $lotes->links() }}
            </div>
        @else
            <!-- Sin lotes -->
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">
                    No hay lotes registrados
                </h3>
                <p class="text-gray-600">
                    Los caficultores aún no han registrado lotes de café en la plataforma
                </p>
            </div>
        @endif

        <!-- Estadísticas Rápidas -->
        <div class="mt-8 grid md:grid-cols-4 gap-6">
            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl shadow-lg p-6 border border-green-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-green-700 font-medium">Total Lotes</p>
                        <p class="text-3xl font-bold text-green-800 mt-1">{{ $lotes->total() }}</p>
                    </div>
                    <div class="bg-green-500 p-3 rounded-xl">
                        <i class="fas fa-box text-2xl text-white"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl shadow-lg p-6 border border-blue-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-blue-700 font-medium">Disponibles</p>
                        <p class="text-3xl font-bold text-blue-800 mt-1">
                            {{ $lotes->where('estado', 'disponible')->count() }}
                        </p>
                    </div>
                    <div class="bg-blue-500 p-3 rounded-xl">
                        <i class="fas fa-check-circle text-2xl text-white"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-amber-50 to-amber-100 rounded-xl shadow-lg p-6 border border-amber-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-amber-700 font-medium">Kg Totales</p>
                        <p class="text-3xl font-bold text-amber-800 mt-1">
                            {{ number_format($lotes->sum('peso_kg'), 0) }}
                        </p>
                    </div>
                    <div class="bg-amber-500 p-3 rounded-xl">
                        <i class="fas fa-weight text-2xl text-white"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl shadow-lg p-6 border border-purple-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-purple-700 font-medium">Kg Disponibles</p>
                        <p class="text-3xl font-bold text-purple-800 mt-1">
                            {{ number_format($lotes->sum('peso_disponible'), 0) }}
                        </p>
                    </div>
                    <div class="bg-purple-500 p-3 rounded-xl">
                        <i class="fas fa-box-open text-2xl text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection