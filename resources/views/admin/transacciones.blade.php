@extends('layouts.app')

@section('title', 'Transacciones - Admin')

@section('content')
<style>
*{box-sizing:border-box;margin:0;padding:0}
:root{
  --cafe-900:#2d1b0e;--cafe-800:#3b1a08;--cafe-700:#6b2f06;
  --cafe-600:#92400e;--cafe-500:#b45309;--cafe-400:#d97706;
  --cafe-200:#fde68a;--cafe-100:#fef3c7;--cafe-50:#fffbf5;
  --cream:#faf6f0;--border:#ede8e0;
  --g600:#2d7a1f;--g100:#e8f5e0
}
.dash{background:var(--cafe-50);min-height:100vh;display:grid;grid-template-rows:auto 1fr}

/* NAV */
.nav{background:var(--cafe-800);padding:0 28px;display:flex;align-items:center;justify-content:space-between;height:60px;border-bottom:1px solid rgba(255,255,255,0.08)}
.nav-brand{display:flex;align-items:center;gap:12px}
.nav-logo{width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,0.12);border:1.5px solid rgba(255,255,255,0.25);display:flex;align-items:center;justify-content:center;overflow:hidden}
.nav-logo img{width:100%;height:100%;object-fit:cover}
.nav-name{font-size:15px;font-weight:500;color:#fff}
.nav-sub{font-size:10px;color:rgba(255,255,255,0.45);letter-spacing:1.5px;text-transform:uppercase}
.nav-links{display:flex;gap:4px}
.nav-link{display:flex;align-items:center;gap:7px;padding:7px 14px;border-radius:8px;font-size:13px;color:rgba(255,255,255,0.65);transition:background 0.15s;text-decoration:none}
.nav-link:hover{background:rgba(255,255,255,0.08);color:#fff}
.nav-link.active{background:rgba(255,255,255,0.12);color:#fff}
.nav-right{display:flex;align-items:center;gap:10px}
.nav-user{display:flex;align-items:center;gap:8px}
.nav-avatar{width:32px;height:32px;border-radius:50%;background:var(--cafe-600);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:500;color:#fff}
.nav-username{font-size:13px;color:rgba(255,255,255,0.75)}
.btn-logout{display:flex;align-items:center;gap:6px;padding:7px 13px;border-radius:8px;border:1px solid rgba(255,255,255,0.2);background:transparent;color:rgba(255,255,255,0.65);font-size:12px;cursor:pointer;transition:all 0.15s;font-family:inherit}
.btn-logout:hover{background:rgba(255,255,255,0.08);color:#fff}

/* MAIN */
.main{padding:28px}
.page-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:22px;flex-wrap:wrap;gap:10px}
.page-title{font-size:20px;font-weight:500;color:var(--cafe-900)}
.page-sub{font-size:13px;color:#9a7a5e;margin-top:3px}

/* ALERT */
.alert-success{background:#f0fdf4;border:1px solid #bbf7d0;color:#14532d;padding:12px 16px;border-radius:10px;font-size:13px;margin-bottom:20px;display:flex;align-items:center;gap:8px}

/* STATS */
.stats{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:22px}
.stat{background:#fff;border:0.5px solid var(--border);border-radius:12px;padding:16px 18px;display:flex;align-items:center;gap:12px}
.stat-icon{width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.stat-icon i{font-size:18px}
.si-blue{background:#e6f1fb;color:#185fa5}
.si-green{background:var(--g100);color:var(--g600)}
.si-amber{background:var(--cafe-100);color:var(--cafe-600)}
.si-red{background:#fef2f2;color:#991b1b}
.stat-val{font-size:20px;font-weight:500;color:var(--cafe-900);line-height:1}
.stat-lbl{font-size:11px;color:#9a7a5e;margin-top:3px}

/* TARJETA TRANSACCION */
.tx-card{background:#fff;border:0.5px solid var(--border);border-radius:14px;padding:20px;margin-bottom:12px}
.tx-head{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:16px;flex-wrap:wrap;gap:8px}
.tx-code{font-size:14px;font-weight:500;color:var(--cafe-900);font-family:monospace}
.tx-date{font-size:12px;color:#9a7a5e;margin-top:2px}
.estado-badge{font-size:11px;font-weight:500;padding:4px 12px;border-radius:20px}
.est-pendiente{background:var(--cafe-100);color:var(--cafe-600)}
.est-confirmada{background:#e6f1fb;color:#185fa5}
.est-en_proceso{background:#eeedfe;color:#534ab7}
.est-completada{background:var(--g100);color:var(--g600)}
.est-cancelada{background:#fef2f2;color:#991b1b}

/* GRID PRINCIPAL */
.tx-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-bottom:16px}
.tx-box{background:var(--cafe-50);border:0.5px solid var(--border);border-radius:10px;padding:12px 14px}
.tx-box-title{font-size:10px;font-weight:600;color:#9a7a5e;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:6px}
.tx-box-name{font-size:13px;font-weight:500;color:var(--cafe-900)}
.tx-box-sub{font-size:11px;color:#9a7a5e;margin-top:2px}

/* FINANCIERO */
.fin-row{display:grid;grid-template-columns:repeat(5,1fr);gap:8px;padding:14px 0 0;border-top:0.5px solid var(--border);margin-top:4px}
.fin-lbl{font-size:10px;color:#9a7a5e;margin-bottom:3px;text-transform:uppercase;letter-spacing:0.3px}
.fin-val{font-size:13px;font-weight:500;color:var(--cafe-900)}
.fin-val.green{font-size:15px;color:var(--g600)}
.fin-val.amber{color:var(--cafe-500)}
.fin-val.red{color:#991b1b}

/* COMPROBANTE */
.comprobante-section{margin-top:14px;padding:14px;background:#f0fdf4;border-radius:10px;border:1px solid #bbf7d0;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px}
.comprobante-info{display:flex;align-items:center;gap:10px}
.comprobante-icon{width:36px;height:36px;border-radius:8px;background:#16a34a;display:flex;align-items:center;justify-content:center;color:#fff;font-size:15px;flex-shrink:0}
.comprobante-lbl{font-size:11px;color:#166534;font-weight:600;margin-bottom:2px}
.comprobante-meta{font-size:12px;color:#4ade80;margin:0}
.comprobante-meta span{color:#166534}
.btn-ver-comprobante{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:#16a34a;color:#fff;border-radius:8px;font-size:12px;font-weight:500;text-decoration:none;transition:background 0.15s}
.btn-ver-comprobante:hover{background:#15803d}
.sin-comprobante{margin-top:14px;padding:12px 14px;background:#fef2f2;border-radius:10px;border:1px solid #fecaca;font-size:12px;color:#991b1b;display:flex;align-items:center;gap:7px}

/* ACCIONES */
.tx-actions{display:flex;gap:8px;flex-wrap:wrap;margin-top:14px;padding-top:12px;border-top:0.5px solid var(--border);align-items:center}
.tx-actions-lbl{font-size:11px;color:#9a7a5e;margin-right:4px}
.btn-estado{display:inline-flex;align-items:center;gap:5px;padding:7px 14px;border-radius:8px;border:none;cursor:pointer;font-size:12px;font-weight:500;font-family:inherit;transition:all 0.15s}
.btn-confirmar{background:#e6f1fb;color:#185fa5}.btn-confirmar:hover{background:#185fa5;color:#fff}
.btn-proceso{background:#eeedfe;color:#534ab7}.btn-proceso:hover{background:#534ab7;color:#fff}
.btn-completar{background:var(--g100);color:var(--g600)}.btn-completar:hover{background:var(--g600);color:#fff}
.btn-cancelar{background:#fef2f2;color:#991b1b}.btn-cancelar:hover{background:#dc2626;color:#fff}

/* EMPTY / PAGINACION */
.empty{background:#fff;border:0.5px solid var(--border);border-radius:14px;padding:52px 20px;text-align:center}
.empty i{font-size:40px;color:var(--cafe-200);display:block;margin-bottom:12px}
.empty-title{font-size:16px;font-weight:500;color:var(--cafe-900);margin-bottom:5px}
.empty-sub{font-size:13px;color:#9a7a5e}
.pagination-wrap{background:#fff;border:0.5px solid var(--border);border-radius:12px;padding:14px 20px}

@media(max-width:900px){.stats{grid-template-columns:repeat(2,1fr)}.tx-grid{grid-template-columns:1fr 1fr}.fin-row{grid-template-columns:repeat(3,1fr)}}
@media(max-width:640px){.nav-links{display:none}.nav-username{display:none}.main{padding:16px}.tx-grid{grid-template-columns:1fr}.fin-row{grid-template-columns:repeat(2,1fr)}}
</style>

<div class="dash">
<nav class="nav">
  <div class="nav-brand">
    <div class="nav-logo"><img src="{{ asset('images/CafeTrace.png') }}" alt="CaféTrace"></div>
    <div><div class="nav-name">CaféTrace</div><div class="nav-sub">Admin</div></div>
  </div>
  <div class="nav-links">
    <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-th-large"></i> Dashboard</a>
    <a href="{{ route('admin.usuarios') }}" class="nav-link"><i class="fas fa-users"></i> Usuarios</a>
    <a href="{{ route('admin.lotes') }}" class="nav-link"><i class="fas fa-box"></i> Lotes</a>
    <a href="{{ route('admin.transacciones') }}" class="nav-link active"><i class="fas fa-receipt"></i> Transacciones</a>
  </div>
  <div class="nav-right">
    <div class="nav-user">
      <div class="nav-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
      <span class="nav-username">{{ auth()->user()->name }}</span>
    </div>
    <form method="POST" action="{{ route('logout') }}">@csrf
      <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Salir</button>
    </form>
  </div>
</nav>

<div class="main">
  @if(session('success'))<div class="alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>@endif

  <div class="page-header">
    <div>
      <div class="page-title">Transacciones</div>
      <div class="page-sub">{{ $stats['total'] }} transacciones registradas · {{ $stats['pendientes'] }} pendientes de verificar</div>
    </div>
  </div>

  {{-- STATS --}}
  <div class="stats">
    <div class="stat">
      <div class="stat-icon si-blue"><i class="fas fa-exchange-alt"></i></div>
      <div><div class="stat-val">{{ $stats['total'] }}</div><div class="stat-lbl">Total transacciones</div></div>
    </div>
    <div class="stat">
      <div class="stat-icon si-green"><i class="fas fa-dollar-sign"></i></div>
      <div><div class="stat-val">${{ number_format($stats['monto'], 0) }}</div><div class="stat-lbl">Monto total</div></div>
    </div>
    <div class="stat">
      <div class="stat-icon si-amber"><i class="fas fa-landmark"></i></div>
      <div><div class="stat-val">${{ number_format($stats['comisiones'], 0) }}</div><div class="stat-lbl">Comisiones (5%)</div></div>
    </div>
    <div class="stat">
      <div class="stat-icon si-red"><i class="fas fa-clock"></i></div>
      <div><div class="stat-val">{{ $stats['pendientes'] }}</div><div class="stat-lbl">Pendientes pago</div></div>
    </div>
  </div>

  {{-- TRANSACCIONES --}}
  @if($transacciones->count() > 0)
    @foreach($transacciones as $tx)
    <div class="tx-card">
      <div class="tx-head">
        <div>
          <div class="tx-code">{{ $tx->codigo_transaccion }}</div>
          <div class="tx-date">{{ $tx->created_at->format('d/m/Y H:i') }}</div>
        </div>
        <span class="estado-badge est-{{ $tx->estado }}">{{ ucfirst(str_replace('_',' ', $tx->estado)) }}</span>
      </div>

      <div class="tx-grid">
        <div class="tx-box">
          <div class="tx-box-title"><i class="fas fa-user"></i> Comprador</div>
          <div class="tx-box-name">{{ $tx->comprador->name }}</div>
          <div class="tx-box-sub">{{ $tx->comprador->email }}</div>
        </div>
        <div class="tx-box">
          <div class="tx-box-title"><i class="fas fa-seedling"></i> Caficultor</div>
          <div class="tx-box-name">{{ $tx->caficultor->name }}</div>
          <div class="tx-box-sub">{{ $tx->caficultor->email }}</div>
        </div>
        <div class="tx-box">
          <div class="tx-box-title"><i class="fas fa-box"></i> Lote</div>
          <div class="tx-box-name">{{ $tx->lote->variedad }}</div>
          <div class="tx-box-sub">{{ $tx->lote->codigo_lote }} · {{ number_format($tx->cantidad_kg, 2) }} kg</div>
        </div>
      </div>

      <div class="fin-row">
        <div><div class="fin-lbl">Precio/kg</div><div class="fin-val">${{ number_format($tx->precio_por_kg, 0) }}</div></div>
        <div><div class="fin-lbl">Cantidad</div><div class="fin-val">{{ number_format($tx->cantidad_kg, 2) }} kg</div></div>
        <div><div class="fin-lbl">Total comprador</div><div class="fin-val">${{ number_format($tx->precio_total, 0) }}</div></div>
        <div><div class="fin-lbl">Comisión (5%)</div><div class="fin-val amber">${{ number_format($tx->comision_plataforma, 0) }}</div></div>
        <div><div class="fin-lbl">Al caficultor</div><div class="fin-val green">${{ number_format($tx->total_caficultor, 0) }}</div></div>
      </div>

      {{-- COMPROBANTE --}}
      @if($tx->comprobante_pago)
      <div class="comprobante-section">
        <div class="comprobante-info">
          <div class="comprobante-icon"><i class="fas fa-file-alt"></i></div>
          <div>
            <div class="comprobante-lbl">Comprobante recibido</div>
            <div class="comprobante-meta">
              @if($tx->metodo_pago)<span>{{ ucfirst($tx->metodo_pago) }}</span>@endif
              @if($tx->referencia_pago) · Ref: <span>{{ $tx->referencia_pago }}</span>@endif
            </div>
          </div>
        </div>
        <a href="{{ asset('storage/'.$tx->comprobante_pago) }}" target="_blank" class="btn-ver-comprobante">
          <i class="fas fa-eye"></i> Ver comprobante
        </a>
      </div>
      @else
      <div class="sin-comprobante">
        <i class="fas fa-exclamation-circle"></i>
        Sin comprobante · El comprador aún no ha enviado el pago
      </div>
      @endif

      {{-- ACCIONES --}}
      @if(!in_array($tx->estado, ['completada','cancelada']))
      <div class="tx-actions">
        <span class="tx-actions-lbl">Actualizar estado:</span>
        @if($tx->estado === 'pendiente')
          <form method="POST" action="{{ route('admin.transacciones.estado', $tx->id) }}">@csrf @method('PUT')
            <button name="estado" value="confirmada" class="btn-estado btn-confirmar"><i class="fas fa-check"></i> Confirmar pago</button>
          </form>
        @elseif($tx->estado === 'confirmada')
          <form method="POST" action="{{ route('admin.transacciones.estado', $tx->id) }}">@csrf @method('PUT')
            <button name="estado" value="en_proceso" class="btn-estado btn-proceso"><i class="fas fa-box"></i> En preparación</button>
          </form>
        @elseif($tx->estado === 'en_proceso')
          <form method="POST" action="{{ route('admin.transacciones.estado', $tx->id) }}">@csrf @method('PUT')
            <button name="estado" value="completada" class="btn-estado btn-completar"><i class="fas fa-check-double"></i> Marcar entregado</button>
          </form>
        @endif
        <form method="POST" action="{{ route('admin.transacciones.estado', $tx->id) }}">@csrf @method('PUT')
          <button name="estado" value="cancelada" class="btn-estado btn-cancelar" onclick="return confirm('¿Cancelar esta transacción?')">
            <i class="fas fa-times"></i> Cancelar
          </button>
        </form>
      </div>
      @endif

    </div>
    @endforeach
    <div class="pagination-wrap">{{ $transacciones->links() }}</div>
  @else
    <div class="empty">
      <i class="fas fa-receipt"></i>
      <div class="empty-title">No hay transacciones aún</div>
      <div class="empty-sub">Las compras realizadas en la plataforma aparecerán aquí</div>
    </div>
  @endif
</div>
</div>
@endsection
