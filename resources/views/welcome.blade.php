@extends('layouts.app')

@section('title', 'CaféTrace - Plataforma de Trazabilidad del Café Colombiano')

@section('content')
<div class="min-h-screen">
    
    <!-- Navbar Profesional -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="bg-gradient-to-br from-amber-600 to-orange-600 p-2 rounded-lg">
                        <i class="fas fa-coffee text-3xl text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold bg-gradient-to-r from-amber-700 to-orange-600 bg-clip-text text-transparent">
                            CaféTrace
                        </h1>
                        <p class="text-xs text-gray-500 hidden sm:block">Trazabilidad Blockchain</p>
                    </div>
                </div>

                <!-- Menu Desktop -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="#inicio" class="text-gray-700 hover:text-amber-600 transition font-medium">Inicio</a>
                    <a href="#como-funciona" class="text-gray-700 hover:text-amber-600 transition font-medium">¿Cómo funciona?</a>
                    <a href="#beneficios" class="text-gray-700 hover:text-amber-600 transition font-medium">Beneficios</a>
                    <a href="#roles" class="text-gray-700 hover:text-amber-600 transition font-medium">Ingresar</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section Moderno -->
    <section id="inicio" class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white overflow-hidden">
        <!-- Patrón de fondo -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')"></div>
        </div>

        <div class="container mx-auto px-4 lg:px-8 py-20 lg:py-32 relative">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                
                <!-- Contenido -->
                <div class="text-center lg:text-left">
                    <div class="inline-flex items-center bg-amber-600/20 border border-amber-600/30 rounded-full px-4 py-2 mb-6">
                        <span class="w-2 h-2 bg-amber-500 rounded-full mr-2 animate-pulse"></span>
                        <span class="text-amber-400 text-sm font-medium">Tecnología Blockchain</span>
                    </div>
                    
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                        Del Campo a tu Taza
                        <span class="block bg-gradient-to-r from-amber-400 to-orange-500 bg-clip-text text-transparent">
                            Con Total Transparencia
                        </span>
                    </h1>
                    
                    <p class="text-lg md:text-xl text-slate-300 mb-8 max-w-2xl mx-auto lg:mx-0">
                        La primera plataforma en Colombia que conecta directamente caficultores con compradores, 
                        eliminando intermediarios y garantizando precios justos con tecnología blockchain.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="#roles" class="bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white px-8 py-4 rounded-lg font-bold shadow-lg shadow-amber-600/30 transition transform hover:scale-105">
                            <i class="fas fa-rocket mr-2"></i> Comenzar Ahora
                        </a>
                        <a href="#como-funciona" class="bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white px-8 py-4 rounded-lg font-bold border border-white/20 transition">
                            <i class="fas fa-play-circle mr-2"></i> Ver Cómo Funciona
                        </a>
                    </div>

                    <!-- Estadísticas -->
                    <div class="grid grid-cols-3 gap-6 mt-12 pt-8 border-t border-white/10">
                        <div>
                            <div class="text-3xl md:text-4xl font-bold text-amber-400">+175%</div>
                            <div class="text-sm text-slate-400 mt-1">Más Ingresos</div>
                        </div>
                        <div>
                            <div class="text-3xl md:text-4xl font-bold text-green-400">100%</div>
                            <div class="text-sm text-slate-400 mt-1">Trazable</div>
                        </div>
                        <div>
                            <div class="text-3xl md:text-4xl font-bold text-blue-400">0</div>
                            <div class="text-sm text-slate-400 mt-1">Intermediarios</div>
                        </div>
                    </div>
                </div>

                <!-- Ilustración -->
                <div class="hidden lg:block">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-amber-600 to-orange-600 rounded-3xl blur-3xl opacity-20"></div>
                        <div class="relative bg-gradient-to-br from-slate-800 to-slate-900 rounded-3xl p-8 border border-white/10">
                            <div class="text-center space-y-6">
                                <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-amber-600 to-orange-600 rounded-2xl">
                                    <i class="fas fa-seedling text-5xl text-white"></i>
                                </div>
                                <div class="h-1 bg-gradient-to-r from-amber-600 to-orange-600 rounded-full w-2/3 mx-auto"></div>
                                <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-green-600 to-emerald-600 rounded-2xl">
                                    <i class="fas fa-link text-5xl text-white"></i>
                                </div>
                                <div class="h-1 bg-gradient-to-r from-green-600 to-emerald-600 rounded-full w-2/3 mx-auto"></div>
                                <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-blue-600 to-cyan-600 rounded-2xl">
                                    <i class="fas fa-coffee text-5xl text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Wave Separator -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 80C1200 80 1320 70 1380 65L1440 60V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="#f9fafb"/>
            </svg>
        </div>
    </section>

    <!-- Cómo Funciona -->
    <section id="como-funciona" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-4">
                    ¿Cómo Funciona?
                </h2>
                <p class="text-xl text-slate-600 max-w-3xl mx-auto">
                    Un proceso simple y transparente que beneficia a todos
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Paso 1 -->
                <div class="relative">
                    <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition h-full">
                        <div class="absolute -top-6 left-8">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                                1
                            </div>
                        </div>
                        <div class="mt-8">
                            <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6">
                                <i class="fas fa-seedling text-3xl text-green-600"></i>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-3">Caficultor Registra</h3>
                            <p class="text-slate-600">
                                El caficultor registra su lote de café con fotos, ubicación, variedad y proceso completo en la plataforma.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Paso 2 -->
                <div class="relative">
                    <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition h-full">
                        <div class="absolute -top-6 left-8">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                                2
                            </div>
                        </div>
                        <div class="mt-8">
                            <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6">
                                <i class="fas fa-qrcode text-3xl text-blue-600"></i>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-3">Blockchain Verifica</h3>
                            <p class="text-slate-600">
                                La información se registra en blockchain creando un historial inmutable y se genera un código QR único.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Paso 3 -->
                <div class="relative">
                    <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition h-full">
                        <div class="absolute -top-6 left-8">
                            <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                                3
                            </div>
                        </div>
                        <div class="mt-8">
                            <div class="w-16 h-16 bg-amber-100 rounded-2xl flex items-center justify-center mb-6">
                                <i class="fas fa-handshake text-3xl text-amber-600"></i>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-3">Venta Directa</h3>
                            <p class="text-slate-600">
                                Compradores encuentran el café, verifican su origen y compran directamente sin intermediarios.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Beneficios -->
    <section id="beneficios" class="py-20 bg-white">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-4">
                    Beneficios para Todos
                </h2>
                <p class="text-xl text-slate-600 max-w-3xl mx-auto">
                    Una plataforma que revoluciona la industria del café en Colombia
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-8 max-w-6xl mx-auto">
                <!-- Para Caficultores -->
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-8 border border-green-200">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-green-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-seedling text-2xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900">Para Caficultores</h3>
                    </div>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-600 mt-1 mr-3"></i>
                            <span class="text-slate-700"><strong>+175% más ingresos:</strong> Elimina intermediarios que se quedan con el 70% del valor</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-600 mt-1 mr-3"></i>
                            <span class="text-slate-700"><strong>Acceso a mercados:</strong> Vende directamente a cafeterías y tostadores premium</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-600 mt-1 mr-3"></i>
                            <span class="text-slate-700"><strong>Reconocimiento:</strong> Tu nombre y finca visibles para el consumidor final</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-600 mt-1 mr-3"></i>
                            <span class="text-slate-700"><strong>Pagos justos:</strong> Transferencias directas sin retrasos ni descuentos injustos</span>
                        </li>
                    </ul>
                </div>

                <!-- Para Compradores -->
                <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl p-8 border border-amber-200">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-amber-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-shopping-cart text-2xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900">Para Compradores</h3>
                    </div>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-amber-600 mt-1 mr-3"></i>
                            <span class="text-slate-700"><strong>100% trazable:</strong> Conoce el origen exacto, variedad y proceso de cada grano</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-amber-600 mt-1 mr-3"></i>
                            <span class="text-slate-700"><strong>Calidad garantizada:</strong> Accede a cafés especiales directamente de la fuente</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-amber-600 mt-1 mr-3"></i>
                            <span class="text-slate-700"><strong>Historia verificable:</strong> Comparte la historia real del café con tus clientes</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-amber-600 mt-1 mr-3"></i>
                            <span class="text-slate-700"><strong>Impacto social:</strong> Apoya directamente a familias caficultoras colombianas</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Roles / Call to Action -->
    <section id="roles" class="py-20 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white relative overflow-hidden">
        <!-- Patrón de fondo -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')"></div>
        </div>

        <div class="container mx-auto px-4 lg:px-8 relative">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">
                    Únete a CaféTrace Hoy
                </h2>
                <p class="text-xl text-slate-300 max-w-3xl mx-auto">
                    Elige tu perfil y comienza a transformar la industria del café en Colombia
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                
                <!-- Card Administrador -->
                <div class="group bg-white/5 backdrop-blur-sm rounded-2xl overflow-hidden border border-white/10 hover:border-blue-500/50 transition-all duration-300 hover:transform hover:scale-105">
                    <div class="bg-gradient-to-br from-blue-600 to-blue-700 p-8 text-center relative overflow-hidden">
                        <div class="absolute inset-0 bg-blue-500 opacity-0 group-hover:opacity-20 transition-opacity"></div>
                        <i class="fas fa-user-shield text-6xl mb-4 relative"></i>
                        <h3 class="text-2xl font-bold relative">Administrador</h3>
                    </div>
                    <div class="p-8">
                        <p class="text-slate-300 mb-6 text-center">
                            Gestiona la plataforma, aprueba usuarios y supervisa operaciones.
                        </p>
                        <a href="{{ route('login.form', 'administrador') }}" 
                           class="block w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white text-center font-bold py-3 px-6 rounded-lg transition transform hover:scale-105 shadow-lg">
                            <i class="fas fa-sign-in-alt mr-2"></i> Ingresar
                        </a>
                    </div>
                </div>

                <!-- Card Caficultor -->
                <div class="group bg-white/5 backdrop-blur-sm rounded-2xl overflow-hidden border border-white/10 hover:border-green-500/50 transition-all duration-300 hover:transform hover:scale-105">
                    <div class="bg-gradient-to-br from-green-600 to-emerald-700 p-8 text-center relative overflow-hidden">
                        <div class="absolute inset-0 bg-green-500 opacity-0 group-hover:opacity-20 transition-opacity"></div>
                        <i class="fas fa-seedling text-6xl mb-4 relative"></i>
                        <h3 class="text-2xl font-bold relative">Caficultor</h3>
                    </div>
                    <div class="p-8">
                        <p class="text-slate-300 mb-6 text-center">
                            Registra tus lotes y vende directamente sin intermediarios.
                        </p>
                        <div class="space-y-2">
                            <a href="{{ route('login.form', 'caficultor') }}" 
                               class="block w-full bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white text-center font-bold py-3 px-6 rounded-lg transition transform hover:scale-105 shadow-lg">
                                <i class="fas fa-sign-in-alt mr-2"></i> Ingresar
                            </a>
                            <a href="{{ route('register.form', 'caficultor') }}" 
                               class="block w-full bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white text-center font-bold py-3 px-6 rounded-lg border border-white/20 transition">
                                <i class="fas fa-user-plus mr-2"></i> Registrarse
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card Comprador -->
                <div class="group bg-white/5 backdrop-blur-sm rounded-2xl overflow-hidden border border-white/10 hover:border-amber-500/50 transition-all duration-300 hover:transform hover:scale-105">
                    <div class="bg-gradient-to-br from-amber-600 to-orange-700 p-8 text-center relative overflow-hidden">
                        <div class="absolute inset-0 bg-amber-500 opacity-0 group-hover:opacity-20 transition-opacity"></div>
                        <i class="fas fa-shopping-cart text-6xl mb-4 relative"></i>
                        <h3 class="text-2xl font-bold relative">Comprador</h3>
                    </div>
                    <div class="p-8">
                        <p class="text-slate-300 mb-6 text-center">
                            Encuentra café de alta calidad con total transparencia.
                        </p>
                        <div class="space-y-2">
                            <a href="{{ route('login.form', 'comprador') }}" 
                               class="block w-full bg-gradient-to-r from-amber-600 to-orange-700 hover:from-amber-700 hover:to-orange-800 text-white text-center font-bold py-3 px-6 rounded-lg transition transform hover:scale-105 shadow-lg">
                                <i class="fas fa-sign-in-alt mr-2"></i> Ingresar
                            </a>
                            <a href="{{ route('register.form', 'comprador') }}" 
                               class="block w-full bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white text-center font-bold py-3 px-6 rounded-lg border border-white/20 transition">
                                <i class="fas fa-user-plus mr-2"></i> Registrarse
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer Profesional -->
    <footer class="bg-slate-900 text-slate-300 py-12 border-t border-slate-800">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <!-- Logo y Descripción -->
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-gradient-to-br from-amber-600 to-orange-600 p-2 rounded-lg">
                            <i class="fas fa-coffee text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white">CaféTrace</h3>
                    </div>
                    <p class="text-slate-400 mb-4 max-w-md">
                        La plataforma de trazabilidad blockchain que conecta caficultores colombianos 
                        con compradores de café specialty en todo el mundo.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-slate-800 hover:bg-amber-600 rounded-lg flex items-center justify-center transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-slate-800 hover:bg-amber-600 rounded-lg flex items-center justify-center transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-slate-800 hover:bg-amber-600 rounded-lg flex items-center justify-center transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-slate-800 hover:bg-amber-600 rounded-lg flex items-center justify-center transition">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>

                <!-- Enlaces Rápidos -->
                <div>
                    <h4 class="text-white font-bold mb-4">Plataforma</h4>
                    <ul class="space-y-2">
                        <li><a href="#como-funciona" class="hover:text-amber-500 transition">¿Cómo Funciona?</a></li>
                        <li><a href="#beneficios" class="hover:text-amber-500 transition">Beneficios</a></li>
                        <li><a href="#roles" class="hover:text-amber-500 transition">Registrarse</a></li>
                        <li><a href="#" class="hover:text-amber-500 transition">Preguntas Frecuentes</a></li>
                    </ul>
                </div>

                <!-- Contacto -->
                <div>
                    <h4 class="text-white font-bold mb-4">Contacto</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2 text-amber-500"></i>
                            <span>info@cafetrace.com</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-2 text-amber-500"></i>
                            <span>+57 300 123 4567</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-amber-500"></i>
                            <span>Bogotá, Colombia</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-slate-800 pt-8 text-center">
                <p class="text-slate-400">
                    &copy; {{ date('Y') }} CaféTrace. Todos los derechos reservados. 
                    <span class="text-amber-500">Devolviendo el valor al campo colombiano.</span>
                </p>
            </div>
        </div>
    </footer>

</div>
@endsection