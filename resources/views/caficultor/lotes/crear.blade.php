@extends('layouts.app')

@section('title', 'Registrar Nuevo Lote')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Navbar Simple -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('caficultor.dashboard') }}" class="flex items-center text-gray-700 hover:text-green-600 transition">
                    <i class="fas fa-arrow-left mr-3"></i>
                    <span class="font-semibold">Volver al Dashboard</span>
                </a>
                <div class="flex items-center space-x-3">
                    <i class="fas fa-seedling text-2xl text-green-600"></i>
                    <span class="font-bold text-gray-800">Registrar Nuevo Lote</span>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8 max-w-4xl">
        
        <!-- Progress Bar -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between mb-4">
                <span class="text-sm font-semibold text-gray-600">Progreso del registro</span>
                <span id="progress-percentage" class="text-sm font-bold text-green-600">0%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                <div id="progress-bar" class="bg-gradient-to-r from-green-500 to-emerald-600 h-full transition-all duration-300" style="width: 0%"></div>
            </div>
        </div>

        <!-- Formulario -->
        <form method="POST" action="{{ route('caficultor.lotes.guardar') }}" enctype="multipart/form-data" id="form-lote">
            @csrf

            <!-- Sección 1: Información Básica -->
            <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 mb-6">
                <div class="flex items-center mb-6">
                    <div class="bg-green-100 p-3 rounded-xl mr-4">
                        <i class="fas fa-info-circle text-2xl text-green-600"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">Información Básica</h3>
                        <p class="text-gray-600">Datos principales del lote de café</p>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Peso -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="peso_kg">
                            <i class="fas fa-weight-hanging text-green-600 mr-2"></i> Peso Total (kg) *
                        </label>
                        <input 
                            type="number" 
                            id="peso_kg" 
                            name="peso_kg" 
                            value="{{ old('peso_kg') }}"
                            required 
                            step="0.01"
                            min="1"
                            class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            placeholder="Ej: 50">
                        @error('peso_kg')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Variedad -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="variedad">
                            <i class="fas fa-leaf text-green-600 mr-2"></i> Variedad *
                        </label>
                        <select 
                            id="variedad" 
                            name="variedad" 
                            required
                            class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="">Selecciona una variedad</option>
                            <option value="Caturra" {{ old('variedad') == 'Caturra' ? 'selected' : '' }}>Caturra</option>
                            <option value="Castillo" {{ old('variedad') == 'Castillo' ? 'selected' : '' }}>Castillo</option>
                            <option value="Colombia" {{ old('variedad') == 'Colombia' ? 'selected' : '' }}>Colombia</option>
                            <option value="Típica" {{ old('variedad') == 'Típica' ? 'selected' : '' }}>Típica</option>
                            <option value="Borbón" {{ old('variedad') == 'Borbón' ? 'selected' : '' }}>Borbón</option>
                            <option value="Geisha" {{ old('variedad') == 'Geisha' ? 'selected' : '' }}>Geisha</option>
                            <option value="Tabi" {{ old('variedad') == 'Tabi' ? 'selected' : '' }}>Tabi</option>
                            <option value="Otra">Otra</option>
                        </select>
                        @error('variedad')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Altura -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="altura_msnm">
                            <i class="fas fa-mountain text-green-600 mr-2"></i> Altura (msnm) *
                        </label>
                        <input 
                            type="number" 
                            id="altura_msnm" 
                            name="altura_msnm" 
                            value="{{ old('altura_msnm') }}"
                            required 
                            min="800"
                            max="2500"
                            class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            placeholder="Ej: 1850">
                        @error('altura_msnm')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fecha de Cosecha -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="fecha_cosecha">
                            <i class="fas fa-calendar text-green-600 mr-2"></i> Fecha de Cosecha *
                        </label>
                        <input 
                            type="date" 
                            id="fecha_cosecha" 
                            name="fecha_cosecha" 
                            value="{{ old('fecha_cosecha') }}"
                            required 
                            max="{{ date('Y-m-d') }}"
                            class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        @error('fecha_cosecha')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Precio -->
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 font-semibold mb-2" for="precio_por_kg">
                            <i class="fas fa-dollar-sign text-green-600 mr-2"></i> Precio por Kilogramo (COP) *
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-3.5 text-gray-500">$</span>
                            <input 
                                type="number" 
                                id="precio_por_kg" 
                                name="precio_por_kg" 
                                value="{{ old('precio_por_kg') }}"
                                required 
                                min="1000"
                                step="100"
                                class="form-input w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                placeholder="18000">
                        </div>
                        <p class="text-sm text-gray-500 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>
                            Precio sugerido: $15,000 - $25,000 según calidad
                        </p>
                        @error('precio_por_kg')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
<!-- Sección 2: Proceso de Producción -->
            <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 mb-6">
                <div class="flex items-center mb-6">
                    <div class="bg-blue-100 p-3 rounded-xl mr-4">
                        <i class="fas fa-cogs text-2xl text-blue-600"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">Proceso de Producción</h3>
                        <p class="text-gray-600">Fechas del proceso (opcional)</p>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="fecha_despulpado">
                            <i class="fas fa-calendar-day text-blue-600 mr-2"></i> Despulpado
                        </label>
                        <input 
                            type="date" 
                            id="fecha_despulpado" 
                            name="fecha_despulpado" 
                            value="{{ old('fecha_despulpado') }}"
                            class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="fecha_fermentacion">
                            <i class="fas fa-calendar-day text-blue-600 mr-2"></i> Fermentación
                        </label>
                        <input 
                            type="date" 
                            id="fecha_fermentacion" 
                            name="fecha_fermentacion" 
                            value="{{ old('fecha_fermentacion') }}"
                            class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="fecha_lavado">
                            <i class="fas fa-calendar-day text-blue-600 mr-2"></i> Lavado
                        </label>
                        <input 
                            type="date" 
                            id="fecha_lavado" 
                            name="fecha_lavado" 
                            value="{{ old('fecha_lavado') }}"
                            class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="fecha_secado">
                            <i class="fas fa-calendar-day text-blue-600 mr-2"></i> Secado
                        </label>
                        <input 
                            type="date" 
                            id="fecha_secado" 
                            name="fecha_secado" 
                            value="{{ old('fecha_secado') }}"
                            class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
            </div>

            <!-- Sección 3: Certificaciones -->
            <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 mb-6">
                <div class="flex items-center mb-6">
                    <div class="bg-amber-100 p-3 rounded-xl mr-4">
                        <i class="fas fa-certificate text-2xl text-amber-600"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">Certificaciones y Calidad</h3>
                        <p class="text-gray-600">Selecciona las certificaciones que aplican</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-green-50 transition">
                        <input 
                            type="checkbox" 
                            name="es_organico" 
                            value="1"
                            {{ old('es_organico') ? 'checked' : '' }}
                            class="w-5 h-5 text-green-600 rounded focus:ring-green-500">
                        <div class="ml-4 flex-1">
                            <div class="flex items-center">
                                <i class="fas fa-leaf text-green-600 mr-2"></i>
                                <span class="font-semibold text-gray-800">Café Orgánico</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">Cultivado sin químicos ni pesticidas</p>
                        </div>
                    </label>

                    <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-blue-50 transition">
                        <input 
                            type="checkbox" 
                            name="comercio_justo" 
                            value="1"
                            {{ old('comercio_justo') ? 'checked' : '' }}
                            class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500">
                        <div class="ml-4 flex-1">
                            <div class="flex items-center">
                                <i class="fas fa-handshake text-blue-600 mr-2"></i>
                                <span class="font-semibold text-gray-800">Comercio Justo</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">Prácticas justas y sostenibles</p>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Sección 4: Descripción -->
            <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 mb-6">
                <div class="flex items-center mb-6">
                    <div class="bg-purple-100 p-3 rounded-xl mr-4">
                        <i class="fas fa-file-alt text-2xl text-purple-600"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">Descripción del Lote</h3>
                        <p class="text-gray-600">Cuéntale a los compradores sobre tu café</p>
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2" for="descripcion">
                        <i class="fas fa-align-left text-purple-600 mr-2"></i> Descripción
                    </label>
                    <textarea 
                        id="descripcion" 
                        name="descripcion" 
                        rows="5"
                        maxlength="1000"
                        class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                        placeholder="Describe las características especiales de tu café, notas de sabor, proceso especial, etc.">{{ old('descripcion') }}</textarea>
                    <div class="flex justify-between items-center mt-2">
                        <p class="text-sm text-gray-500">
                            <i class="fas fa-info-circle mr-1"></i>
                            Máximo 1000 caracteres
                        </p>
                        <span id="char-count" class="text-sm text-gray-500">0 / 1000</span>
                    </div>
                    @error('descripcion')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Sección 5: Imágenes -->
            <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 mb-6">
                <div class="flex items-center mb-6">
                    <div class="bg-pink-100 p-3 rounded-xl mr-4">
                        <i class="fas fa-images text-2xl text-pink-600"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">Fotografías</h3>
                        <p class="text-gray-600">Sube hasta 8 fotos del proceso (máx 5MB c/u)</p>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-green-500 transition cursor-pointer" id="drop-zone">
                        <input 
                            type="file" 
                            id="imagenes" 
                            name="imagenes[]" 
                            accept="image/jpeg,image/jpg,image/png"
                            multiple
                            class="hidden"
                            onchange="handleFileSelect(event)">
                        
                        <label for="imagenes" class="cursor-pointer">
                            <div class="mb-4">
                                <i class="fas fa-cloud-upload-alt text-6xl text-gray-400"></i>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-700 mb-2">
                                Arrastra imágenes aquí o haz click para seleccionar
                            </h4>
                            <p class="text-sm text-gray-500">
                                PNG, JPG hasta 5MB cada una. Máximo 8 imágenes.
                            </p>
                        </label>
                    </div>
                </div>

                <!-- Preview de imágenes -->
                <div id="image-preview" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6 hidden">
                    <!-- Las imágenes se cargarán aquí dinámicamente -->
                </div>

                <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <p class="text-sm text-blue-800">
                        <i class="fas fa-info-circle mr-2"></i>
                        <strong>Recomendación:</strong> Sube fotos del cultivo, cosecha, despulpado, fermentación, lavado y secado para dar mayor transparencia.
                    </p>
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('caficultor.dashboard') }}" 
                   class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-4 px-6 rounded-xl text-center transition">
                    <i class="fas fa-times mr-2"></i> Cancelar
                </a>
                <button 
                    type="submit" 
                    class="flex-1 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white font-bold py-4 px-6 rounded-xl shadow-lg transition transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i> Registrar Lote
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

// Barra de progreso
const formInputs = document.querySelectorAll('#form-lote input[required], #form-lote select[required]');
const progressBar = document.getElementById('progress-bar');
const progressPercentage = document.getElementById('progress-percentage');

function updateProgress() {
    let filled = 0;
    formInputs.forEach(input => {
        if (input.type === 'checkbox') {
            // Los checkboxes no son requeridos, no contar
        } else if (input.value.trim() !== '') {
            filled++;
        }
    });
    
    const percentage = Math.round((filled / formInputs.length) * 100);
    progressBar.style.width = percentage + '%';
    progressPercentage.textContent = percentage + '%';
}

formInputs.forEach(input => {
    input.addEventListener('input', updateProgress);
    input.addEventListener('change', updateProgress);
});

// Manejo de imágenes
let selectedFiles = [];
const maxFiles = 8;

function handleFileSelect(event) {
    const files = Array.from(event.target.files);
    
    if (files.length + selectedFiles.length > maxFiles) {
        alert(`Solo puedes subir máximo ${maxFiles} imágenes`);
        return;
    }
    
    files.forEach(file => {
        if (file.size > 5 * 1024 * 1024) {
            alert(`La imagen ${file.name} excede el tamaño máximo de 5MB`);
            return;
        }
        
        selectedFiles.push(file);
    });
    
    displayImages();
}

function displayImages() {
    const preview = document.getElementById('image-preview');
    preview.innerHTML = '';
    
    if (selectedFiles.length > 0) {
        preview.classList.remove('hidden');
    } else {
        preview.classList.add('hidden');
        return;
    }
    
    selectedFiles.forEach((file, index) => {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'relative group';
            div.innerHTML = `
                <img src="${e.target.result}" class="w-full h-32 object-cover rounded-lg border-2 border-gray-300">
                <button 
                    type="button" 
                    onclick="removeImage(${index})"
                    class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                    <i class="fas fa-times"></i>
                </button>
                <div class="mt-2">
                    <select name="tipos_imagenes[]" class="w-full text-xs border border-gray-300 rounded px-2 py-1">
                        <option value="cultivo">Cultivo</option>
                        <option value="cosecha">Cosecha</option>
                        <option value="despulpado">Despulpado</option>
                        <option value="fermentacion">Fermentación</option>
                        <option value="lavado">Lavado</option>
                        <option value="secado">Secado</option>
                        <option value="general">General</option>
                    </select>
                </div>
            `;
            preview.appendChild(div);
        };
        
        reader.readAsDataURL(file);
    });
    
    updateFileInput();
}

function removeImage(index) {
    selectedFiles.splice(index, 1);
    displayImages();
}

function updateFileInput() {
    const dataTransfer = new DataTransfer();
    selectedFiles.forEach(file => {
        dataTransfer.items.add(file);
    });
    document.getElementById('imagenes').files = dataTransfer.files;
}

// Drag and drop
const dropZone = document.getElementById('drop-zone');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    dropZone.addEventListener(eventName, highlight, false);
});

['dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, unhighlight, false);
});

function highlight(e) {
    dropZone.classList.add('border-green-500', 'bg-green-50');
}

function unhighlight(e) {
    dropZone.classList.remove('border-green-500', 'bg-green-50');
}

dropZone.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    
    document.getElementById('imagenes').files = files;
    handleFileSelect({ target: { files: files } });
}
</script>
@endsection