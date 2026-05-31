@extends('layouts.app')

@section('title', 'Dashboard Caficultor')

@section('content')
<style>
*{box-sizing:border-box;margin:0;padding:0}
:root{
  --g900:#0d2e0a;--g800:#1a4a14;--g700:#246019;--g600:#2d7a1f;
  --g500:#3d9e2a;--g400:#5ab83a;--g300:#8dd468;--g100:#e8f5e0;--g50:#f4fbee;
  --amber:#c47c0a;--amber-bg:#fef3d6;
  --cream:#fafaf7;--white:#ffffff;--border:#e4e8df;
  --text:#1a2416;--muted:#5a6e52;--hint:#9aac8e;
}
body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;background:var(--cream);color:var(--text)}

/* NAV */
.nav{background:var(--g800);height:60px;padding:0 28px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid rgba(255,255,255,0.07)}
.nav-brand{display:flex;align-items:center;gap:11px}
.nav-logo{width:36px;height:36px;border-radius:50%;border:1.5px solid rgba(255,255,255,0.2);background:rgba(255,255,255,0.1);overflow:hidden;display:flex;align-items:center;justify-content:center}
.nav-logo img{width:100%;height:100%;object-fit:cover}
.nav-name{font-size:15px;font-weight:500;color:#fff}
.nav-sub{font-size:10px;color:rgba(255,255,255,0.4);letter-spacing:1.5px;text-transform:uppercase}
.nav-links{display:flex;gap:3px}
.nav-link{display:flex;align-items:center;gap:7px;padding:7px 14px;border-radius:8px;font-size:13px;color:rgba(255,255,255,0.6);text-decoration:none;transition:all 0.15s}
.nav-link:hover{background:rgba(255,255,255,0.07);color:#fff}
.nav-link.active{background:rgba(141,212,104,0.15);color:var(--g300)}
.nav-link i{font-size:15px}
.nav-right{display:flex;align-items:center;gap:9px}
.nav-avatar{width:32px;height:32px;border-radius:50%;background:var(--g600);border:1.5px solid rgba(141,212,104,0.3);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:500;color:#fff}
.nav-username{font-size:13px;color:rgba(255,255,255,0.65)}
.nav-cta{display:flex;align-items:center;gap:6px;padding:8px 16px;border-radius:9px;background:var(--g400);color:#fff;font-size:13px;font-weight:500;text-decoration:none;transition:all 0.15s}
.nav-cta:hover{background:var(--g500);transform:translateY(-1px)}
.nav-cta i{font-size:14px}
.btn-logout{display:flex;align-items:center;gap:6px;padding:7px 12px;border-radius:8px;border:1px solid rgba(255,255,255,0.15);background:transparent;color:rgba(255,255,255,0.55);font-size:12px;cursor:pointer;transition:all 0.15s;font-family:inherit}
.btn-logout:hover{background:rgba(255,255,255,0.07);color:#fff}

/* MOBILE NAV */
.mobile-nav{display:none;background:var(--g800);border-top:1px solid rgba(255,255,255,0.07);padding:10px 20px}
.mobile-nav-inner{display:flex;justify-content:space-around}
.mobile-link{display:flex;flex-direction:column;align-items:center;gap:4px;color:rgba(255,255,255,0.5);font-size:11px;text-decoration:none}
.mobile-link i{font-size:20px}
.mobile-link.active{color:var(--g300)}

/* BANNER */
.banner{background:var(--g700);padding:20px 28px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;border-bottom:1px solid rgba(255,255,255,0.06)}
.banner-greeting{font-size:19px;font-weight:500;color:#fff;margin-bottom:2px}
.banner-greeting span{color:var(--g300)}
.banner-sub{font-size:13px;color:rgba(255,255,255,0.5)}
.banner-btn{display:flex;align-items:center;gap:8px;padding:11px 20px;border-radius:10px;background:var(--g300);color:var(--g900);font-size:13px;font-weight:500;text-decoration:none;transition:all 0.15s;flex-shrink:0}
.banner-btn:hover{background:#a8e07a;transform:translateY(-1px)}
.banner-btn i{font-size:15px}

/* ALERT */
.alert-success{background:#f0fdf4;border:1px solid #bbf7d0;color:#14532d;padding:12px 16px;border-radius:10px;font-size:13px;margin-bottom:20px;display:flex;align-items:center;gap:8px}

/* MAIN */
.main{padding:24px 28px}

/* STATS */
.stats{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:22px}
.stat{background:var(--white);border:0.5px solid var(--border);border-radius:12px;padding:18px 20px;display:flex;flex-direction:column;gap:10px}
.stat-top{display:flex;align-items:flex-start;justify-content:space-between}
.stat-icon{width:38px;height:38px;border-radius:10px;display:flex;align-items:center;justify-content:center}
.stat-icon i{font-size:19px}
.stat-icon.green{background:var(--g100);color:var(--g600)}
.stat-icon.purple{background:#eeedfe;color:#534ab7}
.stat-icon.amber{background:var(--amber-bg);color:var(--amber)}
.stat-icon.teal{background:#e0f5f0;color:#0f6e56}
.stat-val{font-size:26px;font-weight:500;color:var(--text);line-height:1}
.stat-label{font-size:12px;color:var(--muted);margin-top:2px}

/* SECTION HEADER */
.section-hdr{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px}
.section-title{font-size:15px;font-weight:500;color:var(--text);display:flex;align-items:center;gap:8px}
.section-title i{font-size:17px;color:var(--g500)}
.section-link{font-size:12px;color:var(--g600);display:flex;align-items:center;gap:4px;text-decoration:none}
.section-link:hover{color:var(--g700)}

/* LOTES GRID */
.lotes-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:22px}
.lote-card{background:var(--white);border:0.5px solid var(--border);border-radius:14px;overflow:hidden;transition:all 0.18s}
.lote-card:hover{box-shadow:0 6px 24px rgba(0,0,0,0.07);transform:translateY(-2px)}

/* IMG */
.lote-img{height:140px;position:relative;overflow:hidden;background:linear-gradient(135deg,var(--g700),var(--g900));display:flex;align-items:center;justify-content:center}
.lote-img img{width:100%;height:100%;object-fit:cover;position:absolute;inset:0}
.lote-img-ph{display:flex;align-items:center;justify-content:center;width:100%;height:100%}
.lote-img-ph i{font-size:40px;color:rgba(255,255,255,0.18)}
.badge-estado{position:absolute;top:9px;right:9px;font-size:10px;font-weight:500;padding:3px 9px;border-radius:20px}
.est-disponible{background:rgba(10,50,5,0.82);color:#8dd468}
.est-vendido{background:rgba(40,20,5,0.82);color:#f5c08a}
.est-reservado{background:rgba(70,55,5,0.82);color:#f5d878}
.est-en_proceso{background:rgba(10,30,70,0.82);color:#b5d4f4}
.badge-organico{position:absolute;top:9px;left:9px;background:rgba(10,50,5,0.82);color:#8dd468;font-size:10px;padding:3px 9px;border-radius:20px;display:flex;align-items:center;gap:4px}
.badge-organico i{font-size:10px}

/* CARD BODY */
.lote-body{padding:14px 16px}
.lote-meta{display:flex;align-items:center;justify-content:space-between;margin-bottom:5px}
.lote-code{font-size:10px;color:var(--hint);text-transform:uppercase;letter-spacing:0.8px}
.lote-score{font-size:11px;color:var(--amber);display:flex;align-items:center;gap:3px}
.lote-score i{font-size:10px}
.lote-variedad{font-size:14px;font-weight:500;color:var(--text);margin-bottom:10px}
.lote-details{display:flex;flex-direction:column;gap:4px;padding-bottom:12px;border-bottom:0.5px solid var(--border);margin-bottom:12px}
.lote-detail{display:flex;align-items:center;gap:6px;font-size:11px;color:var(--muted)}
.lote-detail i{font-size:12px;color:var(--g400);width:13px;text-align:center}
.lote-footer{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:12px}
.price-lbl{font-size:10px;color:var(--hint)}
.price-val{font-size:20px;font-weight:500;color:var(--g600)}
.price-unit{font-size:10px;color:var(--hint)}
.lote-actions{display:grid;grid-template-columns:1fr 1fr 1fr;gap:6px}
.btn-act{display:flex;align-items:center;justify-content:center;gap:5px;padding:7px 4px;border-radius:8px;font-size:11px;font-weight:500;text-decoration:none;border:none;cursor:pointer;transition:background 0.15s;font-family:inherit}
.btn-act i{font-size:12px}
.btn-qr{background:#f4f0e8;color:#5a4020}
.btn-qr:hover{background:#ebe4d4}
.btn-edit{background:var(--g50);color:var(--g700)}
.btn-edit:hover{background:var(--g100)}
.btn-see{background:var(--g700);color:#fff}
.btn-see:hover{background:var(--g800)}

/* EMPTY */
.empty{background:var(--white);border:0.5px solid var(--border);border-radius:14px;padding:52px 20px;text-align:center;margin-bottom:22px}
.empty i{font-size:40px;color:var(--g300);display:block;margin-bottom:12px}
.empty-title{font-size:16px;font-weight:500;color:var(--text);margin-bottom:5px}
.empty-sub{font-size:13px;color:var(--muted);margin-bottom:18px}
.btn-empty{display:inline-flex;align-items:center;gap:7px;padding:10px 20px;border-radius:10px;background:var(--g600);color:#fff;font-size:13px;font-weight:500;text-decoration:none;transition:all 0.15s}
.btn-empty:hover{background:var(--g700);transform:translateY(-1px)}

/* GUIDE */
.guide{background:var(--white);border:0.5px solid var(--border);border-radius:14px;padding:22px 24px}
.guide-title{font-size:15px;font-weight:500;color:var(--text);display:flex;align-items:center;gap:8px;margin-bottom:18px}
.guide-title i{font-size:17px;color:var(--amber)}
.guide-steps{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
.guide-step{display:flex;gap:12px;align-items:flex-start}
.step-num{width:32px;height:32px;border-radius:50%;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:500}
.sn1{background:var(--g100);color:var(--g700)}
.sn2{background:#eeedfe;color:#534ab7}
.sn3{background:var(--amber-bg);color:var(--amber)}
.step-title{font-size:13px;font-weight:500;color:var(--text);margin-bottom:3px}
.step-desc{font-size:12px;color:var(--muted);line-height:1.6}

@media(max-width:900px){
  .stats{grid-template-columns:repeat(2,1fr)}
  .lotes-grid{grid-template-columns:repeat(2,1fr)}
}
@media(max-width:600px){
  .nav-links,.nav-username,.nav-cta{display:none}
  .mobile-nav{display:block}
  .main{padding:16px}
  .banner{padding:16px 20px}
  .stats{grid-template-columns:repeat(2,1fr);gap:9px}
  .lotes-grid{grid-template-columns:1fr}
  .guide-steps{grid-template-columns:1fr}
}
</style>

<div>

{{-- NAV --}}
<nav class="nav">
  <div class="nav-brand">
    <div class="nav-logo">
      <img src="{{ asset('images/logo-cafetrace.png') }}" alt="CaféTrace">
    </div>
    <div>
      <div class="nav-name">CaféTrace</div>
      <div class="nav-sub">Panel caficultor</div>
    </div>
  </div>

  <div class="nav-links">
    <a href="{{ route('caficultor.dashboard') }}" class="nav-link active">
      <i class="fas fa-th-large"></i> Inicio
    </a>
    <a href="{{ route('caficultor.dashboard') }}" class="nav-link">
      <i class="fas fa-coffee"></i> Mis lotes
    </a>
    <a href="{{ route('caficultor.mis-ventas') }}" class="nav-link">
      <i class="fas fa-chart-bar"></i> Mis ventas
    </a>
  </div>

  <div class="nav-right">
    <a href="{{ route('caficultor.lotes.crear') }}" class="nav-cta">
      <i class="fas fa-plus"></i> Nuevo lote
    </a>
    <div style="display:flex;align-items:center;gap:8px;margin-left:6px">
      <div class="nav-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
      <span class="nav-username">{{ auth()->user()->name }}</span>
    </div>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="btn-logout">
        <i class="fas fa-sign-out-alt"></i> Salir
      </button>
    </form>
  </div>
</nav>

{{-- MOBILE NAV --}}
<div class="mobile-nav">
  <div class="mobile-nav-inner">
    <a href="{{ route('caficultor.dashboard') }}" class="mobile-link active">
      <i class="fas fa-th-large"></i><span>Inicio</span>
    </a>
    <a href="{{ route('caficultor.dashboard') }}" class="mobile-link">
      <i class="fas fa-coffee"></i><span>Mis lotes</span>
    </a>
    <a href="{{ route('caficultor.mis-ventas') }}" class="mobile-link">
      <i class="fas fa-chart-bar"></i><span>Ventas</span>
    </a>
    <a href="{{ route('caficultor.lotes.crear') }}" class="mobile-link">
      <i class="fas fa-plus"></i><span>Nuevo</span>
    </a>
  </div>
</div>

{{-- BANNER --}}
<div class="banner">
  <div>
    <div class="banner-greeting">
      Buenos días, <span>{{ auth()->user()->name }}</span>
    </div>
    <div class="banner-sub">Gestiona tus lotes y conecta con compradores directamente</div>
  </div>
  <a href="{{ route('caficultor.lotes.crear') }}" class="banner-btn">
    <i class="fas fa-plus"></i> Registrar nuevo lote
  </a>
</div>

<div class="main">

  {{-- ALERT --}}
  @if(session('success'))
    <div class="alert-success">
      <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
  @endif

  {{-- STATS --}}
  <div class="stats">
    <div class="stat">
      <div class="stat-top">
        <div class="stat-icon green"><i class="fas fa-coffee"></i></div>
      </div>
      <div>
        <div class="stat-val">{{ $totalLotes }}</div>
        <div class="stat-label">Total lotes</div>
      </div>
    </div>
    <div class="stat">
      <div class="stat-top">
        <div class="stat-icon purple"><i class="fas fa-weight"></i></div>
      </div>
      <div>
        <div class="stat-val">{{ number_format($kgDisponibles, 0) }}</div>
        <div class="stat-label">Kg disponibles</div>
      </div>
    </div>
    <div class="stat">
      <div class="stat-top">
        <div class="stat-icon amber"><i class="fas fa-chart-line"></i></div>
      </div>
      <div>
        <div class="stat-val">{{ $totalVentas }}</div>
        <div class="stat-label">Total ventas</div>
      </div>
    </div>
    <div class="stat">
      <div class="stat-top">
        <div class="stat-icon teal"><i class="fas fa-dollar-sign"></i></div>
      </div>
      <div>
        <div class="stat-val" style="font-size:20px">${{ number_format($ingresosNetos, 0) }}</div>
        <div class="stat-label">Ingresos netos</div>
      </div>
    </div>
  </div>

  {{-- LOTES RECIENTES --}}
  <div class="section-hdr">
    <div class="section-title">
      <i class="fas fa-coffee"></i> Mis lotes recientes
    </div>
    <a href="{{ route('caficultor.dashboard') }}" class="section-link">
      Ver todos <i class="fas fa-arrow-right" style="font-size:12px"></i>
    </a>
  </div>

  @if($lotesRecientes->count() > 0)
    <div class="lotes-grid">
      @foreach($lotesRecientes as $lote)
        <div class="lote-card">

          {{-- IMAGEN --}}
          <div class="lote-img">
            @if($lote->imagenes->first())
              <img src="{{ asset('storage/' . $lote->imagenes->first()->ruta_imagen) }}"
                   alt="{{ $lote->codigo_lote }}">
            @else
              <div class="lote-img-ph">
                <i class="fas fa-coffee"></i>
              </div>
            @endif

            <span class="badge-estado est-{{ $lote->estado }}">
              {{ ucfirst($lote->estado) }}
            </span>

            @if($lote->es_organico)
              <span class="badge-organico">
                <i class="fas fa-leaf"></i> Orgánico
              </span>
            @endif
          </div>

          {{-- BODY --}}
          <div class="lote-body">
            <div class="lote-meta">
              <span class="lote-code">{{ $lote->codigo_lote }}</span>
              @if($lote->puntaje_calidad)
                <span class="lote-score">
                  <i class="fas fa-star"></i> {{ $lote->puntaje_calidad }}/100
                </span>
              @endif
            </div>

            <div class="lote-variedad">{{ $lote->variedad }}</div>

            <div class="lote-details">
              <div class="lote-detail">
                <i class="fas fa-weight-hanging"></i>
                {{ number_format($lote->peso_disponible, 0) }} kg disponibles
              </div>
              <div class="lote-detail">
                <i class="fas fa-mountain"></i>
                {{ number_format($lote->altura_msnm, 0) }} msnm
              </div>
              <div class="lote-detail">
                <i class="fas fa-calendar"></i>
                {{ $lote->fecha_cosecha->format('d/m/Y') }}
              </div>
            </div>

            <div class="lote-footer">
              <div>
                <div class="price-lbl">Precio por kg</div>
                <div class="price-val">
                  ${{ number_format($lote->precio_por_kg, 0) }}
                  <span class="price-unit">COP</span>
                </div>
              </div>
            </div>

            <div class="lote-actions">
              <a href="{{ route('caficultor.lotes.qr', $lote->id) }}" class="btn-act btn-qr">
                <i class="fas fa-qrcode"></i> QR
              </a>
              <a href="{{ route('caficultor.lotes.editar', $lote->id) }}" class="btn-act btn-edit">
                <i class="fas fa-edit"></i> Editar
              </a>
              <a href="{{ route('caficultor.lotes.ver', $lote->id) }}" class="btn-act btn-see">
                <i class="fas fa-eye"></i> Ver
              </a>
            </div>
          </div>

        </div>
      @endforeach
    </div>

  @else
    <div class="empty">
      <i class="fas fa-coffee"></i>
      <div class="empty-title">Aún no has registrado lotes</div>
      <div class="empty-sub">Comienza registrando tu primer lote de café</div>
      <a href="{{ route('caficultor.lotes.crear') }}" class="btn-empty">
        <i class="fas fa-plus"></i> Registrar primer lote
      </a>
    </div>
  @endif

  {{-- GUÍA --}}
  <div class="guide">
    <div class="guide-title">
      <i class="fas fa-lightbulb"></i> Guía rápida
    </div>
    <div class="guide-steps">
      <div class="guide-step">
        <div class="step-num sn1">1</div>
        <div>
          <div class="step-title">Registra tu lote</div>
          <div class="step-desc">Ingresa peso, variedad, altura y sube fotos del proceso de beneficio.</div>
        </div>
      </div>
      <div class="guide-step">
        <div class="step-num sn2">2</div>
        <div>
          <div class="step-title">Código QR automático</div>
          <div class="step-desc">El sistema genera un QR único con trazabilidad completa en blockchain.</div>
        </div>
      </div>
      <div class="guide-step">
        <div class="step-num sn3">3</div>
        <div>
          <div class="step-title">Recibe pedidos</div>
          <div class="step-desc">Compradores verán tu lote y realizarán pedidos directamente.</div>
        </div>
      </div>
    </div>
  </div>

</div>
</div>

{{-- CAFÉBOT --}}
<style>
.cb-fab{position:fixed;bottom:28px;left:28px;width:54px;height:54px;border-radius:50%;background:linear-gradient(135deg,#1a4a14,#3d9e2a);color:#fff;border:none;cursor:pointer;box-shadow:0 4px 18px rgba(26,74,20,0.45);z-index:500;display:flex;align-items:center;justify-content:center;transition:transform 0.2s,box-shadow 0.2s}
.cb-fab::before{content:'';position:absolute;inset:-5px;border-radius:50%;border:2px solid rgba(61,158,42,0.45);animation:cbRing 2.4s ease-out infinite;pointer-events:none}
@keyframes cbRing{0%{opacity:.9;transform:scale(1)}65%{opacity:0;transform:scale(1.18)}100%{opacity:0;transform:scale(1.18)}}
.cb-fab:hover{transform:translateY(-3px);box-shadow:0 8px 26px rgba(26,74,20,0.55)}
.cb-panel{position:fixed;bottom:94px;left:28px;width:320px;height:420px;background:#fff;border-radius:18px;box-shadow:0 10px 40px rgba(0,0,0,0.18);z-index:500;flex-direction:column;overflow:hidden;animation:cbSlide 0.25s ease;display:none}
@keyframes cbSlide{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
.cb-header{background:linear-gradient(135deg,#1a4a14,#3d9e2a);padding:12px 16px;display:flex;justify-content:space-between;align-items:center;flex-shrink:0}
.cb-hinfo{display:flex;align-items:center;gap:10px}
.cb-avatar{width:34px;height:34px;border-radius:50%;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.cb-name{color:#fff;font-size:13px;font-weight:600}
.cb-status{font-size:10px;color:rgba(255,255,255,0.75);display:flex;align-items:center;gap:4px}
.cb-dot{width:6px;height:6px;border-radius:50%;background:#86efac;animation:cbPulse 2s infinite}
@keyframes cbPulse{0%,100%{opacity:1}50%{opacity:.35}}
.cb-close{background:rgba(255,255,255,0.2);border:none;color:#fff;width:28px;height:28px;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:13px}
.cb-close:hover{background:rgba(255,255,255,0.35)}
.cb-msgs{flex:1;padding:12px;overflow-y:auto;display:flex;flex-direction:column;gap:8px;background:#f4fbee}
.cb-msg{display:flex}
.cb-msg.bot{justify-content:flex-start}
.cb-msg.user{justify-content:flex-end}
.cb-bubble{max-width:82%;padding:9px 12px;border-radius:14px;font-size:12.5px;line-height:1.5}
.cb-msg.bot .cb-bubble{background:#fff;color:#1a2416;border:0.5px solid #e4e8df;border-bottom-left-radius:4px}
.cb-msg.user .cb-bubble{background:linear-gradient(135deg,#246019,#3d9e2a);color:#fff;border-bottom-right-radius:4px}
.cb-typing .cb-bubble{display:flex;gap:4px;align-items:center;padding:11px 14px}
.cb-typing span{width:6px;height:6px;border-radius:50%;background:#9aac8e;animation:cbT 1.2s infinite}
.cb-typing span:nth-child(2){animation-delay:.2s}
.cb-typing span:nth-child(3){animation-delay:.4s}
@keyframes cbT{0%,80%,100%{transform:scale(.8);opacity:.5}40%{transform:scale(1.2);opacity:1}}
.cb-footer{display:flex;gap:7px;padding:10px 12px;border-top:0.5px solid #e4e8df;background:#fff;flex-shrink:0}
.cb-input{flex:1;padding:8px 11px;border:1px solid #e4e8df;border-radius:9px;font-size:12.5px;outline:none;font-family:inherit;color:#1a2416}
.cb-input:focus{border-color:#3d9e2a}
.cb-send{width:34px;height:34px;border-radius:9px;background:linear-gradient(135deg,#246019,#3d9e2a);border:none;color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.cb-send:hover{opacity:.85}
@media(max-width:600px){.cb-panel{width:calc(100vw - 40px);left:20px}}
</style>

<button id="cbFab" class="cb-fab" aria-label="CaféBot - Asistente IA">
  <svg viewBox="0 0 24 24" fill="currentColor" width="22" height="22">
    <path d="M12 2a2 2 0 110 4 2 2 0 010-4zm5 7H7a1 1 0 00-1 1v5a1 1 0 001 1h1v3l3-3h4a1 1 0 001-1v-5a1 1 0 00-1-1zm-8 2h6v1H9v-1zm6 3H9v-1h6v1z"/>
  </svg>
</button>

<div id="cbPanel" class="cb-panel">
  <div class="cb-header">
    <div class="cb-hinfo">
      <div class="cb-avatar">
        <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18">
          <path d="M12 2a2 2 0 110 4 2 2 0 010-4zm5 7H7a1 1 0 00-1 1v5a1 1 0 001 1h1v3l3-3h4a1 1 0 001-1v-5a1 1 0 00-1-1z"/>
        </svg>
      </div>
      <div>
        <div class="cb-name">CaféBot</div>
        <div class="cb-status"><span class="cb-dot"></span> Asistente IA</div>
      </div>
    </div>
    <button id="cbClose" class="cb-close">✕</button>
  </div>
  <div id="cbMsgs" class="cb-msgs">
    <div class="cb-msg bot"><div class="cb-bubble">¡Hola! Soy CaféBot. Te ayudo con precios de mercado, técnicas de cultivo, cómo mejorar la calidad de tu café y más. ¿En qué te ayudo?</div></div>
  </div>
  <div class="cb-footer">
    <input id="cbInput" class="cb-input" type="text" placeholder="Pregunta sobre tu café..." maxlength="500">
    <button id="cbSend" class="cb-send">
      <svg viewBox="0 0 24 24" fill="currentColor" width="14" height="14"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
    </button>
  </div>
</div>

<script>
(function(){
  const fab=document.getElementById('cbFab'),panel=document.getElementById('cbPanel'),close=document.getElementById('cbClose'),input=document.getElementById('cbInput'),send=document.getElementById('cbSend'),msgs=document.getElementById('cbMsgs');
  let open=false;
  function toggle(){open=!open;panel.style.display=open?'flex':'none';if(open){panel.style.flexDirection='column';input.focus();}}
  function addMsg(t,tp){const d=document.createElement('div');d.className='cb-msg '+tp;d.innerHTML='<div class="cb-bubble">'+t.replace(/\n/g,'<br>')+'</div>';msgs.appendChild(d);msgs.scrollTop=msgs.scrollHeight;return d;}
  function addTyping(){const d=document.createElement('div');d.className='cb-msg bot cb-typing';d.innerHTML='<div class="cb-bubble"><span></span><span></span><span></span></div>';msgs.appendChild(d);msgs.scrollTop=msgs.scrollHeight;return d;}
  async function sendMsg(){const t=input.value.trim();if(!t||input.disabled)return;input.value='';input.disabled=true;send.disabled=true;addMsg(t,'user');const ty=addTyping();try{const r=await fetch('{{ route("asistente.chat") }}',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},body:JSON.stringify({message:t,context:'caficultor'})});const d=await r.json();ty.remove();addMsg(d.reply||'Sin respuesta.','bot');}catch(e){ty.remove();addMsg('Error de conexión.','bot');}input.disabled=false;send.disabled=false;input.focus();}
  fab.addEventListener('click',toggle);close.addEventListener('click',toggle);send.addEventListener('click',sendMsg);input.addEventListener('keydown',e=>{if(e.key==='Enter')sendMsg();});
})();
</script>
@endsection