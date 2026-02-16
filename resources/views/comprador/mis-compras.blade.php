@extends('layouts.app')

@section('title', 'Mis Compras')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-amber-600 to-orange-700 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('comprador.dashboard') }}" class="bg-white/20 p-2 rounded-lg hover:bg-white/30 transition">
                        <i class="fas fa-arrow-left text-xl"></i>
                    </a>
                    <div>
                        <h1 class="text-xl font-bold">Mis Compras</h1>
                        <p class="text-sm text-amber-100">{{ auth()->user()->name }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-amber-700 hover:bg-amber-900 px-4 py-2 rounded-lg transition">
                        <i class="fas fa-sign-out-alt mr-2"></i> Salir
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <!-- Mensajes -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
        @endif

        <!-- Header -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                <i class="fas fa-shopping-bag text-amber-600 mr-2"></i>
                Historial de Compras
            </h2>
            <p class="text-gray-600 mt-1">Total: {{ $compras->total() }} transacciones</p>
        </div>

        @if($compras->count() > 0)
            <div class="space-y-4 mb-6">
                @foreach($compras as $compra)
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">{{ $compra->codigo_transaccion }}</h3>
                                <p class="text-sm text-gray-500">{{ $compra->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <span class="px-4 py-2 rounded-full text-sm font-bold
                                {{ $compra->estado === 'pendiente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $compra->estado === 'confirmada' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $compra->estado === 'en_proceso' ? 'bg-purple-100 text-purple-800' : '' }}
                                {{ $compra->estado === 'completada' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $compra->estado === 'cancelada' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ ucfirst($compra->estado) }}
                            </span>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Info del Lote -->
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-2">Producto</h4>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="font-bold text-gray-900">{{ $compra->lote->variedad }}</p>
                                    <p class="text-sm text-gray-600">{{ $compra->lote->codigo_lote }}</p>
                                    <p class="text-sm text-gray-500 mt-2">
                                        <i class="fas fa-weight-hanging text-amber-600 mr-1"></i>
                                        {{ number_format($compra->cantidad_kg, 2) }} kg
                                    </p>
                                </div>
                            </div>

                            <!-- Info del Caficultor -->
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-2">Vendedor</h4>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="font-bold text-gray-900">{{ $compra->caficultor->name }}</p>
                                    @if($compra->caficultor->telefono)
                                        <p class="text-sm text-gray-600">
                                            <i class="fas fa-phone text-green-600 mr-1"></i>
                                            {{ $compra->caficultor->telefono }}
                                        </p>
                                    @endif
                                    @if($compra->caficultor->email)
                                        <p class="text-sm text-gray-600">
                                            <i class="fas fa-envelope text-blue-600 mr-1"></i>
                                            {{ $compra->caficultor->email }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Detalles de Pago -->
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <div class="grid md:grid-cols-4 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Precio por kg</p>
                                    <p class="font-bold text-gray-900">${{ number_format($compra->precio_por_kg, 0) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Cantidad</p>
                                    <p class="font-bold text-gray-900">{{ number_format($compra->cantidad_kg, 2) }} kg</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Comisión</p>
                                    <p class="font-bold text-gray-900">${{ number_format($compra->comision_plataforma, 0) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Total Pagado</p>
                                    <p class="font-bold text-green-600 text-lg">${{ number_format($compra->precio_total, 0) }}</p>
                                </div>
                            </div>
                        </div>

                        @if($compra->notas_comprador)
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <p class="text-sm text-gray-500 mb-1">Notas:</p>
                                <p class="text-sm text-gray-700">{{ $compra->notas_comprador }}</p>
                            </div>
                        @endif>
                    </div>
                @endforeach
            </div>

            <!-- Paginación -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                {{ $compras->links() }}
            </div>
        @else
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <i class="fas fa-shopping-bag text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Aún no has realizado compras</h3>
                <p class="text-gray-600 mb-6">Explora el marketplace y encuentra el café perfecto</p>
                <a href="{{ route('comprador.marketplace') }}" 
                   class="inline-flex items-center bg-amber-600 hover:bg-amber-700 text-white px-6 py-3 rounded-lg font-bold transition">
                    <i class="fas fa-store mr-2"></i> Ir al Marketplace
                </a>
            </div>
        @endif
    </div>
</div>
@endsection