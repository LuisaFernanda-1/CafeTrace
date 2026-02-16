@extends('layouts.app')

@section('title', 'Dashboard Caficultor')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-green-600 to-emerald-700 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="bg-white/20 p-2 rounded-lg">
                        <i class="fas fa-seedling text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">Panel Caficultor</h1>
                        <p class="text-sm text-green-100">{{ auth()->user()->name }}</p>
                    </div>
                </div>
                
                <!-- Menu Desktop -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('caficultor.dashboard') }}" class="hover:text-green-200 transition">
                        <i class="fas fa-home mr-2"></i> Inicio
                    </a>
                    <a href="{{ route('caficultor.dashboard') }}" class="hover:text-green-200 transition">
                        <i class="fas fa-coffee mr-2"></i> Mis Lotes
                    </a>
                    <a href="{{ route('caficultor.mis-ventas') }}" class="hover:text-green-200 transition">
                        <i class="fas fa-dollar-sign mr-2"></i> Mis Ventas
                    </a>
                    <a href="{{ route('caficultor.lotes.crear') }}" class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg transition">
                        <i class="fas fa-plus mr-2"></i> Nuevo Lote
                    </a>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-green-700 hover:bg-green-800 px-4 py-2 rounded-lg transition">
                        <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Menu Mobile -->
    <div class="md:hidden bg-green-600 border-t border-green-500">
        <div class="container mx-auto px-4 py-3 flex justify-around text-white text-sm">
            <a href="{{ route('caficultor.dashboard') }}" class="flex flex-col items-center">
                <i class="fas fa-home text-xl mb-1"></i>
                <span>Inicio</span>
            </a>
            <a href="{{ route('caficultor.dashboard') }}" class="flex flex-col items-center">
                <i class="fas fa-coffee text-xl mb-1"></i>
                <span>Mis Lotes</span>
            </a>
            <a href="{{ route('caficultor.mis-ventas') }}" class="flex flex-col items-center">
                <i class="fas fa-dollar-sign text-xl mb-1"></i>
                <span>Ventas</span>
            </a>
            <a href="{{ route('caficultor.lotes.crear') }}" class="flex flex-col items-center">
                <i class="fas fa-plus text-xl mb-1"></i>
                <span>Nuevo</span>
            </a>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="container mx-auto px-4 py-8">
        
        <!-- Mensajes -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center">
                <i class="fas fa-check-circle mr-3 text-xl"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Mensaje de Bienvenida -->
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl shadow-lg p-8 mb-8">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <h2 class="text-3xl font-bold mb-2">¡Hola, {{ auth()->user()->name }}! 👋</h2>
                    <p class="text-green-100">Gestiona tus lotes de café y conecta directamente con compradores</p>
                </div>
                <a href="{{ route('caficultor.lotes.crear') }}" 
                   class="bg-white text-green-600 hover:bg-green-50 px-6 py-3 rounded-xl font-bold shadow-lg transition transform hover:scale-105">
                    <i class="fas fa-plus mr-2"></i> Registrar Nuevo Lote
                </a>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="grid md:grid-cols-4 gap-6 mb-8">
            
            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Lotes</p>
                        <p class="text-3xl font-bold text-green-600 mt-1">{{ $totalLotes }}</p>
                    </div>
                    <div class="bg-green-100 p-4 rounded-xl">
                        <i class="fas fa-coffee text-3xl text-green-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Kg Disponibles</p>
                        <p class="text-3xl font-bold text-blue-600 mt-1">{{ number_format($kgDisponibles, 0) }}</p>
                    </div>
                    <div class="bg-blue-100 p-4 rounded-xl">
                        <i class="fas fa-weight text-3xl text-blue-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-amber-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Ventas</p>
                        <p class="text-3xl font-bold text-amber-600 mt-1">{{ $totalVentas }}</p>
                    </div>
                    <div class="bg-amber-100 p-4 rounded-xl">
                        <i class="fas fa-chart-line text-3xl text-amber-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Ingresos Netos</p>
                        <p class="text-2xl font-bold text-purple-600 mt-1">
                            ${{ number_format($ingresosNetos, 0) }}
                        </p>
                    </div>
                    <div class="bg-purple-100 p-4 rounded-xl">
                        <i class="fas fa-dollar-sign text-3xl text-purple-600"></i>
                    </div>
                </div>
            </div>

        </div>

        <!-- Lotes Recientes -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-coffee text-green-600 mr-3"></i>
                    Mis Lotes Recientes
                </h3>
                <a href="{{ route('caficultor.dashboard') }}" class="text-green-600 hover:text-green-700 font-semibold">
                    Ver todos <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            @if($lotesRecientes->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($lotesRecientes as $lote)
                        <div class="border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition group">
                            <!-- Imagen -->
                            <div class="relative h-48 bg-gray-200 overflow-hidden">
                                @if($lote->imagenes->first())
                                    <img src="{{ asset('storage/' . $lote->imagenes->first()->ruta_imagen) }}" 
                                         alt="Lote {{ $lote->codigo_lote }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-green-400 to-emerald-600">
                                        <i class="fas fa-coffee text-6xl text-white opacity-50"></i>
                                    </div>
                                @endif
                                
                                <!-- Badge de estado -->
                                <div class="absolute top-3 right-3">
                                    <span class="px-3 py-1 text-xs font-bold rounded-full
                                        {{ $lote->estado === 'disponible' ? 'bg-green-500 text-white' : '' }}
                                        {{ $lote->estado === 'vendido' ? 'bg-gray-500 text-white' : '' }}
                                        {{ $lote->estado === 'reservado' ? 'bg-amber-500 text-white' : '' }}
                                        {{ $lote->estado === 'en_proceso' ? 'bg-blue-500 text-white' : '' }}">
                                        {{ ucfirst($lote->estado) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Contenido -->
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">
                                        {{ $lote->codigo_lote }}
                                    </span>
                                    @if($lote->es_organico)
                                        <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">
                                            <i class="fas fa-leaf mr-1"></i> Orgánico
                                        </span>
                                    @endif
                                </div>

                                <h4 class="text-lg font-bold text-gray-900 mb-2">
                                    {{ $lote->variedad }}
                                </h4>

                                <div class="space-y-2 text-sm text-gray-600 mb-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-weight-hanging w-5 text-green-600"></i>
                                        <span>{{ number_format($lote->peso_disponible, 0) }} kg disponibles</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-mountain w-5 text-green-600"></i>
                                        <span>{{ number_format($lote->altura_msnm, 0) }} msnm</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar w-5 text-green-600"></i>
                                        <span>{{ $lote->fecha_cosecha->format('d/m/Y') }}</span>
                                    </div>
                                </div>

                                <div class="pt-4 border-t border-gray-200">
                                    <div class="flex items-center justify-between mb-3">
                                        <div>
                                            <p class="text-xs text-gray-500">Precio por kg</p>
                                            <p class="text-xl font-bold text-green-600">
                                                ${{ number_format($lote->precio_por_kg, 0) }}
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <!-- Botones de Acción -->
                                    <div class="grid grid-cols-3 gap-2">
                                        <a href="{{ route('caficultor.lotes.qr', $lote->id) }}" 
                                           class="bg-purple-500 hover:bg-purple-600 text-white text-center py-2 rounded-lg transition text-sm font-semibold">
                                            <i class="fas fa-qrcode"></i> QR
                                        </a>
                                        <a href="{{ route('caficultor.lotes.editar', $lote->id) }}" 
                                           class="bg-blue-500 hover:bg-blue-600 text-white text-center py-2 rounded-lg transition text-sm font-semibold">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <a href="{{ route('caficultor.lotes.ver', $lote->id) }}" 
                                           class="bg-green-600 hover:bg-green-700 text-white text-center py-2 rounded-lg transition text-sm font-semibold">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                    </div>
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
                    <h4 class="text-xl font-bold text-gray-700 mb-2">Aún no has registrado lotes</h4>
                    <p class="text-gray-500 mb-6">Comienza registrando tu primer lote de café</p>
                    <a href="{{ route('caficultor.lotes.crear') }}" 
                       class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-bold transition">
                        <i class="fas fa-plus mr-2"></i> Registrar Primer Lote
                    </a>
                </div>
            @endif
        </div>

        <!-- Guía Rápida -->
        <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl shadow-lg p-8 border border-blue-200">
            <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-lightbulb text-amber-500 mr-3"></i>
                Guía Rápida
            </h3>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="flex items-start space-x-4">
                    <div class="bg-green-500 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold flex-shrink-0">
                        1
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-1">Registra tu lote</h4>
                        <p class="text-sm text-gray-600">Ingresa la información de tu café: peso, variedad, altura y sube fotos del proceso</p>
                    </div>
                </div>
                <div class="flex items-start space-x-4">
                    <div class="bg-blue-500 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold flex-shrink-0">
                        2
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-1">Código QR automático</h4>
                        <p class="text-sm text-gray-600">El sistema genera un código QR único para trazabilidad completa</p>
                    </div>
                </div>
                <div class="flex items-start space-x-4">
                    <div class="bg-amber-500 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold flex-shrink-0">
                        3
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-1">Recibe pedidos</h4>
                        <p class="text-sm text-gray-600">Los compradores verán tu lote y realizarán pedidos directamente</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection