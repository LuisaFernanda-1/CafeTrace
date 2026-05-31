@extends('layouts.app')

@section('title', 'Gestión de Usuarios - Admin')

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
.page-header{background:#fff;border:0.5px solid var(--border);border-radius:12px;padding:20px 24px;margin-bottom:16px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px}
.page-title{font-size:18px;font-weight:500;color:var(--cafe-900);display:flex;align-items:center;gap:10px}
.page-title i{color:var(--cafe-500)}
.page-sub{font-size:13px;color:#9a7a5e;margin-top:3px}

/* FILTROS */
.filters{background:#fff;border:0.5px solid var(--border);border-radius:12px;padding:14px 20px;margin-bottom:20px;display:flex;flex-wrap:wrap;gap:8px;align-items:center}
.filter-label{font-size:12px;color:#9a7a5e;margin-right:4px}
.filter-btn{display:inline-flex;align-items:center;gap:6px;padding:6px 14px;border-radius:8px;font-size:12px;font-weight:500;text-decoration:none;border:0.5px solid var(--border);background:#fff;color:#9a7a5e;transition:all 0.15s}
.filter-btn:hover{background:var(--cream);color:var(--cafe-800)}
.filter-btn.active-all{background:var(--cafe-800);color:#fff;border-color:var(--cafe-800)}
.filter-btn.active-pendiente{background:#faeeda;color:#854f0b;border-color:#e4c08a}
.filter-btn.active-activo{background:#eaf3de;color:#3b6d11;border-color:#b3d47f}
.filter-btn.active-inactivo{background:#fcebeb;color:#a32d2d;border-color:#f5b8b8}

/* TABLE CARD */
.table-card{background:#fff;border:0.5px solid var(--border);border-radius:12px;overflow:hidden}
.table-wrap{overflow-x:auto}

table{width:100%;border-collapse:collapse}
thead tr{background:var(--cream);border-bottom:0.5px solid var(--border)}
thead th{padding:12px 20px;text-align:left;font-size:11px;font-weight:500;color:#9a7a5e;text-transform:uppercase;letter-spacing:0.8px;white-space:nowrap}
thead th.center{text-align:center}

tbody tr{border-bottom:0.5px solid var(--border);transition:background 0.12s}
tbody tr:last-child{border-bottom:none}
tbody tr:hover{background:var(--cafe-50)}
td{padding:14px 20px;vertical-align:middle}

/* USUARIO COL */
.user-cell{display:flex;align-items:center;gap:12px}
.user-avatar{width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,var(--cafe-500),var(--cafe-900));display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:500;color:#fff;flex-shrink:0}
.user-name{font-size:13px;font-weight:500;color:var(--cafe-900);white-space:nowrap}
.user-email{font-size:11px;color:#9a7a5e;white-space:nowrap}

/* BADGES */
.badge{display:inline-flex;align-items:center;gap:4px;font-size:11px;font-weight:500;padding:3px 10px;border-radius:20px}
.badge i{font-size:10px}
.badge-green{background:#eaf3de;color:#3b6d11}
.badge-amber{background:#faeeda;color:#854f0b}
.badge-blue{background:#e6f1fb;color:#185fa5}
.badge-gray{background:#f1efe8;color:#5f5e5a}
.badge-red{background:#fcebeb;color:#a32d2d}

/* CONTACTO */
.contact-phone{font-size:12px;color:var(--cafe-900);display:flex;align-items:center;gap:5px}
.contact-phone i{font-size:11px;color:#c4b09a}
.contact-doc{font-size:11px;color:#9a7a5e;display:flex;align-items:center;gap:5px;margin-top:3px}
.contact-doc i{font-size:11px;color:#c4b09a}

/* FECHA */
.date-cell{font-size:12px;color:#9a7a5e;white-space:nowrap;display:flex;align-items:center;gap:5px}
.date-cell i{font-size:11px;color:#c4b09a}

/* ACCIONES */
.actions-cell{display:flex;align-items:center;justify-content:center;gap:6px}
.btn-action{width:32px;height:32px;border-radius:8px;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:14px;transition:background 0.15s}
.btn-action i{font-size:13px}
.btn-approve{background:#eaf3de;color:#3b6d11}
.btn-approve:hover{background:#c0dd97}
.btn-reject{background:#fcebeb;color:#a32d2d}
.btn-reject:hover{background:#f7c1c1}
.btn-disable{background:#f1efe8;color:#5f5e5a}
.btn-disable:hover{background:#d3d1c7}

/* EMPTY */
.empty-state{text-align:center;padding:60px 20px}
.empty-state i{font-size:48px;color:#d6c9bb;display:block;margin-bottom:12px}
.empty-title{font-size:17px;font-weight:500;color:var(--cafe-900);margin-bottom:6px}
.empty-sub{font-size:13px;color:#9a7a5e}

/* PAGINATION */
.pagination-wrap{padding:14px 20px;border-top:0.5px solid var(--border)}

@media(max-width:640px){
  .nav-links{display:none}
  .nav-username{display:none}
  .mobile-nav{display:block}
  .main{padding:16px}
  thead th:nth-child(3),td:nth-child(3),
  thead th:nth-child(5),td:nth-child(5){display:none}
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
      <a href="{{ route('admin.usuarios') }}" class="nav-link active">
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
      <a href="{{ route('admin.usuarios') }}" class="mobile-link active">
        <i class="fas fa-users"></i><span>Usuarios</span>
      </a>
      <a href="{{ route('admin.lotes') }}" class="mobile-link">
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
          <i class="fas fa-users"></i> Gestión de usuarios
        </div>
        <div class="page-sub">{{ $usuarios->total() }} usuarios registrados en la plataforma</div>
      </div>
    </div>

    {{-- FILTROS --}}
    <div class="filters">
      <span class="filter-label">Filtrar por:</span>
      <a href="{{ route('admin.usuarios') }}"
         class="filter-btn {{ !request('estado') ? 'active-all' : '' }}">
        <i class="fas fa-list"></i> Todos
      </a>
      <a href="{{ route('admin.usuarios', ['estado' => 'pendiente']) }}"
         class="filter-btn {{ request('estado') == 'pendiente' ? 'active-pendiente' : '' }}">
        <i class="fas fa-clock"></i> Pendientes
      </a>
      <a href="{{ route('admin.usuarios', ['estado' => 'activo']) }}"
         class="filter-btn {{ request('estado') == 'activo' ? 'active-activo' : '' }}">
        <i class="fas fa-check-circle"></i> Activos
      </a>
      <a href="{{ route('admin.usuarios', ['estado' => 'inactivo']) }}"
         class="filter-btn {{ request('estado') == 'inactivo' ? 'active-inactivo' : '' }}">
        <i class="fas fa-times-circle"></i> Inactivos
      </a>
    </div>

    {{-- TABLA --}}
    <div class="table-card">
      @if($usuarios->count() > 0)
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Contacto</th>
                <th>Estado</th>
                <th>Registro</th>
                <th class="center">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($usuarios as $usuario)
                <tr>

                  {{-- USUARIO --}}
                  <td>
                    <div class="user-cell">
                      <div class="user-avatar">{{ substr($usuario->name, 0, 1) }}</div>
                      <div>
                        <div class="user-name">{{ $usuario->name }}</div>
                        <div class="user-email">{{ $usuario->email }}</div>
                      </div>
                    </div>
                  </td>

                  {{-- ROL --}}
                  <td>
                    @if($usuario->role)
                      @php $rol = strtolower($usuario->role->nombre); @endphp
                      <span class="badge {{ $rol === 'caficultor' ? 'badge-green' : ($rol === 'comprador' ? 'badge-amber' : 'badge-blue') }}">
                        {{ ucfirst($usuario->role->nombre) }}
                      </span>
                    @else
                      <span class="badge badge-gray">Sin rol</span>
                    @endif
                  </td>

                  {{-- CONTACTO --}}
                  <td>
                    @if($usuario->telefono)
                      <div class="contact-phone">
                        <i class="fas fa-phone"></i> {{ $usuario->telefono }}
                      </div>
                    @endif
                    @if($usuario->documento)
                      <div class="contact-doc">
                        <i class="fas fa-id-card"></i> {{ $usuario->documento }}
                      </div>
                    @endif
                    @if(!$usuario->telefono && !$usuario->documento)
                      <span style="font-size:12px;color:#c4b09a">—</span>
                    @endif
                  </td>

                  {{-- ESTADO --}}
                  <td>
                    @if($usuario->estado == 'activo')
                      <span class="badge badge-green"><i class="fas fa-check-circle"></i> Activo</span>
                    @elseif($usuario->estado == 'pendiente')
                      <span class="badge badge-amber"><i class="fas fa-clock"></i> Pendiente</span>
                    @else
                      <span class="badge badge-red"><i class="fas fa-times-circle"></i> Inactivo</span>
                    @endif
                  </td>

                  {{-- REGISTRO --}}
                  <td>
                    <div class="date-cell">
                      <i class="fas fa-calendar"></i>
                      {{ $usuario->created_at->format('d/m/Y') }}
                    </div>
                  </td>

                  {{-- ACCIONES --}}
                  <td>
                    <div class="actions-cell">
                      @if($usuario->estado == 'pendiente')
                        <form method="POST" action="{{ route('admin.usuarios.aprobar', $usuario->id) }}" style="display:inline">
                          @csrf
                          <button type="submit" class="btn-action btn-approve"
                                  title="Aprobar"
                                  onclick="return confirm('¿Aprobar a {{ $usuario->name }}?')">
                            <i class="fas fa-check"></i>
                          </button>
                        </form>
                        <form method="POST" action="{{ route('admin.usuarios.rechazar', $usuario->id) }}" style="display:inline">
                          @csrf
                          <button type="submit" class="btn-action btn-reject"
                                  title="Rechazar"
                                  onclick="return confirm('¿Rechazar a {{ $usuario->name }}?')">
                            <i class="fas fa-times"></i>
                          </button>
                        </form>

                      @elseif($usuario->estado == 'activo')
                        <form method="POST" action="{{ route('admin.usuarios.rechazar', $usuario->id) }}" style="display:inline">
                          @csrf
                          <button type="submit" class="btn-action btn-disable"
                                  title="Desactivar"
                                  onclick="return confirm('¿Desactivar a {{ $usuario->name }}?')">
                            <i class="fas fa-ban"></i>
                          </button>
                        </form>

                      @else
                        <form method="POST" action="{{ route('admin.usuarios.aprobar', $usuario->id) }}" style="display:inline">
                          @csrf
                          <button type="submit" class="btn-action btn-approve"
                                  title="Activar"
                                  onclick="return confirm('¿Activar a {{ $usuario->name }}?')">
                            <i class="fas fa-check-circle"></i>
                          </button>
                        </form>
                      @endif
                    </div>
                  </td>

                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        {{-- PAGINACIÓN --}}
        <div class="pagination-wrap">
          {{ $usuarios->links() }}
        </div>

      @else
        <div class="empty-state">
          <i class="fas fa-users"></i>
          <div class="empty-title">No hay usuarios</div>
          <div class="empty-sub">No se encontraron usuarios con los filtros seleccionados</div>
        </div>
      @endif
    </div>

  </div>
</div>

@endsection
