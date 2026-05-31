@extends('layouts.app')

@section('title', 'Código QR - ' . $lote->codigo_lote)

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
.nav-actions{display:flex;align-items:center;gap:8px}
.btn-back{display:flex;align-items:center;gap:7px;padding:8px 14px;border-radius:8px;font-size:13px;color:rgba(255,255,255,0.65);background:rgba(255,255,255,0.07);text-decoration:none;transition:all 0.15s}
.btn-back:hover{background:rgba(255,255,255,0.12);color:#fff}
.btn-logout{display:flex;align-items:center;gap:6px;padding:7px 12px;border-radius:8px;border:1px solid rgba(255,255,255,0.15);background:transparent;color:rgba(255,255,255,0.55);font-size:12px;cursor:pointer;transition:all 0.15s;font-family:inherit}
.btn-logout:hover{background:rgba(255,255,255,0.07);color:#fff}
.main{padding:24px 28px;max-width:900px;margin:0 auto}
/* LOTE INFO */
.lote-info-card{background:var(--white);border:0.5px solid var(--border);border-radius:14px;padding:18px 22px;margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap}
.lote-info-left{display:flex;align-items:center;gap:14px}
.lote-thumb{width:56px;height:56px;border-radius:10px;overflow:hidden;background:linear-gradient(135deg,var(--g700),var(--g900));display:flex;align-items:center;justify-content:center;flex-shrink:0}
.lote-thumb img{width:100%;height:100%;object-fit:cover}
.lote-thumb i{font-size:22px;color:rgba(255,255,255,0.3)}
.lote-name{font-size:16px;font-weight:500;color:var(--text)}
.lote-code{font-size:12px;color:var(--hint);margin-top:2px}
.lote-stats{display:flex;gap:14px}
.lote-stat{text-align:center}
.lote-stat-val{font-size:15px;font-weight:500;color:var(--text)}
.lote-stat-lbl{font-size:10px;color:var(--hint);margin-top:1px}
/* GRID */
.content-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.card{background:var(--white);border:0.5px solid var(--border);border-radius:14px;padding:22px}
.card-title{font-size:14px;font-weight:500;color:var(--text);display:flex;align-items:center;gap:8px;margin-bottom:18px}
.card-title i{font-size:16px;color:var(--g500)}
/* QR */
.qr-box{background:var(--cream);border:0.5px solid var(--border);border-radius:12px;padding:20px;display:flex;justify-content:center;align-items:center;margin-bottom:16px}
.qr-box svg,.qr-box img{max-width:220px;height:auto}
.btn-dl{display:flex;align-items:center;justify-content:center;gap:7px;padding:11px;border-radius:10px;font-size:13px;font-weight:500;text-decoration:none;margin-bottom:8px;transition:all 0.15s}
.btn-dl:last-child{margin-bottom:0}
.btn-dl-green{background:var(--g600);color:#fff}
.btn-dl-green:hover{background:var(--g700)}
.btn-dl-amber{background:var(--amber);color:#fff}
.btn-dl-amber:hover{background:#a36608}
.btn-dl-blue{background:#185fa5;color:#fff}
.btn-dl-blue:hover{background:#134d87}
/* STEPS */
.step{display:flex;gap:12px;align-items:flex-start;margin-bottom:16px}
.step:last-child{margin-bottom:0}
.step-num{width:30px;height:30px;border-radius:50%;background:var(--g100);color:var(--g700);font-size:13px;font-weight:500;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.step-title{font-size:13px;font-weight:500;color:var(--text);margin-bottom:3px}
.step-desc{font-size:12px;color:var(--muted);line-height:1.6}
/* TIP */
.tip{background:var(--amber-bg);border:0.5px solid #e4c08a;border-radius:10px;padding:12px 14px;font-size:12px;color:#5a3e08;display:flex;gap:8px;margin-top:18px}
.tip i{color:var(--amber);flex-shrink:0;margin-top:1px}
/* URL */
.url-card{background:var(--white);border:0.5px solid var(--border);border-radius:14px;padding:18px 22px;margin-top:16px}
.url-row{display:flex;gap:8px;align-items:center}
.url-input{flex:1;padding:9px 14px;border:1px solid var(--border);border-radius:9px;font-size:12px;color:var(--muted);background:var(--cream);font-family:monospace}
.btn-copy{display:flex;align-items:center;gap:6px;padding:9px 16px;border-radius:9px;background:var(--g600);color:#fff;font-size:13px;border:none;cursor:pointer;transition:background 0.15s;font-family:inherit;flex-shrink:0}
.btn-copy:hover{background:var(--g700)}
.url-hint{font-size:11px;color:var(--hint);margin-top:6px;display:flex;align-items:center;gap:4px}
@media(max-width:700px){.content-grid{grid-template-columns:1fr}.main{padding:16px}.lote-stats{display:none}}
</style>

<div>
<nav class="nav">
  <div class="nav-brand">
    <div class="nav-logo"><img src="{{ asset('images/logo-cafetrace.png') }}" alt="CaféTrace"></div>
    <div><div class="nav-name">QR · {{ $lote->codigo_lote }}</div><div class="nav-sub">Trazabilidad</div></div>
  </div>
  <div class="nav-actions">
    <a href="{{ route('caficultor.lotes.ver', $lote->id) }}" class="btn-back"><i class="fas fa-arrow-left"></i> Volver al lote</a>
    <form method="POST" action="{{ route('logout') }}">@csrf
      <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Salir</button>
    </form>
  </div>
</nav>

<div class="main">
  {{-- LOTE INFO --}}
  <div class="lote-info-card">
    <div class="lote-info-left">
      <div class="lote-thumb">
        @if($lote->imagenes->first())
          <img src="{{ asset('storage/' . $lote->imagenes->first()->ruta_imagen) }}" alt="">
        @else
          <i class="fas fa-coffee"></i>
        @endif
      </div>
      <div>
        <div class="lote-name">{{ $lote->variedad }}</div>
        <div class="lote-code">{{ $lote->codigo_lote }}</div>
      </div>
    </div>
    <div class="lote-stats">
      <div class="lote-stat"><div class="lote-stat-val">{{ number_format($lote->peso_kg, 0) }} kg</div><div class="lote-stat-lbl">Peso</div></div>
      <div class="lote-stat"><div class="lote-stat-val">{{ number_format($lote->altura_msnm, 0) }}</div><div class="lote-stat-lbl">msnm</div></div>
      <div class="lote-stat"><div class="lote-stat-val">{{ $lote->fecha_cosecha->format('d/m/Y') }}</div><div class="lote-stat-lbl">Cosecha</div></div>
    </div>
  </div>

  <div class="content-grid">
    {{-- QR --}}
    <div class="card">
      <div class="card-title"><i class="fas fa-qrcode"></i> Código QR</div>
      <div class="qr-box">
        {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(220)->margin(2)->errorCorrection('H')->generate(route('trazabilidad.lote', $lote->codigo_lote)) !!}
      </div>
      <a href="{{ route('caficultor.lotes.qr.descargar', $lote->id) }}" class="btn-dl btn-dl-green">
        <i class="fas fa-download"></i> Descargar QR (PNG)
      </a>
      <a href="{{ route('caficultor.lotes.qr.etiqueta', $lote->id) }}" class="btn-dl btn-dl-amber">
        <i class="fas fa-file-pdf"></i> Descargar etiqueta (PDF)
      </a>
      <a href="{{ route('trazabilidad.lote', $lote->codigo_lote) }}" target="_blank" class="btn-dl btn-dl-blue">
        <i class="fas fa-external-link-alt"></i> Ver trazabilidad
      </a>
    </div>

    {{-- INSTRUCCIONES --}}
    <div class="card">
      <div class="card-title"><i class="fas fa-info-circle"></i> ¿Cómo usar el QR?</div>
      <div class="step"><div class="step-num">1</div><div><div class="step-title">Descarga el QR</div><div class="step-desc">Descarga la imagen PNG o el PDF con la etiqueta completa.</div></div></div>
      <div class="step"><div class="step-num">2</div><div><div class="step-title">Imprime</div><div class="step-desc">Imprime en etiquetas adhesivas o directamente en tus empaques.</div></div></div>
      <div class="step"><div class="step-num">3</div><div><div class="step-title">Pega en tus productos</div><div class="step-desc">Coloca el QR en las bolsas de café para verificar la trazabilidad.</div></div></div>
      <div class="step"><div class="step-num">4</div><div><div class="step-title">Verificación instantánea</div><div class="step-desc">Cualquier persona puede escanear y ver la información completa.</div></div></div>
      <div class="tip"><i class="fas fa-lightbulb"></i><span>El QR apunta directamente a la página de trazabilidad pública de este lote.</span></div>
    </div>
  </div>

  {{-- URL --}}
  <div class="url-card">
    <div class="card-title" style="margin-bottom:12px"><i class="fas fa-link" style="color:var(--g500)"></i> URL de trazabilidad</div>
    <div class="url-row">
      <input type="text" id="urlTrazabilidad" value="{{ route('trazabilidad.lote', $lote->codigo_lote) }}" readonly class="url-input">
      <button onclick="copiarURL()" class="btn-copy"><i class="fas fa-copy"></i> Copiar</button>
    </div>
    <div class="url-hint"><i class="fas fa-info-circle"></i> Esta URL puede compartirse manualmente sin necesidad del QR</div>
  </div>
</div>
</div>

<script>
function copiarURL() {
  const input = document.getElementById('urlTrazabilidad');
  input.select();
  document.execCommand('copy');
  alert('✓ URL copiada al portapapeles');
}
</script>
@endsection