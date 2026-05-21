@extends('layouts.app')

@section('title', 'Crear Cuenta - ' . ucfirst($role))

@section('content')

@php
$config = [
    'caficultor' => [
        'color'     => '#15803d',
        'colorH'    => '#0f5c2e',
        'colorSoft' => '#f0fdf4',
        'colorText' => '#166534',
        'icon'      => '🌱',
        'label'     => 'Productor',
        'badgeBg'   => '#dcfce7',
        'badgeText' => '#14532d',
        'ring'      => '#86efac',
        'title'     => 'Únete como Caficultor',
        'subtitle'  => 'Registra tu finca y comienza a vender directamente sin intermediarios.',
        'left_h'    => 'Conecta tu finca con el mundo',
        'left_desc' => 'Miles de compradores esperan café de calidad directamente desde el origen. Tú pones el café, nosotros la tecnología.',
        'stats'     => [
            ['icon'=>'🌿','title'=>'Sin intermediarios','sub'=>'Vende directo al comprador final'],
            ['icon'=>'📈','title'=>'+175% más ingresos','sub'=>'Precio justo por tu trabajo'],
            ['icon'=>'🔗','title'=>'Tu finca en blockchain','sub'=>'Trazabilidad inmutable de cada lote'],
        ],
    ],
    'comprador' => [
        'color'     => '#b45309',
        'colorH'    => '#8b3a06',
        'colorSoft' => '#fff7ed',
        'colorText' => '#9a3412',
        'icon'      => '☕',
        'label'     => 'Consumidor',
        'badgeBg'   => '#ffedd5',
        'badgeText' => '#9a3412',
        'ring'      => '#fdba74',
        'title'     => 'Únete como Comprador',
        'subtitle'  => 'Encuentra café de origen verificado con total transparencia y trazabilidad.',
        'left_h'    => 'Café con historia y origen',
        'left_desc' => 'Accede a los mejores cafés colombianos directamente desde la finca, con la certeza de que cada taza es auténtica.',
        'stats'     => [
            ['icon'=>'✅','title'=>'100% trazable','sub'=>'Conoce el origen exacto de tu café'],
            ['icon'=>'🏆','title'=>'Calidad garantizada','sub'=>'Selección premium de fincas'],
            ['icon'=>'🤝','title'=>'Apoyas al caficultor','sub'=>'Comercio justo y directo'],
        ],
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

.reg-page {
  min-height: 100vh;
  display: grid;
  grid-template-columns: 380px 1fr;
}

/* ===== PANEL IZQUIERDO ===== */
.reg-left {
  background: linear-gradient(160deg, #3b1a08 0%, #6b2f06 50%, #92400e 100%);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: clamp(2rem, 4vw, 3rem);
  position: sticky;
  top: 0;
  height: 100vh;
  overflow: hidden;
}
.reg-left::before {
  content: '';
  position: absolute;
  width: 450px; height: 450px;
  border-radius: 50%;
  background: rgba(255,255,255,0.04);
  top: -150px; right: -150px;
  pointer-events: none;
}
.reg-left::after {
  content: '';
  position: absolute;
  width: 300px; height: 300px;
  border-radius: 50%;
  background: rgba(255,255,255,0.04);
  bottom: -80px; left: -60px;
  pointer-events: none;
}

.left-top { position: relative; z-index: 1; }

.left-logo {
  display: flex;
  align-items: center;
  gap: 13px;
  margin-bottom: clamp(2.5rem, 5vw, 4rem);
}
.left-logo-circle {
  width: 50px; height: 50px;
  border-radius: 50%;
  overflow: hidden;
  border: 2.5px solid rgba(255,255,255,0.4);
  background: rgba(255,255,255,0.1);
  flex-shrink: 0;
}
.left-logo-circle img {
  width: 100%; height: 100%;
  object-fit: cover; display: block;
}
.left-logo-text { display: flex; flex-direction: column; line-height: 1.15; }
.left-logo-name {
  font-size: 1.2rem; font-weight: 800;
  color: #fff; letter-spacing: -0.3px;
}
.left-logo-sub {
  font-size: 0.57rem; color: rgba(255,255,255,0.5);
  letter-spacing: 2px; text-transform: uppercase; font-weight: 600;
}

.left-heading {
  font-size: clamp(1.4rem, 2.5vw, 2rem);
  font-weight: 900; color: #fff; line-height: 1.25;
  margin-bottom: 0.9rem;
}
.left-heading span { color: #fbbf24; }
.left-desc {
  font-size: clamp(0.8rem, 1.2vw, 0.88rem);
  color: rgba(255,255,255,0.6);
  line-height: 1.7; max-width: 300px;
}

.left-stats {
  position: relative; z-index: 1;
  display: flex; flex-direction: column; gap: 10px;
}
.stat-item {
  display: flex; align-items: center; gap: 12px;
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,255,255,0.12);
  border-radius: 14px; padding: 13px 16px;
}
.stat-icon { font-size: 1.2rem; flex-shrink: 0; }
.stat-text p {
  font-size: 0.8rem; font-weight: 700;
  color: #fff; margin-bottom: 2px;
}
.stat-text small {
  font-size: 0.68rem; color: rgba(255,255,255,0.5);
}

/* ===== PANEL DERECHO ===== */
.reg-right {
  background: #fffbf5;
  padding: clamp(1.5rem, 4vw, 3rem) clamp(1.5rem, 5vw, 4rem);
  overflow-y: auto;
  min-height: 100vh;
}
.reg-right-inner {
  max-width: 620px;
  margin: 0 auto;
}

.back-link {
  display: inline-flex; align-items: center; gap: 8px;
  color: #9a7a5e; font-size: 0.85rem; font-weight: 600;
  text-decoration: none; margin-bottom: 2rem;
  transition: color 0.2s;
}
.back-link:hover { color: #6b2f06; }
.back-arrow {
  width: 32px; height: 32px;
  border-radius: 10px; border: 1.5px solid #ede8e0;
  background: #fff; display: flex;
  align-items: center; justify-content: center;
  font-size: 0.85rem; transition: background 0.2s;
}
.back-link:hover .back-arrow { background: #f5ede0; }

.form-header { margin-bottom: 2rem; }
.role-badge {
  display: inline-flex; align-items: center; gap: 6px;
  padding: 5px 14px; border-radius: 999px;
  font-size: 0.72rem; font-weight: 700;
  letter-spacing: 1px; text-transform: uppercase;
  margin-bottom: 1rem;
}
.form-title {
  font-size: clamp(1.4rem, 3vw, 1.9rem);
  font-weight: 900; color: #2d1b0e; line-height: 1.2;
  margin-bottom: 0.4rem;
}
.form-subtitle {
  font-size: 0.88rem; color: #9a7a5e; line-height: 1.6;
}

/* ===== PROGRESO ===== */
.progress-wrap {
  background: #fff;
  border: 1px solid #ede8e0;
  border-radius: 14px;
  padding: 14px 18px;
  margin-bottom: 2rem;
}
.progress-top {
  display: flex; justify-content: space-between;
  font-size: 0.78rem; font-weight: 600;
  color: #7c5a3c; margin-bottom: 8px;
}
.progress-track {
  width: 100%; height: 6px;
  background: #f0ebe3; border-radius: 999px; overflow: hidden;
}
.progress-fill {
  height: 100%; border-radius: 999px;
  transition: width 0.3s ease;
  width: 0%;
}

/* ===== SECCIÓN ===== */
.form-section {
  margin-bottom: 2rem;
}
.section-title {
  display: flex; align-items: center; gap: 10px;
  font-size: 0.88rem; font-weight: 800;
  color: #2d1b0e; text-transform: uppercase;
  letter-spacing: 1px; margin-bottom: 1.1rem;
  padding-bottom: 0.75rem;
  border-bottom: 1.5px solid #f0ebe3;
}
.section-icon {
  width: 30px; height: 30px; border-radius: 8px;
  display: flex; align-items: center; justify-content: center;
  font-size: 0.9rem; flex-shrink: 0;
}

.fields-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1rem;
}
.fields-grid.full { grid-template-columns: 1fr; }

/* ===== FIELDS ===== */
.field { display: flex; flex-direction: column; }
.field-label {
  font-size: 0.8rem; font-weight: 700;
  color: #4a3020; margin-bottom: 6px;
  display: flex; align-items: center; gap: 5px;
}
.field-input {
  width: 100%; padding: 11px 42px 11px 14px;
  border: 1.5px solid #ede8e0; border-radius: 12px;
  font-size: 0.88rem; color: #2d1b0e;
  background: #fff; outline: none;
  transition: border-color 0.2s, box-shadow 0.2s;
  -webkit-appearance: none;
}
.field-input::placeholder { color: #c4b09a; }
.field-input:focus {
  border-color: var(--role-color);
  box-shadow: 0 0 0 3px var(--role-ring);
}
.field-input.error {
  border-color: #f87171;
  box-shadow: 0 0 0 3px rgba(248,113,113,0.15);
}
.field-wrap { position: relative; }
.field-suffix {
  position: absolute; right: 13px; top: 50%;
  transform: translateY(-50%);
  color: #c4b09a; font-size: 0.82rem;
  pointer-events: none;
}
.toggle-pw {
  position: absolute; right: 13px; top: 50%;
  transform: translateY(-50%);
  background: none; border: none; cursor: pointer;
  color: #c4b09a; font-size: 0.85rem; padding: 4px;
  transition: color 0.2s;
}
.toggle-pw:hover { color: #6b2f06; }

/* ===== STRENGTH BAR ===== */
.strength-wrap {
  display: flex; align-items: center; gap: 8px; margin-top: 6px;
}
.strength-track {
  flex: 1; height: 4px;
  background: #f0ebe3; border-radius: 999px; overflow: hidden;
}
.strength-fill {
  height: 100%; border-radius: 999px;
  transition: width 0.3s, background-color 0.3s;
  width: 0%;
}
.strength-label {
  font-size: 0.7rem; font-weight: 700;
  min-width: 60px; text-align: right;
  color: #c4b09a;
}

/* ===== MATCH INDICATOR ===== */
.match-msg {
  font-size: 0.72rem; font-weight: 600;
  margin-top: 5px; min-height: 16px;
}

/* ===== ALERTA ===== */
.alert {
  display: flex; align-items: flex-start; gap: 10px;
  padding: 12px 16px; border-radius: 12px;
  font-size: 0.85rem; margin-bottom: 1.5rem; line-height: 1.5;
}
.alert-error { background:#fef2f2; border:1px solid #fecaca; color:#991b1b; }
.alert-icon { font-size: 1rem; flex-shrink: 0; margin-top: 1px; }
.alert ul { padding-left: 1rem; }
.alert ul li { margin-bottom: 2px; }

/* ===== TÉRMINOS ===== */
.terms-box {
  background: #fff; border: 1.5px solid #ede8e0;
  border-radius: 14px; padding: 16px;
  margin-bottom: 1.5rem;
}
.terms-label {
  display: flex; align-items: flex-start;
  gap: 10px; cursor: pointer;
}
.terms-label input[type="checkbox"] {
  width: 17px; height: 17px; margin-top: 1px;
  accent-color: var(--role-color); cursor: pointer; flex-shrink: 0;
}
.terms-label span {
  font-size: 0.83rem; color: #7c5a3c; line-height: 1.6;
}
.terms-label a {
  color: var(--role-color); font-weight: 600; text-decoration: none;
}
.terms-label a:hover { text-decoration: underline; }

/* ===== PENDING NOTE ===== */
.pending-note {
  display: flex; align-items: center; gap: 8px;
  background: #fefce8; border: 1px solid #fde68a;
  border-radius: 10px; padding: 10px 14px;
  font-size: 0.78rem; color: #92400e; font-weight: 600;
  margin-bottom: 1.5rem;
}

/* ===== BOTONES ===== */
.btn-submit {
  width: 100%; padding: 14px;
  border: none; border-radius: 14px;
  font-size: 0.95rem; font-weight: 800;
  color: #fff; cursor: pointer;
  transition: transform 0.15s, opacity 0.2s;
  display: flex; align-items: center;
  justify-content: center; gap: 8px;
  letter-spacing: 0.3px; margin-bottom: 1.25rem;
}
.btn-submit:hover   { opacity: 0.9; transform: translateY(-1px); }
.btn-submit:active  { transform: scale(0.98); }

.divider {
  display: flex; align-items: center; gap: 12px; margin-bottom: 1.1rem;
}
.divider::before, .divider::after {
  content: ''; flex: 1; height: 1px; background: #ede8e0;
}
.divider span { font-size: 0.75rem; color: #c4b09a; font-weight: 600; }

.btn-login {
  width: 100%; padding: 13px; border-radius: 14px;
  border: 1.5px solid #ede8e0; background: #fff;
  font-size: 0.88rem; font-weight: 700; color: #4a3020;
  text-decoration: none; display: flex;
  align-items: center; justify-content: center; gap: 8px;
  transition: background 0.2s, border-color 0.2s;
}
.btn-login:hover { background: #faf6f0; border-color: #d6c9bb; }

.security-note {
  margin-top: 1.5rem; text-align: center;
  font-size: 0.75rem; color: #c4b09a;
  display: flex; align-items: center;
  justify-content: center; gap: 6px;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 900px) {
  .reg-page { grid-template-columns: 1fr; }
  .reg-left  { display: none; }
  .reg-right { min-height: 100vh; }
  .reg-right-inner { max-width: 100%; }
}
@media (max-width: 560px) {
  .fields-grid { grid-template-columns: 1fr; }
}
</style>

<div class="reg-page" style="--role-color:{{ $c['color'] }};--role-ring:{{ $c['ring'] }}33;">

  {{-- PANEL IZQUIERDO --}}
  <div class="reg-left">
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
      <h2 class="left-heading">{{ $c['left_h'] }}</h2>
      <p class="left-desc">{{ $c['left_desc'] }}</p>
    </div>
    <div class="left-stats">
      @foreach($c['stats'] as $s)
        <div class="stat-item">
          <span class="stat-icon">{{ $s['icon'] }}</span>
          <div class="stat-text">
            <p>{{ $s['title'] }}</p>
            <small>{{ $s['sub'] }}</small>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  {{-- PANEL DERECHO --}}
  <div class="reg-right">
    <div class="reg-right-inner">

      <a href="{{ route('home') }}" class="back-link">
        <span class="back-arrow">←</span>
        Volver al inicio
      </a>

      <div class="form-header">
        <div class="role-badge" style="background:{{ $c['badgeBg'] }};color:{{ $c['badgeText'] }};">
          <span>{{ $c['icon'] }}</span> <span>{{ $c['label'] }}</span>
        </div>
        <h1 class="form-title">{{ $c['title'] }}</h1>
        <p class="form-subtitle">{{ $c['subtitle'] }}</p>
      </div>

      {{-- Barra de progreso --}}
      <div class="progress-wrap">
        <div class="progress-top">
          <span>Completando tu perfil</span>
          <span id="progress-pct">0%</span>
        </div>
        <div class="progress-track">
          <div class="progress-fill" id="progress-fill" style="background:{{ $c['color'] }};"></div>
        </div>
      </div>

      {{-- Errores --}}
      @if($errors->any())
        <div class="alert alert-error">
          <span class="alert-icon">⚠</span>
          <div>
            <strong style="display:block;margin-bottom:4px;">Por favor corrige los siguientes errores:</strong>
            <ul>
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif

      <form method="POST" action="{{ route('register') }}" id="reg-form">
        @csrf
        <input type="hidden" name="role" value="{{ $role }}">

        {{-- SECCIÓN 1: Personal --}}
        <div class="form-section">
          <div class="section-title">
            <div class="section-icon" style="background:{{ $c['badgeBg'] }};color:{{ $c['badgeText'] }};">👤</div>
            Información personal
          </div>
          <div class="fields-grid">
            <div class="field">
              <label class="field-label" for="name">
                <span>✏</span> Nombre completo
              </label>
              <div class="field-wrap">
                <input type="text" id="name" name="name"
                       value="{{ old('name') }}"
                       class="field-input reg-input" placeholder="Juan Pérez García"
                       autocomplete="name" required>
              </div>
            </div>
            <div class="field">
              <label class="field-label" for="documento">
                <span>🪪</span> Documento de identidad
              </label>
              <div class="field-wrap">
                <input type="text" id="documento" name="documento"
                       value="{{ old('documento') }}"
                       class="field-input reg-input" placeholder="1234567890"
                       required>
              </div>
            </div>
          </div>
        </div>

        {{-- SECCIÓN 2: Contacto --}}
        <div class="form-section">
          <div class="section-title">
            <div class="section-icon" style="background:{{ $c['badgeBg'] }};color:{{ $c['badgeText'] }};">✉</div>
            Información de contacto
          </div>
          <div class="fields-grid">
            <div class="field">
              <label class="field-label" for="email">
                <span>@</span> Correo electrónico
              </label>
              <div class="field-wrap">
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}"
                       class="field-input reg-input" placeholder="correo@ejemplo.com"
                       autocomplete="email" required>
                <span class="field-suffix">✉</span>
              </div>
            </div>
            <div class="field">
              <label class="field-label" for="telefono">
                <span>📞</span> Teléfono
              </label>
              <div class="field-wrap">
                <input type="tel" id="telefono" name="telefono"
                       value="{{ old('telefono') }}"
                       class="field-input reg-input" placeholder="300 123 4567"
                       autocomplete="tel" required>
              </div>
            </div>
          </div>
        </div>

        {{-- SECCIÓN 3: Seguridad --}}
        <div class="form-section">
          <div class="section-title">
            <div class="section-icon" style="background:{{ $c['badgeBg'] }};color:{{ $c['badgeText'] }};">🔒</div>
            Seguridad de la cuenta
          </div>
          <div class="fields-grid">
            <div class="field">
              <label class="field-label" for="password">
                <span>🔑</span> Contraseña
              </label>
              <div class="field-wrap">
                <input type="password" id="password" name="password"
                       class="field-input reg-input" placeholder="Mínimo 8 caracteres"
                       autocomplete="new-password" required>
                <button type="button" class="toggle-pw" onclick="togglePw('password','eye1')" aria-label="Mostrar contraseña">
                  <span id="eye1">👁</span>
                </button>
              </div>
              <div class="strength-wrap">
                <div class="strength-track">
                  <div class="strength-fill" id="strength-fill"></div>
                </div>
                <span class="strength-label" id="strength-label">—</span>
              </div>
            </div>
            <div class="field">
              <label class="field-label" for="password_confirmation">
                <span>✅</span> Confirmar contraseña
              </label>
              <div class="field-wrap">
                <input type="password" id="password_confirmation" name="password_confirmation"
                       class="field-input reg-input" placeholder="Repite la contraseña"
                       autocomplete="new-password" required>
                <button type="button" class="toggle-pw" onclick="togglePw('password_confirmation','eye2')" aria-label="Mostrar contraseña">
                  <span id="eye2">👁</span>
                </button>
              </div>
              <div class="match-msg" id="match-msg"></div>
            </div>
          </div>
        </div>

        {{-- Nota aprobación --}}
        <div class="pending-note">
          <span>⏳</span>
          Tu cuenta quedará pendiente de aprobación por un administrador antes de poder ingresar.
        </div>

        {{-- Términos --}}
        <div class="terms-box">
          <label class="terms-label">
            <input type="checkbox" required>
            <span>
              Acepto los <a href="#">términos y condiciones</a> y la
              <a href="#">política de privacidad</a> de CaféTrace.
              Entiendo que mis datos serán tratados de forma segura.
            </span>
          </label>
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn-submit" style="background:{{ $c['color'] }};">
          <span>＋</span> Crear mi cuenta
        </button>

        <div class="divider"><span>o</span></div>

        <a href="{{ route('login.form', $role) }}" class="btn-login">
          <span>→</span> Ya tengo cuenta, iniciar sesión
        </a>

      </form>

      <div class="security-note">
        <span>🔐</span> Datos protegidos con encriptación de nivel bancario
      </div>

    </div>
  </div>

</div>

<script>
// ===== PROGRESO =====
const regInputs = document.querySelectorAll('.reg-input');
const fill = document.getElementById('progress-fill');
const pct  = document.getElementById('progress-pct');

function updateProgress() {
  const filled = [...regInputs].filter(i => i.value.trim() !== '').length;
  const p = Math.round((filled / regInputs.length) * 100);
  fill.style.width = p + '%';
  pct.textContent  = p + '%';
}
regInputs.forEach(i => i.addEventListener('input', updateProgress));

// ===== TOGGLE PASSWORD =====
function togglePw(id, eyeId) {
  const input = document.getElementById(id);
  const eye   = document.getElementById(eyeId);
  if (input.type === 'password') {
    input.type = 'text';
    eye.textContent = '🙈';
  } else {
    input.type = 'password';
    eye.textContent = '👁';
  }
}

// ===== FORTALEZA CONTRASEÑA =====
const pwInput       = document.getElementById('password');
const strengthFill  = document.getElementById('strength-fill');
const strengthLabel = document.getElementById('strength-label');

const levels = [
  { label: 'Muy débil', color: '#ef4444', w: '20%' },
  { label: 'Débil',     color: '#f97316', w: '40%' },
  { label: 'Media',     color: '#f59e0b', w: '60%' },
  { label: 'Fuerte',    color: '#22c55e', w: '80%' },
  { label: 'Muy fuerte',color: '#15803d', w: '100%'},
];

pwInput.addEventListener('input', () => {
  const v = pwInput.value;
  let score = 0;
  if (v.length >= 8)                        score++;
  if (v.match(/[a-z]/) && v.match(/[A-Z]/)) score++;
  if (v.match(/[0-9]/))                      score++;
  if (v.match(/[^a-zA-Z0-9]/))              score++;
  const idx = v.length === 0 ? -1 : Math.min(score, 4);
  if (idx < 0) {
    strengthFill.style.width = '0%';
    strengthLabel.textContent = '—';
    strengthLabel.style.color = '#c4b09a';
  } else {
    strengthFill.style.width           = levels[idx].w;
    strengthFill.style.backgroundColor = levels[idx].color;
    strengthLabel.textContent          = levels[idx].label;
    strengthLabel.style.color          = levels[idx].color;
  }
  checkMatch();
});

// ===== MATCH CONTRASEÑAS =====
const pwConf  = document.getElementById('password_confirmation');
const matchMsg = document.getElementById('match-msg');

function checkMatch() {
  if (!pwConf.value) { matchMsg.textContent = ''; return; }
  if (pwInput.value === pwConf.value) {
    matchMsg.textContent = '✓ Las contraseñas coinciden';
    matchMsg.style.color = '#15803d';
  } else {
    matchMsg.textContent = '✗ No coinciden aún';
    matchMsg.style.color = '#ef4444';
  }
}
pwConf.addEventListener('input', checkMatch);
</script>

@endsection