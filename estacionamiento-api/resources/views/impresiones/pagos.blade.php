<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Pagos Residentes</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Reporte de Pagos Residentes del {{$fecha_inicial}} al {{$fecha_final}}</h2>
    <table>
        <thead>
            <tr>
                <th>Placa</th>
                <th>Tipo de Vehículo</th>
                <th>Duración (Minutos)</th>
                <th>Cantidad a Pagar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($estancias as $estancia)
                <tr>
                    <td>{{ $estancia['placa'] }}</td>
                    <td>{{ $estancia['tipo_vehiculo'] }}</td>
                    <td>{{ $estancia['duracion_total_minutos'] }}</td>
                    <td>{{ round($estancia['tarifa'] * $estancia['duracion_total_minutos'], 2) }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</body>

</html>
