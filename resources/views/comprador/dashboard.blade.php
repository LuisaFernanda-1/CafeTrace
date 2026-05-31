@extends('layouts.app')

@section('title', 'Dashboard Comprador')

@section('content')
<style>
*{box-sizing:border-box;margin:0;padding:0}
:root{
  --a900:#4a1a00;--a800:#6b2800;--a700:#8b3a00;--a600:#b45309;--a500:#d97706;
  --a400:#f59e0b;--a300:#fbbf24;--a100:#fef3c7;--a50:#fffbf0;
  --cream:#fafaf7;--white:#fff;--border:#e8e0d0;
  --text:#1a1208;--muted:#6b5a3e;--hint:#a89a7c;
}
body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;background:var(--cream);color:var(--text)}
.nav{background:var(--a800);height:60px;padding:0 28px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid rgba(255,255,255,0.07)}
.nav-brand{display:flex;align-items:center;gap:11px}
.nav-logo{width:36px;height:36px;border-radius:50%;border:1.5px solid rgba(255,255,255,0.2);background:rgba(255,255,255,0.1);overflow:hidden;display:flex;align-items:center;justify-content:center}
.nav-logo img{width:100%;height:100%;object-fit:cover}
.nav-name{font-size:15px;font-weight:500;color:#fff}
.nav-sub{font-size:10px;color:rgba(255,255,255,0.4);letter-spacing:1.5px;text-transform:uppercase}
.nav-links{display:flex;gap:3px}
.nav-link{display:flex;align-items:center;gap:7px;padding:7px 14px;border-radius:8px;font-size:13px;color:rgba(255,255,255,0.6);text-decoration:none;transition:all 0.15s}
.nav-link:hover{background:rgba(255,255,255,0.07);color:#fff}
.nav-link.active{background:rgba(251,191,36,0.15);color:var(--a300)}
.nav-link i{font-size:15px}
.nav-right{display:flex;align-items:center;gap:9px}
.nav-avatar{width:32px;height:32px;border-radius:50%;background:var(--a600);border:1.5px solid rgba(251,191,36,0.3);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:500;color:#fff}
.nav-username{font-size:13px;color:rgba(255,255,255,0.65)}
.nav-cart{position:relative;display:flex;align-items:center;gap:6px;padding:8px 16px;border-radius:9px;background:rgba(251,191,36,0.15);color:var(--a300);font-size:13px;font-weight:500;text-decoration:none;transition:all 0.15s}
.nav-cart:hover{background:rgba(251,191,36,0.25)}
.cart-badge{position:absolute;top:-6px;right:-6px;background:#dc2626;color:#fff;font-size:10px;font-weight:600;width:18px;height:18px;border-radius:50%;display:flex;align-items:center;justify-content:center}
.btn-logout{display:flex;align-items:center;gap:6px;padding:7px 12px;border-radius:8px;border:1px solid rgba(255,255,255,0.15);background:transparent;color:rgba(255,255,255,0.55);font-size:12px;cursor:pointer;transition:all 0.15s;font-family:inherit}
.btn-logout:hover{background:rgba(255,255,255,0.07);color:#fff}
.mobile-nav{display:none;background:var(--a800);border-top:1px solid rgba(255,255,255,0.07);padding:10px 20px}
.mobile-nav-inner{display:flex;justify-content:space-around}
.mobile-link{display:flex;flex-direction:column;align-items:center;gap:4px;color:rgba(255,255,255,0.5);font-size:11px;text-decoration:none;position:relative}
.mobile-link i{font-size:20px}
.mobile-link.active{color:var(--a300)}
.mobile-badge{position:absolute;top:-4px;right:-8px;background:#dc2626;color:#fff;font-size:9px;font-weight:600;width:16px;height:16px;border-radius:50%;display:flex;align-items:center;justify-content:center}
/* BANNER */
.banner{background:var(--a700);padding:20px 28px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;border-bottom:1px solid rgba(255,255,255,0.06)}
.banner-greeting{font-size:19px;font-weight:500;color:#fff;margin-bottom:2px}
.banner-greeting span{color:var(--a300)}
.banner-sub{font-size:13px;color:rgba(255,255,255,0.5)}
.banner-btn{display:flex;align-items:center;gap:8px;padding:11px 20px;border-radius:10px;background:var(--a300);color:var(--a900);font-size:13px;font-weight:500;text-decoration:none;transition:all 0.15s;flex-shrink:0}
.banner-btn:hover{background:#fcd34d;transform:translateY(-1px)}
/* MAIN */
.main{padding:24px 28px}
.alert-success{background:#f0fdf4;border:1px solid #bbf7d0;color:#14532d;padding:12px 16px;border-radius:10px;font-size:13px;margin-bottom:20px;display:flex;align-items:center;gap:8px}
/* STATS */
.stats{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:22px}
.stat{background:var(--white);border:0.5px solid var(--border);border-radius:12px;padding:18px 20px;display:flex;flex-direction:column;gap:10px}
.stat-top{display:flex;align-items:flex-start;justify-content:space-between}
.stat-icon{width:38px;height:38px;border-radius:10px;display:flex;align-items:center;justify-content:center}
.stat-icon i{font-size:19px}
.si-green{background:#eaf3de;color:#3b6d11}
.si-blue{background:#e6f1fb;color:#185fa5}
.si-purple{background:#eeedfe;color:#534ab7}
.si-amber{background:var(--a100);color:var(--a600)}
.stat-val{font-size:26px;font-weight:500;color:var(--text);line-height:1}
.stat-label{font-size:12px;color:var(--muted);margin-top:2px}
/* SECTION */
.section-hdr{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px}
.section-title{font-size:15px;font-weight:500;color:var(--text);display:flex;align-items:center;gap:8px}
.section-title i{font-size:17px;color:var(--a500)}
.section-link{font-size:12px;color:var(--a600);display:flex;align-items:center;gap:4px;text-decoration:none}
.section-link:hover{color:var(--a700)}
/* LOTES GRID */
.lotes-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:22px}
.lote-card{background:var(--white);border:0.5px solid var(--border);border-radius:14px;overflow:hidden;transition:all 0.18s}
.lote-card:hover{box-shadow:0 6px 24px rgba(0,0,0,0.07);transform:translateY(-2px)}
.lote-img{height:140px;position:relative;overflow:hidden;background:linear-gradient(135deg,var(--a600),var(--a900));display:flex;align-items:center;justify-content:center}
.lote-img img{width:100%;height:100%;object-fit:cover;position:absolute;inset:0}
.lote-img i{font-size:40px;color:rgba(255,255,255,0.18)}
.badge-org{position:absolute;top:9px;left:9px;background:rgba(10,50,5,0.82);color:#8dd468;font-size:10px;padding:3px 9px;border-radius:20px;display:flex;align-items:center;gap:4px}
.badge-justo{position:absolute;top:9px;left:9px;background:rgba(20,40,100,0.82);color:#b5d4f4;font-size:10px;padding:3px 9px;border-radius:20px;margin-top:26px}
.lote-body{padding:14px 16px}
.lote-meta{display:flex;justify-content:space-between;align-items:center;margin-bottom:5px}
.lote-code{font-size:10px;color:var(--hint);text-transform:uppercase;letter-spacing:0.8px}
.lote-score{font-size:11px;color:var(--a500);display:flex;align-items:center;gap:3px}
.lote-variedad{font-size:14px;font-weight:500;color:var(--text);margin-bottom:4px}
.lote-producer{font-size:11px;color:var(--muted);display:flex;align-items:center;gap:4px;margin-bottom:10px;padding-bottom:10px;border-bottom:0.5px solid var(--border)}
.lote-producer i{font-size:11px;color:var(--a500)}
.lote-details{display:flex;flex-direction:column;gap:4px;margin-bottom:12px}
.lote-detail{display:flex;align-items:center;gap:6px;font-size:11px;color:var(--muted)}
.lote-detail i{font-size:12px;color:var(--a400);width:13px;text-align:center}
.lote-footer{display:flex;align-items:center;justify-content:space-between;padding-top:12px;border-top:0.5px solid var(--border)}
.price-lbl{font-size:10px;color:var(--hint)}
.price-val{font-size:18px;font-weight:500;color:var(--a600)}
.btn-ver{display:flex;align-items:center;gap:5px;padding:8px 14px;border-radius:9px;background:var(--a700);color:#fff;font-size:12px;font-weight:500;text-decoration:none;transition:background 0.15s}
.btn-ver:hover{background:var(--a800)}
/* EMPTY */
.empty-card{background:var(--white);border:0.5px solid var(--border);border-radius:14px;padding:40px 20px;text-align:center;margin-bottom:22px}
.empty-card i{font-size:40px;color:var(--a300);display:block;margin-bottom:10px}
.empty-card p{font-size:13px;color:var(--muted)}
/* VENTAJAS */
.ventajas{background:var(--white);border:0.5px solid var(--border);border-radius:14px;padding:22px 24px}
.ventajas-title{font-size:15px;font-weight:500;color:var(--text);display:flex;align-items:center;gap:8px;margin-bottom:18px}
.ventajas-title i{color:var(--a500)}
.ventajas-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
.ventaja{display:flex;gap:12px;align-items:flex-start}
.ventaja-num{width:32px;height:32px;border-radius:50%;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:14px}
.vn1{background:var(--a100);color:var(--a700)}
.vn2{background:#eaf3de;color:#3b6d11}
.vn3{background:#eeedfe;color:#534ab7}
.ventaja-title{font-size:13px;font-weight:500;color:var(--text);margin-bottom:3px}
.ventaja-desc{font-size:12px;color:var(--muted);line-height:1.6}
@media(max-width:900px){.stats{grid-template-columns:repeat(2,1fr)}.lotes-grid{grid-template-columns:repeat(2,1fr)}.ventajas-grid{grid-template-columns:1fr}}
@media(max-width:600px){.nav-links,.nav-username,.nav-cart{display:none}.mobile-nav{display:block}.main{padding:16px}.banner{padding:14px 20px}.stats{grid-template-columns:repeat(2,1fr);gap:9px}.lotes-grid{grid-template-columns:1fr}}
</style>

<div>
<nav class="nav">
  <div class="nav-brand">
    <div class="nav-logo"><img src="{{ asset('images/logo-cafetrace.png') }}" alt="CaféTrace"></div>
    <div><div class="nav-name">CaféTrace</div><div class="nav-sub">Panel comprador</div></div>
  </div>
  <div class="nav-links">
    <a href="{{ route('comprador.dashboard') }}" class="nav-link active"><i class="fas fa-th-large"></i> Inicio</a>
    <a href="{{ route('comprador.marketplace') }}" class="nav-link"><i class="fas fa-store"></i> Marketplace</a>
    <a href="{{ route('comprador.mis-compras') }}" class="nav-link"><i class="fas fa-shopping-bag"></i> Mis compras</a>
  </div>
  <div class="nav-right">
    <a href="{{ route('comprador.carrito') }}" class="nav-cart">
      <i class="fas fa-shopping-cart"></i> Carrito
      @if($itemsCarrito > 0)<span class="cart-badge">{{ $itemsCarrito }}</span>@endif
    </a>
    <div style="display:flex;align-items:center;gap:8px;margin-left:4px">
      <div class="nav-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
      <span class="nav-username">{{ auth()->user()->name }}</span>
    </div>
    <form method="POST" action="{{ route('logout') }}">@csrf
      <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Salir</button>
    </form>
  </div>
</nav>
<div class="mobile-nav"><div class="mobile-nav-inner">
  <a href="{{ route('comprador.dashboard') }}" class="mobile-link active"><i class="fas fa-th-large"></i><span>Inicio</span></a>
  <a href="{{ route('comprador.marketplace') }}" class="mobile-link"><i class="fas fa-store"></i><span>Marketplace</span></a>
  <a href="{{ route('comprador.mis-compras') }}" class="mobile-link"><i class="fas fa-shopping-bag"></i><span>Compras</span></a>
  <a href="{{ route('comprador.carrito') }}" class="mobile-link">
    <i class="fas fa-shopping-cart"></i><span>Carrito</span>
    @if($itemsCarrito > 0)<span class="mobile-badge">{{ $itemsCarrito }}</span>@endif
  </a>
</div></div>

<div class="banner">
  <div>
    <div class="banner-greeting">Buenos días, <span>{{ auth()->user()->name }}</span></div>
    <div class="banner-sub">Encuentra el mejor café colombiano con trazabilidad verificada</div>
  </div>
  <a href="{{ route('comprador.marketplace') }}" class="banner-btn"><i class="fas fa-store"></i> Explorar marketplace</a>
</div>

<div class="main">
  @if(session('success'))<div class="alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>@endif

  <div class="stats">
    <div class="stat">
      <div class="stat-top"><div class="stat-icon si-green"><i class="fas fa-shopping-bag"></i></div></div>
      <div><div class="stat-val">{{ $totalCompras }}</div><div class="stat-label">Total compras</div></div>
    </div>
    <div class="stat">
      <div class="stat-top"><div class="stat-icon si-blue"><i class="fas fa-weight"></i></div></div>
      <div><div class="stat-val">{{ number_format($kgComprados, 0) }}</div><div class="stat-label">Kg comprados</div></div>
    </div>
    <div class="stat">
      <div class="stat-top"><div class="stat-icon si-purple"><i class="fas fa-dollar-sign"></i></div></div>
      <div><div class="stat-val" style="font-size:20px">${{ number_format($totalGastado, 0) }}</div><div class="stat-label">Total gastado</div></div>
    </div>
    <div class="stat">
      <div class="stat-top"><div class="stat-icon si-amber"><i class="fas fa-shopping-cart"></i></div></div>
      <div><div class="stat-val">{{ $itemsCarrito }}</div><div class="stat-label">En carrito</div></div>
    </div>
  </div>

  <div class="section-hdr">
    <div class="section-title"><i class="fas fa-star"></i> Lotes destacados</div>
    <a href="{{ route('comprador.marketplace') }}" class="section-link">Ver todos <i class="fas fa-arrow-right" style="font-size:12px"></i></a>
  </div>

  @if($lotesDestacados->count() > 0)
    <div class="lotes-grid">
      @foreach($lotesDestacados as $lote)
      <div class="lote-card">
        <div class="lote-img">
          @if($lote->imagenes->first())
            <img src="{{ asset('storage/' . $lote->imagenes->first()->ruta_imagen) }}" alt="{{ $lote->codigo_lote }}">
          @else
            <i class="fas fa-coffee"></i>
          @endif
          @if($lote->es_organico)<span class="badge-org"><i class="fas fa-leaf"></i> Orgánico</span>@endif
        </div>
        <div class="lote-body">
          <div class="lote-meta">
            <span class="lote-code">{{ $lote->codigo_lote }}</span>
            @if($lote->puntaje_calidad)<span class="lote-score"><i class="fas fa-star"></i> {{ $lote->puntaje_calidad }}/100</span>@endif
          </div>
          <div class="lote-variedad">{{ $lote->variedad }}</div>
          <div class="lote-producer"><i class="fas fa-user"></i> {{ $lote->caficultor->name }}</div>
          <div class="lote-details">
            <div class="lote-detail"><i class="fas fa-weight-hanging"></i> {{ number_format($lote->peso_disponible, 0) }} kg disponibles</div>
            <div class="lote-detail"><i class="fas fa-mountain"></i> {{ number_format($lote->altura_msnm, 0) }} msnm</div>
          </div>
          <div class="lote-footer">
            <div><div class="price-lbl">Precio por kg</div><div class="price-val">${{ number_format($lote->precio_por_kg, 0) }}</div></div>
            <a href="{{ route('comprador.lote.ver', $lote->id) }}" class="btn-ver"><i class="fas fa-eye"></i> Ver</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  @else
    <div class="empty-card">
      <i class="fas fa-coffee"></i>
      <p>No hay lotes disponibles por ahora. Revisa más tarde.</p>
    </div>
  @endif

  <div class="ventajas">
    <div class="ventajas-title"><i class="fas fa-shield-alt"></i> ¿Por qué comprar en CaféTrace?</div>
    <div class="ventajas-grid">
      <div class="ventaja"><div class="ventaja-num vn1"><i class="fas fa-route"></i></div><div><div class="ventaja-title">Trazabilidad 100%</div><div class="ventaja-desc">Conoce el origen exacto de tu café, desde la finca hasta tu taza.</div></div></div>
      <div class="ventaja"><div class="ventaja-num vn2"><i class="fas fa-user-tie"></i></div><div><div class="ventaja-title">Directo del productor</div><div class="ventaja-desc">Compra directamente a caficultores colombianos sin intermediarios.</div></div></div>
      <div class="ventaja"><div class="ventaja-num vn3"><i class="fas fa-award"></i></div><div><div class="ventaja-title">Calidad verificada</div><div class="ventaja-desc">Café de alta calidad con información completa del proceso productivo.</div></div></div>
    </div>
  </div>
</div>
</div>

{{-- CAFÉBOT --}}
<style>
.cb-fab{position:fixed;bottom:28px;left:28px;width:54px;height:54px;border-radius:50%;background:linear-gradient(135deg,#6b2800,#d97706);color:#fff;border:none;cursor:pointer;box-shadow:0 4px 18px rgba(107,40,0,0.45);z-index:500;display:flex;align-items:center;justify-content:center;transition:transform 0.2s,box-shadow 0.2s}
.cb-fab::before{content:'';position:absolute;inset:-5px;border-radius:50%;border:2px solid rgba(217,119,6,0.45);animation:cbRing 2.4s ease-out infinite;pointer-events:none}
@keyframes cbRing{0%{opacity:.9;transform:scale(1)}65%{opacity:0;transform:scale(1.18)}100%{opacity:0;transform:scale(1.18)}}
.cb-fab:hover{transform:translateY(-3px);box-shadow:0 8px 26px rgba(107,40,0,0.55)}
.cb-panel{position:fixed;bottom:94px;left:28px;width:320px;height:420px;background:#fff;border-radius:18px;box-shadow:0 10px 40px rgba(0,0,0,0.18);z-index:500;flex-direction:column;overflow:hidden;animation:cbSlide 0.25s ease;display:none}
@keyframes cbSlide{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
.cb-header{background:linear-gradient(135deg,#6b2800,#d97706);padding:12px 16px;display:flex;justify-content:space-between;align-items:center;flex-shrink:0}
.cb-hinfo{display:flex;align-items:center;gap:10px}
.cb-avatar{width:34px;height:34px;border-radius:50%;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.cb-name{color:#fff;font-size:13px;font-weight:600}
.cb-status{font-size:10px;color:rgba(255,255,255,0.75);display:flex;align-items:center;gap:4px}
.cb-dot{width:6px;height:6px;border-radius:50%;background:#fbbf24;animation:cbPulse 2s infinite}
@keyframes cbPulse{0%,100%{opacity:1}50%{opacity:.35}}
.cb-close{background:rgba(255,255,255,0.2);border:none;color:#fff;width:28px;height:28px;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:13px}
.cb-close:hover{background:rgba(255,255,255,0.35)}
.cb-msgs{flex:1;padding:12px;overflow-y:auto;display:flex;flex-direction:column;gap:8px;background:#fffbf0}
.cb-msg{display:flex}
.cb-msg.bot{justify-content:flex-start}
.cb-msg.user{justify-content:flex-end}
.cb-bubble{max-width:82%;padding:9px 12px;border-radius:14px;font-size:12.5px;line-height:1.5}
.cb-msg.bot .cb-bubble{background:#fff;color:#1a1208;border:0.5px solid #e8e0d0;border-bottom-left-radius:4px}
.cb-msg.user .cb-bubble{background:linear-gradient(135deg,#b45309,#d97706);color:#fff;border-bottom-right-radius:4px}
.cb-typing .cb-bubble{display:flex;gap:4px;align-items:center;padding:11px 14px}
.cb-typing span{width:6px;height:6px;border-radius:50%;background:#a89a7c;animation:cbT 1.2s infinite}
.cb-typing span:nth-child(2){animation-delay:.2s}
.cb-typing span:nth-child(3){animation-delay:.4s}
@keyframes cbT{0%,80%,100%{transform:scale(.8);opacity:.5}40%{transform:scale(1.2);opacity:1}}
.cb-footer{display:flex;gap:7px;padding:10px 12px;border-top:0.5px solid #e8e0d0;background:#fff;flex-shrink:0}
.cb-input{flex:1;padding:8px 11px;border:1px solid #e8e0d0;border-radius:9px;font-size:12.5px;outline:none;font-family:inherit;color:#1a1208}
.cb-input:focus{border-color:#d97706}
.cb-send{width:34px;height:34px;border-radius:9px;background:linear-gradient(135deg,#b45309,#d97706);border:none;color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0}
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
    <div class="cb-msg bot"><div class="cb-bubble">¡Hola! Soy CaféBot. Te ayudo a entender los atributos del café, qué significa cada dato del lote, cómo leer la trazabilidad y más. ¿Qué quieres saber?</div></div>
  </div>
  <div class="cb-footer">
    <input id="cbInput" class="cb-input" type="text" placeholder="Pregunta sobre el café..." maxlength="500">
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
  async function sendMsg(){const t=input.value.trim();if(!t||input.disabled)return;input.value='';input.disabled=true;send.disabled=true;addMsg(t,'user');const ty=addTyping();try{const r=await fetch('{{ route("asistente.chat") }}',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},body:JSON.stringify({message:t,context:'comprador'})});const d=await r.json();ty.remove();addMsg(d.reply||'Sin respuesta.','bot');}catch(e){ty.remove();addMsg('Error de conexión.','bot');}input.disabled=false;send.disabled=false;input.focus();}
  fab.addEventListener('click',toggle);close.addEventListener('click',toggle);send.addEventListener('click',sendMsg);input.addEventListener('keydown',e=>{if(e.key==='Enter')sendMsg();});
})();
</script>
@endsection