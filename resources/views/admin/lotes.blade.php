@extends('layouts.app')

@section('title', 'Gestión de Lotes - Admin')

@section('content')
<style>
*{box-sizing:border-box;margin:0;padding:0}
:root{
  --cafe-900:#2d1b0e;--cafe-800:#3b1a08;--cafe-700:#6b2f06;
  --cafe-600:#92400e;--cafe-500:#b45309;--cafe-400:#d97706;
  --cafe-200:#fde68a;--cafe-100:#fef3c7;--cafe-50:#fffbf5;
  --cream:#faf6f0;--border:#ede8e0
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
.nav-avatar{width:32px;height:32px;border-radius:50%;background:var(--cafe-600);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:500;color:#fff}
.nav-username{font-size:13px;color:rgba(255,255,255,0.75)}
.btn-logout{display:flex;align-items:center;gap:6px;padding:7px 13px;border-radius:8px;border:1px solid rgba(255,255,255,0.2);background:transparent;color:rgba(255,255,255,0.65);font-size:12px;cursor:pointer;transition:all 0.15s}
.btn-logout:hover{background:rgba(255,255,255,0.08);color:#fff;border-color:rgba(255,255,255,0.35)}

/* MOBILE NAV */
.mobile-nav{display:none;background:var(--cafe-800);border-top:1px solid rgba(255,255,255,0.08);padding:10px 20px}
.mobile-nav-inner{display:flex;justify-content:space-around}
.mobile-link{display:flex;flex-direction:column;align-items:center;gap:4px;color:rgba(255,255,255,0.6);font-size:11px;text-decoration:none}
.mobile-link i{font-size:20px}
.mobile-link.active{color:#fde68a}

/* MAIN */
.main{padding:28px}

/* ALERT */
.alert-success{background:#f0fdf4;border:1px solid #bbf7d0;color:#14532d;padding:12px 16px;border-radius:10px;font-size:13px;margin-bottom:20px;display:flex;align-items:center;gap:8px}

/* PAGE HEADER */
.page-header{background:#fff;border:0.5px solid var(--border);border-radius:12px;padding:20px 24px;margin-bottom:24px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px}
.page-title{font-size:18px;font-weight:500;color:var(--cafe-900);display:flex;align-items:center;gap:10px}
.page-title i{font-size:18px;color:var(--cafe-500)}
.page-sub{font-size:13px;color:#9a7a5e;margin-top:3px}

/* STATS BAR */
.stats-bar{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:24px}
.sbar-card{background:#fff;border:0.5px solid var(--border);border-radius:10px;padding:14px 18px;display:flex;align-items:center;gap:12px}
.sbar-icon{width:36px;height:36px;border-radius:9px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.sbar-icon i{font-size:17px}
.sbar-icon.green{background:#eaf3de;color:#3b6d11}
.sbar-icon.blue{background:#e6f1fb;color:#185fa5}
.sbar-icon.amber{background:#faeeda;color:#854f0b}
.sbar-icon.purple{background:#eeedfe;color:#534ab7}
.sbar-val{font-size:20px;font-weight:500;color:var(--cafe-900);line-height:1}
.sbar-label{font-size:11px;color:#9a7a5e;margin-top:2px}

/* LOTES GRID */
.lotes-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px}
.lote-card{background:#fff;border:0.5px solid var(--border);border-radius:12px;overflow:hidden;transition:box-shadow 0.2s}
.lote-card:hover{box-shadow:0 4px 20px rgba(0,0,0,0.07)}

/* CARD IMAGE */
.lote-img{position:relative;height:160px;background:linear-gradient(135deg,var(--cafe-400),var(--cafe-700));overflow:hidden}
.lote-img img{width:100%;height:100%;object-fit:cover}
.lote-img-placeholder{width:100%;height:100%;display:flex;align-items:center;justify-content:center}
.lote-img-placeholder i{font-size:40px;color:rgba(255,255,255,0.4)}

/* BADGES sobre imagen */
.img-badges-right{position:absolute;top:10px;right:10px}
.img-badges-left{position:absolute;top:10px;left:10px;display:flex;flex-direction:column;gap:5px}
.img-badge{font-size:10px;font-weight:600;padding:3px 9px;border-radius:20px;display:inline-flex;align-items:center;gap:4px;backdrop-filter:blur(4px)}
.img-badge i{font-size:10px}
.badge-disponible{background:rgba(20,83,45,0.85);color:#bbf7d0}
.badge-vendido{background:rgba(127,29,29,0.85);color:#fecaca}
.badge-reservado{background:rgba(120,53,15,0.85);color:#fde68a}
.badge-organico{background:rgba(20,83,45,0.85);color:#bbf7d0}
.badge-justo{background:rgba(30,64,175,0.85);color:#bfdbfe}

/* CARD BODY */
.lote-body{padding:16px}
.lote-meta{display:flex;align-items:center;justify-content:space-between;margin-bottom:8px}
.lote-code{font-size:10px;font-weight:600;color:#9a7a5e;text-transform:uppercase;letter-spacing:0.8px}
.lote-score{font-size:11px;font-weight:500;color:var(--cafe-500);display:flex;align-items:center;gap:3px}
.lote-score i{font-size:10px}
.lote-variedad{font-size:15px;font-weight:500;color:var(--cafe-900);margin-bottom:6px}
.lote-caficultor{font-size:12px;color:#9a7a5e;display:flex;align-items:center;gap:5px;padding-bottom:10px;border-bottom:0.5px solid var(--border);margin-bottom:10px}
.lote-caficultor i{font-size:12px;color:var(--cafe-500)}

/* DETAILS */
.lote-details{display:flex;flex-direction:column;gap:5px;margin-bottom:12px}
.detail-row{display:flex;justify-content:space-between;align-items:center;font-size:12px}
.detail-label{color:#9a7a5e;display:flex;align-items:center;gap:5px}
.detail-label i{font-size:12px;color:var(--cafe-400);width:14px;text-align:center}
.detail-val{font-weight:500;color:var(--cafe-900)}

/* PRICE ROW */
.lote-footer{border-top:0.5px solid var(--border);padding-top:12px;display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:12px}
.price-label{font-size:10px;color:#9a7a5e}
.price-val{font-size:20px;font-weight:500;color:var(--cafe-600);line-height:1}
.price-unit{font-size:10px;color:#9a7a5e}
.weight-label{font-size:10px;color:#9a7a5e;text-align:right}
.weight-val{font-size:14px;font-weight:500;color:var(--cafe-900);text-align:right}

/* ACTIONS */
.lote-actions{display:flex;gap:8px}
.btn-ver{flex:1;display:flex;align-items:center;justify-content:center;gap:6px;padding:8px;border-radius:9px;background:#e6f1fb;color:#185fa5;font-size:12px;font-weight:500;text-decoration:none;transition:background 0.15s;border:none;cursor:pointer}
.btn-ver:hover{background:#b5d4f4}
.btn-eliminar{flex:1;display:flex;align-items:center;justify-content:center;gap:6px;padding:8px;border-radius:9px;background:#fcebeb;color:#a32d2d;font-size:12px;font-weight:500;border:none;cursor:pointer;transition:background 0.15s;width:100%}
.btn-eliminar:hover{background:#f7c1c1}

/* EMPTY */
.empty-state{background:#fff;border:0.5px solid var(--border);border-radius:12px;padding:60px 20px;text-align:center}
.empty-state i{font-size:48px;color:#d6c9bb;display:block;margin-bottom:12px}
.empty-title{font-size:17px;font-weight:500;color:var(--cafe-900);margin-bottom:6px}
.empty-sub{font-size:13px;color:#9a7a5e}

/* PAGINATION */
.pagination-wrap{background:#fff;border:0.5px solid var(--border);border-radius:12px;padding:16px 20px}

@media(max-width:1024px){.lotes-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:900px){.stats-bar{grid-template-columns:repeat(2,1fr)}}
@media(max-width:640px){
  .nav-links{display:none}
  .nav-username{display:none}
  .mobile-nav{display:block}
  .main{padding:16px}
  .lotes-grid{grid-template-columns:1fr}
  .stats-bar{grid-template-columns:repeat(2,1fr);gap:8px}
}
</style>

<div class="dash">

  {{-- NAVBAR --}}
  <nav class="nav">
    <div class="nav-brand">
      <div class="nav-logo">
        <img src="{{ asset('images/logo-cafetrace.png') }}" alt="CaféTrace">
      </div>
      <div>
        <div class="nav-name">CaféTrace</div>
        <div class="nav-sub">Panel administrativo</div>
      </div>
    </div>

    <div class="nav-links">
      <a href="{{ route('admin.dashboard') }}" class="nav-link">
        <i class="fas fa-th-large"></i> Dashboard
      </a>
      <a href="{{ route('admin.usuarios') }}" class="nav-link">
        <i class="fas fa-users"></i> Usuarios
      </a>
      <a href="{{ route('admin.lotes') }}" class="nav-link active">
        <i class="fas fa-box"></i> Lotes
      </a>
      <a href="{{ route('admin.transacciones') }}" class="nav-link">
        <i class="fas fa-receipt"></i> Transacciones
      </a>
    </div>

    <div class="nav-right">
      <div style="display:flex;align-items:center;gap:8px">
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
      <a href="{{ route('admin.dashboard') }}" class="mobile-link">
        <i class="fas fa-th-large"></i><span>Dashboard</span>
      </a>
      <a href="{{ route('admin.usuarios') }}" class="mobile-link">
        <i class="fas fa-users"></i><span>Usuarios</span>
      </a>
      <a href="{{ route('admin.lotes') }}" class="mobile-link active">
        <i class="fas fa-box"></i><span>Lotes</span>
      </a>
    </div>
  </div>

  <div class="main">

    {{-- ALERT --}}
    @if(session('success'))
      <div class="alert-success">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
      </div>
    @endif

    {{-- PAGE HEADER --}}
    <div class="page-header">
      <div>
        <div class="page-title">
          <i class="fas fa-box"></i> Gestión de lotes
        </div>
        <div class="page-sub">{{ $lotes->total() }} lotes registrados en la plataforma</div>
      </div>
    </div>

    {{-- STATS BAR --}}
    <div class="stats-bar">
      <div class="sbar-card">
        <div class="sbar-icon green"><i class="fas fa-box"></i></div>
        <div>
          <div class="sbar-val">{{ $lotes->total() }}</div>
          <div class="sbar-label">Total lotes</div>
        </div>
      </div>
      <div class="sbar-card">
        <div class="sbar-icon blue"><i class="fas fa-check-circle"></i></div>
        <div>
          <div class="sbar-val">{{ $lotes->where('estado', 'disponible')->count() }}</div>
          <div class="sbar-label">Disponibles</div>
        </div>
      </div>
      <div class="sbar-card">
        <div class="sbar-icon amber"><i class="fas fa-weight"></i></div>
        <div>
          <div class="sbar-val">{{ number_format($lotes->sum('peso_kg'), 0) }}</div>
          <div class="sbar-label">Kg totales</div>
        </div>
      </div>
      <div class="sbar-card">
        <div class="sbar-icon purple"><i class="fas fa-box-open"></i></div>
        <div>
          <div class="sbar-val">{{ number_format($lotes->sum('peso_disponible'), 0) }}</div>
          <div class="sbar-label">Kg disponibles</div>
        </div>
      </div>
    </div>

    {{-- GRID DE LOTES --}}
    @if($lotes->count() > 0)
      <div class="lotes-grid">
        @foreach($lotes as $lote)
          <div class="lote-card">

            {{-- IMAGEN --}}
            <div class="lote-img">
              @if($lote->imagenes->first())
                <img src="{{ asset('storage/' . $lote->imagenes->first()->ruta_imagen) }}"
                     alt="{{ $lote->codigo_lote }}">
              @else
                <div class="lote-img-placeholder">
                  <i class="fas fa-coffee"></i>
                </div>
              @endif

              {{-- Badge estado --}}
              <div class="img-badges-right">
                @if($lote->estado == 'disponible')
                  <span class="img-badge badge-disponible"><i class="fas fa-check-circle"></i> Disponible</span>
                @elseif($lote->estado == 'vendido')
                  <span class="img-badge badge-vendido"><i class="fas fa-times-circle"></i> Vendido</span>
                @elseif($lote->estado == 'reservado')
                  <span class="img-badge badge-reservado"><i class="fas fa-clock"></i> Reservado</span>
                @endif
              </div>

              {{-- Certificaciones --}}
              <div class="img-badges-left">
                @if($lote->es_organico)
                  <span class="img-badge badge-organico"><i class="fas fa-leaf"></i> Orgánico</span>
                @endif
                @if($lote->comercio_justo)
                  <span class="img-badge badge-justo"><i class="fas fa-handshake"></i> C. Justo</span>
                @endif
              </div>
            </div>

            {{-- BODY --}}
            <div class="lote-body">
              <div class="lote-meta">
                <span class="lote-code">{{ $lote->codigo_lote }}</span>
                @if($lote->puntaje_calidad)
                  <span class="lote-score"><i class="fas fa-star"></i> {{ $lote->puntaje_calidad }}/100</span>
                @endif
              </div>

              <div class="lote-variedad">{{ $lote->variedad }}</div>

              @if($lote->caficultor)
                <div class="lote-caficultor">
                  <i class="fas fa-user"></i>
                  <span>{{ $lote->caficultor->name }}</span>
                </div>
              @endif

              <div class="lote-details">
                <div class="detail-row">
                  <span class="detail-label"><i class="fas fa-weight-hanging"></i> Peso disponible</span>
                  <span class="detail-val">{{ number_format($lote->peso_disponible, 0) }} kg</span>
                </div>
                <div class="detail-row">
                  <span class="detail-label"><i class="fas fa-mountain"></i> Altura</span>
                  <span class="detail-val">{{ number_format($lote->altura_msnm, 0) }} msnm</span>
                </div>
                <div class="detail-row">
                  <span class="detail-label"><i class="fas fa-calendar"></i> Cosecha</span>
                  <span class="detail-val">{{ $lote->fecha_cosecha->format('d/m/Y') }}</span>
                </div>
                @if($lote->caficultor && $lote->caficultor->departamento)
                  <div class="detail-row">
                    <span class="detail-label"><i class="fas fa-map-marker-alt"></i> Ubicación</span>
                    <span class="detail-val">{{ $lote->caficultor->departamento }}</span>
                  </div>
                @endif
              </div>

              <div class="lote-footer">
                <div>
                  <div class="price-label">Precio por kg</div>
                  <div class="price-val">${{ number_format($lote->precio_por_kg, 0) }}</div>
                </div>
                <div>
                  <div class="weight-label">Peso total</div>
                  <div class="weight-val">{{ number_format($lote->peso_kg, 0) }} kg</div>
                </div>
              </div>

              <div class="lote-actions">
                <a href="{{ route('trazabilidad.lote', $lote->codigo_lote) }}"
                   target="_blank"
                   class="btn-ver">
                  <i class="fas fa-eye"></i> Ver trazabilidad
                </a>
                <form method="POST"
                      action="{{ route('admin.lotes.eliminar', $lote->id) }}"
                      onsubmit="return confirm('¿Eliminar este lote permanentemente? Esta acción no se puede deshacer.')"
                      style="flex:1">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-eliminar">
                    <i class="fas fa-trash"></i> Eliminar
                  </button>
                </form>
              </div>
            </div>

          </div>
        @endforeach
      </div>

      {{-- PAGINACIÓN --}}
      <div class="pagination-wrap">
        {{ $lotes->links() }}
      </div>

    @else
      <div class="empty-state">
        <i class="fas fa-box-open"></i>
        <div class="empty-title">No hay lotes registrados</div>
        <div class="empty-sub">Los caficultores aún no han registrado lotes de café en la plataforma</div>
      </div>
    @endif

  </div>
</div>

@endsection
