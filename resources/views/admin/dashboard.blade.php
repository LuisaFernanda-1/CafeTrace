@extends('layouts.app')

@section('title', 'Dashboard Administrador')

@section('content')
<style>
*{box-sizing:border-box;margin:0;padding:0}
:root{
  --cafe-900:#2d1b0e;--cafe-800:#3b1a08;--cafe-700:#6b2f06;
  --cafe-600:#92400e;--cafe-500:#b45309;--cafe-400:#d97706;
  --cafe-200:#fde68a;--cafe-100:#fef3c7;--cafe-50:#fffbf5;
  --cream:#faf6f0;--border:#ede8e0
}
.dash{background:var(--cafe-50);min-height:100vh;display:grid;grid-template-rows:auto auto 1fr}

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
.btn-logout{display:flex;align-items:center;gap:6px;padding:7px 13px;border-radius:8px;border:1px solid rgba(255,255,255,0.2);background:transparent;color:rgba(255,255,255,0.65);font-size:12px;cursor:pointer;transition:all 0.15s}
.btn-logout:hover{background:rgba(255,255,255,0.08);color:#fff;border-color:rgba(255,255,255,0.35)}

/* BANNER ALERT */
.banner-alert{background:var(--cafe-700);padding:9px 28px;display:flex;align-items:center;gap:10px}
.banner-alert i{font-size:15px;color:#fde68a}
.banner-text{font-size:13px;color:rgba(255,255,255,0.85)}
.banner-text strong{color:#fde68a}
.banner-cta{margin-left:auto;padding:5px 14px;border-radius:7px;background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.25);color:#fff;font-size:12px;font-weight:500;cursor:pointer;transition:background 0.15s;text-decoration:none}
.banner-cta:hover{background:rgba(255,255,255,0.25)}

/* MOBILE NAV */
.mobile-nav{display:none;background:var(--cafe-800);border-top:1px solid rgba(255,255,255,0.08);padding:10px 20px}
.mobile-nav-inner{display:flex;justify-content:space-around}
.mobile-link{display:flex;flex-direction:column;align-items:center;gap:4px;color:rgba(255,255,255,0.6);font-size:11px;text-decoration:none}
.mobile-link i{font-size:20px}
.mobile-link.active{color:#fde68a}

/* MAIN */
.main{padding:28px}
.page-header{margin-bottom:24px}
.page-title{font-size:20px;font-weight:500;color:var(--cafe-900)}
.page-sub{font-size:13px;color:#9a7a5e;margin-top:3px}

/* SUCCESS ALERT */
.alert-success{background:#f0fdf4;border:1px solid #bbf7d0;color:#14532d;padding:12px 16px;border-radius:10px;font-size:13px;margin-bottom:20px;display:flex;align-items:center;gap:8px}

/* STATS GRID */
.stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:24px}
.stat-card{background:#fff;border:0.5px solid var(--border);border-radius:12px;padding:18px 20px;display:flex;flex-direction:column;gap:12px}
.stat-top{display:flex;align-items:flex-start;justify-content:space-between}
.stat-icon{width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center}
.stat-icon i{font-size:20px}
.stat-icon.blue{background:#e6f1fb;color:#185fa5}
.stat-icon.green{background:#eaf3de;color:#3b6d11}
.stat-icon.amber{background:#faeeda;color:#854f0b}
.stat-icon.purple{background:#eeedfe;color:#534ab7}
.stat-badge{font-size:11px;padding:3px 8px;border-radius:20px;font-weight:500}
.stat-badge.up{background:#eaf3de;color:#3b6d11}
.stat-badge.warn{background:#faeeda;color:#854f0b}
.stat-badge.red{background:#fcebeb;color:#a32d2d}
.stat-val{font-size:26px;font-weight:500;color:var(--cafe-900);line-height:1}
.stat-label{font-size:12px;color:#9a7a5e;margin-top:3px}
.stat-sub{font-size:11px;color:#c4b09a}

/* CONTENT GRID */
.content-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px}

/* CARDS */
.card{background:#fff;border:0.5px solid var(--border);border-radius:12px;overflow:hidden}
.card-header{padding:16px 20px;border-bottom:0.5px solid var(--border);display:flex;align-items:center;justify-content:space-between}
.card-title{font-size:14px;font-weight:500;color:var(--cafe-900);display:flex;align-items:center;gap:8px}
.card-title i{font-size:17px;color:#b45309}
.card-link{font-size:12px;color:#b45309;display:flex;align-items:center;gap:4px;text-decoration:none}
.card-link:hover{color:#854f0b}
.card-body{padding:16px 20px}
.card-empty{text-align:center;padding:32px 0;color:#9a7a5e;font-size:13px}
.card-empty i{font-size:36px;color:#d6c9bb;display:block;margin-bottom:8px}

/* USER ITEMS */
.user-item{display:flex;align-items:center;gap:12px;padding:12px;border-radius:10px;border:0.5px solid var(--border);margin-bottom:10px}
.user-item:last-child{margin-bottom:0}
.user-avatar{width:38px;height:38px;border-radius:50%;background:linear-gradient(135deg,var(--cafe-600),var(--cafe-900));display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:500;color:#fff;flex-shrink:0}
.user-info{flex:1;min-width:0}
.user-name{font-size:13px;font-weight:500;color:var(--cafe-900)}
.user-email{font-size:11px;color:#9a7a5e;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.user-meta{display:flex;align-items:center;gap:6px;margin-top:4px;flex-wrap:wrap}
.badge{font-size:10px;padding:2px 8px;border-radius:20px;font-weight:500}
.badge-blue{background:#e6f1fb;color:#185fa5}
.badge-green{background:#eaf3de;color:#3b6d11}
.badge-amber{background:#faeeda;color:#854f0b}
.badge-gray{background:#f1efe8;color:#5f5e5a}
.time-label{font-size:10px;color:#c4b09a;display:flex;align-items:center;gap:3px}
.time-label i{font-size:11px}
.user-actions{display:flex;gap:6px;flex-shrink:0}
.btn-approve{width:30px;height:30px;border-radius:8px;border:none;background:#eaf3de;color:#3b6d11;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background 0.15s}
.btn-approve:hover{background:#c0dd97}
.btn-reject{width:30px;height:30px;border-radius:8px;border:none;background:#fcebeb;color:#a32d2d;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background 0.15s}
.btn-reject:hover{background:#f7c1c1}
.btn-approve i,.btn-reject i{font-size:14px}

/* LOTE ITEMS */
.lote-item{display:flex;align-items:center;gap:12px;padding:12px;border-radius:10px;border:0.5px solid var(--border);margin-bottom:10px}
.lote-item:last-child{margin-bottom:0}
.lote-thumb{width:48px;height:48px;border-radius:10px;overflow:hidden;flex-shrink:0;background:linear-gradient(135deg,var(--cafe-400),var(--cafe-700));display:flex;align-items:center;justify-content:center}
.lote-thumb img{width:100%;height:100%;object-fit:cover}
.lote-thumb i{font-size:20px;color:rgba(255,255,255,0.85)}
.lote-info{flex:1;min-width:0}
.lote-name{font-size:13px;font-weight:500;color:var(--cafe-900)}
.lote-code{font-size:11px;color:#9a7a5e}
.lote-grower{font-size:11px;color:#c4b09a;display:flex;align-items:center;gap:3px;margin-top:2px}
.lote-grower i{font-size:11px}
.lote-price{text-align:right;flex-shrink:0}
.lote-val{font-size:14px;font-weight:500;color:var(--cafe-600)}
.lote-kg{font-size:11px;color:#9a7a5e}

/* BOTTOM GRID */
.bottom-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px}
.mini-card{background:#fff;border:0.5px solid var(--border);border-radius:12px;padding:18px 20px}
.mini-title{font-size:13px;font-weight:500;color:var(--cafe-900);display:flex;align-items:center;gap:7px;margin-bottom:14px}
.mini-title i{font-size:16px;color:#b45309}
.mini-link{display:flex;align-items:center;gap:8px;padding:9px 12px;border-radius:9px;border:0.5px solid var(--border);font-size:12px;color:var(--cafe-800);text-decoration:none;transition:background 0.15s;margin-bottom:8px}
.mini-link:last-child{margin-bottom:0}
.mini-link:hover{background:var(--cream)}
.mini-link i{font-size:15px;color:#b45309}
.summary-row{display:flex;justify-content:space-between;align-items:center;padding:6px 0;border-bottom:0.5px solid var(--border);font-size:12px}
.summary-row:last-child{border-bottom:none}
.summary-label{color:#9a7a5e}
.summary-val{font-weight:500;color:var(--cafe-900)}
.status-row{display:flex;justify-content:space-between;align-items:center;padding:6px 0;border-bottom:0.5px solid var(--border);font-size:12px}
.status-row:last-child{border-bottom:none}
.status-label{color:#9a7a5e}
.status-ok{display:flex;align-items:center;gap:5px;font-size:11px;font-weight:500;color:#3b6d11}
.status-dot{width:7px;height:7px;border-radius:50%;background:#639922}
.status-time{font-size:11px;color:#c4b09a}

@media(max-width:900px){
  .stats-grid{grid-template-columns:repeat(2,1fr)}
  .content-grid{grid-template-columns:1fr}
  .bottom-grid{grid-template-columns:1fr}
}
@media(max-width:640px){
  .nav-links{display:none}
  .nav-username{display:none}
  .mobile-nav{display:block}
  .main{padding:16px}
  .stats-grid{grid-template-columns:repeat(2,1fr);gap:10px}
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
      <a href="{{ route('admin.dashboard') }}" class="nav-link active">
        <i class="fas fa-th-large"></i> Dashboard
      </a>
      <a href="{{ route('admin.usuarios') }}" class="nav-link">
        <i class="fas fa-users"></i> Usuarios
      </a>
      <a href="{{ route('admin.lotes') }}" class="nav-link">
        <i class="fas fa-box"></i> Lotes
      </a>
      <a href="{{ route('admin.transacciones') }}" class="nav-link">
        <i class="fas fa-receipt"></i> Transacciones
      </a>
    </div>

    <div class="nav-right">
      <div class="nav-user">
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
      <a href="{{ route('admin.dashboard') }}" class="mobile-link active">
        <i class="fas fa-th-large"></i>
        <span>Dashboard</span>
      </a>
      <a href="{{ route('admin.usuarios') }}" class="mobile-link">
        <i class="fas fa-users"></i>
        <span>Usuarios</span>
      </a>
      <a href="{{ route('admin.lotes') }}" class="mobile-link">
        <i class="fas fa-box"></i>
        <span>Lotes</span>
      </a>
    </div>
  </div>

  {{-- BANNER PENDIENTES --}}
  @if($usuariosPendientes > 0)
    <div class="banner-alert">
      <i class="fas fa-exclamation-circle"></i>
      <span class="banner-text">
        <strong>{{ $usuariosPendientes }} {{ $usuariosPendientes == 1 ? 'usuario pendiente' : 'usuarios pendientes' }}</strong>
        de aprobación están esperando revisión
      </span>
      <a href="{{ route('admin.usuarios') }}" class="banner-cta">Revisar ahora</a>
    </div>
  @endif

  <div class="main">

    {{-- ALERTA SUCCESS --}}
    @if(session('success'))
      <div class="alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
      </div>
    @endif

    {{-- ENCABEZADO --}}
    <div class="page-header">
      <h1 class="page-title">Buenos días, {{ auth()->user()->name }}</h1>
      <p class="page-sub">Panel de control y gestión de CaféTrace · {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    {{-- STATS --}}
    <div class="stats-grid">

      <div class="stat-card">
        <div class="stat-top">
          <div class="stat-icon blue"><i class="fas fa-users"></i></div>
          @if($usuariosPendientes > 0)
            <span class="stat-badge red">{{ $usuariosPendientes }} pendientes</span>
          @endif
        </div>
        <div>
          <div class="stat-val">{{ $totalUsuarios }}</div>
          <div class="stat-label">Total usuarios</div>
          <div class="stat-sub">{{ $totalCaficultores }} caficultores · {{ $totalCompradores }} compradores</div>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-top">
          <div class="stat-icon green"><i class="fas fa-box"></i></div>
          <span class="stat-badge up">{{ $lotesDisponibles }} activos</span>
        </div>
        <div>
          <div class="stat-val">{{ $totalLotes }}</div>
          <div class="stat-label">Total lotes</div>
          <div class="stat-sub">{{ $lotesDisponibles }} disponibles</div>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-top">
          <div class="stat-icon amber"><i class="fas fa-weight"></i></div>
          <span class="stat-badge warn">
            @if($totalKgRegistrados > 0)
              {{ round(($totalKgDisponibles / $totalKgRegistrados) * 100) }}% disp.
            @else
              0%
            @endif
          </span>
        </div>
        <div>
          <div class="stat-val">{{ number_format($totalKgRegistrados, 0) }}</div>
          <div class="stat-label">Kg registrados</div>
          <div class="stat-sub">{{ number_format($totalKgDisponibles, 0) }} disponibles</div>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-top">
          <div class="stat-icon purple"><i class="fas fa-exchange-alt"></i></div>
        </div>
        <div>
          <div class="stat-val">{{ $totalTransacciones }}</div>
          <div class="stat-label">Transacciones</div>
          <div class="stat-sub">${{ number_format($comisionesTotales, 0) }} comisión total</div>
        </div>
      </div>

    </div>

    {{-- USUARIOS + LOTES --}}
    <div class="content-grid">

      {{-- Usuarios pendientes --}}
      <div class="card">
        <div class="card-header">
          <span class="card-title">
            <i class="fas fa-user-check"></i> Usuarios pendientes
          </span>
          <a href="{{ route('admin.usuarios') }}" class="card-link">
            Ver todos <i class="fas fa-arrow-right" style="font-size:11px"></i>
          </a>
        </div>
        <div class="card-body">
          @if($usuariosPendientesLista->count() > 0)
            @foreach($usuariosPendientesLista as $usuario)
              <div class="user-item">
                <div class="user-avatar">{{ substr($usuario->name, 0, 1) }}</div>
                <div class="user-info">
                  <div class="user-name">{{ $usuario->name }}</div>
                  <div class="user-email">{{ $usuario->email }}</div>
                  <div class="user-meta">
                    @if($usuario->role)
                      @php
                        $rol = strtolower($usuario->role->nombre);
                        $badgeClass = $rol === 'caficultor' ? 'badge-green' : ($rol === 'comprador' ? 'badge-amber' : 'badge-blue');
                      @endphp
                      <span class="badge {{ $badgeClass }}">{{ ucfirst($usuario->role->nombre) }}</span>
                    @else
                      <span class="badge badge-gray">Sin rol</span>
                    @endif
                    <span class="time-label">
                      <i class="fas fa-clock"></i>
                      {{ $usuario->created_at->diffForHumans() }}
                    </span>
                  </div>
                </div>
                <div class="user-actions">
                  <form method="POST" action="{{ route('admin.usuarios.aprobar', $usuario->id) }}">
                    @csrf
                    <button type="submit" class="btn-approve"
                            onclick="return confirm('¿Aprobar a {{ $usuario->name }}?')"
                            title="Aprobar">
                      <i class="fas fa-check"></i>
                    </button>
                  </form>
                  <form method="POST" action="{{ route('admin.usuarios.rechazar', $usuario->id) }}">
                    @csrf
                    <button type="submit" class="btn-reject"
                            onclick="return confirm('¿Rechazar a {{ $usuario->name }}?')"
                            title="Rechazar">
                      <i class="fas fa-times"></i>
                    </button>
                  </form>
                </div>
              </div>
            @endforeach
          @else
            <div class="card-empty">
              <i class="fas fa-check-circle"></i>
              No hay usuarios pendientes de aprobación
            </div>
          @endif
        </div>
      </div>

      {{-- Últimos lotes --}}
      <div class="card">
        <div class="card-header">
          <span class="card-title">
            <i class="fas fa-box"></i> Últimos lotes
          </span>
          <a href="{{ route('admin.lotes') }}" class="card-link">
            Ver todos <i class="fas fa-arrow-right" style="font-size:11px"></i>
          </a>
        </div>
        <div class="card-body">
          @if($ultimosLotes->count() > 0)
            @foreach($ultimosLotes as $lote)
              <div class="lote-item">
                <div class="lote-thumb">
                  @if($lote->imagenes->first())
                    <img src="{{ asset('storage/' . $lote->imagenes->first()->ruta_imagen) }}"
                         alt="{{ $lote->codigo_lote }}">
                  @else
                    <i class="fas fa-coffee"></i>
                  @endif
                </div>
                <div class="lote-info">
                  <div class="lote-name">{{ $lote->variedad }}</div>
                  <div class="lote-code">{{ $lote->codigo_lote }}</div>
                  @if($lote->caficultor)
                    <div class="lote-grower">
                      <i class="fas fa-user"></i> {{ $lote->caficultor->name }}
                    </div>
                  @endif
                </div>
                <div class="lote-price">
                  <div class="lote-val">${{ number_format($lote->precio_por_kg, 0) }}/kg</div>
                  <div class="lote-kg">{{ number_format($lote->peso_disponible, 0) }} kg disp.</div>
                </div>
              </div>
            @endforeach
          @else
            <div class="card-empty">
              <i class="fas fa-box-open"></i>
              No hay lotes registrados
            </div>
          @endif
        </div>
      </div>

    </div>

    {{-- BOTTOM: ACCESO RÁPIDO + RESUMEN + ESTADO --}}
    <div class="bottom-grid">

      <div class="mini-card">
        <div class="mini-title"><i class="fas fa-bolt"></i> Acceso rápido</div>
        <a href="{{ route('admin.usuarios') }}" class="mini-link">
          <i class="fas fa-users"></i> Gestionar usuarios
        </a>
        <a href="{{ route('admin.lotes') }}" class="mini-link">
          <i class="fas fa-box"></i> Gestionar lotes
        </a>
      </div>

      <div class="mini-card">
        <div class="mini-title"><i class="fas fa-chart-line"></i> Resumen</div>
        <div class="summary-row">
          <span class="summary-label">Caficultores activos</span>
          <span class="summary-val">{{ $totalCaficultores }}</span>
        </div>
        <div class="summary-row">
          <span class="summary-label">Compradores activos</span>
          <span class="summary-val">{{ $totalCompradores }}</span>
        </div>
        <div class="summary-row">
          <span class="summary-label">Lotes disponibles</span>
          <span class="summary-val">{{ $lotesDisponibles }}</span>
        </div>
        <div class="summary-row">
          <span class="summary-label">Pendientes aprobación</span>
          <span class="summary-val" style="{{ $usuariosPendientes > 0 ? 'color:#854f0b' : '' }}">
            {{ $usuariosPendientes }}
          </span>
        </div>
      </div>

      <div class="mini-card">
        <div class="mini-title"><i class="fas fa-server"></i> Estado del sistema</div>
        <div class="status-row">
          <span class="status-label">Base de datos</span>
          <span class="status-ok"><span class="status-dot"></span> Activa</span>
        </div>
        <div class="status-row">
          <span class="status-label">Servidor</span>
          <span class="status-ok"><span class="status-dot"></span> Online</span>
        </div>
        <div class="status-row">
          <span class="status-label">Última actualización</span>
          <span class="status-time">{{ now()->format('d/m/Y H:i') }}</span>
        </div>
      </div>

    </div>
  </div>
</div>

@endsection
