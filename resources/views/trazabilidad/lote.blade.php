@extends('layouts.app')

@section('title', 'Trazabilidad · ' . $lote->codigo_lote)

@section('content')
<style>
*{box-sizing:border-box;margin:0;padding:0}
:root{
  --g800:#1a4a14;--g700:#246019;--g600:#2d7a1f;--g500:#3d9e2a;--g400:#5ab83a;--g100:#e8f5e0;
  --amber:#c47c0a;--amber-bg:#fef3d6;
  --cream:#fafaf7;--white:#fff;--border:#e4e8df;--text:#1a2416;--muted:#5a6e52;--hint:#9aac8e;
}
body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;background:var(--cream);color:var(--text);min-height:100vh}

/* NAV */
.nav{background:var(--g800);height:62px;padding:0 28px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:100;border-bottom:1px solid rgba(255,255,255,0.07)}
.nav-brand{display:flex;align-items:center;gap:12px}
.nav-logo{width:38px;height:38px;border-radius:50%;border:1.5px solid rgba(255,255,255,0.2);overflow:hidden;background:#fff}
.nav-logo img{width:100%;height:100%;object-fit:cover;display:block}
.nav-title{font-size:15px;font-weight:600;color:#fff}
.nav-sub{font-size:10px;color:rgba(255,255,255,0.45);letter-spacing:2px;text-transform:uppercase}
.nav-badge{display:flex;align-items:center;gap:7px;background:rgba(141,212,104,0.15);border:1px solid rgba(141,212,104,0.25);padding:6px 14px;border-radius:999px}
.nav-badge-dot{width:7px;height:7px;border-radius:50%;background:#86efac;animation:dotPulse 1.8s infinite}
@keyframes dotPulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.4;transform:scale(.75)}}
.nav-badge-label{font-size:11px;color:#86efac;font-weight:600}
.btn-home{display:flex;align-items:center;gap:6px;padding:7px 14px;border-radius:8px;background:rgba(255,255,255,0.08);color:rgba(255,255,255,0.75);font-size:13px;text-decoration:none;transition:all 0.15s}
.btn-home:hover{background:rgba(255,255,255,0.15);color:#fff}

/* MAIN */
.main{max-width:980px;margin:0 auto;padding:28px 20px 60px}

/* HERO CODE */
.hero-code{background:linear-gradient(135deg,var(--g800),var(--g600));border-radius:18px;padding:24px 28px;margin-bottom:22px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:14px}
.hero-code-left{display:flex;align-items:center;gap:16px}
.hero-icon{width:50px;height:50px;border-radius:12px;background:rgba(255,255,255,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.hero-icon svg{width:26px;height:26px;fill:#fff}
.hero-label{font-size:11px;color:rgba(255,255,255,0.6);letter-spacing:2px;text-transform:uppercase;margin-bottom:4px}
.hero-code-val{font-size:20px;font-weight:700;color:#fff;letter-spacing:1px;font-family:monospace}
.hero-verified{display:flex;align-items:center;gap:8px;background:rgba(134,239,172,0.15);border:1px solid rgba(134,239,172,0.3);padding:8px 16px;border-radius:999px}
.hero-verified svg{width:16px;height:16px;fill:#86efac;flex-shrink:0}
.hero-verified-txt{font-size:12px;font-weight:600;color:#86efac}

/* GRID */
.grid-2{display:grid;grid-template-columns:1fr 320px;gap:18px;align-items:start}

/* CARDS */
.card{background:var(--white);border:0.5px solid var(--border);border-radius:16px;overflow:hidden;margin-bottom:18px}
.card-last{margin-bottom:0}
.card-header{padding:16px 20px;border-bottom:0.5px solid var(--border);display:flex;align-items:center;gap:10px}
.card-header svg{width:16px;height:16px;fill:var(--g500);flex-shrink:0}
.card-header-title{font-size:14px;font-weight:600;color:var(--text)}
.card-body{padding:18px 20px}

/* GALLERY */
.gallery-main{width:100%;height:260px;object-fit:cover;display:block;background:var(--g100)}
.gallery-thumbs{display:flex;gap:8px;padding:12px 20px;overflow-x:auto;background:var(--cream);border-top:0.5px solid var(--border)}
.thumb{width:56px;height:56px;border-radius:8px;object-fit:cover;cursor:pointer;border:2px solid transparent;flex-shrink:0;transition:border-color 0.15s}
.thumb:hover{border-color:var(--g400)}

/* BADGES */
.badges{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:16px}
.badge{display:inline-flex;align-items:center;gap:5px;padding:5px 12px;border-radius:999px;font-size:11px;font-weight:600}
.badge-green{background:var(--g100);color:var(--g700)}
.badge-blue{background:#eff6ff;color:#1d4ed8}

/* STATS */
.stats-row{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin-bottom:18px}
.stat{background:var(--cream);border:0.5px solid var(--border);border-radius:12px;padding:14px;text-align:center}
.stat-val{font-size:18px;font-weight:700;color:var(--text);line-height:1}
.stat-lbl{font-size:10px;color:var(--hint);margin-top:4px;text-transform:uppercase;letter-spacing:1px}

/* DESCRIPCION */
.desc{font-size:13.5px;color:var(--muted);line-height:1.75;margin-bottom:18px}

/* TIMELINE PRODUCCIÓN */
.tl-prod{position:relative;padding-left:32px}
.tl-prod::before{content:'';position:absolute;left:9px;top:8px;bottom:8px;width:2px;background:linear-gradient(to bottom,var(--g400),var(--amber))}
.tl-item{position:relative;margin-bottom:18px}
.tl-item:last-child{margin-bottom:0}
.tl-circle{position:absolute;left:-32px;width:20px;height:20px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.tl-circle svg{width:10px;height:10px;fill:#fff}
.tl-g{background:var(--g500)}
.tl-b{background:#3b82f6}
.tl-p{background:#8b5cf6}
.tl-c{background:#06b6d4}
.tl-a{background:var(--amber)}
.tl-text{}
.tl-title{font-size:13px;font-weight:600;color:var(--text)}
.tl-date{font-size:11px;color:var(--hint);margin-top:2px}

/* CAFICULTOR CARD */
.caf-head{text-align:center;padding-bottom:16px;border-bottom:0.5px solid var(--border);margin-bottom:16px}
.caf-avatar{width:64px;height:64px;border-radius:50%;background:linear-gradient(135deg,var(--g400),var(--g700));display:flex;align-items:center;justify-content:center;margin:0 auto 10px;border:3px solid var(--g100)}
.caf-avatar svg{width:30px;height:30px;fill:#fff}
.caf-name{font-size:15px;font-weight:600;color:var(--text)}
.caf-role{font-size:11px;color:var(--hint);margin-top:2px;text-transform:uppercase;letter-spacing:1px}
.caf-info-row{display:flex;align-items:flex-start;gap:10px;margin-bottom:12px}
.caf-info-row svg{width:14px;height:14px;fill:var(--g500);flex-shrink:0;margin-top:2px}
.caf-info-lbl{font-size:10px;color:var(--hint);margin-bottom:2px;text-transform:uppercase;letter-spacing:0.5px}
.caf-info-val{font-size:13px;font-weight:500;color:var(--text)}

/* VERIFICACIÓN */
.verif{background:linear-gradient(135deg,var(--g100),var(--amber-bg));border:0.5px solid var(--border);border-radius:16px;padding:18px 20px}
.verif-title{font-size:13px;font-weight:600;color:var(--text);display:flex;align-items:center;gap:8px;margin-bottom:14px}
.verif-title svg{width:15px;height:15px;fill:var(--amber)}
.verif-item{display:flex;align-items:center;gap:8px;margin-bottom:10px;font-size:12.5px;color:var(--muted)}
.verif-item:last-child{margin-bottom:0}
.verif-item svg{width:14px;height:14px;fill:var(--g500);flex-shrink:0}

/* BLOCKCHAIN */
.hash-box{background:var(--cream);border:0.5px solid var(--border);border-radius:10px;padding:12px 14px}
.hash-lbl{font-size:10px;color:var(--hint);margin-bottom:5px;text-transform:uppercase;letter-spacing:1px}
.hash-val{font-size:10px;font-family:monospace;color:var(--muted);word-break:break-all;line-height:1.6}

@media(max-width:760px){.grid-2{grid-template-columns:1fr}.stats-row{grid-template-columns:repeat(3,1fr)}.hero-code{flex-direction:column}.main{padding:16px 14px 48px}}
@media(max-width:400px){.stats-row{grid-template-columns:1fr 1fr}.nav-badge{display:none}}
</style>

<div>
{{-- NAV --}}
<nav class="nav">
  <div class="nav-brand">
    <div class="nav-logo"><img src="{{ asset('images/CafeTrace.png') }}" alt="CaféTrace"></div>
    <div><div class="nav-title">CaféTrace</div><div class="nav-sub">Trazabilidad</div></div>
  </div>
  <div style="display:flex;align-items:center;gap:10px">
    <div class="nav-badge">
      <span class="nav-badge-dot"></span>
      <span class="nav-badge-label">Verificado</span>
    </div>
    <a href="/" class="btn-home">
      <svg viewBox="0 0 24 24" fill="currentColor" width="14" height="14"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
      Inicio
    </a>
  </div>
</nav>

<div class="main">
  {{-- HERO --}}
  <div class="hero-code">
    <div class="hero-code-left">
      <div class="hero-icon">
        <svg viewBox="0 0 24 24"><path d="M2 21l1.65-3.8A9 9 0 1112 21H2zm10-2a7 7 0 100-14 7 7 0 000 14z"/></svg>
      </div>
      <div>
        <div class="hero-label">Código de trazabilidad</div>
        <div class="hero-code-val">{{ $lote->codigo_lote }}</div>
      </div>
    </div>
    <div class="hero-verified">
      <svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
      <span class="hero-verified-txt">Trazabilidad blockchain verificada</span>
    </div>
  </div>

  <div class="grid-2">
    {{-- COLUMNA PRINCIPAL --}}
    <div>

      {{-- GALERÍA --}}
      @if($lote->imagenes->count() > 0)
      <div class="card">
        <img id="imgMain" class="gallery-main" src="{{ asset('storage/' . $lote->imagenes->first()->ruta_imagen) }}" alt="{{ $lote->variedad }}">
        @if($lote->imagenes->count() > 1)
        <div class="gallery-thumbs">
          @foreach($lote->imagenes as $img)
          <img class="thumb" src="{{ asset('storage/' . $img->ruta_imagen) }}" onclick="document.getElementById('imgMain').src=this.src" alt="">
          @endforeach
        </div>
        @endif
      </div>
      @endif

      {{-- INFO LOTE --}}
      <div class="card">
        <div class="card-header">
          <svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 100 20A10 10 0 0012 2zm1 17.93V18h-2v1.93A8 8 0 014.07 13H6v-2H4.07A8 8 0 0111 4.07V6h2V4.07A8 8 0 0119.93 11H18v2h1.93A8 8 0 0113 19.93z"/></svg>
          <span class="card-header-title">Café {{ $lote->variedad }}</span>
        </div>
        <div class="card-body">
          <div class="badges">
            @if($lote->es_organico)
              <span class="badge badge-green">
                <svg viewBox="0 0 24 24" width="10" height="10" fill="currentColor"><path d="M17 8C8 10 5.9 16.17 3.82 21.33L5.71 22l1-2.3A4.49 4.49 0 008 20C19 20 22 3 22 3c-1 2-8 2-8 2z"/></svg>
                Orgánico
              </span>
            @endif
            @if($lote->comercio_justo)
              <span class="badge badge-blue">
                <svg viewBox="0 0 24 24" width="10" height="10" fill="currentColor"><path d="M11 6.5A2.5 2.5 0 0113.5 4H22v13h-8.5A2.5 2.5 0 0011 19.5V6.5zM2 7h7v13H2V7z"/></svg>
                Comercio justo
              </span>
            @endif
            <span class="badge" style="background:#f3e8ff;color:#7c3aed">{{ $lote->estado }}</span>
          </div>

          <div class="stats-row">
            <div class="stat">
              <div class="stat-val">{{ number_format($lote->peso_kg, 0) }} kg</div>
              <div class="stat-lbl">Peso total</div>
            </div>
            <div class="stat">
              <div class="stat-val">{{ number_format($lote->altura_msnm, 0) }}</div>
              <div class="stat-lbl">msnm</div>
            </div>
            <div class="stat">
              <div class="stat-val">{{ $lote->fecha_cosecha->format('d/m/Y') }}</div>
              <div class="stat-lbl">Cosecha</div>
            </div>
          </div>

          @if($lote->descripcion)
            <p class="desc">{{ $lote->descripcion }}</p>
          @endif

          {{-- PROCESO --}}
          <div class="card-header" style="padding:0 0 12px 0;border-bottom:0.5px solid var(--border);margin-bottom:16px">
            <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
            <span class="card-header-title">Proceso de producción</span>
          </div>
          <div class="tl-prod">
            @if($lote->fecha_cosecha)
            <div class="tl-item">
              <div class="tl-circle tl-g">
                <svg viewBox="0 0 24 24"><path d="M17 8C8 10 5.9 16.17 3.82 21.33L5.71 22l1-2.3A4.49 4.49 0 008 20C19 20 22 3 22 3c-1 2-8 2-8 2z"/></svg>
              </div>
              <div class="tl-text">
                <div class="tl-title">Cosecha</div>
                <div class="tl-date">{{ $lote->fecha_cosecha->format('d \d\e F \d\e Y') }}</div>
              </div>
            </div>
            @endif
            @if($lote->fecha_despulpado)
            <div class="tl-item">
              <div class="tl-circle tl-b">
                <svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 100 20A10 10 0 0012 2zm0 18a8 8 0 110-16 8 8 0 010 16z"/></svg>
              </div>
              <div class="tl-text">
                <div class="tl-title">Despulpado</div>
                <div class="tl-date">{{ $lote->fecha_despulpado->format('d \d\e F \d\e Y') }}</div>
              </div>
            </div>
            @endif
            @if($lote->fecha_fermentacion)
            <div class="tl-item">
              <div class="tl-circle tl-p">
                <svg viewBox="0 0 24 24"><path d="M7 2v2H5v14a2 2 0 002 2h10a2 2 0 002-2V4h-2V2H7z"/></svg>
              </div>
              <div class="tl-text">
                <div class="tl-title">Fermentación</div>
                <div class="tl-date">{{ $lote->fecha_fermentacion->format('d \d\e F \d\e Y') }}</div>
              </div>
            </div>
            @endif
            @if($lote->fecha_lavado)
            <div class="tl-item">
              <div class="tl-circle tl-c">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93s3.05-7.44 7-7.93v15.86z"/></svg>
              </div>
              <div class="tl-text">
                <div class="tl-title">Lavado</div>
                <div class="tl-date">{{ $lote->fecha_lavado->format('d \d\e F \d\e Y') }}</div>
              </div>
            </div>
            @endif
            @if($lote->fecha_secado)
            <div class="tl-item">
              <div class="tl-circle tl-a">
                <svg viewBox="0 0 24 24"><path d="M12 7c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zM2 13h2c.55 0 1-.45 1-1s-.45-1-1-1H2c-.55 0-1 .45-1 1s.45 1 1 1zm18 0h2c.55 0 1-.45 1-1s-.45-1-1-1h-2c-.55 0-1 .45-1 1s.45 1 1 1zM11 2v2c0 .55.45 1 1 1s1-.45 1-1V2c0-.55-.45-1-1-1s-1 .45-1 1zm0 18v2c0 .55.45 1 1 1s1-.45 1-1v-2c0-.55-.45-1-1-1s-1 .45-1 1z"/></svg>
              </div>
              <div class="tl-text">
                <div class="tl-title">Secado</div>
                <div class="tl-date">{{ $lote->fecha_secado->format('d \d\e F \d\e Y') }}</div>
              </div>
            </div>
            @endif
          </div>
        </div>
      </div>

      {{-- BLOCKCHAIN --}}
      @if($lote->hash_blockchain)
      <div class="card card-last">
        <div class="card-header">
          <svg viewBox="0 0 24 24"><path d="M10.9 2.1l9.899 1.415 1.414 9.9-9.192 9.192a1 1 0 01-1.414 0l-9.9-9.9a1 1 0 010-1.414L10.9 2.1zm.707 2.122L3.828 12l8.486 8.485 7.778-7.778-1.06-7.425-7.425-1.06zM15.5 8a1.5 1.5 0 110 3 1.5 1.5 0 010-3z"/></svg>
          <span class="card-header-title">Registro blockchain</span>
        </div>
        <div class="card-body">
          <div class="hash-box">
            <div class="hash-lbl">Hash de verificación</div>
            <div class="hash-val">{{ $lote->hash_blockchain }}</div>
          </div>
          @if($lote->fecha_registro_blockchain)
          <p style="font-size:11px;color:var(--hint);margin-top:8px">Registrado el {{ $lote->fecha_registro_blockchain->format('d/m/Y H:i') }}</p>
          @endif
        </div>
      </div>
      @endif

    </div>

    {{-- COLUMNA LATERAL --}}
    <div>
      {{-- CAFICULTOR --}}
      <div class="card">
        <div class="card-header">
          <svg viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
          <span class="card-header-title">Productor</span>
        </div>
        <div class="card-body">
          <div class="caf-head">
            <div class="caf-avatar">
              <svg viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
            </div>
            <div class="caf-name">{{ $lote->caficultor->name }}</div>
            <div class="caf-role">Caficultor</div>
          </div>
          @if($lote->caficultor->nombre_finca ?? null)
          <div class="caf-info-row">
            <svg viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
            <div><div class="caf-info-lbl">Finca</div><div class="caf-info-val">{{ $lote->caficultor->nombre_finca }}</div></div>
          </div>
          @endif
          @if($lote->caficultor->departamento ?? null)
          <div class="caf-info-row">
            <svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
            <div><div class="caf-info-lbl">Ubicación</div><div class="caf-info-val">{{ $lote->caficultor->municipio ? $lote->caficultor->municipio . ', ' : '' }}{{ $lote->caficultor->departamento }}</div></div>
          </div>
          @endif
          @if($lote->caficultor->hectareas ?? null)
          <div class="caf-info-row">
            <svg viewBox="0 0 24 24"><path d="M3 5H1v16a2 2 0 002 2h16v-2H3V5zm18-4H7a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V3a2 2 0 00-2-2zm0 16H7V3h14v14z"/></svg>
            <div><div class="caf-info-lbl">Extensión</div><div class="caf-info-val">{{ $lote->caficultor->hectareas }} hectáreas</div></div>
          </div>
          @endif
        </div>
      </div>

      {{-- VERIFICACIÓN --}}
      <div class="verif">
        <div class="verif-title">
          <svg viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/></svg>
          Verificación CaféTrace
        </div>
        <div class="verif-item">
          <svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
          Trazabilidad 100% verificada
        </div>
        <div class="verif-item">
          <svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
          Información auténtica del productor
        </div>
        <div class="verif-item">
          <svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
          Proceso documentado paso a paso
        </div>
        <div class="verif-item">
          <svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
          Sin intermediarios · Directo del campo
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
