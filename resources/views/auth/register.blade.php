@extends('layouts.app')

@section('title', 'Crear Cuenta - ' . ucfirst($role))

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 flex items-center justify-center px-4 py-12 relative overflow-hidden">
    
    <!-- Patrón de fondo animado -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')"></div>
    </div>

    <!-- Elementos decorativos flotantes -->
    <div class="absolute top-20 left-10 w-72 h-72 bg-green-600 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob"></div>
    <div class="absolute top-40 right-10 w-72 h-72 bg-amber-600 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-20 left-40 w-72 h-72 bg-emerald-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-4000"></div>

    <div class="w-full max-w-4xl relative z-10">
        
        <!-- Botón Volver -->
        <a href="{{ route('home') }}" class="inline-flex items-center text-white/80 hover:text-white mb-8 transition group">
            <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center mr-3 group-hover:bg-white/20 transition">
                <i class="fas fa-arrow-left text-sm"></i>
            </div>
            <span class="font-medium">Volver al inicio</span>
        </a>

        <!-- Card Principal -->
        <div class="bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20">
            
            @php
                $config = [
                    'caficultor' => [
                        'gradient' => 'from-green-500 via-emerald-600 to-green-700',
                        'icon' => 'fa-seedling',
                        'iconBg' => 'bg-green-400/20',
                        'accentColor' => 'green',
                        'title' => 'Únete como Caficultor',
                        'subtitle' => 'Registra tu finca y comienza a vender directamente'
                    ],
                    'comprador' => [
                        'gradient' => 'from-amber-500 via-orange-600 to-orange-700',
                        'icon' => 'fa-shopping-cart',
                        'iconBg' => 'bg-amber-400/20',
                        'accentColor' => 'amber',
                        'title' => 'Únete como Comprador',
                        'subtitle' => 'Encuentra café de alta calidad con total transparencia'
                    ]
                ];
                $cfg = $config[$role];
            @endphp

            <!-- Header -->
            <div class="relative bg-gradient-to-br {{ $cfg['gradient'] }} p-8 md:p-10 text-white overflow-hidden">
                <!-- Patrón decorativo -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'40\' height=\'40\' viewBox=\'0 0 40 40\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\' fill-rule=\'evenodd\'%3E%3Cpath d=\'M0 40L40 0H20L0 20M40 40V20L20 40\'/%3E%3C/g%3E%3C/svg%3E')"></div>
                </div>
                
                <div class="relative text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 {{ $cfg['iconBg'] }} backdrop-blur-sm rounded-2xl mb-4 border border-white/20">
                        <i class="fas {{ $cfg['icon'] }} text-4xl"></i>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-2">{{ $cfg['title'] }}</h2>
                    <p class="text-white/80 max-w-2xl mx-auto">{{ $cfg['subtitle'] }}</p>
                </div>
            </div>

            <!-- Formulario -->
            <div class="p-6 md:p-10">
                
                <!-- Mensajes de error -->
                @if($errors->any())
                    <div class="bg-red-500/10 border border-red-500/50 backdrop-blur-sm text-red-200 px-4 py-3 rounded-xl mb-6">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-circle mt-0.5 mr-3"></i>
                            <div class="flex-1 text-sm space-y-1">
                                @foreach($errors->all() as $error)
                                    <p>• {{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="role" value="{{ $role }}">

                    <!-- Indicador de progreso -->
                    <div class="bg-white/5 rounded-xl p-4 mb-6">
                        <div class="flex items-center justify-between text-sm text-white/60 mb-2">
                            <span>Completa tu perfil</span>
                            <span id="progress-text">0%</span>
                        </div>
                        <div class="w-full bg-white/10 rounded-full h-2 overflow-hidden">
                            <div id="progress-bar" class="bg-gradient-to-r {{ $cfg['gradient'] }} h-full transition-all duration-300" style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- Información Personal -->
                    <div class="space-y-4">
                        <h3 class="text-white font-semibold text-lg flex items-center">
                            <div class="w-8 h-8 rounded-lg bg-{{ $cfg['accentColor'] }}-500/20 flex items-center justify-center mr-3">
                                <i class="fas fa-user text-{{ $cfg['accentColor'] }}-400 text-sm"></i>
                            </div>
                            Información Personal
                        </h3>
                        
                        <div class="grid md:grid-cols-2 gap-4">
                            <!-- Nombre -->
                            <div class="space-y-2">
                                <label class="block text-white/90 font-medium text-sm" for="name">
                                    <i class="fas fa-user mr-2 text-{{ $cfg['accentColor'] }}-400"></i> 
                                    Nombre Completo
                                </label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    value="{{ old('name') }}" 
                                    required 
                                    class="register-input w-full px-4 py-3.5 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-{{ $cfg['accentColor'] }}-500 focus:border-transparent backdrop-blur-sm transition"
                                    placeholder="Juan Pérez García"
                                    autocomplete="name">
                            </div>

                            <!-- Documento -->
                            <div class="space-y-2">
                                <label class="block text-white/90 font-medium text-sm" for="documento">
                                    <i class="fas fa-id-card mr-2 text-{{ $cfg['accentColor'] }}-400"></i> 
                                    Documento de Identidad
                                </label>
                                <input 
                                    type="text" 
                                    id="documento" 
                                    name="documento" 
                                    value="{{ old('documento') }}" 
                                    required 
                                    class="register-input w-full px-4 py-3.5 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-{{ $cfg['accentColor'] }}-500 focus:border-transparent backdrop-blur-sm transition"
                                    placeholder="1234567890">
                            </div>
                        </div>
                    </div>

                    <!-- Información de Contacto -->
                    <div class="space-y-4">
                        <h3 class="text-white font-semibold text-lg flex items-center">
                            <div class="w-8 h-8 rounded-lg bg-{{ $cfg['accentColor'] }}-500/20 flex items-center justify-center mr-3">
                                <i class="fas fa-envelope text-{{ $cfg['accentColor'] }}-400 text-sm"></i>
                            </div>
                            Información de Contacto
                        </h3>
                        
                        <div class="grid md:grid-cols-2 gap-4">
                            <!-- Email -->
                            <div class="space-y-2">
                                <label class="block text-white/90 font-medium text-sm" for="email">
                                    <i class="fas fa-envelope mr-2 text-{{ $cfg['accentColor'] }}-400"></i> 
                                    Correo Electrónico
                                </label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required 
                                    class="register-input w-full px-4 py-3.5 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-{{ $cfg['accentColor'] }}-500 focus:border-transparent backdrop-blur-sm transition"
                                    placeholder="correo@ejemplo.com"
                                    autocomplete="email">
                            </div>

                            <!-- Teléfono -->
                            <div class="space-y-2">
                                <label class="block text-white/90 font-medium text-sm" for="telefono">
                                    <i class="fas fa-phone mr-2 text-{{ $cfg['accentColor'] }}-400"></i> 
                                    Teléfono
                                </label>
                                <input 
                                    type="tel" 
                                    id="telefono" 
                                    name="telefono" 
                                    value="{{ old('telefono') }}" 
                                    required 
                                    class="register-input w-full px-4 py-3.5 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-{{ $cfg['accentColor'] }}-500 focus:border-transparent backdrop-blur-sm transition"
                                    placeholder="300 123 4567"
                                    autocomplete="tel">
                            </div>
                        </div>
                    </div>

                    <!-- Seguridad -->
                    <div class="space-y-4">
                        <h3 class="text-white font-semibold text-lg flex items-center">
                            <div class="w-8 h-8 rounded-lg bg-{{ $cfg['accentColor'] }}-500/20 flex items-center justify-center mr-3">
                                <i class="fas fa-lock text-{{ $cfg['accentColor'] }}-400 text-sm"></i>
                            </div>
                            Seguridad de la Cuenta
                        </h3>
                        
                        <div class="grid md:grid-cols-2 gap-4">
                            <!-- Contraseña -->
                            <div class="space-y-2">
                                <label class="block text-white/90 font-medium text-sm" for="password">
                                    <i class="fas fa-lock mr-2 text-{{ $cfg['accentColor'] }}-400"></i> 
                                    Contraseña
                                </label>
                                <div class="relative">
                                    <input 
                                        type="password" 
                                        id="password" 
                                        name="password" 
                                        required 
                                        class="register-input w-full px-4 py-3.5 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-{{ $cfg['accentColor'] }}-500 focus:border-transparent backdrop-blur-sm transition"
                                        placeholder="Mínimo 8 caracteres"
                                        autocomplete="new-password">
                                    <button type="button" onclick="togglePassword('password')" class="absolute inset-y-0 right-0 flex items-center pr-4 text-white/40 hover:text-white/60">
                                        <i class="fas fa-eye" id="password-icon"></i>
                                    </button>
                                </div>
                                <div class="flex items-center space-x-2 text-xs">
                                    <div id="strength-bar" class="flex-1 h-1 bg-white/10 rounded-full overflow-hidden">
                                        <div id="strength-fill" class="h-full transition-all duration-300" style="width: 0%"></div>
                                    </div>
                                    <span id="strength-text" class="text-white/50">Débil</span>
                                </div>
                            </div>

                            <!-- Confirmar Contraseña -->
                            <div class="space-y-2">
                                <label class="block text-white/90 font-medium text-sm" for="password_confirmation">
                                    <i class="fas fa-check-circle mr-2 text-{{ $cfg['accentColor'] }}-400"></i> 
                                    Confirmar Contraseña
                                </label>
                                <div class="relative">
                                    <input 
                                        type="password" 
                                        id="password_confirmation" 
                                        name="password_confirmation" 
                                        required 
                                        class="register-input w-full px-4 py-3.5 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-{{ $cfg['accentColor'] }}-500 focus:border-transparent backdrop-blur-sm transition"
                                        placeholder="Repite la contraseña"
                                        autocomplete="new-password">
                                    <button type="button" onclick="togglePassword('password_confirmation')" class="absolute inset-y-0 right-0 flex items-center pr-4 text-white/40 hover:text-white/60">
                                        <i class="fas fa-eye" id="password_confirmation-icon"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Términos y Condiciones -->
                    <div class="bg-white/5 rounded-xl p-4">
                        <label class="flex items-start cursor-pointer group">
                            <input type="checkbox" required class="mt-1 w-4 h-4 rounded border-white/20 bg-white/10 text-{{ $cfg['accentColor'] }}-500 focus:ring-{{ $cfg['accentColor'] }}-500 focus:ring-offset-0 transition">
                            <span class="ml-3 text-sm text-white/70 group-hover:text-white/90 transition">
                                Acepto los <a href="#" class="text-{{ $cfg['accentColor'] }}-400 hover:text-{{ $cfg['accentColor'] }}-300 underline">términos y condiciones</a> y la <a href="#" class="text-{{ $cfg['accentColor'] }}-400 hover:text-{{ $cfg['accentColor'] }}-300 underline">política de privacidad</a> de CaféTrace
                            </span>
                        </label>
                    </div>

                    <!-- Botón Submit -->
                    <button type="submit" class="group relative w-full bg-gradient-to-r {{ $cfg['gradient'] }} hover:shadow-lg hover:shadow-{{ $cfg['accentColor'] }}-500/50 text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 transform hover:scale-[1.02] overflow-hidden">
                        <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                        <span class="relative flex items-center justify-center">
                            <i class="fas fa-user-plus mr-2"></i> 
                            Crear Mi Cuenta
                        </span>
                    </button>

                    <!-- Ya tienes cuenta -->
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-white/10"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-transparent text-white/60">¿Ya tienes cuenta?</span>
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('login.form', $role) }}" 
                           class="inline-flex items-center justify-center w-full bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white font-semibold py-3.5 px-6 rounded-xl border border-white/20 transition-all duration-300 group">
                            <i class="fas fa-sign-in-alt mr-2 group-hover:scale-110 transition-transform"></i> 
                            Iniciar Sesión
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Info adicional -->
        <div class="mt-6 text-center space-y-2">
            <p class="text-white/50 text-sm">
                <i class="fas fa-shield-alt mr-2"></i>
                Todos tus datos están protegidos con encriptación de nivel bancario
            </p>
            <p class="text-white/40 text-xs">
                Tu cuenta estará pendiente de aprobación por un administrador
            </p>
        </div>
    </div>
</div>

<style>
    @keyframes blob {
        0%, 100% { transform: translate(0, 0) scale(1); }
        25% { transform: translate(20px, -50px) scale(1.1); }
        50% { transform: translate(-20px, 20px) scale(0.9); }
        75% { transform: translate(50px, 50px) scale(1.05); }
    }
    .animate-blob { animation: blob 7s infinite; }
    .animation-delay-2000 { animation-delay: 2s; }
    .animation-delay-4000 { animation-delay: 4s; }
</style>

<script>
// Barra de progreso del formulario
const inputs = document.querySelectorAll('.register-input');
const progressBar = document.getElementById('progress-bar');
const progressText = document.getElementById('progress-text');

inputs.forEach(input => {
    input.addEventListener('input', updateProgress);
});

function updateProgress() {
    const filled = Array.from(inputs).filter(input => input.value.trim() !== '').length;
    const percentage = (filled / inputs.length) * 100;
    progressBar.style.width = percentage + '%';
    progressText.textContent = Math.round(percentage) + '%';
}

// Toggle password visibility
function togglePassword(id) {
    const input = document.getElementById(id);
    const icon = document.getElementById(id + '-icon');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Password strength indicator
const passwordInput = document.getElementById('password');
const strengthFill = document.getElementById('strength-fill');
const strengthText = document.getElementById('strength-text');

passwordInput.addEventListener('input', (e) => {
    const password = e.target.value;
    let strength = 0;
    
    if (password.length >= 8) strength++;
    if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
    if (password.match(/[0-9]/)) strength++;
    if (password.match(/[^a-zA-Z0-9]/)) strength++;
    
    const colors = ['#ef4444', '#f59e0b', '#10b981', '#10b981'];
    const texts = ['Débil', 'Media', 'Fuerte', 'Muy fuerte'];
    const widths = ['25%', '50%', '75%', '100%'];
    
    strengthFill.style.width = widths[strength];
    strengthFill.style.backgroundColor = colors[strength];
    strengthText.textContent = texts[strength];
    strengthText.style.color = colors[strength];
});
</script>
@endsection