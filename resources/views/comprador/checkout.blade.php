@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-amber-600 to-orange-700 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('comprador.carrito') }}" class="bg-white/20 p-2 rounded-lg hover:bg-white/30 transition">
                        <i class="fas fa-arrow-left text-xl"></i>
                    </a>
                    <div>
                        <h1 class="text-xl font-bold">Checkout</h1>
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
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            </div>
        @endif

        <!-- Progress Steps -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <div class="flex items-center justify-center">
                <div class="flex items-center">
                    <div class="flex items-center text-green-600">
                        <div class="rounded-full h-10 w-10 bg-green-600 text-white flex items-center justify-center font-bold">
                            <i class="fas fa-check"></i>
                        </div>
                        <span class="ml-2 font-semibold">Carrito</span>
                    </div>
                    <div class="w-20 h-1 bg-green-600 mx-2"></div>
                    <div class="flex items-center text-green-600">
                        <div class="rounded-full h-10 w-10 bg-green-600 text-white flex items-center justify-center font-bold">
                            2
                        </div>
                        <span class="ml-2 font-semibold">Checkout</span>
                    </div>
                    <div class="w-20 h-1 bg-gray-300 mx-2"></div>
                    <div class="flex items-center text-gray-400">
                        <div class="rounded-full h-10 w-10 bg-gray-300 flex items-center justify-center font-bold">
                            3
                        </div>
                        <span class="ml-2 font-semibold">Confirmación</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Formulario -->
            <div class="lg:col-span-2">
                <form method="POST" action="{{ route('comprador.confirmar-compra') }}">
                    @csrf
                    
                    <!-- Información de Contacto -->
                    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">
                            <i class="fas fa-user text-amber-600 mr-2"></i>
                            Información de Contacto
                        </h2>

                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                                <input type="text" value="{{ auth()->user()->name }}" readonly 
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" value="{{ auth()->user()->email }}" readonly 
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                                <input type="text" value="{{ auth()->user()->telefono }}" readonly 
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Documento</label>
                                <input type="text" value="{{ auth()->user()->documento }}" readonly 
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50">
                            </div>
                        </div>
                    </div>

                    <!-- Productos -->
                    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">
                            <i class="fas fa-box text-amber-600 mr-2"></i>
                            Productos a Comprar
                        </h2>

                        <div class="space-y-4">
                            @foreach($items as $item)
                                <div class="flex gap-4 p-4 border border-gray-200 rounded-lg">
                                    <div class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0">
                                        @if($item->lote->imagenes->first())
                                            <img src="{{ asset('storage/' . $item->lote->imagenes->first()->ruta_imagen) }}" 
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-amber-400 to-orange-600 flex items-center justify-center">
                                                <i class="fas fa-coffee text-2xl text-white"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex-1">
                                        <h3 class="font-bold text-gray-900">{{ $item->lote->variedad }}</h3>
                                        <p class="text-sm text-gray-600">{{ $item->lote->codigo_lote }}</p>
                                        <p class="text-xs text-gray-500">
                                            <i class="fas fa-user mr-1"></i>{{ $item->lote->caficultor->name }}
                                        </p>
                                        <div class="flex items-center gap-4 mt-2">
                                            <span class="text-sm text-gray-600">
                                                {{ number_format($item->cantidad_kg, 2) }} kg × ${{ number_format($item->lote->precio_por_kg, 0) }}
                                            </span>
                                            <span class="font-bold text-amber-600">
                                                ${{ number_format($item->subtotal, 0) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Notas -->
                    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">
                            <i class="fas fa-comment text-amber-600 mr-2"></i>
                            Notas Adicionales (Opcional)
                        </h2>
                        <textarea name="notas" rows="4" 
                                  placeholder="Agrega cualquier comentario o instrucción especial para los caficultores..."
                                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-amber-500 focus:border-transparent"></textarea>
                    </div>

                    <!-- Botones -->
                    <div class="flex gap-4">
                        <a href="{{ route('comprador.carrito') }}" 
                           class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 rounded-lg font-bold transition text-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Volver al Carrito
                        </a>
                        <button type="submit" 
                                class="flex-1 bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-bold transition">
                            <i class="fas fa-check-circle mr-2"></i>
                            Confirmar Compra
                        </button>
                    </div>
                </form>
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
                            <span>${{ number_format($subtotal, 0) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Total Items:</span>
                            <span>{{ $items->count() }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Total kg:</span>
                            <span>{{ number_format($items->sum('cantidad_kg'), 2) }} kg</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-500">
                            <span>Comisión plataforma (5%):</span>
                            <span>${{ number_format($comision, 0) }}</span>
                        </div>
                        <div class="border-t border-gray-200 pt-3">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-gray-800">Total a Pagar:</span>
                                <span class="text-2xl font-bold text-green-600">
                                    ${{ number_format($total, 0) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-lg p-4">
                        <h4 class="font-bold text-gray-800 mb-2 text-sm">
                            <i class="fas fa-shield-alt text-green-600 mr-2"></i>
                            Compra Protegida
                        </h4>
                        <ul class="text-xs text-gray-600 space-y-1">
                            <li><i class="fas fa-check text-green-500 mr-1"></i> Trazabilidad 100% verificada</li>
                            <li><i class="fas fa-check text-green-500 mr-1"></i> Información auténtica</li>
                            <li><i class="fas fa-check text-green-500 mr-1"></i> Productos de calidad</li>
                            <li><i class="fas fa-check text-green-500 mr-1"></i> Soporte incluido</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection