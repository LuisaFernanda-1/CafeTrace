@extends('layouts.app')

@section('title', 'Mis Ventas')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-green-600 to-emerald-700 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('caficultor.dashboard') }}" class="bg-white/20 p-2 rounded-lg hover:bg-white/30 transition">
                        <i class="fas fa-arrow-left text-xl"></i>
                    </a>
                    <div>
                        <h1 class="text-xl font-bold">Mis Ventas</h1>
                        <p class="text-sm text-green-100">{{ auth()->user()->name }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-green-700 hover:bg-green-900 px-4 py-2 rounded-lg transition">
                        <i class="fas fa-sign-out-alt mr-2"></i> Salir
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                <i class="fas fa-dollar-sign text-green-600 mr-2"></i>
                Historial de Ventas
            </h2>
            <p class="text-gray-600 mt-1">Total: {{ $ventas->total() }} transacciones</p>
        </div>

        <!-- Estadísticas Rápidas -->
        @if($ventas->count() > 0)
            <div class="grid md:grid-cols-4 gap-6 mb-6">
                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl shadow-lg p-6 border border-green-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-green-700 font-medium">Total Vendido</p>
                            <p class="text-3xl font-bold text-green-800 mt-1">
                                {{ number_format($ventas->sum('cantidad_kg'), 0) }} kg
                            </p>
                        </div>
                        <div class="bg-green-500 p-3 rounded-xl">
                            <i class="fas fa-weight text-2xl text-white"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl shadow-lg p-6 border border-blue-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-blue-700 font-medium">Ingresos Totales</p>
                            <p class="text-3xl font-bold text-blue-800 mt-1">
                                ${{ number_format($ventas->sum('precio_total'), 0) }}
                            </p>
                        </div>
                        <div class="bg-blue-500 p-3 rounded-xl">
                            <i class="fas fa-dollar-sign text-2xl text-white"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-amber-50 to-amber-100 rounded-xl shadow-lg p-6 border border-amber-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-amber-700 font-medium">Comisiones</p>
                            <p class="text-3xl font-bold text-amber-800 mt-1">
                                ${{ number_format($ventas->sum('comision_plataforma'), 0) }}
                            </p>
                        </div>
                        <div class="bg-amber-500 p-3 rounded-xl">
                            <i class="fas fa-percent text-2xl text-white"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl shadow-lg p-6 border border-purple-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-purple-700 font-medium">Total Neto</p>
                            <p class="text-3xl font-bold text-purple-800 mt-1">
                                ${{ number_format($ventas->sum('total_caficultor'), 0) }}
                            </p>
                        </div>
                        <div class="bg-purple-500 p-3 rounded-xl">
                            <i class="fas fa-wallet text-2xl text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($ventas->count() > 0)
            <div class="space-y-4 mb-6">
                @foreach($ventas as $venta)
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">{{ $venta->codigo_transaccion }}</h3>
                                <p class="text-sm text-gray-500">{{ $venta->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <span class="px-4 py-2 rounded-full text-sm font-bold
                                {{ $venta->estado === 'pendiente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $venta->estado === 'confirmada' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $venta->estado === 'en_proceso' ? 'bg-purple-100 text-purple-800' : '' }}
                                {{ $venta->estado === 'completada' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $venta->estado === 'cancelada' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ ucfirst($venta->estado) }}
                            </span>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Info del Lote -->
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-2">Producto Vendido</h4>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="font-bold text-gray-900">{{ $venta->lote->variedad }}</p>
                                    <p class="text-sm text-gray-600">{{ $venta->lote->codigo_lote }}</p>
                                    <p class="text-sm text-gray-500 mt-2">
                                        <i class="fas fa-weight-hanging text-green-600 mr-1"></i>
                                        {{ number_format($venta->cantidad_kg, 2) }} kg
                                    </p>
                                </div>
                            </div>

                            <!-- Info del Comprador -->
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-2">Comprador</h4>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="font-bold text-gray-900">{{ $venta->comprador->name }}</p>
                                    @if($venta->comprador->telefono)
                                        <p class="text-sm text-gray-600">
                                            <i class="fas fa-phone text-green-600 mr-1"></i>
                                            {{ $venta->comprador->telefono }}
                                        </p>
                                    @endif
                                    @if($venta->comprador->email)
                                        <p class="text-sm text-gray-600">
                                            <i class="fas fa-envelope text-blue-600 mr-1"></i>
                                            {{ $venta->comprador->email }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Detalles Financieros -->
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <div class="grid md:grid-cols-5 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Precio por kg</p>
                                    <p class="font-bold text-gray-900">${{ number_format($venta->precio_por_kg, 0) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Cantidad</p>
                                    <p class="font-bold text-gray-900">{{ number_format($venta->cantidad_kg, 2) }} kg</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Subtotal</p>
                                    <p class="font-bold text-gray-900">${{ number_format($venta->precio_total, 0) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Comisión (5%)</p>
                                    <p class="font-bold text-red-600">-${{ number_format($venta->comision_plataforma, 0) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Tu Ingreso</p>
                                    <p class="font-bold text-green-600 text-lg">${{ number_format($venta->total_caficultor, 0) }}</p>
                                </div>
                            </div>
                        </div>

                        @if($venta->notas_comprador)
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <p class="text-sm text-gray-500 mb-1">Notas del comprador:</p>
                                <p class="text-sm text-gray-700">{{ $venta->notas_comprador }}</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Paginación -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                {{ $ventas->links() }}
            </div>
        @else
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <i class="fas fa-dollar-sign text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Aún no has realizado ventas</h3>
                <p class="text-gray-600 mb-6">Tus lotes están disponibles en el marketplace para que los compradores los encuentren</p>
                <a href="{{ route('caficultor.dashboard') }}" 
                   class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-bold transition">
                    <i class="fas fa-home mr-2"></i> Ir al Dashboard
                </a>
            </div>
        @endif
    </div>
</div>
@endsection