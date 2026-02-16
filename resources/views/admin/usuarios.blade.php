@extends('layouts.app')

@section('title', 'Gestión de Usuarios - Admin')

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
                        <h1 class="text-xl font-bold">Gestión de Usuarios</h1>
                        <p class="text-sm text-blue-100">{{ auth()->user()->name }}</p>
                    </div>
                </div>
                <!-- Menu Desktop -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-200 transition">
                        <i class="fas fa-home mr-2"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.usuarios') }}" class="bg-white/20 px-4 py-2 rounded-lg">
                        <i class="fas fa-users mr-2"></i> Usuarios
                    </a>
                    <a href="{{ route('admin.lotes') }}" class="hover:text-blue-200 transition">
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
            <a href="{{ route('admin.usuarios') }}" class="flex flex-col items-center text-blue-200">
                <i class="fas fa-users text-xl mb-1"></i>
                <span>Usuarios</span>
            </a>
            <a href="{{ route('admin.lotes') }}" class="flex flex-col items-center">
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
                        <i class="fas fa-users text-blue-600 mr-3"></i>
                        Gestión de Usuarios
                    </h2>
                    <p class="text-gray-600 mt-1">
                        Total: {{ $usuarios->total() }} usuarios
                    </p>
                </div>
            </div>
        </div>

        <!-- Filtros por Estado -->
        <div class="bg-white rounded-xl shadow-lg p-4 mb-6">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.usuarios') }}" 
                   class="px-4 py-2 rounded-lg transition {{ !request('estado') ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    <i class="fas fa-list mr-2"></i>Todos
                </a>
                <a href="{{ route('admin.usuarios', ['estado' => 'pendiente']) }}" 
                   class="px-4 py-2 rounded-lg transition {{ request('estado') == 'pendiente' ? 'bg-amber-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    <i class="fas fa-clock mr-2"></i>Pendientes
                </a>
                <a href="{{ route('admin.usuarios', ['estado' => 'activo']) }}" 
                   class="px-4 py-2 rounded-lg transition {{ request('estado') == 'activo' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    <i class="fas fa-check-circle mr-2"></i>Activos
                </a>
                <a href="{{ route('admin.usuarios', ['estado' => 'inactivo']) }}" 
                   class="px-4 py-2 rounded-lg transition {{ request('estado') == 'inactivo' ? 'bg-red-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    <i class="fas fa-times-circle mr-2"></i>Inactivos
                </a>
            </div>
        </div>

        <!-- Tabla de Usuarios -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            @if($usuarios->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-100 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Usuario
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Rol
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Contacto
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Estado
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Registro
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($usuarios as $usuario)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold mr-3">
                                                {{ substr($usuario->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-900">{{ $usuario->name }}</p>
                                                <p class="text-sm text-gray-600">{{ $usuario->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($usuario->role)
                                            <span class="px-3 py-1 rounded-full text-xs font-bold
                                                @if($usuario->role->nombre == 'caficultor') bg-green-100 text-green-800
                                                @elseif($usuario->role->nombre == 'comprador') bg-amber-100 text-amber-800
                                                @else bg-blue-100 text-blue-800
                                                @endif">
                                                {{ ucfirst($usuario->role->nombre) }}
                                            </span>
                                        @else
                                            <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-bold">
                                                Sin rol
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm">
                                            @if($usuario->telefono)
                                                <p class="text-gray-900">
                                                    <i class="fas fa-phone text-gray-400 mr-2"></i>{{ $usuario->telefono }}
                                                </p>
                                            @endif
                                            @if($usuario->documento)
                                                <p class="text-gray-600 text-xs mt-1">
                                                    <i class="fas fa-id-card text-gray-400 mr-2"></i>{{ $usuario->documento }}
                                                </p>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($usuario->estado == 'activo')
                                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">
                                                <i class="fas fa-check-circle mr-1"></i>Activo
                                            </span>
                                        @elseif($usuario->estado == 'pendiente')
                                            <span class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-xs font-bold">
                                                <i class="fas fa-clock mr-1"></i>Pendiente
                                            </span>
                                        @else
                                            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold">
                                                <i class="fas fa-times-circle mr-1"></i>Inactivo
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        <i class="fas fa-calendar mr-2"></i>{{ $usuario->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            @if($usuario->estado == 'pendiente')
                                                <form method="POST" action="{{ route('admin.usuarios.aprobar', $usuario->id) }}" class="inline">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-lg text-sm transition"
                                                            title="Aprobar"
                                                            onclick="return confirm('¿Aprobar usuario?')">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('admin.usuarios.rechazar', $usuario->id) }}" class="inline">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-sm transition"
                                                            title="Rechazar"
                                                            onclick="return confirm('¿Rechazar usuario?')">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            @elseif($usuario->estado == 'activo')
                                                <form method="POST" action="{{ route('admin.usuarios.rechazar', $usuario->id) }}" class="inline">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-2 rounded-lg text-sm transition"
                                                            title="Desactivar"
                                                            onclick="return confirm('¿Desactivar usuario?')">
                                                        <i class="fas fa-ban"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form method="POST" action="{{ route('admin.usuarios.aprobar', $usuario->id) }}" class="inline">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-lg text-sm transition"
                                                            title="Activar"
                                                            onclick="return confirm('¿Activar usuario?')">
                                                        <i class="fas fa-check-circle"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $usuarios->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-users text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">No hay usuarios</h3>
                    <p class="text-gray-600">No se encontraron usuarios con los filtros seleccionados</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection