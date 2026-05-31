@extends('layouts.app')

@section('title', 'Mis Ventas')

@section('content')
<style>
*{box-sizing:border-box;margin:0;padding:0}
:root{--g900:#0d2e0a;--g800:#1a4a14;--g700:#246019;--g600:#2d7a1f;--g500:#3d9e2a;--g400:#5ab83a;--g300:#8dd468;--g100:#e8f5e0;--g50:#f4fbee;--amber:#c47c0a;--amber-bg:#fef3d6;--cream:#fafaf7;--white:#ffffff;--border:#e4e8df;--text:#1a2416;--muted:#5a6e52;--hint:#9aac8e}
body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;background:var(--cream);color:var(--text)}
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
.nav-right{display:flex;align-items:center;gap:9px}
.nav-avatar{width:32px;height:32px;border-radius:50%;background:var(--g600);border:1.5px solid rgba(141,212,104,0.3);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:500;color:#fff}
.nav-username{font-size:13px;color:rgba(255,255,255,0.65)}
.btn-logout{display:flex;align-items:center;gap:6px;padding:7px 12px;border-radius:8px;border:1px solid rgba(255,255,255,0.15);background:transparent;color:rgba(255,255,255,0.55);font-size:12px;cursor:pointer;transition:all 0.15s;font-family:inherit}
.btn-logout:hover{background:rgba(255,255,255,0.07);color:#fff}
.mobile-nav{display:none;background:var(--g800);border-top:1px solid rgba(255,255,255,0.07);padding:10px 20px}
.mobile-nav-inner{display:flex;justify-content:space-around}
.mobile-link{display:flex;flex-direction:column;align-items:center;gap:4px;color:rgba(255,255,255,0.5);font-size:11px;text-decoration:none}
.mobile-link i{font-size:20px}
.mobile-link.active{color:var(--g300)}
.main{padding:24px 28px}
/* STATS */
.stats{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:22px}
.stat{background:var(--white);border:0.5px solid var(--border);border-radius:12px;padding:16px 18px;display:flex;align-items:center;gap:12px}
.stat-icon{width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.stat-icon i{font-size:18px}
.si-green{background:var(--g100);color:var(--g600)}
.si-blue{background:#e6f1fb;color:#185fa5}
.si-amber{background:var(--amber-bg);color:var(--amber)}
.si-purple{background:#eeedfe;color:#534ab7}
.stat-val{font-size:20px;font-weight:500;color:var(--text);line-height:1}
.stat-label{font-size:11px;color:var(--muted);margin-top:2px}
/* VENTAS */
.venta-card{background:var(--white);border:0.5px solid var(--border);border-radius:14px;padding:20px;margin-bottom:12px}
.venta-head{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:16px;flex-wrap:wrap;gap:8px}
.venta-codigo{font-size:14px;font-weight:500;color:var(--text)}
.venta-fecha{font-size:12px;color:var(--hint);margin-top:2px}
.estado-badge{font-size:11px;font-weight:500;padding:4px 12px;border-radius:20px}
.est-pendiente{background:#fef3d6;color:var(--amber)}
.est-confirmada{background:#e6f1fb;color:#185fa5}
.est-en_proceso{background:#eeedfe;color:#534ab7}
.est-completada{background:var(--g100);color:var(--g700)}
.est-cancelada{background:#fef2f2;color:#991b1b}
.venta-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:16px}
.venta-box{background:var(--cream);border:0.5px solid var(--border);border-radius:10px;padding:12px 14px}
.venta-box-title{font-size:12px;font-weight:500;color:var(--text);margin-bottom:8px}
.venta-box-name{font-size:13px;font-weight:500;color:var(--text)}
.venta-box-sub{font-size:11px;color:var(--muted);margin-top:2px;display:flex;align-items:center;gap:4px}
.venta-box-sub i{font-size:11px;color:var(--g400)}
/* FINANCIERO */
.fin-row{display:grid;grid-template-columns:repeat(5,1fr);gap:8px;padding-top:14px;border-top:0.5px solid var(--border)}
.fin-item{}
.fin-label{font-size:11px;color:var(--hint);margin-bottom:3px}
.fin-val{font-size:13px;font-weight:500;color:var(--text)}
.fin-val.red{color:#dc2626}
.fin-val.green{font-size:16px;color:var(--g600)}
/* NOTAS */
.notas{margin-top:12px;padding-top:12px;border-top:0.5px solid var(--border)}
.notas-label{font-size:11px;color:var(--hint);margin-bottom:4px}
.notas-text{font-size:12px;color:var(--muted);line-height:1.5}
/* EMPTY */
.empty{background:var(--white);border:0.5px solid var(--border);border-radius:14px;padding:52px 20px;text-align:center}
.empty i{font-size:40px;color:var(--g300);display:block;margin-bottom:12px}
.empty-title{font-size:16px;font-weight:500;color:var(--text);margin-bottom:5px}
.empty-sub{font-size:13px;color:var(--muted);margin-bottom:18px}
.btn-empty{display:inline-flex;align-items:center;gap:7px;padding:10px 20px;border-radius:10px;background:var(--g600);color:#fff;font-size:13px;font-weight:500;text-decoration:none;transition:all 0.15s}
.btn-empty:hover{background:var(--g700)}
.pagination-wrap{background:var(--white);border:0.5px solid var(--border);border-radius:12px;padding:14px 20px}
.alert-success{background:#f0fdf4;border:1px solid #bbf7d0;color:#14532d;padding:12px 16px;border-radius:10px;font-size:13px;margin-bottom:18px;display:flex;align-items:center;gap:8px}
/* TIMELINE */
.timeline{display:flex;align-items:flex-start;margin:14px 0 0;padding:14px 0 0;border-top:0.5px solid var(--border)}
.tl-step{flex:1;display:flex;flex-direction:column;align-items:center;position:relative;text-align:center}
.tl-step:not(:last-child)::after{content:'';position:absolute;top:10px;left:50%;width:100%;height:2px;background:var(--border);z-index:0}
.tl-step.done:not(:last-child)::after{background:var(--g400)}
.tl-dot{width:22px;height:22px;border-radius:50%;border:2px solid var(--border);background:var(--white);z-index:1;position:relative;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all 0.2s}
.tl-step.done .tl-dot{background:var(--g400);border-color:var(--g400);color:#fff}
.tl-step.current .tl-dot{border-color:var(--g500);background:var(--g100);box-shadow:0 0 0 4px rgba(61,158,42,0.15)}
.tl-dot i{font-size:9px}
.tl-label{font-size:10px;color:var(--hint);margin-top:5px;line-height:1.3;max-width:70px}
.tl-step.done .tl-label{color:var(--g600);font-weight:500}
.tl-step.current .tl-label{color:var(--text);font-weight:600}
.tl-cancelled{margin:12px 0 0;padding:10px 12px;background:#fef2f2;border-radius:8px;font-size:12px;color:#991b1b;border:1px solid #fecaca;display:flex;align-items:center;gap:6px}
/* ESTADO FORM */
.estado-form{margin-top:14px;padding-top:12px;border-top:0.5px solid var(--border);display:flex;gap:8px;flex-wrap:wrap;align-items:center}
.estado-form-label{font-size:11px;color:var(--hint);width:100%;margin-bottom:2px}
.btn-advance{padding:8px 15px;border-radius:9px;border:none;cursor:pointer;font-size:12px;font-weight:500;font-family:inherit;transition:all 0.15s;display:inline-flex;align-items:center;gap:6px}
.btn-confirm{background:#e6f1fb;color:#185fa5}.btn-confirm:hover{background:#185fa5;color:#fff}
.btn-process{background:#eeedfe;color:#534ab7}.btn-process:hover{background:#534ab7;color:#fff}
.btn-complete{background:var(--g100);color:var(--g700)}.btn-complete:hover{background:var(--g600);color:#fff}
.btn-cancel-estado{padding:8px 15px;border-radius:9px;border:none;cursor:pointer;font-size:12px;font-weight:500;font-family:inherit;transition:all 0.15s;background:#fef2f2;color:#991b1b;display:inline-flex;align-items:center;gap:6px}.btn-cancel-estado:hover{background:#dc2626;color:#fff}
/* CHAT WIDGET */
.chat-fab{position:fixed;bottom:28px;left:28px;width:52px;height:52px;border-radius:50%;background:linear-gradient(135deg,#1a4a14,#3d9e2a);color:#fff;border:none;cursor:pointer;font-size:20px;box-shadow:0 4px 18px rgba(0,0,0,0.25);z-index:200;transition:transform 0.2s,box-shadow 0.2s;display:flex;align-items:center;justify-content:center}
.chat-fab:hover{transform:translateY(-2px);box-shadow:0 8px 26px rgba(0,0,0,0.3)}
.chat-panel{position:fixed;bottom:90px;left:28px;width:330px;height:430px;background:#fff;border-radius:18px;box-shadow:0 10px 40px rgba(0,0,0,0.18);z-index:300;display:flex;flex-direction:column;overflow:hidden;animation:chatSlide 0.25s ease}
@keyframes chatSlide{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:translateY(0)}}
.chat-header{background:linear-gradient(135deg,#1a4a14,#3d9e2a);padding:13px 16px;display:flex;justify-content:space-between;align-items:center;flex-shrink:0}
.chat-header-info{display:flex;align-items:center;gap:10px}
.chat-avatar{width:34px;height:34px;border-radius:50%;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;color:#fff;font-size:15px;flex-shrink:0}
.chat-title{color:#fff;font-size:13px;font-weight:600}
.chat-status{display:flex;align-items:center;gap:5px;font-size:10px;color:rgba(255,255,255,0.75)}
.chat-dot{width:6px;height:6px;border-radius:50%;background:#86efac;animation:pulse 2s infinite}
@keyframes pulse{0%,100%{opacity:1}50%{opacity:.4}}
.chat-close{background:rgba(255,255,255,0.2);border:none;color:#fff;width:28px;height:28px;border-radius:50%;cursor:pointer;font-size:12px;display:flex;align-items:center;justify-content:center}
.chat-close:hover{background:rgba(255,255,255,0.35)}
.chat-messages{flex:1;padding:12px;overflow-y:auto;display:flex;flex-direction:column;gap:9px;background:#f4fbee}
.msg{display:flex}
.msg.bot{justify-content:flex-start}
.msg.user{justify-content:flex-end}
.msg-bubble{max-width:82%;padding:9px 13px;border-radius:14px;font-size:12.5px;line-height:1.5}
.msg.bot .msg-bubble{background:#fff;color:#1a2416;border:0.5px solid #e4e8df;border-bottom-left-radius:4px}
.msg.user .msg-bubble{background:linear-gradient(135deg,#246019,#3d9e2a);color:#fff;border-bottom-right-radius:4px}
.msg-typing .msg-bubble{display:flex;gap:4px;align-items:center;padding:12px 14px}
.msg-typing span{width:7px;height:7px;border-radius:50%;background:#9aac8e;animation:typing 1.2s infinite}
.msg-typing span:nth-child(2){animation-delay:.2s}
.msg-typing span:nth-child(3){animation-delay:.4s}
@keyframes typing{0%,80%,100%{transform:scale(.8);opacity:.5}40%{transform:scale(1.2);opacity:1}}
.chat-input-wrap{display:flex;gap:7px;padding:10px 12px;border-top:0.5px solid #e4e8df;background:#fff;flex-shrink:0}
.chat-input{flex:1;padding:8px 12px;border:1px solid #e4e8df;border-radius:9px;font-size:12.5px;outline:none;font-family:inherit;color:#1a2416}
.chat-input:focus{border-color:var(--g400)}
.chat-send{width:34px;height:34px;border-radius:9px;background:linear-gradient(135deg,#246019,#3d9e2a);border:none;color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:13px;flex-shrink:0}
.chat-send:hover{opacity:0.85}
@media(max-width:900px){.stats{grid-template-columns:repeat(2,1fr)}.fin-row{grid-template-columns:repeat(2,1fr)}.venta-grid{grid-template-columns:1fr}}
@media(max-width:600px){.nav-links,.nav-username{display:none}.mobile-nav{display:block}.main{padding:16px}.stats{grid-template-columns:repeat(2,1fr);gap:9px}.fin-row{grid-template-columns:1fr 1fr}.chat-panel{width:calc(100vw - 40px);left:20px}}
</style>

<div>
<nav class="nav">
  <div class="nav-brand">
    <div class="nav-logo"><img src="{{ asset('images/logo-cafetrace.png') }}" alt="CaféTrace"></div>
    <div><div class="nav-name">CaféTrace</div><div class="nav-sub">Panel caficultor</div></div>
  </div>
  <div class="nav-links">
    <a href="{{ route('caficultor.dashboard') }}" class="nav-link"><i class="fas fa-th-large"></i> Inicio</a>
    <a href="{{ route('caficultor.dashboard') }}" class="nav-link"><i class="fas fa-coffee"></i> Mis lotes</a>
    <a href="{{ route('caficultor.mis-ventas') }}" class="nav-link active"><i class="fas fa-chart-bar"></i> Mis ventas</a>
  </div>
  <div class="nav-right">
    <div style="display:flex;align-items:center;gap:8px">
      <div class="nav-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
      <span class="nav-username">{{ auth()->user()->name }}</span>
    </div>
    <form method="POST" action="{{ route('logout') }}">@csrf
      <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Salir</button>
    </form>
  </div>
</nav>
<div class="mobile-nav"><div class="mobile-nav-inner">
  <a href="{{ route('caficultor.dashboard') }}" class="mobile-link"><i class="fas fa-th-large"></i><span>Inicio</span></a>
  <a href="{{ route('caficultor.dashboard') }}" class="mobile-link"><i class="fas fa-coffee"></i><span>Mis lotes</span></a>
  <a href="{{ route('caficultor.mis-ventas') }}" class="mobile-link active"><i class="fas fa-chart-bar"></i><span>Ventas</span></a>
</div></div>

<div class="main">
  @if(session('success'))<div class="alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>@endif

  @if($ventas->count() > 0)
  <div class="stats">
    <div class="stat"><div class="stat-icon si-green"><i class="fas fa-weight"></i></div><div><div class="stat-val">{{ number_format($ventas->sum('cantidad_kg'), 0) }} kg</div><div class="stat-label">Total vendido</div></div></div>
    <div class="stat"><div class="stat-icon si-blue"><i class="fas fa-dollar-sign"></i></div><div><div class="stat-val">${{ number_format($ventas->sum('precio_total'), 0) }}</div><div class="stat-label">Ingresos totales</div></div></div>
    <div class="stat"><div class="stat-icon si-amber"><i class="fas fa-percent"></i></div><div><div class="stat-val">${{ number_format($ventas->sum('comision_plataforma'), 0) }}</div><div class="stat-label">Comisiones</div></div></div>
    <div class="stat"><div class="stat-icon si-purple"><i class="fas fa-wallet"></i></div><div><div class="stat-val">${{ number_format($ventas->sum('total_caficultor'), 0) }}</div><div class="stat-label">Total neto</div></div></div>
  </div>
  @endif

  @if($ventas->count() > 0)
    @foreach($ventas as $venta)
    <div class="venta-card">
      <div class="venta-head">
        <div>
          <div class="venta-codigo">{{ $venta->codigo_transaccion }}</div>
          <div class="venta-fecha">{{ $venta->created_at->format('d/m/Y H:i') }}</div>
        </div>
        <span class="estado-badge est-{{ $venta->estado }}">{{ ucfirst($venta->estado) }}</span>
      </div>
      <div class="venta-grid">
        <div class="venta-box">
          <div class="venta-box-title">Producto vendido</div>
          <div class="venta-box-name">{{ $venta->lote->variedad }}</div>
          <div class="venta-box-sub">{{ $venta->lote->codigo_lote }}</div>
          <div class="venta-box-sub"><i class="fas fa-weight-hanging"></i> {{ number_format($venta->cantidad_kg, 2) }} kg</div>
        </div>
        <div class="venta-box">
          <div class="venta-box-title">Comprador</div>
          <div class="venta-box-name">{{ $venta->comprador->name }}</div>
          @if($venta->comprador->telefono)<div class="venta-box-sub"><i class="fas fa-phone"></i> {{ $venta->comprador->telefono }}</div>@endif
          @if($venta->comprador->email)<div class="venta-box-sub"><i class="fas fa-envelope"></i> {{ $venta->comprador->email }}</div>@endif
        </div>
      </div>
      <div class="fin-row">
        <div class="fin-item"><div class="fin-label">Precio por kg</div><div class="fin-val">${{ number_format($venta->precio_por_kg, 0) }}</div></div>
        <div class="fin-item"><div class="fin-label">Cantidad</div><div class="fin-val">{{ number_format($venta->cantidad_kg, 2) }} kg</div></div>
        <div class="fin-item"><div class="fin-label">Subtotal</div><div class="fin-val">${{ number_format($venta->precio_total, 0) }}</div></div>
        <div class="fin-item"><div class="fin-label">Comisión (5%)</div><div class="fin-val red">-${{ number_format($venta->comision_plataforma, 0) }}</div></div>
        <div class="fin-item"><div class="fin-label">Tu ingreso</div><div class="fin-val green">${{ number_format($venta->total_caficultor, 0) }}</div></div>
      </div>
      @php
        $pasos = ['pendiente'=>'Pedido recibido','confirmada'=>'Pago confirmado','en_proceso'=>'En preparación','completada'=>'Entregado'];
        $orden = array_keys($pasos);
        $idxActual = array_search($venta->estado, $orden);
      @endphp
      @if($venta->estado !== 'cancelada')
      <div class="timeline">
        @foreach($pasos as $key => $etiqueta)
          @php $i = array_search($key, $orden); @endphp
          <div class="tl-step {{ $i <= $idxActual ? 'done' : '' }} {{ $i === $idxActual ? 'current' : '' }}">
            <div class="tl-dot">@if($i < $idxActual)<i class="fas fa-check"></i>@endif</div>
            <div class="tl-label">{{ $etiqueta }}</div>
          </div>
        @endforeach
      </div>
      @else
        <div class="tl-cancelled"><i class="fas fa-times-circle"></i> Venta cancelada</div>
      @endif

      @if(!in_array($venta->estado, ['completada','cancelada']))
      <div class="estado-form">
        <div class="estado-form-label">Actualizar estado del pedido</div>
        @if($venta->estado === 'pendiente')
          <form method="POST" action="{{ route('caficultor.ventas.actualizar-estado', $venta->id) }}">@csrf @method('PUT')
            <button name="estado" value="confirmada" class="btn-advance btn-confirm"><i class="fas fa-check"></i> Confirmar pago recibido</button>
          </form>
        @elseif($venta->estado === 'confirmada')
          <form method="POST" action="{{ route('caficultor.ventas.actualizar-estado', $venta->id) }}">@csrf @method('PUT')
            <button name="estado" value="en_proceso" class="btn-advance btn-process"><i class="fas fa-box"></i> Iniciar preparación</button>
          </form>
        @elseif($venta->estado === 'en_proceso')
          <form method="POST" action="{{ route('caficultor.ventas.actualizar-estado', $venta->id) }}">@csrf @method('PUT')
            <button name="estado" value="completada" class="btn-advance btn-complete"><i class="fas fa-check-double"></i> Marcar como entregado</button>
          </form>
        @endif
        <form method="POST" action="{{ route('caficultor.ventas.actualizar-estado', $venta->id) }}">@csrf @method('PUT')
          <button name="estado" value="cancelada" class="btn-cancel-estado" onclick="return confirm('¿Cancelar esta venta?')"><i class="fas fa-times"></i> Cancelar venta</button>
        </form>
      </div>
      @endif

      @if($venta->comprobante_pago || $venta->referencia_pago)
      <div class="notas" style="background:#f0fdf4;border-radius:10px;padding:12px 14px;border:1px solid #bbf7d0">
        <div class="notas-label" style="color:#166534;margin-bottom:6px">
          <i class="fas fa-receipt"></i> Comprobante de pago
        </div>
        @if($venta->metodo_pago)
          <div style="font-size:12px;color:var(--muted);margin-bottom:4px">
            <strong>Método:</strong> {{ ucfirst($venta->metodo_pago) }}
          </div>
        @endif
        @if($venta->referencia_pago)
          <div style="font-size:12px;color:var(--muted);margin-bottom:8px">
            <strong>Referencia:</strong> {{ $venta->referencia_pago }}
          </div>
        @endif
        @if($venta->comprobante_pago)
          <a href="{{ asset('storage/'.$venta->comprobante_pago) }}" target="_blank"
             style="display:inline-flex;align-items:center;gap:6px;padding:7px 14px;background:#166534;color:#fff;border-radius:8px;font-size:12px;font-weight:500;text-decoration:none">
            <i class="fas fa-file-alt"></i> Ver comprobante
          </a>
        @endif
      </div>
      @endif
      @if($venta->notas_comprador)
        <div class="notas"><div class="notas-label">Notas del comprador</div><div class="notas-text">{{ $venta->notas_comprador }}</div></div>
      @endif
    </div>
    @endforeach
    <div class="pagination-wrap">{{ $ventas->links() }}</div>
  @else
    <div class="empty">
      <i class="fas fa-chart-bar"></i>
      <div class="empty-title">Aún no has realizado ventas</div>
      <div class="empty-sub">Tus lotes están disponibles para que los compradores los encuentren</div>
      <a href="{{ route('caficultor.dashboard') }}" class="btn-empty"><i class="fas fa-home"></i> Ir al dashboard</a>
    </div>
  @endif
</div>
</div>

{{-- CAFÉBOT CHAT WIDGET --}}
<button id="chatFab" class="chat-fab" aria-label="Abrir asistente CaféBot">
  <i class="fas fa-robot"></i>
</button>

<div id="chatPanel" class="chat-panel" style="display:none">
  <div class="chat-header">
    <div class="chat-header-info">
      <div class="chat-avatar"><i class="fas fa-robot"></i></div>
      <div>
        <div class="chat-title">CaféBot</div>
        <div class="chat-status"><span class="chat-dot"></span> Asistente IA · Caficultor</div>
      </div>
    </div>
    <button id="chatClose" class="chat-close" aria-label="Cerrar"><i class="fas fa-times"></i></button>
  </div>
  <div id="chatMessages" class="chat-messages">
    <div class="msg bot">
      <div class="msg-bubble">¡Hola! Soy CaféBot. Puedo ayudarte con precios de mercado, procesos de beneficio, cómo vender mejor tu café y mucho más. ¿En qué te ayudo?</div>
    </div>
  </div>
  <div class="chat-input-wrap">
    <input type="text" id="chatInput" class="chat-input" placeholder="Pregunta algo sobre tu café..." maxlength="500">
    <button id="chatSend" class="chat-send" aria-label="Enviar"><i class="fas fa-paper-plane"></i></button>
  </div>
</div>

<script>
(function(){
  const fab = document.getElementById('chatFab');
  const panel = document.getElementById('chatPanel');
  const closeBtn = document.getElementById('chatClose');
  const input = document.getElementById('chatInput');
  const send = document.getElementById('chatSend');
  const messages = document.getElementById('chatMessages');
  let open = false;

  function toggleChat(){
    open = !open;
    panel.style.display = open ? 'flex' : 'none';
    if(open){ panel.style.flexDirection='column'; input.focus(); }
    fab.querySelector('i').className = open ? 'fas fa-times' : 'fas fa-robot';
  }

  function addMsg(text, type){
    const d = document.createElement('div');
    d.className = 'msg ' + type;
    d.innerHTML = '<div class="msg-bubble">' + text.replace(/\n/g,'<br>') + '</div>';
    messages.appendChild(d);
    messages.scrollTop = messages.scrollHeight;
    return d;
  }

  function addTyping(){
    const d = document.createElement('div');
    d.className = 'msg bot msg-typing';
    d.innerHTML = '<div class="msg-bubble"><span></span><span></span><span></span></div>';
    messages.appendChild(d);
    messages.scrollTop = messages.scrollHeight;
    return d;
  }

  async function sendMsg(){
    const text = input.value.trim();
    if(!text || input.disabled) return;
    input.value = '';
    input.disabled = true;
    send.disabled = true;
    addMsg(text, 'user');
    const typing = addTyping();
    try {
      const res = await fetch('{{ route("asistente.chat") }}', {
        method: 'POST',
        headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN':'{{ csrf_token() }}' },
        body: JSON.stringify({ message: text, context: 'caficultor' })
      });
      const data = await res.json();
      typing.remove();
      addMsg(data.reply || 'Sin respuesta.', 'bot');
    } catch(e){
      typing.remove();
      addMsg('Error de conexión. Intenta de nuevo.', 'bot');
    }
    input.disabled = false;
    send.disabled = false;
    input.focus();
  }

  fab.addEventListener('click', toggleChat);
  closeBtn.addEventListener('click', toggleChat);
  send.addEventListener('click', sendMsg);
  input.addEventListener('keydown', e => { if(e.key==='Enter') sendMsg(); });
})();
</script>
@endsection