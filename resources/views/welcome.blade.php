@extends('layouts.app')

@section('title', 'CaféTrace - Bienvenido')

@section('content')
<div id="app-root">

  {{-- NAVBAR --}}
  <nav id="main-nav">
    <div class="nav-inner">
      <div class="nav-brand">
        <div class="logo-circle">
          <img src="{{ asset('images/CafeTrace.png') }}" alt="CaféTrace">
        </div>
        <div class="nav-text">
          <span class="nav-title">CaféTrace</span>
          <span class="nav-sub">Del campesino al consumidor</span>
        </div>
      </div>
      <div class="status-badge">
        <span class="status-dot"></span>
        <span class="status-label">Plataforma Activa</span>
      </div>
    </div>
  </nav>

  {{-- HERO --}}
  <section class="hero">
    <p class="hero-tag">☕ Café colombiano · Trazabilidad blockchain</p>
    <h1 class="hero-title">Del campo colombiano<br><span class="hero-accent">a tu taza, con certeza</span></h1>
    <p class="hero-desc">Selecciona tu perfil para ingresar a la plataforma</p>
    <div class="hero-chips">
      <span class="chip chip-green">🌱 Caficultor</span>
      <span class="chip chip-orange">☕ Comprador</span>
      <span class="chip chip-blue">⚙️ Administrador</span>
    </div>
  </section>

  {{-- CARDS --}}
  <div class="cards-wrapper">
    <div class="cards-grid">

      {{-- Caficultor --}}
      <div class="card">
        <div class="card-img-wrap">
          <img src="https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?w=600&h=380&fit=crop&q=80" alt="Caficultor">
          <div class="card-overlay"></div>
          <div class="card-img-info">
            <span class="card-icon-circle">🌱</span>
            <span class="card-img-title">Caficultor</span>
          </div>
          <span class="card-badge badge-green">Productor</span>
        </div>
        <div class="card-body">
          <p class="card-label label-green">Vende directo, gana más</p>
          <p class="card-desc">Conecta tu finca directamente con compradores. Sin intermediarios, con trazabilidad completa en blockchain.</p>
          <ul class="card-list">
            <li><span class="check">✓</span> Sin intermediarios</li>
            <li><span class="check">✓</span> +175% más ingresos</li>
            <li><span class="check">✓</span> Tu finca en blockchain</li>
          </ul>
          <div class="card-btns">
            <a href="{{ route('login.form', 'caficultor') }}" class="btn btn-green">Entrar</a>
            <a href="{{ route('register.form', 'caficultor') }}" class="btn btn-outline">Registrarme</a>
          </div>
        </div>
      </div>

      {{-- Comprador --}}
      <div class="card">
        <div class="card-img-wrap">
          <img src="https://images.unsplash.com/photo-1442512595331-e89e73853f31?w=600&h=380&fit=crop&q=80" alt="Comprador">
          <div class="card-overlay"></div>
          <div class="card-img-info">
            <span class="card-icon-circle">☕</span>
            <span class="card-img-title">Comprador</span>
          </div>
          <span class="card-badge badge-orange">Consumidor</span>
        </div>
        <div class="card-body">
          <p class="card-label label-orange">Café de origen verificado</p>
          <p class="card-desc">Accede a café 100% trazable desde la finca hasta tu mesa. Calidad garantizada y apoyo directo al productor.</p>
          <ul class="card-list">
            <li><span class="check">✓</span> 100% trazable</li>
            <li><span class="check">✓</span> Calidad garantizada</li>
            <li><span class="check">✓</span> Apoyas al caficultor</li>
          </ul>
          <div class="card-btns">
            <a href="{{ route('login.form', 'comprador') }}" class="btn btn-orange">Entrar</a>
            <a href="{{ route('register.form', 'comprador') }}" class="btn btn-outline">Registrarme</a>
          </div>
        </div>
      </div>

      {{-- Administrador --}}
      <div class="card">
        <div class="card-img-wrap">
          <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=600&h=380&fit=crop&q=80" alt="Administrador">
          <div class="card-overlay"></div>
          <div class="card-img-info">
            <span class="card-icon-circle">⚙️</span>
            <span class="card-img-title">Administrador</span>
          </div>
          <span class="card-badge badge-blue">Staff</span>
        </div>
        <div class="card-body">
          <p class="card-label label-blue">Gestiona la plataforma</p>
          <p class="card-desc">Acceso completo a la gestión de usuarios, operaciones y monitoreo de toda la cadena de valor del café.</p>
          <ul class="card-list">
            <li><span class="check">✓</span> Aprueba usuarios</li>
            <li><span class="check">✓</span> Supervisa operaciones</li>
            <li><span class="check">✓</span> Control total</li>
          </ul>
          <div class="card-btns">
            <a href="{{ route('login.form', 'administrador') }}" class="btn btn-blue">Entrar</a>
          </div>
        </div>
      </div>

    </div>
  </div>

  {{-- TRUST STRIP --}}
  <div class="trust-strip">
    <div class="trust-inner">
      <div class="trust-item"><span>🔗</span><div><p>Blockchain verificado</p><small>Trazabilidad inmutable</small></div></div>
      <div class="trust-item"><span>🛡️</span><div><p>Pago seguro</p><small>Transacciones protegidas</small></div></div>
      <div class="trust-item"><span>🌿</span><div><p>Origen colombiano</p><small>100% auténtico</small></div></div>
      <div class="trust-item"><span>📱</span><div><p>Soporte 24/7</p><small>Siempre disponible</small></div></div>
    </div>
  </div>

  {{-- FOOTER --}}
  <footer class="site-footer">
    © {{ date('Y') }} CaféTrace · Devolviendo el valor al campo colombiano
  </footer>

</div>

{{-- FAB --}}
<button id="fabBtn" class="fab" onclick="accesibilidad.togglePanel()" aria-label="Abrir panel de accesibilidad">
  ♿ Accesibilidad
</button>

{{-- PANEL ACCESIBILIDAD --}}
<div id="accesibilidadPanel" role="dialog" aria-modal="true" aria-label="Opciones de accesibilidad">
  <div class="panel-overlay" onclick="accesibilidad.togglePanel()"></div>
  <div class="panel-sidebar">
    <div class="panel-header">
      <h3>♿ Accesibilidad</h3>
      <button onclick="accesibilidad.togglePanel()" class="panel-close" aria-label="Cerrar panel">✕</button>
    </div>
    <div class="panel-body">

      <div class="panel-option">
        <label>Tamaño de texto</label>
        <div class="size-control">
          <button onclick="accesibilidad.texto(-1)" aria-label="Reducir texto">A−</button>
          <span id="textSizeValue" aria-live="polite">100%</span>
          <button onclick="accesibilidad.texto(1)" aria-label="Aumentar texto">A+</button>
        </div>
      </div>

      <div class="panel-option">
        <label for="darkBtn">Modo oscuro</label>
        <button id="darkBtn" onclick="accesibilidad.darkMode()" class="toggle-btn" aria-pressed="false">Activar</button>
      </div>

      <div class="panel-option">
        <label for="contrastBtn">Alto contraste</label>
        <button id="contrastBtn" onclick="accesibilidad.contrastMode()" class="toggle-btn" aria-pressed="false">Activar</button>
      </div>

      <div class="panel-option">
        <label for="dyslexiaBtn">📖 Fuente para dislexia</label>
        <button id="dyslexiaBtn" onclick="accesibilidad.dyslexiaMode()" class="toggle-btn" aria-pressed="false">Activar</button>
        <small>Evita confundir letras como b/d/p/q</small>
      </div>

      <div class="panel-option">
        <label for="voiceBtn">🔊 Leer en voz alta</label>
        <button id="voiceBtn" onclick="accesibilidad.voiceMode()" class="toggle-btn" aria-pressed="false">Activar</button>
        <small id="voice-status" aria-live="polite"></small>
      </div>

    </div>
    <div class="panel-footer">
      <button onclick="accesibilidad.resetAll()" class="reset-btn">↺ Restablecer todo</button>
    </div>
  </div>
</div>

<style>
/* ===========================
   VARIABLES & BASE
=========================== */
:root {
  --bg:         #fffbf5;
  --bg2:        #fff7ed;
  --surface:    #ffffff;
  --border:     #ede8e0;
  --text:       #2d1b0e;
  --text2:      #7c5a3c;
  --text3:      #9a7a5e;
  --green:      #15803d;
  --green-h:    #0f5c2e;
  --orange:     #b45309;
  --orange-h:   #8b3a06;
  --blue:       #1d4ed8;
  --blue-h:     #153eb3;
  --accent:     #d97706;
  --accent2:    #6b2f06;
}

/* ===========================
   MODO OSCURO
=========================== */
body.dark {
  --bg:      #0f0f0f;
  --bg2:     #1a1410;
  --surface: #1e1a16;
  --border:  #3a302a;
  --text:    #f5f0eb;
  --text2:   #c8b49e;
  --text3:   #9a8778;
  --accent:  #f59e0b;
  --accent2: #fbbf24;
}
body.dark { background: var(--bg); color: var(--text); }

/* ===========================
   ALTO CONTRASTE
=========================== */
body.contrast {
  --bg:      #000000;
  --bg2:     #000000;
  --surface: #000000;
  --border:  #ffffff;
  --text:    #ffffff;
  --text2:   #ffff00;
  --text3:   #00ffff;
  --green:   #00ff00;
  --orange:  #ff8800;
  --blue:    #00aaff;
  --accent:  #ffff00;
  --accent2: #ffffff;
}
body.contrast { background: #000; color: #fff; }
body.contrast .card { border: 2px solid #fff; }
body.contrast .btn-green  { background: #00cc00 !important; color: #000 !important; border: 2px solid #fff; }
body.contrast .btn-orange { background: #ff6600 !important; color: #000 !important; border: 2px solid #fff; }
body.contrast .btn-blue   { background: #0088ff !important; color: #000 !important; border: 2px solid #fff; }
body.contrast .btn-outline { background: #000; color: #fff; border: 2px solid #fff; }
body.contrast .hero-tag, body.contrast .card-label { color: #ffff00 !important; }
body.contrast .card-desc, body.contrast .card-list li { color: #fff !important; }
body.contrast .trust-strip { background: #000; border-color: #fff; }
body.contrast .trust-item p { color: #fff !important; }
body.contrast .trust-item small { color: #ffff00 !important; }
body.contrast .chip { border: 1px solid #fff; }
body.contrast .nav-sub { color: #ffff00 !important; }
body.contrast .status-badge { background: #000; border: 1px solid #fff; }
body.contrast .status-label { color: #ffff00 !important; }
body.contrast #main-nav { background: #000; border-color: #fff; }
body.contrast .site-footer { background: #000; border-color: #fff; color: #fff; }

/* ===========================
   DISLEXIA
=========================== */
@font-face {
  font-family: 'Dyslexic';
  src: url('https://cdn.jsdelivr.net/npm/opendyslexic@1.0.3/opendyslexic-regular.woff2') format('woff2');
  font-display: swap;
}
body.dyslexia,
body.dyslexia * {
  font-family: 'Dyslexic', 'Comic Sans MS', sans-serif !important;
  letter-spacing: 0.06em;
  word-spacing: 0.12em;
  line-height: 1.9;
}

/* ===========================
   RESET & BOX
=========================== */
*, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
body {
  background: var(--bg);
  color: var(--text);
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  transition: background 0.3s, color 0.3s;
}

/* ===========================
   NAVBAR
=========================== */
#main-nav {
  background: var(--surface);
  border-bottom: 1px solid var(--border);
  position: sticky;
  top: 0;
  z-index: 100;
  padding: 0 1.5rem;
  transition: background 0.3s, border-color 0.3s;
}
.nav-inner {
  max-width: 1200px;
  margin: 0 auto;
  display: flex;
  justify-content: space-between;
  align-items: center;
  height: 72px;
  gap: 1rem;
}
.nav-brand {
  display: flex;
  align-items: center;
  gap: 14px;
  min-width: 0;
}
.logo-circle {
  width: 54px;
  height: 54px;
  border-radius: 50%;
  overflow: hidden;
  border: 2.5px solid var(--accent);
  flex-shrink: 0;
  background: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
}
.logo-circle img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}
.nav-text {
  display: flex;
  flex-direction: column;
  line-height: 1.15;
  min-width: 0;
}
.nav-title {
  font-size: clamp(1rem, 3vw, 1.35rem);
  font-weight: 800;
  color: var(--accent2);
  letter-spacing: -0.3px;
  white-space: nowrap;
}
body.dark .nav-title { color: var(--accent); }
.nav-sub {
  font-size: clamp(0.5rem, 1.5vw, 0.6rem);
  color: var(--text3);
  letter-spacing: 2px;
  font-weight: 600;
  text-transform: uppercase;
  white-space: nowrap;
}
.status-badge {
  display: flex;
  align-items: center;
  gap: 7px;
  background: var(--bg2);
  border: 1px solid var(--border);
  padding: 6px 14px;
  border-radius: 999px;
  flex-shrink: 0;
  transition: background 0.3s;
}
.status-dot {
  width: 7px;
  height: 7px;
  background: #f59e0b;
  border-radius: 50%;
  animation: pulse 1.8s infinite;
  flex-shrink: 0;
}
.status-label {
  font-size: clamp(0.65rem, 1.5vw, 0.78rem);
  font-weight: 600;
  color: var(--text2);
  white-space: nowrap;
}
@keyframes pulse {
  0%, 100% { opacity: 1; transform: scale(1); }
  50%       { opacity: .5; transform: scale(.75); }
}

/* ===========================
   HERO
=========================== */
.hero {
  background: var(--bg);
  padding: clamp(2.5rem, 7vw, 5rem) 1.5rem clamp(2rem, 5vw, 4rem);
  text-align: center;
  transition: background 0.3s;
}
.hero-tag {
  font-size: clamp(0.65rem, 1.8vw, 0.75rem);
  letter-spacing: 2.5px;
  font-weight: 700;
  color: var(--accent);
  text-transform: uppercase;
  margin-bottom: 1.1rem;
}
.hero-title {
  font-size: clamp(1.6rem, 5vw, 3.1rem);
  font-weight: 900;
  color: var(--text);
  line-height: 1.2;
  margin: 0 auto 1.1rem;
  max-width: 680px;
}
.hero-accent { color: var(--accent); }
.hero-desc {
  font-size: clamp(0.88rem, 2vw, 1.05rem);
  color: var(--text2);
  max-width: 460px;
  margin: 0 auto 2rem;
  line-height: 1.7;
}
.hero-chips {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  justify-content: center;
}
.chip {
  padding: 7px 16px;
  border-radius: 999px;
  font-size: clamp(0.72rem, 1.5vw, 0.78rem);
  font-weight: 700;
  border: 1px solid transparent;
}
.chip-green  { background: #dcfce7; color: #14532d; }
.chip-orange { background: #fff7ed; color: #9a3412; }
.chip-blue   { background: #eff6ff; color: #1e40af; }

/* ===========================
   CARDS
=========================== */
.cards-wrapper {
  max-width: 1100px;
  margin: 0 auto;
  padding: clamp(1.5rem, 4vw, 3rem) 1.25rem clamp(2rem, 5vw, 5rem);
}
.cards-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 1.5rem;
}
.card {
  background: var(--surface);
  border-radius: 20px;
  border: 1px solid var(--border);
  overflow: hidden;
  transition: transform 0.2s, box-shadow 0.2s, background 0.3s, border-color 0.3s;
  display: flex;
  flex-direction: column;
}
.card:hover {
  transform: translateY(-6px);
  box-shadow: 0 20px 40px rgba(107,47,6,0.12);
}
body.dark .card:hover {
  box-shadow: 0 20px 40px rgba(0,0,0,0.5);
}
.card-img-wrap {
  position: relative;
  height: 190px;
  overflow: hidden;
}
.card-img-wrap img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}
.card-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(20,8,0,.8) 0%, rgba(0,0,0,.1) 65%);
}
.card-img-info {
  position: absolute;
  bottom: 15px;
  left: 16px;
  display: flex;
  align-items: center;
  gap: 10px;
}
.card-icon-circle {
  background: rgba(255,255,255,0.95);
  border-radius: 50%;
  width: 38px;
  height: 38px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.15rem;
  flex-shrink: 0;
}
.card-img-title {
  color: #fff;
  font-size: clamp(1.1rem, 2.5vw, 1.4rem);
  font-weight: 800;
  text-shadow: 0 2px 8px rgba(0,0,0,.4);
}
.card-badge {
  position: absolute;
  top: 13px;
  right: 13px;
  font-size: 0.65rem;
  font-weight: 700;
  padding: 4px 11px;
  border-radius: 999px;
  letter-spacing: 1px;
  text-transform: uppercase;
  color: #fff;
}
.badge-green  { background: var(--green); }
.badge-orange { background: var(--orange); }
.badge-blue   { background: var(--blue); }

.card-body {
  padding: clamp(1.1rem, 3vw, 1.5rem);
  display: flex;
  flex-direction: column;
  flex: 1;
}
.card-label {
  font-size: 0.72rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1.5px;
  margin-bottom: 0.65rem;
}
.label-green  { color: var(--green); }
.label-orange { color: var(--orange); }
.label-blue   { color: var(--blue); }

.card-desc {
  font-size: clamp(0.82rem, 1.8vw, 0.9rem);
  color: var(--text2);
  line-height: 1.65;
  margin-bottom: 1.1rem;
}
.card-list {
  list-style: none;
  margin-bottom: 1.4rem;
  display: flex;
  flex-direction: column;
  gap: 5px;
}
.card-list li {
  font-size: clamp(0.8rem, 1.8vw, 0.87rem);
  color: var(--text2);
  display: flex;
  align-items: center;
  gap: 8px;
}
.check {
  color: var(--green);
  font-weight: 800;
  flex-shrink: 0;
}
body.contrast .check { color: #00ff00 !important; }

.card-btns {
  display: flex;
  gap: 10px;
  margin-top: auto;
}
.btn {
  flex: 1;
  text-align: center;
  padding: 11px 8px;
  border-radius: 12px;
  text-decoration: none;
  font-weight: 700;
  font-size: clamp(0.8rem, 1.8vw, 0.88rem);
  border: none;
  cursor: pointer;
  transition: background 0.2s, transform 0.1s;
  display: block;
}
.btn:active { transform: scale(0.97); }
.btn-green  { background: var(--green);  color: #fff; }
.btn-green:hover  { background: var(--green-h); }
.btn-orange { background: var(--orange); color: #fff; }
.btn-orange:hover { background: var(--orange-h); }
.btn-blue   { background: var(--blue);   color: #fff; }
.btn-blue:hover   { background: var(--blue-h); }
.btn-outline {
  background: transparent;
  border: 1.5px solid var(--border);
  color: var(--text);
}
.btn-outline:hover { background: var(--bg2); }

/* ===========================
   TRUST STRIP
=========================== */
.trust-strip {
  background: var(--surface);
  border-top: 1px solid var(--border);
  border-bottom: 1px solid var(--border);
  padding: 1.5rem 1.5rem;
  transition: background 0.3s;
}
.trust-inner {
  max-width: 1100px;
  margin: 0 auto;
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 1.5rem 2.5rem;
}
.trust-item {
  display: flex;
  align-items: center;
  gap: 10px;
}
.trust-item span { font-size: 1.3rem; }
.trust-item p {
  font-size: 0.78rem;
  font-weight: 700;
  color: var(--text);
  margin: 0 0 2px;
}
.trust-item small {
  font-size: 0.7rem;
  color: var(--text3);
  display: block;
}

/* ===========================
   FOOTER
=========================== */
.site-footer {
  background: var(--surface);
  border-top: 1px solid var(--border);
  padding: 1.5rem;
  text-align: center;
  color: var(--text3);
  font-size: 0.82rem;
  transition: background 0.3s;
}

/* ===========================
   FAB
=========================== */
.fab {
  position: fixed;
  bottom: clamp(16px, 4vw, 28px);
  right:  clamp(16px, 4vw, 28px);
  background: var(--accent2);
  color: #fff;
  border: none;
  padding: 12px 20px;
  border-radius: 50px;
  cursor: pointer;
  font-weight: 700;
  font-size: 0.85rem;
  box-shadow: 0 4px 18px rgba(0,0,0,0.28);
  z-index: 200;
  transition: transform 0.2s, background 0.2s;
  white-space: nowrap;
}
.fab:hover  { transform: scale(1.05); }
.fab:active { transform: scale(0.97); }
body.contrast .fab { background: #ff6600; color: #000; border: 2px solid #fff; }

/* ===========================
   PANEL ACCESIBILIDAD
=========================== */
#accesibilidadPanel {
  display: none;
  position: fixed;
  inset: 0;
  z-index: 1000;
  justify-content: flex-end;
}
#accesibilidadPanel.open { display: flex; }

.panel-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0,0,0,0.5);
}
.panel-sidebar {
  position: relative;
  width: min(360px, 100vw);
  height: 100%;
  background: var(--surface);
  display: flex;
  flex-direction: column;
  animation: slideIn 0.28s ease;
  overflow: hidden;
}
@keyframes slideIn {
  from { transform: translateX(100%); }
  to   { transform: translateX(0); }
}
.panel-header {
  background: linear-gradient(135deg, #6b2f06, #d97706);
  padding: 1.25rem 1.5rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-shrink: 0;
}
.panel-header h3 {
  color: #fff;
  font-size: 1rem;
  font-weight: 700;
  margin: 0;
}
.panel-close {
  background: rgba(255,255,255,0.2);
  border: none;
  color: #fff;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  cursor: pointer;
  font-size: 1rem;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background 0.2s;
}
.panel-close:hover { background: rgba(255,255,255,0.35); }

.panel-body {
  flex: 1;
  padding: 1.25rem 1.5rem;
  overflow-y: auto;
  display: flex;
  flex-direction: column;
  gap: 0;
}
.panel-option {
  padding: 1rem 0;
  border-bottom: 1px solid var(--border);
}
.panel-option:last-child { border-bottom: none; }
.panel-option label {
  display: block;
  font-weight: 700;
  font-size: 0.88rem;
  color: var(--text);
  margin-bottom: 10px;
}
.panel-option small {
  display: block;
  margin-top: 7px;
  font-size: 0.7rem;
  color: var(--text3);
  line-height: 1.5;
}
.size-control {
  display: flex;
  align-items: center;
  gap: 12px;
}
.size-control button {
  padding: 8px 16px;
  border: 1.5px solid var(--border);
  background: var(--bg2);
  color: var(--text);
  border-radius: 8px;
  cursor: pointer;
  font-weight: 700;
  font-size: 0.9rem;
  transition: background 0.2s;
}
.size-control button:hover { background: var(--border); }
.size-control span {
  min-width: 50px;
  text-align: center;
  font-weight: 600;
  font-size: 0.88rem;
  color: var(--text);
}
.toggle-btn {
  width: 100%;
  padding: 10px 14px;
  background: var(--bg2);
  border: 1.5px solid var(--border);
  border-radius: 10px;
  cursor: pointer;
  font-weight: 600;
  font-size: 0.88rem;
  color: var(--text);
  transition: background 0.2s, color 0.2s, border-color 0.2s;
  text-align: left;
}
.toggle-btn.active {
  background: #15803d;
  color: #fff;
  border-color: #15803d;
}
.toggle-btn:hover:not(.active) { background: var(--border); }

body.contrast .toggle-btn {
  background: #000;
  color: #fff;
  border: 2px solid #fff;
}
body.contrast .toggle-btn.active {
  background: #00cc00;
  color: #000;
  border-color: #fff;
}
body.contrast .panel-sidebar {
  background: #000;
  border-left: 2px solid #fff;
}
body.contrast .panel-option { border-color: #555; }
body.contrast .panel-option label { color: #fff; }
body.contrast .size-control button {
  background: #000;
  color: #fff;
  border-color: #fff;
}
body.contrast .size-control span { color: #ffff00; }
body.contrast .panel-option small { color: #00ffff; }

.panel-footer {
  padding: 1rem 1.5rem;
  border-top: 1px solid var(--border);
  flex-shrink: 0;
}
.reset-btn {
  width: 100%;
  padding: 10px;
  background: transparent;
  border: 1.5px solid var(--border);
  border-radius: 10px;
  cursor: pointer;
  color: var(--text3);
  font-size: 0.88rem;
  font-weight: 600;
  transition: background 0.2s;
}
.reset-btn:hover { background: var(--bg2); }
body.contrast .reset-btn { background: #000; color: #fff; border-color: #fff; }

/* ===========================
   RESPONSIVE
=========================== */
@media (max-width: 640px) {
  .nav-inner { height: 62px; }
  .logo-circle { width: 44px; height: 44px; }
  .status-label { display: none; }
  .status-badge { padding: 6px 10px; }
  .hero-chips { gap: 6px; }
  .cards-grid { grid-template-columns: 1fr; }
  .trust-inner { gap: 1rem 1.5rem; }
  .trust-item span { font-size: 1.1rem; }
}

@media (max-width: 400px) {
  .nav-sub { display: none; }
  .fab { padding: 10px 14px; font-size: 0.78rem; }
}
</style>

<script>
const accesibilidad = {
  textSize: 100,
  darkActive: false,
  contrastActive: false,
  dyslexiaActive: false,
  voiceActive: false,
  utterance: null,

  togglePanel() {
    const p = document.getElementById('accesibilidadPanel');
    const open = p.classList.toggle('open');
    document.body.style.overflow = open ? 'hidden' : '';
    if (open) {
      p.querySelector('.panel-close').focus();
    }
  },

  texto(delta) {
    this.textSize = Math.min(150, Math.max(80, this.textSize + delta * 10));
    document.documentElement.style.fontSize = this.textSize + '%';
    document.getElementById('textSizeValue').innerText = this.textSize + '%';
  },

  _setBtn(id, active) {
    const btn = document.getElementById(id);
    btn.innerText = active ? 'Desactivar' : 'Activar';
    btn.classList.toggle('active', active);
    btn.setAttribute('aria-pressed', String(active));
  },

  darkMode() {
    // Si contraste está activo, apagarlo primero
    if (this.contrastActive) {
      this.contrastActive = false;
      document.body.classList.remove('contrast');
      this._setBtn('contrastBtn', false);
    }
    this.darkActive = !this.darkActive;
    document.body.classList.toggle('dark', this.darkActive);
    this._setBtn('darkBtn', this.darkActive);
  },

  contrastMode() {
    // Si modo oscuro está activo, apagarlo primero
    if (this.darkActive) {
      this.darkActive = false;
      document.body.classList.remove('dark');
      this._setBtn('darkBtn', false);
    }
    this.contrastActive = !this.contrastActive;
    document.body.classList.toggle('contrast', this.contrastActive);
    this._setBtn('contrastBtn', this.contrastActive);
  },

  dyslexiaMode() {
    this.dyslexiaActive = !this.dyslexiaActive;
    document.body.classList.toggle('dyslexia', this.dyslexiaActive);
    this._setBtn('dyslexiaBtn', this.dyslexiaActive);
  },

  voiceMode() {
    const btn = document.getElementById('voiceBtn');
    const status = document.getElementById('voice-status');
    if (this.voiceActive) {
      speechSynthesis.cancel();
      this.voiceActive = false;
      this._setBtn('voiceBtn', false);
      if (status) status.innerText = '';
    } else {
      // Leer solo contenido principal, no el panel
      const contenido = document.querySelector('.hero').innerText
        + ' ' + document.querySelector('.cards-wrapper').innerText;
      this.utterance = new SpeechSynthesisUtterance(contenido);
      this.utterance.lang = 'es-CO';
      this.utterance.rate = 0.85;
      this.utterance.pitch = 1;
      this.utterance.onend = () => {
        this.voiceActive = false;
        this._setBtn('voiceBtn', false);
        if (status) status.innerText = 'Lectura finalizada.';
        setTimeout(() => { if (status) status.innerText = ''; }, 3000);
      };
      this.utterance.onerror = () => {
        this.voiceActive = false;
        this._setBtn('voiceBtn', false);
        if (status) status.innerText = 'Error al leer. Intente de nuevo.';
      };
      speechSynthesis.speak(this.utterance);
      this.voiceActive = true;
      btn.innerText = 'Detener';
      btn.classList.add('active');
      btn.setAttribute('aria-pressed', 'true');
      if (status) status.innerText = 'Leyendo página...';
    }
  },

  resetAll() {
    this.textSize = 100;
    document.documentElement.style.fontSize = '100%';
    document.getElementById('textSizeValue').innerText = '100%';
    if (this.darkActive)     this.darkMode();
    if (this.contrastActive) this.contrastMode();
    if (this.dyslexiaActive) this.dyslexiaMode();
    if (this.voiceActive)    this.voiceMode();
  }
};

// Cerrar panel con Escape
document.addEventListener('keydown', e => {
  if (e.key === 'Escape' && document.getElementById('accesibilidadPanel').classList.contains('open')) {
    accesibilidad.togglePanel();
  }
});
</script>
@endsection