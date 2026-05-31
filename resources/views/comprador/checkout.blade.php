@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<style>
*{box-sizing:border-box;margin:0;padding:0}
:root{--a900:#4a1a00;--a800:#6b2800;--a700:#8b3a00;--a600:#b45309;--a500:#d97706;--a400:#f59e0b;--a300:#fbbf24;--a100:#fef3c7;--a50:#fffbf0;--cream:#fafaf7;--white:#fff;--border:#e8e0d0;--text:#1a1208;--muted:#6b5a3e;--hint:#a89a7c}
body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;background:var(--cream);color:var(--text)}
.nav{background:var(--a800);height:60px;padding:0 28px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid rgba(255,255,255,0.07)}
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
.main{padding:24px 28px;max-width:960px;margin:0 auto}
.alert-error{background:#fef2f2;border:1px solid #fecaca;color:#991b1b;padding:12px 16px;border-radius:10px;font-size:13px;margin-bottom:20px;display:flex;align-items:center;gap:8px}
/* STEPS */
.steps{background:var(--white);border:0.5px solid var(--border);border-radius:14px;padding:18px 24px;margin-bottom:20px;display:flex;align-items:center;justify-content:center;gap:0}
.step{display:flex;align-items:center;gap:8px}
.step-circle{width:34px;height:34px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:500;flex-shrink:0}
.sc-done{background:#3b6d11;color:#fff}
.sc-active{background:var(--a600);color:#fff}
.sc-pending{background:var(--border);color:var(--hint)}
.step-label{font-size:13px;font-weight:500}
.sl-done{color:#3b6d11}
.sl-active{color:var(--a600)}
.sl-pending{color:var(--hint)}
.step-line{width:60px;height:2px;background:var(--border);margin:0 4px}
.step-line.done{background:#3b6d11}
/* LAYOUT */
.layout{display:grid;grid-template-columns:1fr 260px;gap:16px}
.card{background:var(--white);border:0.5px solid var(--border);border-radius:14px;padding:20px;margin-bottom:14px}
.card-title{font-size:14px;font-weight:500;color:var(--text);display:flex;align-items:center;gap:7px;margin-bottom:16px}
.card-title i{color:var(--a500)}
/* CONTACT */
.field-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.field-label{font-size:11px;color:var(--muted);margin-bottom:5px}
.field-readonly{padding:9px 13px;border:1px solid var(--border);border-radius:9px;font-size:13px;color:var(--muted);background:var(--cream)}
/* ITEMS */
.checkout-item{display:flex;gap:12px;padding:12px;border-radius:10px;border:0.5px solid var(--border);margin-bottom:10px}
.checkout-item:last-child{margin-bottom:0}
.ci-thumb{width:56px;height:56px;border-radius:9px;overflow:hidden;flex-shrink:0;background:linear-gradient(135deg,var(--a600),var(--a900));display:flex;align-items:center;justify-content:center}
.ci-thumb img{width:100%;height:100%;object-fit:cover}
.ci-thumb i{font-size:18px;color:rgba(255,255,255,0.3)}
.ci-name{font-size:13px;font-weight:500;color:var(--text)}
.ci-code{font-size:11px;color:var(--hint)}
.ci-producer{font-size:11px;color:var(--muted);display:flex;align-items:center;gap:3px;margin-top:2px}
.ci-price{font-size:12px;color:var(--muted);margin-top:6px}
.ci-subtotal{font-size:14px;font-weight:500;color:var(--a600)}
/* NOTAS */
.notas-input{width:100%;padding:10px 14px;border:1px solid var(--border);border-radius:10px;font-size:13px;color:var(--text);font-family:inherit;resize:vertical;min-height:90px;outline:none;transition:border-color 0.15s}
.notas-input:focus{border-color:var(--a400);box-shadow:0 0 0 3px rgba(245,158,11,0.1)}
/* PAGO */
.pago-step{display:flex;gap:14px;align-items:flex-start;padding:14px 0;border-bottom:0.5px solid var(--border)}
.pago-step:last-child{border-bottom:none;padding-bottom:0}
.pago-num{width:28px;height:28px;border-radius:50%;background:var(--a600);color:#fff;font-size:12px;font-weight:600;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px}
.pago-title{font-size:13px;font-weight:600;color:var(--text);margin-bottom:4px}
.pago-desc{font-size:12px;color:var(--muted);line-height:1.6}
.banco-card{background:var(--cream);border:1px solid var(--border);border-radius:10px;padding:14px;margin-top:10px}
.banco-row{display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;font-size:13px}
.banco-row:last-child{margin-bottom:0}
.banco-lbl{color:var(--hint);font-size:11px;text-transform:uppercase;letter-spacing:0.5px}
.banco-val{font-weight:600;color:var(--text)}
.banco-total{font-size:18px;color:var(--a600)}
.metodo-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin-top:10px}
.metodo-opt{display:none}
.metodo-lbl{display:flex;flex-direction:column;align-items:center;gap:4px;padding:10px 6px;border:1.5px solid var(--border);border-radius:10px;cursor:pointer;transition:all 0.15s;text-align:center}
.metodo-lbl:hover{border-color:var(--a400)}
.metodo-opt:checked+.metodo-lbl{border-color:var(--a600);background:var(--a100)}
.metodo-icon{font-size:20px}
.metodo-name{font-size:11px;font-weight:600;color:var(--muted)}
.metodo-opt:checked+.metodo-lbl .metodo-name{color:var(--a700)}
.ref-input{width:100%;padding:10px 13px;border:1.5px solid var(--border);border-radius:9px;font-size:13px;color:var(--text);font-family:inherit;outline:none;transition:border-color 0.15s;margin-top:10px}
.ref-input:focus{border-color:var(--a400)}
.upload-area{border:2px dashed var(--border);border-radius:12px;padding:20px;text-align:center;cursor:pointer;transition:all 0.2s;margin-top:10px;position:relative}
.upload-area:hover{border-color:var(--a400);background:var(--a50)}
.upload-area input[type=file]{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%}
.upload-icon{font-size:28px;color:var(--a400);margin-bottom:6px}
.upload-text{font-size:13px;font-weight:500;color:var(--muted)}
.upload-hint{font-size:11px;color:var(--hint);margin-top:3px}
.upload-preview{display:none;align-items:center;gap:8px;padding:8px 12px;background:var(--cream);border-radius:8px;margin-top:8px;font-size:12px;color:var(--muted)}
.upload-preview i{color:#3b6d11}
/* BOTONES */
.form-btns{display:flex;gap:10px;margin-top:4px}
.btn-cancel{flex:1;display:flex;align-items:center;justify-content:center;gap:7px;padding:12px;border-radius:10px;background:var(--white);border:1px solid var(--border);color:var(--muted);font-size:13px;font-weight:500;text-decoration:none;transition:all 0.15s}
.btn-cancel:hover{background:var(--cream)}
.btn-confirmar{flex:2;display:flex;align-items:center;justify-content:center;gap:7px;padding:12px;border-radius:10px;background:#3b6d11;color:#fff;font-size:13px;font-weight:500;border:none;cursor:pointer;transition:all 0.15s;font-family:inherit}
.btn-confirmar:hover{background:#2d5a0e;transform:translateY(-1px)}
/* RESUMEN */
.resumen-card{background:var(--white);border:0.5px solid var(--border);border-radius:14px;padding:18px;position:sticky;top:16px}
.resumen-title{font-size:14px;font-weight:500;color:var(--text);margin-bottom:14px}
.res-row{display:flex;justify-content:space-between;font-size:12px;color:var(--muted);margin-bottom:7px}
.res-comision{display:flex;justify-content:space-between;font-size:11px;color:var(--hint);margin-bottom:7px}
.res-total-row{display:flex;justify-content:space-between;align-items:center;padding-top:10px;border-top:0.5px solid var(--border);margin-top:4px;margin-bottom:16px}
.res-total-lbl{font-size:13px;font-weight:500;color:var(--text)}
.res-total-val{font-size:22px;font-weight:500;color:#3b6d11}
.garantia-box{background:var(--cream);border:0.5px solid var(--border);border-radius:10px;padding:12px}
.garantia-title{font-size:12px;font-weight:500;color:var(--text);display:flex;align-items:center;gap:5px;margin-bottom:8px}
.garantia-title i{color:#3b6d11}
.garantia-item{display:flex;align-items:center;gap:6px;font-size:11px;color:var(--muted);margin-bottom:5px}
.garantia-item i{color:#3b6d11;font-size:11px}
@media(max-width:700px){.layout{grid-template-columns:1fr}.field-grid{grid-template-columns:1fr}.form-btns{flex-direction:column}.main{padding:16px}}
</style>

<div>
<nav class="nav">
  <div class="nav-brand">
    <div class="nav-logo"><img src="{{ asset('images/logo-cafetrace.png') }}" alt="CaféTrace"></div>
    <div><div class="nav-name">CaféTrace</div><div class="nav-sub">Checkout</div></div>
  </div>
  <div class="nav-actions">
    <a href="{{ route('comprador.carrito') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Volver al carrito</a>
    <form method="POST" action="{{ route('logout') }}">@csrf
      <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Salir</button>
    </form>
  </div>
</nav>

<div class="main">
  @if(session('error'))<div class="alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>@endif

  <div class="steps">
    <div class="step">
      <div class="step-circle sc-done"><i class="fas fa-check"></i></div>
      <span class="step-label sl-done">Carrito</span>
    </div>
    <div class="step-line done"></div>
    <div class="step">
      <div class="step-circle sc-active">2</div>
      <span class="step-label sl-active">Checkout</span>
    </div>
    <div class="step-line"></div>
    <div class="step">
      <div class="step-circle sc-pending">3</div>
      <span class="step-label sl-pending">Confirmación</span>
    </div>
  </div>

  <div class="layout">
    <div>
      <form method="POST" action="{{ route('comprador.confirmar-compra') }}" enctype="multipart/form-data">
        @csrf

        {{-- PRODUCTOS --}}
        <div class="card">
          <div class="card-title"><i class="fas fa-box"></i> Productos a comprar</div>
          @foreach($items as $item)
          <div class="checkout-item">
            <div class="ci-thumb">
              @if($item->lote->imagenes->first())
                <img src="{{ asset('storage/'.$item->lote->imagenes->first()->ruta_imagen) }}" alt="">
              @else
                <i class="fas fa-coffee"></i>
              @endif
            </div>
            <div style="flex:1">
              <div class="ci-name">{{ $item->lote->variedad }}</div>
              <div class="ci-code">{{ $item->lote->codigo_lote }}</div>
              <div class="ci-producer"><i class="fas fa-user" style="font-size:10px;color:var(--a400)"></i> {{ $item->lote->caficultor->name }}</div>
              <div style="display:flex;justify-content:space-between;align-items:center;margin-top:6px">
                <div class="ci-price">{{ number_format($item->cantidad_kg, 2) }} kg × ${{ number_format($item->lote->precio_por_kg, 0) }}</div>
                <div class="ci-subtotal">${{ number_format($item->subtotal, 0) }}</div>
              </div>
            </div>
          </div>
          @endforeach
        </div>

        {{-- PAGO --}}
        <div class="card">
          <div class="card-title"><i class="fas fa-university"></i> Instrucciones de pago</div>

          <div class="pago-step">
            <div class="pago-num">1</div>
            <div>
              <div class="pago-title">Transfiere el valor total a la cuenta de CaféTrace</div>
              <div class="pago-desc">Realiza el pago usando cualquiera de los siguientes métodos. La plataforma retiene el 5% como comisión y transfiere el resto directamente al caficultor.</div>
              <div class="banco-card">
                <div class="banco-row"><span class="banco-lbl">Nequi / Bancolombia</span><span class="banco-val">301 234 5678</span></div>
                <div class="banco-row"><span class="banco-lbl">Cuenta corriente</span><span class="banco-val">200-123456-78 · Bancolombia</span></div>
                <div class="banco-row"><span class="banco-lbl">Titular</span><span class="banco-val">CaféTrace S.A.S. · NIT 900.123.456-7</span></div>
                <div class="banco-row" style="margin-top:10px;padding-top:10px;border-top:0.5px solid var(--border)">
                  <span class="banco-lbl">Total a transferir</span>
                  <span class="banco-val banco-total">${{ number_format($total, 0) }} COP</span>
                </div>
              </div>
            </div>
          </div>

          <div class="pago-step">
            <div class="pago-num">2</div>
            <div style="width:100%">
              <div class="pago-title">Selecciona el método que usaste</div>
              <div class="metodo-grid">
                <div>
                  <input type="radio" name="metodo_pago" id="mp_nequi" value="nequi" class="metodo-opt" required>
                  <label for="mp_nequi" class="metodo-lbl">
                    <span class="metodo-icon">📱</span>
                    <span class="metodo-name">Nequi</span>
                  </label>
                </div>
                <div>
                  <input type="radio" name="metodo_pago" id="mp_bancolombia" value="bancolombia" class="metodo-opt">
                  <label for="mp_bancolombia" class="metodo-lbl">
                    <span class="metodo-icon">🏦</span>
                    <span class="metodo-name">Bancolombia</span>
                  </label>
                </div>
                <div>
                  <input type="radio" name="metodo_pago" id="mp_davivienda" value="davivienda" class="metodo-opt">
                  <label for="mp_davivienda" class="metodo-lbl">
                    <span class="metodo-icon">🏛️</span>
                    <span class="metodo-name">Davivienda</span>
                  </label>
                </div>
                <div>
                  <input type="radio" name="metodo_pago" id="mp_pse" value="pse" class="metodo-opt">
                  <label for="mp_pse" class="metodo-lbl">
                    <span class="metodo-icon">💻</span>
                    <span class="metodo-name">PSE</span>
                  </label>
                </div>
                <div>
                  <input type="radio" name="metodo_pago" id="mp_efectivo" value="efectivo" class="metodo-opt">
                  <label for="mp_efectivo" class="metodo-lbl">
                    <span class="metodo-icon">💵</span>
                    <span class="metodo-name">Efectivo</span>
                  </label>
                </div>
              </div>
              @error('metodo_pago')<p style="font-size:11px;color:#dc2626;margin-top:6px">{{ $message }}</p>@enderror
            </div>
          </div>

          <div class="pago-step">
            <div class="pago-num">3</div>
            <div style="width:100%">
              <div class="pago-title">Número de referencia o aprobación</div>
              <div class="pago-desc">El código que te dio el banco o la app al confirmar el pago.</div>
              <input type="text" name="referencia_pago" class="ref-input" placeholder="Ej: 987654321 o TXN-20240531" required>
              @error('referencia_pago')<p style="font-size:11px;color:#dc2626;margin-top:6px">{{ $message }}</p>@enderror
            </div>
          </div>

          <div class="pago-step">
            <div class="pago-num">4</div>
            <div style="width:100%">
              <div class="pago-title">Sube el comprobante de pago</div>
              <div class="pago-desc">Foto o captura de pantalla del recibo. Formatos: JPG, PNG o PDF. Máx. 5 MB.</div>
              <div class="upload-area" id="uploadArea">
                <input type="file" name="comprobante" id="comprobanteInput" accept=".jpg,.jpeg,.png,.pdf" required>
                <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                <div class="upload-text">Arrastra aquí o haz clic para subir</div>
                <div class="upload-hint">JPG · PNG · PDF · Máx 5MB</div>
              </div>
              <div class="upload-preview" id="uploadPreview">
                <i class="fas fa-check-circle"></i>
                <span id="uploadName">archivo.jpg</span>
              </div>
              @error('comprobante')<p style="font-size:11px;color:#dc2626;margin-top:6px">{{ $message }}</p>@enderror
            </div>
          </div>
        </div>

        {{-- NOTAS --}}
        <div class="card">
          <div class="card-title"><i class="fas fa-comment"></i> Notas adicionales (opcional)</div>
          <textarea name="notas" class="notas-input" placeholder="Instrucciones especiales, dirección de entrega, etc."></textarea>
        </div>

        <div class="form-btns">
          <a href="{{ route('comprador.carrito') }}" class="btn-cancel"><i class="fas fa-arrow-left"></i> Volver</a>
          <button type="submit" class="btn-confirmar"><i class="fas fa-lock"></i> Enviar comprobante y confirmar</button>
        </div>
      </form>

      <script>
      document.getElementById('comprobanteInput').addEventListener('change', function(){
        const preview = document.getElementById('uploadPreview');
        const name = document.getElementById('uploadName');
        if(this.files[0]){
          name.textContent = this.files[0].name;
          preview.style.display = 'flex';
          document.getElementById('uploadArea').style.borderColor = '#3b6d11';
          document.getElementById('uploadArea').style.background = '#f0fdf4';
        }
      });
      </script>
    </div>

    <div class="resumen-card">
      <div class="resumen-title">Resumen de pago</div>
      <div class="res-row"><span>{{ $items->count() }} producto(s)</span><span>{{ number_format($items->sum('cantidad_kg'), 2) }} kg</span></div>
      <div class="res-row"><span>Subtotal</span><span>${{ number_format($subtotal, 0) }}</span></div>
      <div class="res-total-row"><span class="res-total-lbl">Tú pagas</span><span class="res-total-val">${{ number_format($total, 0) }}</span></div>

      <div style="font-size:11px;color:var(--hint);margin-bottom:10px;text-transform:uppercase;letter-spacing:0.5px">Distribución del pago</div>
      <div class="res-comision" style="margin-bottom:10px">
        <span style="display:flex;align-items:center;gap:5px"><i class="fas fa-user" style="color:#3b6d11;font-size:10px"></i> Caficultor (95%)</span>
        <span style="color:#3b6d11;font-weight:600">${{ number_format($subtotal - $comision, 0) }}</span>
      </div>
      <div class="res-comision" style="margin-bottom:14px;padding-bottom:14px;border-bottom:0.5px solid var(--border)">
        <span style="display:flex;align-items:center;gap:5px"><i class="fas fa-landmark" style="color:var(--a600);font-size:10px"></i> Plataforma (5%)</span>
        <span style="color:var(--a600);font-weight:600">${{ number_format($comision, 0) }}</span>
      </div>

      <div class="garantia-box">
        <div class="garantia-title"><i class="fas fa-shield-alt"></i> Pago seguro</div>
        <div class="garantia-item"><i class="fas fa-check"></i> 95% va directo al caficultor</div>
        <div class="garantia-item"><i class="fas fa-check"></i> 5% comisión de la plataforma</div>
        <div class="garantia-item"><i class="fas fa-check"></i> Trazabilidad verificada</div>
        <div class="garantia-item"><i class="fas fa-check"></i> Sin intermediarios extra</div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection