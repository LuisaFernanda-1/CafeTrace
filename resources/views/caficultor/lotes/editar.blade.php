@extends('layouts.app')

@section('title', 'Editar Lote - ' . $lote->codigo_lote)

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('caficultor.lotes.ver', $lote->id) }}" class="flex items-center text-gray-700 hover:text-green-600 transition">
                    <i class="fas fa-arrow-left mr-3"></i>
                    <span class="font-semibold">Volver al Lote</span>
                </a>
                <div class="flex items-center space-x-3">
                    <i class="fas fa-edit text-2xl text-green-600"></i>
                    <span class="font-bold text-gray-800">Editar Lote</span>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8 max-w-3xl">
        
        <!-- Info del Lote -->
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-green-100 mb-1">Código del Lote</p>
                    <h2 class="text-2xl font-bold">{{ $lote->codigo_lote }}</h2>
                </div>
                <div class="text-right">
                    <p class="text-sm text-green-100 mb-1">Variedad</p>
                    <h3 class="text-xl font-bold">{{ $lote->variedad }}</h3>
                </div>
            </div>
        </div>

        <!-- Formulario -->
        <form method="POST" action="{{ route('caficultor.lotes.actualizar', $lote->id) }}">
            @csrf
            @method('PUT')

            <!-- Mensajes -->
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Información No Editable -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-lock text-gray-400 mr-3"></i>
                    Información No Modificable
                </h3>
                <p class="text-sm text-gray-600 mb-4">Los siguientes datos no pueden ser modificados después del registro inicial</p>

                <div class="grid md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-xs text-gray-500 mb-1">Peso Total</p>
                        <p class="text-lg font-bold text-gray-900">{{ number_format($lote->peso_kg, 2) }} kg</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-xs text-gray-500 mb-1">Variedad</p>
                        <p class="text-lg font-bold text-gray-900">{{ $lote->variedad }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-xs text-gray-500 mb-1">Altura</p>
                        <p class="text-lg font-bold text-gray-900">{{ number_format($lote->altura_msnm, 0) }} msnm</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-xs text-gray-500 mb-1">Fecha de Cosecha</p>
                        <p class="text-lg font-bold text-gray-900">{{ $lote->fecha_cosecha->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Campos Editables -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-edit text-green-600 mr-3"></i>
                    Información Editable
                </h3>

                <!-- Descripción -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="descripcion">
                        <i class="fas fa-align-left text-green-600 mr-2"></i> Descripción
                    </label>
                    <textarea 
                        id="descripcion" 
                        name="descripcion" 
                        rows="5"
                        maxlength="1000"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        placeholder="Describe las características especiales de tu café...">{{ old('descripcion', $lote->descripcion) }}</textarea>
                    <div class="flex justify-between items-center mt-2">
                        <p class="text-sm text-gray-500">Máximo 1000 caracteres</p>
                        <span id="char-count" class="text-sm text-gray-500">
                            {{ strlen($lote->descripcion ?? '') }} / 1000
                        </span>
                    </div>
                </div>

                <!-- Precio -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="precio_por_kg">
                        <i class="fas fa-dollar-sign text-green-600 mr-2"></i> Precio por Kilogramo (COP) *
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-gray-500">$</span>
                        <input 
                            type="number" 
                            id="precio_por_kg" 
                            name="precio_por_kg" 
                            value="{{ old('precio_por_kg', $lote->precio_por_kg) }}"
                            required 
                            min="1000"
                            step="100"
                            class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            placeholder="18000">
                    </div>
                    <p class="text-sm text-gray-500 mt-1">
                        <i class="fas fa-info-circle mr-1"></i>
                        Precio actual: ${{ number_format($lote->precio_por_kg, 0) }}
                    </p>
                </div>

                <!-- Estado -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="estado">
                        <i class="fas fa-info-circle text-green-600 mr-2"></i> Estado del Lote *
                    </label>
                    <select 
                        id="estado" 
                        name="estado" 
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <option value="disponible" {{ $lote->estado === 'disponible' ? 'selected' : '' }}>Disponible</option>
                        <option value="reservado" {{ $lote->estado === 'reservado' ? 'selected' : '' }}>Reservado</option>
                        <option value="en_proceso" {{ $lote->estado === 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                        <option value="vendido" {{ $lote->estado === 'vendido' ? 'selected' : '' }}>Vendido</option>
                    </select>
                    <p class="text-sm text-gray-500 mt-1">
                        Estado actual: <span class="font-semibold">{{ ucfirst($lote->estado) }}</span>
                    </p>
                </div>
            </div>

            <!-- Botones -->
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('caficultor.lotes.ver', $lote->id) }}" 
                   class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-4 px-6 rounded-xl text-center transition">
                    <i class="fas fa-times mr-2"></i> Cancelar
                </a>
                <button 
                    type="submit" 
                    class="flex-1 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white font-bold py-4 px-6 rounded-xl shadow-lg transition transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i> Guardar Cambios
                </button>
            </div>
        </form>

    </div>
</div>

<script>
// Contador de caracteres
const descripcionTextarea = document.getElementById('descripcion');
const charCount = document.getElementById('char-count');

if (descripcionTextarea && charCount) {
    descripcionTextarea.addEventListener('input', function() {
        const length = this.value.length;
        charCount.textContent = length + ' / 1000';
        
        if (length > 900) {
            charCount.classList.add('text-red-500');
            charCount.classList.remove('text-gray-500');
        } else {
            charCount.classList.remove('text-red-500');
            charCount.classList.add('text-gray-500');
        }
    });
}
</script>
@endsection