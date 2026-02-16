@extends('layouts.app')

@section('title', 'Mis Lotes de Café')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-green-600 to-emerald-700 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('caficultor.dashboard') }}" class="hover:text-green-200 transition">
                        <i class="fas fa-arrow-left mr-2"></i> Dashboard
                    </a>
                    <div class="border-l border-green-400 pl-4">
                        <h1 class="text-xl font-bold">Mis Lotes de Café</h1>
                    </div>
                </div>
                
                <a href="{{ route('caficultor.lotes.crear') }}" 
                   class="bg-white text-green-600 hover:bg-green-50 px-4 py-2 rounded-lg font-bold transition">
                    <i class="fas fa-plus mr-2"></i> Nuevo Lote
                </a>
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

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 flex items-center">
                <i class="fas fa-exclamation-circle mr-3 text-xl"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Lista de Lotes -->
        @if($lotes->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($lotes as $lote)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition group">
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
                        <div class="p-5">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-semibold text-gray-500 uppercase">
                                    {{ $lote->codigo_lote }}
                                </span>
                                @if($lote->es_organico)
                                    <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">
                                        <i class="fas fa-leaf mr-1"></i> Orgánico
                                    </span>
                                @endif
                            </div>

                            <h4 class="text-xl font-bold text-gray-900 mb-3">
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

                            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                <div>
                                    <p class="text-xs text-gray-500">Precio por kg</p>
                                    <p class="text-xl font-bold text-green-600">
                                        ${{ number_format($lote->precio_por_kg, 0) }}
                                    </p>
                                </div>
                                <a href="{{ route('caficultor.lotes.ver', $lote->id) }}" 
                                   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition text-sm font-semibold">
                                    Ver Detalles
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginación -->
            <div class="mt-8">
                {{ $lotes->links() }}
            </div>
        @else
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-4">
                    <i class="fas fa-coffee text-5xl text-gray-400"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-700 mb-2">No hay lotes registrados</h3>
                <p class="text-gray-500 mb-6">Comienza registrando tu primer lote de café</p>
                <a href="{{ route('caficultor.lotes.crear') }}" 
                   class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-bold transition">
                    <i class="fas fa-plus mr-2"></i> Registrar Primer Lote
                </a>
            </div>
        @endif

    </div>
</div>
@endsection