@extends('layouts.app')

@section('title', 'Dashboard Administrador')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Navbar del Admin -->
    <nav class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="bg-white/20 p-2 rounded-lg">
                        <i class="fas fa-user-shield text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">Panel Administrativo</h1>
                        <p class="text-sm text-blue-100">{{ auth()->user()->name }}</p>
                    </div>
                </div>
                <!-- Menu Desktop -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('admin.dashboard') }}" class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg transition">
                        <i class="fas fa-home mr-2"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.usuarios') }}" class="hover:text-blue-200 transition">
                        <i class="fas fa-users mr-2"></i> Usuarios
                    </a>
                    <a href="{{ route('admin.lotes') }}" class="hover:text-blue-200 transition">
                        <i class="fas fa-box mr-2"></i> Lotes
                    </a>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-blue-700 hover:bg-blue-900 px-4 py-2 rounded-lg transition">
                        <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Menu Mobile -->
    <div class="md:hidden bg-blue-600 border-t border-blue-500">
        <div class="container mx-auto px-4 py-3 flex justify-around text-white text-sm">
            <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center text-blue-200">
                <i class="fas fa-home text-xl mb-1"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.usuarios') }}" class="flex flex-col items-center">
                <i class="fas fa-users text-xl mb-1"></i>
                <span>Usuarios</span>
            </a>
            <a href="{{ route('admin.lotes') }}" class="flex flex-col items-center">
                <i class="fas fa-box text-xl mb-1"></i>
                <span>Lotes</span>
            </a>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="container mx-auto px-4 py-8">
        <!-- Alertas -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
        @endif

        <!-- Mensaje de Bienvenida -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-2xl shadow-lg p-8 mb-8">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <h2 class="text-3xl font-bold mb-2">¡Bienvenido, Administrador! 👋</h2>
                    <p class="text-blue-100">Panel de control y gestión de CaféTrace</p>
                </div>
                @if($usuariosPendientes > 0)
                    <a href="{{ route('admin.usuarios') }}" 
                       class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-xl font-bold shadow-lg transition">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ $usuariosPendientes }} {{ $usuariosPendientes == 1 ? 'usuario pendiente' : 'usuarios pendientes' }}
                    </a>
                @endif
            </div>
        </div>

        <!-- Estadísticas Principales -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Usuarios -->
            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Usuarios</p>
                        <p class="text-3xl font-bold text-blue-600 mt-1">{{ $totalUsuarios }}</p>
                        <p class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-users mr-1"></i>
                            {{ $totalCaficultores }} caficultores, {{ $totalCompradores }} compradores
                        </p>
                    </div>
                    <div class="bg-blue-100 p-4 rounded-xl">
                        <i class="fas fa-users text-3xl text-blue-600"></i>
                    </div>
                </div>
            </div>

            <!-- Total Lotes -->
            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Lotes</p>
                        <p class="text-3xl font-bold text-green-600 mt-1">{{ $totalLotes }}</p>
                        <p class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-check-circle mr-1"></i>
                            {{ $lotesDisponibles }} disponibles
                        </p>
                    </div>
                    <div class="bg-green-100 p-4 rounded-xl">
                        <i class="fas fa-box text-3xl text-green-600"></i>
                    </div>
                </div>
            </div>

            <!-- Total Kg Registrados -->
            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-amber-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Kg Registrados</p>
                        <p class="text-3xl font-bold text-amber-600 mt-1">{{ number_format($totalKgRegistrados, 0) }}</p>
                        <p class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-box-open mr-1"></i>
                            {{ number_format($totalKgDisponibles, 0) }} disponibles
                        </p>
                    </div>
                    <div class="bg-amber-100 p-4 rounded-xl">
                        <i class="fas fa-weight text-3xl text-amber-600"></i>
                    </div>
                </div>
            </div>

            <!-- Total Transacciones -->
            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Transacciones</p>
                        <p class="text-3xl font-bold text-purple-600 mt-1">{{ $totalTransacciones }}</p>
                        <p class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-dollar-sign mr-1"></i>
                            ${{ number_format($comisionesTotales, 0) }} comisión
                        </p>
                    </div>
                    <div class="bg-purple-100 p-4 rounded-xl">
                        <i class="fas fa-exchange-alt text-3xl text-purple-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-2 gap-6">
            <!-- Usuarios Pendientes de Aprobación -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-user-clock text-amber-500 mr-3"></i>
                        Usuarios Pendientes
                    </h3>
                    <a href="{{ route('admin.usuarios') }}" class="text-blue-600 hover:text-blue-700 font-semibold text-sm">
                        Ver todos <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

                @if($usuariosPendientesLista->count() > 0)
                    <div class="space-y-4">
                        @foreach($usuariosPendientesLista as $usuario)
                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center mb-2">
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-gray-400 to-gray-600 flex items-center justify-center text-white font-bold mr-3">
                                                {{ substr($usuario->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-900">{{ $usuario->name }}</p>
                                                <p class="text-sm text-gray-600">{{ $usuario->email }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-3 text-sm text-gray-600 ml-13">
                                            @if($usuario->role)
                                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">
                                                    {{ ucfirst($usuario->role->nombre) }}
                                                </span>
                                            @else
                                                <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-semibold">
                                                    Sin rol asignado
                                                </span>
                                            @endif
                                            <span class="text-xs">
                                                <i class="fas fa-calendar mr-1"></i>
                                                {{ $usuario->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex gap-2 ml-4">
                                        <form method="POST" action="{{ route('admin.usuarios.aprobar', $usuario->id) }}">
                                            @csrf
                                            <button type="submit" 
                                                    class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-lg text-sm transition"
                                                    title="Aprobar"
                                                    onclick="return confirm('¿Aprobar este usuario?')">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.usuarios.rechazar', $usuario->id) }}">
                                            @csrf
                                            <button type="submit" 
                                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-sm transition"
                                                    title="Rechazar"
                                                    onclick="return confirm('¿Rechazar este usuario?')">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-check-circle text-5xl text-green-500 mb-3"></i>
                        <p class="text-gray-600">No hay usuarios pendientes de aprobación</p>
                    </div>
                @endif
            </div>

            <!-- Últimos Lotes Registrados -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-box text-green-500 mr-3"></i>
                        Últimos Lotes
                    </h3>
                    <a href="{{ route('admin.lotes') }}" class="text-blue-600 hover:text-blue-700 font-semibold text-sm">
                        Ver todos <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

                @if($ultimosLotes->count() > 0)
                    <div class="space-y-4">
                        @foreach($ultimosLotes as $lote)
                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                                <div class="flex items-start gap-4">
                                    <!-- Miniatura -->
                                    <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0 bg-gray-200">
                                        @if($lote->imagenes->first())
                                            <img src="{{ asset('storage/' . $lote->imagenes->first()->ruta_imagen) }}" 
                                                 alt="{{ $lote->codigo_lote }}"
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-amber-400 to-orange-600">
                                                <i class="fas fa-coffee text-2xl text-white"></i>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="flex-1">
                                        <div class="flex items-start justify-between">
                                            <div>
                                                <p class="font-bold text-gray-900">{{ $lote->variedad }}</p>
                                                <p class="text-sm text-gray-600">{{ $lote->codigo_lote }}</p>
                                                @if($lote->caficultor)
                                                    <p class="text-xs text-gray-500 mt-1">
                                                        <i class="fas fa-user mr-1"></i>{{ $lote->caficultor->name }}
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="text-right">
                                                <p class="font-bold text-amber-600">${{ number_format($lote->precio_por_kg, 0) }}/kg</p>
                                                <p class="text-xs text-gray-600">{{ number_format($lote->peso_disponible, 0) }} kg</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-box-open text-5xl text-gray-300 mb-3"></i>
                        <p class="text-gray-600">No hay lotes registrados</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Información Adicional -->
        <div class="mt-8 grid md:grid-cols-3 gap-6">
            <!-- Acceso Rápido -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl shadow-lg p-6 border border-blue-200">
                <h4 class="font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-bolt text-blue-600 mr-2"></i>
                    Acceso Rápido
                </h4>
                <div class="space-y-2">
                    <a href="{{ route('admin.usuarios') }}" class="block bg-white hover:bg-blue-50 px-4 py-3 rounded-lg transition text-sm">
                        <i class="fas fa-users text-blue-600 mr-2"></i> Gestionar Usuarios
                    </a>
                    <a href="{{ route('admin.lotes') }}" class="block bg-white hover:bg-blue-50 px-4 py-3 rounded-lg transition text-sm">
                        <i class="fas fa-box text-blue-600 mr-2"></i> Gestionar Lotes
                    </a>
                </div>
            </div>

            <!-- Resumen Rápido -->
            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl shadow-lg p-6 border border-green-200">
                <h4 class="font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-chart-line text-green-600 mr-2"></i>
                    Resumen
                </h4>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Caficultores activos:</span>
                        <span class="font-bold text-gray-800">{{ $totalCaficultores }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Compradores activos:</span>
                        <span class="font-bold text-gray-800">{{ $totalCompradores }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Lotes disponibles:</span>
                        <span class="font-bold text-gray-800">{{ $lotesDisponibles }}</span>
                    </div>
                </div>
            </div>

            <!-- Estado del Sistema -->
            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl shadow-lg p-6 border border-purple-200">
                <h4 class="font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-server text-purple-600 mr-2"></i>
                    Estado del Sistema
                </h4>
                <div class="space-y-3 text-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Base de datos:</span>
                        <span class="px-2 py-1 bg-green-500 text-white rounded-full text-xs font-bold">
                            <i class="fas fa-check-circle"></i> Activa
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Servidor:</span>
                        <span class="px-2 py-1 bg-green-500 text-white rounded-full text-xs font-bold">
                            <i class="fas fa-check-circle"></i> Online
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Última actualización:</span>
                        <span class="text-gray-800 font-bold">{{ now()->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection