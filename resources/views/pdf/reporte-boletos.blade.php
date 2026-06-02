<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Recaudación - Boleto de Ornato</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #333;
            margin: 0;
            padding: 10px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #1e3a5f;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        h1 {
            color: #1e3a5f;
            font-size: 16px;
            margin: 5px 0;
        }
        h2 {
            color: #2563eb;
            font-size: 14px;
            margin: 5px 0;
        }
        .params {
            margin-bottom: 20px;
            font-size: 12px;
        }
        .params strong {
            color: #1e3a5f;
        }
        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table.data th {
            background-color: #1e3a5f;
            color: white;
            padding: 8px 5px;
            text-align: left;
            font-size: 10px;
        }
        table.data th.right {
            text-align: right;
        }
        table.data td {
            padding: 6px 5px;
            border-bottom: 1px solid #ddd;
            font-size: 10px;
        }
        table.data td.right {
            text-align: right;
        }
        .totals {
            margin-top: 20px;
            width: 50%;
            float: right;
        }
        table.totals-table {
            width: 100%;
            border-collapse: collapse;
        }
        table.totals-table td {
            padding: 8px;
            border: 1px solid #ddd;
            font-size: 12px;
        }
        table.totals-table td.label {
            font-weight: bold;
            background-color: #f8fafc;
        }
        table.totals-table td.value {
            text-align: right;
            font-weight: bold;
        }
        .footer {
            clear: both;
            margin-top: 40px;
            text-align: center;
            font-size: 9px;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ mb_strtoupper($config->nombre_municipalidad) }}</h1>
        <h2>REPORTE DE RECAUDACIÓN - BOLETO DE ORNATO</h2>
        <p>Generado el: {{ now()->timezone('America/Guatemala')->format('d/m/Y H:i:s') }}</p>
    </div>

    <div class="params">
        <strong>Período:</strong> {{ \Carbon\Carbon::parse($filtros['fecha_inicio'])->format('d/m/Y') }} al {{ \Carbon\Carbon::parse($filtros['fecha_fin'])->format('d/m/Y') }} <br>
        <strong>Estado de Boletos:</strong> {{ $filtros['estado'] ? mb_strtoupper($filtros['estado']) : 'TODOS LOS ESTADOS' }}
    </div>

    <table class="data">
        <thead>
            <tr>
                <th>No. Boleto</th>
                <th>Fecha Emisión</th>
                <th>DPI Contribuyente</th>
                <th>Nombre Contribuyente</th>
                <th>Estado</th>
                <th class="right">Monto (Q)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($boletos as $boleto)
                <tr>
                    <td>{{ $boleto->numero_boleto }}</td>
                    <td>{{ $boleto->fecha_emision->format('d/m/Y') }}</td>
                    <td>{{ $boleto->contribuyente->dpi }}</td>
                    <td>{{ mb_substr($boleto->contribuyente->nombre_completo, 0, 30) }}...</td>
                    <td>{{ mb_strtoupper($boleto->estado->etiqueta()) }}</td>
                    <td class="right">{{ number_format($boleto->monto, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 20px;">No se encontraron registros para los criterios seleccionados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($boletos->count() > 0)
    <div class="totals">
        <table class="totals-table">
            <tr>
                <td class="label">Total de Boletos:</td>
                <td class="value">{{ $resumen['total_boletos'] }}</td>
            </tr>
            <tr>
                <td class="label">Monto Total:</td>
                <td class="value">Q {{ number_format($resumen['monto_total'], 2) }}</td>
            </tr>
        </table>
    </div>
    @endif

    <div class="footer">
        Reporte generado automáticamente por el Sistema Electrónico de Boleto de Ornato. <br>
        {{ $config->nombre_municipalidad }}
    </div>
</body>
</html>
