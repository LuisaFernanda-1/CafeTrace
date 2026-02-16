<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etiqueta {{ $lote->codigo_lote }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: #fff;
        }
        .etiqueta {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
            border: 3px solid #d97706;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #d97706;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #d97706;
            font-size: 32px;
            margin-bottom: 5px;
        }
        .header p {
            color: #666;
            font-size: 14px;
        }
        .contenido {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        .columna-izq {
            display: table-cell;
            width: 55%;
            vertical-align: top;
            padding-right: 20px;
        }
        .columna-der {
            display: table-cell;
            width: 45%;
            vertical-align: top;
            text-align: center;
        }
        .info-lote {
            margin-bottom: 20px;
        }
        .info-lote h2 {
            font-size: 28px;
            color: #059669;
            margin-bottom: 10px;
        }
        .codigo-lote {
            background: #f3f4f6;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .codigo-lote strong {
            color: #d97706;
            font-size: 18px;
        }
        .detalles {
            margin-bottom: 15px;
        }
        .detalle-item {
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
            display: table;
            width: 100%;
        }
        .detalle-item:last-child {
            border-bottom: none;
        }
        .detalle-label {
            display: table-cell;
            color: #6b7280;
            font-size: 13px;
            width: 45%;
        }
        .detalle-valor {
            display: table-cell;
            font-weight: bold;
            color: #111827;
            font-size: 14px;
            text-align: right;
        }
        .qr-section {
            background: #f9fafb;
            padding: 20px;
            border-radius: 12px;
            border: 2px solid #d97706;
        }
        .qr-section h3 {
            font-size: 16px;
            color: #059669;
            margin-bottom: 15px;
            text-align: center;
        }
        .qr-code {
            text-align: center;
            margin-bottom: 15px;
        }
        .qr-code img {
            max-width: 250px;
            height: auto;
        }
        .qr-instruccion {
            font-size: 11px;
            color: #6b7280;
            text-align: center;
            line-height: 1.4;
        }
        .badges {
            margin: 15px 0;
        }
        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            margin-right: 8px;
            margin-bottom: 5px;
        }
        .badge-organico {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #059669;
        }
        .badge-comercio {
            background: #dbeafe;
            color: #1e40af;
            border: 1px solid #3b82f6;
        }
        .caficultor {
            background: #f0fdf4;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #059669;
        }
        .caficultor h4 {
            color: #059669;
            font-size: 14px;
            margin-bottom: 8px;
        }
        .caficultor p {
            font-size: 12px;
            color: #4b5563;
            line-height: 1.5;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #d97706;
            text-align: center;
        }
        .footer p {
            font-size: 11px;
            color: #6b7280;
            margin-bottom: 5px;
        }
        .footer .url {
            font-size: 10px;
            color: #9ca3af;
            word-break: break-all;
        }
        .verificacion {
            background: #fffbeb;
            border: 1px solid #fbbf24;
            padding: 12px;
            border-radius: 8px;
            margin-top: 15px;
        }
        .verificacion p {
            font-size: 11px;
            color: #92400e;
            text-align: center;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="etiqueta">
        <!-- Header -->
        <div class="header">
            <h1>🌿 CaféTrace</h1>
            <p>Trazabilidad Verificada de Café Colombiano</p>
        </div>

        <!-- Contenido Principal -->
        <div class="contenido">
            <!-- Columna Izquierda -->
            <div class="columna-izq">
                <!-- Código del Lote -->
                <div class="codigo-lote">
                    <strong>{{ $lote->codigo_lote }}</strong>
                </div>

                <!-- Info del Lote -->
                <div class="info-lote">
                    <h2>{{ $lote->variedad }}</h2>
                    
                    @if($lote->es_organico || $lote->comercio_justo)
                        <div class="badges">
                            @if($lote->es_organico)
                                <span class="badge badge-organico">🌱 Orgánico</span>
                            @endif
                            @if($lote->comercio_justo)
                                <span class="badge badge-comercio">🤝 Comercio Justo</span>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Detalles -->
                <div class="detalles">
                    <div class="detalle-item">
                        <span class="detalle-label">Peso Total:</span>
                        <span class="detalle-valor">{{ number_format($lote->peso_kg, 0) }} kg</span>
                    </div>
                    <div class="detalle-item">
                        <span class="detalle-label">Peso Disponible:</span>
                        <span class="detalle-valor">{{ number_format($lote->peso_disponible, 0) }} kg</span>
                    </div>
                    <div class="detalle-item">
                        <span class="detalle-label">Altura:</span>
                        <span class="detalle-valor">{{ number_format($lote->altura_msnm, 0) }} msnm</span>
                    </div>
                    <div class="detalle-item">
                        <span class="detalle-label">Fecha de Cosecha:</span>
                        <span class="detalle-valor">{{ $lote->fecha_cosecha->format('d/m/Y') }}</span>
                    </div>
                    @if($lote->puntaje_calidad)
                        <div class="detalle-item">
                            <span class="detalle-label">Calidad:</span>
                            <span class="detalle-valor">⭐ {{ $lote->puntaje_calidad }}/100</span>
                        </div>
                    @endif
                    <div class="detalle-item">
                        <span class="detalle-label">Precio por kg:</span>
                        <span class="detalle-valor">${{ number_format($lote->precio_por_kg, 0) }} COP</span>
                    </div>
                </div>

                <!-- Info del Caficultor -->
                <div class="caficultor">
                    <h4>👨‍🌾 Producido por:</h4>
                    <p><strong>{{ $lote->caficultor->name }}</strong></p>
                    @if($lote->caficultor->nombre_finca)
                        <p>Finca: {{ $lote->caficultor->nombre_finca }}</p>
                    @endif
                    @if($lote->caficultor->departamento)
                        <p>📍 {{ $lote->caficultor->municipio ? $lote->caficultor->municipio . ', ' : '' }}{{ $lote->caficultor->departamento }}</p>
                    @endif
                </div>
            </div>

            <!-- Columna Derecha - QR -->
            <div class="columna-der">
                <div class="qr-section">
                    <h3>Escanea para verificar</h3>
                    <div class="qr-code">
                        @if(isset($useSvg) && $useSvg)
    <img src="data:image/svg+xml;base64,{{ $qrCode }}" alt="QR Code">
@else
    <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code">
@endif
                    </div>
                    <p class="qr-instruccion">
                        Escanea este código QR con tu celular para ver la trazabilidad completa del lote
                    </p>
                </div>

                <div class="verificacion">
                    <p>✓ Información verificada y autenticada por CaféTrace</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>CaféTrace</strong> - Sistema de Trazabilidad de Café</p>
            <p class="url">{{ $url }}</p>
        </div>
    </div>
</body>
</html>