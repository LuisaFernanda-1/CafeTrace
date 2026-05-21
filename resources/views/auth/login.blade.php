@extends('layouts.app')

@section('title', 'Iniciar Sesión - ' . ucfirst($role))

@section('content')

@php
$config = [
    'administrador' => [
        'color'    => '#1d4ed8',
        'colorH'   => '#153eb3',
        'colorSoft'=> '#eff6ff',
        'colorText'=> '#1e40af',
        'icon'     => '⚙️',
        'label'    => 'Staff',
        'badgeBg'  => '#dbeafe',
        'badgeText'=> '#1e40af',
        'ring'     => '#93c5fd',
    ],
    'caficultor' => [
        'color'    => '#15803d',
        'colorH'   => '#0f5c2e',
        'colorSoft'=> '#f0fdf4',
        'colorText'=> '#166534',
        'icon'     => '🌱',
        'label'    => 'Productor',
        'badgeBg'  => '#dcfce7',
        'badgeText'=> '#14532d',
        'ring'     => '#86efac',
    ],
    'comprador' => [
        'color'    => '#b45309',
        'colorH'   => '#8b3a06',
        'colorSoft'=> '#fff7ed',
        'colorText'=> '#9a3412',
        'icon'     => '☕',
        'label'    => 'Consumidor',
        'badgeBg'  => '#ffedd5',
        'badgeText'=> '#9a3412',
        'ring'     => '#fdba74',
    ],
];
$c = $config[$role];
@endphp

<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
  background: #fffbf5;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.login-page {
  min-height: 100vh;
  display: grid;
  grid-template-columns: 1fr 1fr;
}

/* ===== PANEL IZQUIERDO ===== */
.login-left {
  background: linear-gradient(160deg, #3b1a08 0%, #6b2f06 50%, #92400e 100%);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: clamp(2rem, 5vw, 3.5rem);
  position: relative;
  overflow: hidden;
}
.login-left::before {
  content: '';
  position: absolute;
  width: 500px;
  height: 500px;
  border-radius: 50%;
  background: rgba(255,255,255,0.04);
  top: -150px;
  right: -150px;
}
.login-left::after {
  content: '';
  position: absolute;
  width: 350px;
  height: 350px;
  border-radius: 50%;
  background: rgba(255,255,255,0.04);
  bottom: -100px;
  left: -80px;
}

.left-top { position: relative; z-index: 1; }

.left-logo {
  display: flex;
  align-items: center;
  gap: 14px;
  margin-bottom: clamp(3rem, 8vw, 6rem);
}
.left-logo-circle {
  width: 52px;
  height: 52px;
  border-radius: 50%;
  overflow: hidden;
  border: 2.5px solid rgba(255,255,255,0.4);
  background: rgba(255,255,255,0.1);
  flex-shrink: 0;
}
.left-logo-circle img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}
.left-logo-text { display: flex; flex-direction: column; line-height: 1.15; }
.left-logo-name {
  font-size: 1.25rem;
  font-weight: 800;
  color: #fff;
  letter-spacing: -0.3px;
}
.left-logo-sub {
  font-size: 0.58rem;
  color: rgba(255,255,255,0.55);
  letter-spacing: 2px;
  text-transform: uppercase;
  font-weight: 600;
}

.left-heading {
  font-size: clamp(1.6rem, 3.5vw, 2.4rem);
  font-weight: 900;
  color: #fff;
  line-height: 1.2;
  margin-bottom: 1rem;
}
.left-heading span { color: #fbbf24; }
.left-desc {
  font-size: clamp(0.85rem, 1.5vw, 0.95rem);
  color: rgba(255,255,255,0.65);
  line-height: 1.7;
  max-width: 340px;
}

.left-stats {
  position: relative;
  z-index: 1;
  display: flex;
  flex-direction: column;
  gap: 12px;
}
.stat-item {
  display: flex;
  align-items: center;
  gap: 12px;
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,255,255,0.12);
  border-radius: 14px;
  padding: 14px 18px;
}
.stat-icon {
  font-size: 1.4rem;
  flex-shrink: 0;
}
.stat-text p {
  font-size: 0.82rem;
  font-weight: 700;
  color: #fff;
  margin-bottom: 2px;
}
.stat-text small {
  font-size: 0.7rem;
  color: rgba(255,255,255,0.5);
}

/* ===== PANEL DERECHO ===== */
.login-right {
  background: #fffbf5;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: clamp(1.5rem, 4vw, 3rem);
  overflow-y: auto;
}
.login-form-wrap {
  width: 100%;
  max-width: 420px;
}

.back-link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  color: #9a7a5e;
  font-size: 0.85rem;
  font-weight: 600;
  text-decoration: none;
  margin-bottom: 2rem;
  transition: color 0.2s;
}
.back-link:hover { color: #6b2f06; }
.back-arrow {
  width: 32px;
  height: 32px;
  border-radius: 10px;
  border: 1.5px solid #ede8e0;
  background: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.85rem;
  transition: background 0.2s;
}
.back-link:hover .back-arrow { background: #f5ede0; }

.form-header { margin-bottom: 2rem; }

.role-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 5px 14px;
  border-radius: 999px;
  font-size: 0.72rem;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
  margin-bottom: 1rem;
}

.form-title {
  font-size: clamp(1.4rem, 3vw, 1.9rem);
  font-weight: 900;
  color: #2d1b0e;
  line-height: 1.2;
  margin-bottom: 0.4rem;
}
.form-subtitle {
  font-size: 0.88rem;
  color: #9a7a5e;
  line-height: 1.6;
}

/* ===== ALERTAS ===== */
.alert {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  padding: 12px 16px;
  border-radius: 12px;
  font-size: 0.85rem;
  margin-bottom: 1.5rem;
  line-height: 1.5;
}
.alert-error {
  background: #fef2f2;
  border: 1px solid #fecaca;
  color: #991b1b;
}
.alert-success {
  background: #f0fdf4;
  border: 1px solid #bbf7d0;
  color: #14532d;
}
.alert-icon { font-size: 1rem; flex-shrink: 0; margin-top: 1px; }

/* ===== FORM FIELDS ===== */
.field { margin-bottom: 1.25rem; }
.field-label {
  display: block;
  font-size: 0.82rem;
  font-weight: 700;
  color: #4a3020;
  margin-bottom: 7px;
  display: flex;
  align-items: center;
  gap: 6px;
}
.field-label-icon { font-size: 0.85rem; }
.field-input {
  width: 100%;
  padding: 12px 44px 12px 14px;
  border: 1.5px solid #ede8e0;
  border-radius: 12px;
  font-size: 0.9rem;
  color: #2d1b0e;
  background: #fff;
  outline: none;
  transition: border-color 0.2s, box-shadow 0.2s;
  -webkit-appearance: none;
}
.field-input::placeholder { color: #c4b09a; }
.field-input:focus {
  border-color: var(--role-color);
  box-shadow: 0 0 0 3px var(--role-ring);
}
.field-wrap {
  position: relative;
}
.field-suffix {
  position: absolute;
  right: 14px;
  top: 50%;
  transform: translateY(-50%);
  color: #c4b09a;
  font-size: 0.85rem;
  pointer-events: none;
}

/* ===== TOGGLE PASSWORD ===== */
.toggle-pw {
  position: absolute;
  right: 14px;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  cursor: pointer;
  color: #c4b09a;
  font-size: 0.85rem;
  padding: 4px;
  transition: color 0.2s;
  pointer-events: all;
}
.toggle-pw:hover { color: #6b2f06; }

/* ===== REMEMBER / FORGOT ===== */
.form-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.5rem;
  flex-wrap: wrap;
  gap: 8px;
}
.remember-label {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 0.83rem;
  color: #7c5a3c;
  cursor: pointer;
}
.remember-label input[type="checkbox"] {
  width: 16px;
  height: 16px;
  accent-color: var(--role-color);
  cursor: pointer;
  border-radius: 4px;
}
.forgot-link {
  font-size: 0.83rem;
  font-weight: 600;
  color: var(--role-color);
  text-decoration: none;
  transition: opacity 0.2s;
}
.forgot-link:hover { opacity: 0.75; }

/* ===== BOTÓN SUBMIT ===== */
.btn-submit {
  width: 100%;
  padding: 14px;
  border: none;
  border-radius: 14px;
  font-size: 0.95rem;
  font-weight: 800;
  color: #fff;
  cursor: pointer;
  transition: transform 0.15s, opacity 0.2s;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  letter-spacing: 0.3px;
  margin-bottom: 1.5rem;
}
.btn-submit:hover   { opacity: 0.9; transform: translateY(-1px); }
.btn-submit:active  { transform: scale(0.98); }

/* ===== DIVIDER ===== */
.divider {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 1.25rem;
}
.divider::before, .divider::after {
  content: '';
  flex: 1;
  height: 1px;
  background: #ede8e0;
}
.divider span {
  font-size: 0.75rem;
  color: #c4b09a;
  font-weight: 600;
}

/* ===== BOTÓN REGISTRO ===== */
.btn-register {
  width: 100%;
  padding: 13px;
  border-radius: 14px;
  border: 1.5px solid #ede8e0;
  background: #fff;
  font-size: 0.88rem;
  font-weight: 700;
  color: #4a3020;
  text-decoration: none;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  transition: background 0.2s, border-color 0.2s;
}
.btn-register:hover {
  background: #faf6f0;
  border-color: #d6c9bb;
}

/* ===== SEGURIDAD ===== */
.security-note {
  margin-top: 1.5rem;
  text-align: center;
  font-size: 0.75rem;
  color: #c4b09a;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
  .login-page { grid-template-columns: 1fr; }
  .login-left  { display: none; }
  .login-right { min-height: 100vh; padding: 1.5rem 1.25rem; align-items: flex-start; }
  .login-form-wrap { max-width: 100%; }
}
</style>

<div class="login-page" style="--role-color: {{ $c['color'] }}; --role-ring: {{ $c['ring'] }}22;">

  {{-- PANEL IZQUIERDO --}}
  <div class="login-left">
    <div class="left-top">
      <div class="left-logo">
        <div class="left-logo-circle">
          <img src="{{ asset('images/logo-cafetrace.png') }}" alt="CaféTrace">
        </div>
        <div class="left-logo-text">
          <span class="left-logo-name">CaféTrace</span>
          <span class="left-logo-sub">Del campesino al consumidor</span>
        </div>
      </div>
      <h1 class="left-heading">
        Bienvenido de<br><span>vuelta</span> al campo
      </h1>
      <p class="left-desc">
        La plataforma que conecta caficultores colombianos con compradores, directamente y sin intermediarios.
      </p>
    </div>
    <div class="left-stats">
      <div class="stat-item">
        <span class="stat-icon">🔗</span>
        <div class="stat-text">
          <p>Blockchain verificado</p>
          <small>Trazabilidad inmutable en cada lote</small>
        </div>
      </div>
      <div class="stat-item">
        <span class="stat-icon">🌿</span>
        <div class="stat-text">
          <p>Origen colombiano</p>
          <small>Café 100% auténtico y certificado</small>
        </div>
      </div>
      <div class="stat-item">
        <span class="stat-icon">🛡️</span>
        <div class="stat-text">
          <p>Conexión segura</p>
          <small>Encriptación SSL en todos los datos</small>
        </div>
      </div>
    </div>
  </div>

  {{-- PANEL DERECHO --}}
  <div class="login-right">
    <div class="login-form-wrap">

      <a href="{{ route('home') }}" class="back-link">
        <span class="back-arrow">←</span>
        Volver al inicio
      </a>

      <div class="form-header">
        <div class="role-badge" style="background:{{ $c['badgeBg'] }};color:{{ $c['badgeText'] }};">
          <span>{{ $c['icon'] }}</span>
          <span>{{ $c['label'] }}</span>
        </div>
        <h2 class="form-title">Inicia sesión</h2>
        <p class="form-subtitle">Ingresa como <strong>{{ ucfirst($role) }}</strong> para continuar.</p>
      </div>

      {{-- Alertas --}}
      @if($errors->any())
        <div class="alert alert-error">
          <span class="alert-icon">⚠</span>
          <div>
            @foreach($errors->all() as $error)
              <p>{{ $error }}</p>
            @endforeach
          </div>
        </div>
      @endif

      @if(session('success'))
        <div class="alert alert-success">
          <span class="alert-icon">✓</span>
          <p>{{ session('success') }}</p>
        </div>
      @endif

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="hidden" name="role" value="{{ $role }}">

        {{-- Email --}}
        <div class="field">
          <label class="field-label" for="email">
            <span class="field-label-icon">✉</span> Correo electrónico
          </label>
          <div class="field-wrap">
            <input type="email" id="email" name="email"
                   value="{{ old('email') }}"
                   class="field-input"
                   placeholder="tu@ejemplo.com"
                   autocomplete="email"
                   required>
            <span class="field-suffix">@</span>
          </div>
        </div>

        {{-- Contraseña --}}
        <div class="field">
          <label class="field-label" for="password">
            <span class="field-label-icon">🔒</span> Contraseña
          </label>
          <div class="field-wrap">
            <input type="password" id="password" name="password"
                   class="field-input"
                   placeholder="••••••••"
                   autocomplete="current-password"
                   required>
            <button type="button" class="toggle-pw" onclick="togglePw()" aria-label="Mostrar contraseña">
              <span id="pw-eye">👁</span>
            </button>
          </div>
        </div>

        {{-- Recordar / Olvidé --}}
        <div class="form-meta">
          <label class="remember-label">
            <input type="checkbox" name="remember" id="remember">
            Recordarme
          </label>
          <a href="#" class="forgot-link">¿Olvidaste tu contraseña?</a>
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn-submit" style="background:{{ $c['color'] }};">
          <span>→</span> Iniciar sesión
        </button>

        {{-- Registro --}}
        @if($role !== 'administrador')
          <div class="divider"><span>o</span></div>
          <a href="{{ route('register.form', $role) }}" class="btn-register">
            <span>＋</span> Crear cuenta nueva
          </a>
        @endif

      </form>

      <div class="security-note">
        <span>🔐</span> Conexión segura con encriptación SSL
      </div>

    </div>
  </div>

</div>

<script>
function togglePw() {
  const input = document.getElementById('password');
  const eye   = document.getElementById('pw-eye');
  if (input.type === 'password') {
    input.type = 'text';
    eye.textContent = '🙈';
  } else {
    input.type = 'password';
    eye.textContent = '👁';
  }
}
</script>

@endsection