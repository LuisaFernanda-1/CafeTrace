@extends('layouts.app')

@section('title', 'Iniciar Sesión - ' . ucfirst($role))

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 flex items-center justify-center px-4 py-12 relative overflow-hidden">
    
    <!-- Patrón de fondo animado -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')"></div>
    </div>

    <!-- Elementos decorativos flotantes -->
    <div class="absolute top-20 left-10 w-72 h-72 bg-amber-600 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob"></div>
    <div class="absolute top-40 right-10 w-72 h-72 bg-orange-600 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-20 left-40 w-72 h-72 bg-amber-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-4000"></div>

    <div class="w-full max-w-md relative z-10">
        
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
                    'administrador' => [
                        'gradient' => 'from-blue-500 via-blue-600 to-blue-700',
                        'icon' => 'fa-user-shield',
                        'iconBg' => 'bg-blue-400/20',
                        'accentColor' => 'blue'
                    ],
                    'caficultor' => [
                        'gradient' => 'from-green-500 via-emerald-600 to-green-700',
                        'icon' => 'fa-seedling',
                        'iconBg' => 'bg-green-400/20',
                        'accentColor' => 'green'
                    ],
                    'comprador' => [
                        'gradient' => 'from-amber-500 via-orange-600 to-orange-700',
                        'icon' => 'fa-shopping-cart',
                        'iconBg' => 'bg-amber-400/20',
                        'accentColor' => 'amber'
                    ]
                ];
                $cfg = $config[$role];
            @endphp

            <!-- Header con efecto de vidrio -->
            <div class="relative bg-gradient-to-br {{ $cfg['gradient'] }} p-8 text-white overflow-hidden">
                <!-- Patrón decorativo -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'40\' height=\'40\' viewBox=\'0 0 40 40\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\' fill-rule=\'evenodd\'%3E%3Cpath d=\'M0 40L40 0H20L0 20M40 40V20L20 40\'/%3E%3C/g%3E%3C/svg%3E')"></div>
                </div>
                
                <div class="relative text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 {{ $cfg['iconBg'] }} backdrop-blur-sm rounded-2xl mb-4 border border-white/20">
                        <i class="fas {{ $cfg['icon'] }} text-4xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold mb-2">Bienvenido de nuevo</h2>
                    <p class="text-white/80">Ingresa como <span class="font-semibold">{{ ucfirst($role) }}</span></p>
                </div>
            </div>

            <!-- Formulario -->
            <div class="p-8">
                
                <!-- Mensajes de error/éxito -->
                @if($errors->any())
                    <div class="bg-red-500/10 border border-red-500/50 backdrop-blur-sm text-red-200 px-4 py-3 rounded-xl mb-6">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-circle mt-0.5 mr-3"></i>
                            <div class="flex-1">
                                @foreach($errors->all() as $error)
                                    <p class="text-sm">{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('success'))
                    <div class="bg-green-500/10 border border-green-500/50 backdrop-blur-sm text-green-200 px-4 py-3 rounded-xl mb-6">
                        <div class="flex items-start">
                            <i class="fas fa-check-circle mt-0.5 mr-3"></i>
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="role" value="{{ $role }}">

                    <!-- Email -->
                    <div class="space-y-2">
                        <label class="block text-white/90 font-medium text-sm" for="email">
                            <i class="fas fa-envelope mr-2 text-{{ $cfg['accentColor'] }}-400"></i> 
                            Correo Electrónico
                        </label>
                        <div class="relative">
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                required 
                                class="w-full px-4 py-3.5 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-{{ $cfg['accentColor'] }}-500 focus:border-transparent backdrop-blur-sm transition"
                                placeholder="tu@ejemplo.com"
                                autocomplete="email">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                <i class="fas fa-at text-white/30"></i>
                            </div>
                        </div>
                    </div>

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
                                class="w-full px-4 py-3.5 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-{{ $cfg['accentColor'] }}-500 focus:border-transparent backdrop-blur-sm transition"
                                placeholder="••••••••"
                                autocomplete="current-password">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                <i class="fas fa-key text-white/30"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center text-white/80 cursor-pointer group">
                            <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded border-white/20 bg-white/10 text-{{ $cfg['accentColor'] }}-500 focus:ring-{{ $cfg['accentColor'] }}-500 focus:ring-offset-0 transition">
                            <span class="ml-2 group-hover:text-white transition">Recordarme</span>
                        </label>
                        <a href="#" class="text-{{ $cfg['accentColor'] }}-400 hover:text-{{ $cfg['accentColor'] }}-300 transition">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>

                    <!-- Botón Submit -->
                    <button type="submit" class="group relative w-full bg-gradient-to-r {{ $cfg['gradient'] }} hover:shadow-lg hover:shadow-{{ $cfg['accentColor'] }}-500/50 text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 transform hover:scale-[1.02] overflow-hidden">
                        <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                        <span class="relative flex items-center justify-center">
                            <i class="fas fa-sign-in-alt mr-2"></i> 
                            Iniciar Sesión
                        </span>
                    </button>

                    <!-- Link de registro -->
                    @if($role !== 'administrador')
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-white/10"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-4 bg-transparent text-white/60">o</span>
                            </div>
                        </div>

                        <div class="text-center">
                            <p class="text-white/70 mb-3">¿No tienes cuenta?</p>
                            <a href="{{ route('register.form', $role) }}" 
                               class="inline-flex items-center justify-center w-full bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white font-semibold py-3.5 px-6 rounded-xl border border-white/20 transition-all duration-300 group">
                                <i class="fas fa-user-plus mr-2 group-hover:scale-110 transition-transform"></i> 
                                Crear Cuenta Nueva
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <!-- Info adicional -->
        <div class="mt-6 text-center">
            <p class="text-white/50 text-sm">
                <i class="fas fa-shield-alt mr-2"></i>
                Conexión segura con encriptación SSL
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
@endsection