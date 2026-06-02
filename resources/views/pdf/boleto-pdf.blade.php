<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Boleto de Ornato - {{ $boleto->numero_boleto }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #1e3a5f;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .logo {
            max-width: 100px;
            max-height: 100px;
        }
        h1 {
            color: #1e3a5f;
            font-size: 18px;
            margin: 5px 0;
        }
        h2 {
            color: #2563eb;
            font-size: 16px;
            margin: 5px 0;
        }
        .info-box {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
        }
        .info-title {
            font-weight: bold;
            color: #1e3a5f;
            margin-bottom: 5px;
            border-bottom: 1px solid #eee;
            padding-bottom: 3px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 5px;
            vertical-align: top;
        }
        .label {
            font-weight: bold;
            color: #666;
            width: 120px;
        }
        .value {
            font-weight: bold;
            color: #000;
        }
        .monto-box {
            text-align: center;
            background-color: #f8fafc;
            border: 2px solid #2563eb;
            padding: 15px;
            margin: 20px 0;
            border-radius: 8px;
        }
        .monto-label {
            font-size: 14px;
            color: #1e3a5f;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .monto-valor {
            font-size: 24px;
            color: #1e3a5f;
            font-weight: bold;
        }
        .qr-container {
            text-align: center;
            margin-top: 30px;
        }
        .qr-code {
            border: 1px solid #ccc;
            padding: 10px;
            display: inline-block;
            background-color: #fff;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 10px;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
        .watermark {
            position: absolute;
            top: 30%;
            left: 20%;
            font-size: 80px;
            color: rgba(0, 0, 0, 0.05);
            transform: rotate(-45deg);
            z-index: -1;
            user-select: none;
        }
    </style>
</head>
<body>
    @if($boleto->estaPagado())
        <div class="watermark">PAGADO OFICIAL</div>
    @endif

    <div class="header">
        @if($config->logo_path)
            <img src="{{ storage_path('app/public/' . $config->logo_path) }}" class="logo" alt="Logo Municipal">
        @endif
        <h1>{{ mb_strtoupper($config->nombre_municipalidad) }}</h1>
        <h2>BOLETO DE ORNATO {{ $boleto->anio_fiscal }}</h2>
        <p>DECRETO 121-96 DEL CONGRESO DE LA REPÚBLICA</p>
    </div>

    <table>
        <tr>
            <td width="60%">
                <div class="info-box">
                    <div class="info-title">DATOS DEL CONTRIBUYENTE</div>
                    <table>
                        <tr>
                            <td class="label">Nombres y Apellidos:</td>
                            <td class="value">{{ mb_strtoupper($boleto->contribuyente->nombre_completo) }}</td>
                        </tr>
                        <tr>
                            <td class="label">DPI:</td>
                            <td class="value">{{ $boleto->contribuyente->dpi }}</td>
                        </tr>
                        <tr>
                            <td class="label">NIT:</td>
                            <td class="value">{{ $boleto->contribuyente->nit ?? 'NO REGISTRADO' }}</td>
                        </tr>
                        <tr>
                            <td class="label">Dirección:</td>
                            <td class="value">{{ mb_strtoupper($boleto->contribuyente->direccion) }}</td>
                        </tr>
                        <tr>
                            <td class="label">Municipio / Depto:</td>
                            <td class="value">{{ mb_strtoupper($boleto->contribuyente->municipio) }}, {{ mb_strtoupper($boleto->contribuyente->departamento) }}</td>
                        </tr>
                    </table>
                </div>
            </td>
            <td width="40%">
                <div class="info-box">
                    <div class="info-title">DATOS DEL BOLETO</div>
                    <table>
                        <tr>
                            <td class="label">No. Boleto:</td>
                            <td class="value">{{ $boleto->numero_boleto }}</td>
                        </tr>
                        <tr>
                            <td class="label">Estado:</td>
                            <td class="value">{{ mb_strtoupper($boleto->estado->etiqueta()) }}</td>
                        </tr>
                        <tr>
                            <td class="label">Fecha Emisión:</td>
                            <td class="value">{{ $boleto->fecha_emision->timezone('America/Guatemala')->format('d/m/Y H:i') }}</td>
                        </tr>
                        @if($boleto->fecha_pago)
                        <tr>
                            <td class="label">Fecha Pago:</td>
                            <td class="value">{{ $boleto->fecha_pago->timezone('America/Guatemala')->format('d/m/Y H:i') }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </td>
        </tr>
    </table>

    <div class="monto-box">
        <div class="monto-label">MONTO CANCELADO</div>
        <div class="monto-valor">Q {{ number_format($boleto->monto, 2) }}</div>
        <div style="margin-top: 5px; font-size: 11px; color: #555;">(Cálculo basado en ingresos mensuales declarados: Q {{ number_format($boleto->contribuyente->ingresos_mensuales, 2) }})</div>
    </div>

    <div class="qr-container">
        <div style="font-weight: bold; margin-bottom: 5px;">Código de Verificación Electrónica:</div>
        <div style="font-family: monospace; font-size: 14px; margin-bottom: 10px;">{{ $boleto->codigo_verificacion }}</div>
        <div class="qr-code">
            <img src="data:image/svg+xml;base64, {{ $qrCodeBase64 }}" width="150" height="150">
        </div>
        <div style="font-size: 10px; margin-top: 5px; color: #666;">Escanee este código QR para verificar la autenticidad de este documento.</div>
    </div>

    <div class="footer">
        Este documento es generado electrónicamente y tiene plena validez legal según la normativa vigente.<br>
        {{ $config->nombre_municipalidad }} - {{ $config->direccion }}, {{ $config->municipio }}, {{ $config->departamento }}.<br>
        Teléfono: {{ $config->telefono }} | Email: {{ $config->email }}
    </div>
</body>
</html>
