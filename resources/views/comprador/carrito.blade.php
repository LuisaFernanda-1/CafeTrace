@extends('layouts.app')

@section('title', 'Mi Carrito')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-amber-600 to-orange-700 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('comprador.marketplace') }}" class="bg-white/20 p-2 rounded-lg hover:bg-white/30 transition">
                        <i class="fas fa-arrow-left text-xl"></i>
                    </a>
                    <div>
                        <h1 class="text-xl font-bold">Mi Carrito de Compras</h1>
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

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            </div>
        @endif

        @if($items->count() > 0)
            <div class="grid lg:grid-cols-3 gap-6">
                <!-- Items del carrito -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">
                            <i class="fas fa-shopping-cart text-amber-600 mr-2"></i>
                            Productos en tu carrito ({{ $items->count() }})
                        </h2>

                        @foreach($items as $item)
                            <div class="border-b border-gray-200 pb-4 mb-4 last:border-0">
                                <div class="flex gap-4">
                                    <!-- Imagen -->
                                    <div class="w-24 h-24 rounded-lg overflow-hidden flex-shrink-0">
                                        @if($item->lote->imagenes->first())
                                            <img src="{{ asset('storage/' . $item->lote->imagenes->first()->ruta_imagen) }}" 
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-amber-400 to-orange-600 flex items-center justify-center">
                                                <i class="fas fa-coffee text-3xl text-white"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Info -->
                                    <div class="flex-1">
                                        <div class="flex justify-between items-start mb-2">
                                            <div>
                                                <h3 class="font-bold text-gray-900">{{ $item->lote->variedad }}</h3>
                                                <p class="text-sm text-gray-600">{{ $item->lote->codigo_lote }}</p>
                                                <p class="text-xs text-gray-500">
                                                    <i class="fas fa-user mr-1"></i>{{ $item->lote->caficultor->name }}
                                                </p>
                                            </div>
                                            <form method="POST" action="{{ route('comprador.carrito.eliminar', $item->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>

                                        <!-- Cantidad -->
                                        <div class="flex items-center gap-4">
                                            <form method="POST" action="{{ route('comprador.carrito.actualizar', $item->id) }}" class="flex items-center gap-2">
                                                @csrf
                                                @method('PUT')
                                                <label class="text-sm text-gray-600">Cantidad:</label>
                                                <input type="number" 
                                                       name="cantidad_kg" 
                                                       value="{{ $item->cantidad_kg }}" 
                                                       min="1" 
                                                       max="{{ $item->lote->peso_disponible }}"
                                                       step="0.01"
                                                       class="w-20 border border-gray-300 rounded px-2 py-1 text-sm">
                                                <span class="text-sm text-gray-600">kg</span>
                                                <button type="submit" class="text-blue-600 hover:text-blue-700 text-sm">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                            </form>
                                        </div>

                                        <!-- Precio -->
                                        <div class="mt-2 flex justify-between items-center">
                                            <span class="text-sm text-gray-600">
                                                ${{ number_format($item->lote->precio_por_kg, 0) }} / kg
                                            </span>
                                            <span class="text-lg font-bold text-amber-600">
                                                ${{ number_format($item->subtotal, 0) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Resumen -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-lg p-6 sticky top-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">
                            Resumen de Compra
                        </h3>

                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal:</span>
                                <span>${{ number_format($total, 0) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Total kg:</span>
                                <span>{{ number_format($items->sum('cantidad_kg'), 2) }} kg</span>
                            </div>
                            <div class="border-t border-gray-200 pt-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold text-gray-800">Total:</span>
                                    <span class="text-2xl font-bold text-amber-600">
                                        ${{ number_format($total, 0) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('comprador.checkout') }}" 
                           class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-bold transition shadow-lg block text-center">
                            <i class="fas fa-check mr-2"></i>
                            Proceder al Checkout
                        </a>

                        <a href="{{ route('comprador.marketplace') }}" 
                           class="w-full bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 rounded-lg font-bold transition mt-3 block text-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Seguir Comprando
                        </a>
                    </div>
                </div>
            </div>
        @else
            <!-- Carrito vacío -->
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <i class="fas fa-shopping-cart text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Tu carrito está vacío</h3>
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