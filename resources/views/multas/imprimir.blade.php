<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura de Multa - {{ $multa->idmulta }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
            background: #fff;
        }
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 40px;
            border-radius: 8px;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 2px solid #75461f;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #75461f;
            font-size: 28px;
        }
        .header p {
            margin: 5px 0 0;
            color: #666;
        }
        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
        }
        .invoice-details .info-block {
            width: 48%;
        }
        .invoice-details h3 {
            margin-top: 0;
            color: #57351f;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }
        .invoice-details p {
            margin: 5px 0;
            line-height: 1.5;
        }
        .invoice-details strong {
            display: inline-block;
            width: 120px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f3ede5;
            color: #57351f;
        }
        .total-row td {
            font-weight: bold;
            font-size: 18px;
            color: #75461f;
            border-top: 2px solid #75461f;
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            color: #888;
            font-size: 14px;
        }
        .print-btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            background: #75461f;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }
        @media print {
            .print-btn {
                display: none;
            }
            .invoice-container {
                border: none;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <button onclick="window.print()" class="print-btn">Imprimir Factura</button>

    <div class="invoice-container">
        <div class="header">
            <h1>Biblioteca Laravel</h1>
            <p>Factura de Multa por Retraso o Daño</p>
        </div>

        <div class="invoice-details">
            <div class="info-block">
                <h3>Datos de la Multa</h3>
                <p><strong>Factura Nº:</strong> {{ str_pad($multa->idmulta, 6, '0', STR_PAD_LEFT) }}</p>
                <p><strong>Fecha Emisión:</strong> {{ optional($multa->fecha)->format('d/m/Y') ?? now()->format('d/m/Y') }}</p>
                <p><strong>Motivo:</strong> {{ $multa->motivo }}</p>
                @if($multa->dias_retraso)
                <p><strong>Días Retraso:</strong> {{ $multa->dias_retraso }}</p>
                @endif
            </div>
            
            <div class="info-block">
                <h3>Datos del Beneficiario</h3>
                <p><strong>Nombre:</strong> {{ $multa->prestamo->usuario->nombre ?? 'N/A' }}</p>
                <p><strong>Documento:</strong> {{ $multa->prestamo->usuario->documento ?? 'N/A' }}</p>
                <p><strong>ID Préstamo:</strong> {{ $multa->idprestamo }}</p>
                <p><strong>Libro:</strong> {{ $multa->prestamo->libro->titulo ?? 'N/A' }}</p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th style="text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        Multa generada por: {{ $multa->motivo }}<br>
                        <small>Préstamo #{{ $multa->idprestamo }} - Libro: {{ $multa->prestamo->libro->titulo ?? 'N/A' }}</small>
                    </td>
                    <td style="text-align: right;">${{ number_format((float) $multa->valor, 2, ',', '.') }}</td>
                </tr>
                <tr class="total-row">
                    <td style="text-align: right;">Total a Pagar:</td>
                    <td style="text-align: right;">${{ number_format((float) $multa->valor, 2, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p>Por favor, cancele esta multa lo antes posible para poder solicitar nuevos préstamos.</p>
            <p>Gracias por utilizar nuestros servicios.</p>
        </div>
    </div>
    
    <script>
        // Imprimir automáticamente al abrir (opcional, pero útil)
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
