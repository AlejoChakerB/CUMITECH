<!-- acta_entrega.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Acta de entrega</title>
    <style>
        /* Estilos generales */
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }

        /* Estilos para los titulos */
        h1 {
            font-size: 15px;
            margin-top: 0px;
            margin-bottom: 10px;
        }

        /* Estilos para los encabezados */
        h2 {
            font-size: 16px;
            margin-top: 50px;
            margin-bottom: 10px;
        }

        /* Estilos para los párrafos */
        p {
            font-size: 14px;
            margin-bottom: 10px;
            line-height: 1.5;
            text-align: justify;
        }

        .table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
            font-size: 12px;
        }

        .table th,
        .table td {
            padding: 5px;
            border: 1px solid black;
        }

        .signature-section {
            margin-bottom: 20px;
            display: inline-block;
            width: 45%;
        }

        .signature-image {
            width: 200px;
            height: auto;
            border-bottom: 1px solid black;
            margin-bottom: 10px;
            display: block;
        }

        /* Estilos para los títulos de las firmas */
        .signature-title {
            margin-bottom: 6px;
            font-size: 12px;
        }

        /* Estilos para el contenedor principal */
        .container {
            overflow: auto;
        }

        .float-left {
            float: left;
            margin-right: 10px;
        }

        .float-right {
            float: right;
            margin-left: 10px;
        }

        /* Estilos para el logo */
        .logo {
            position: absolute;
            top: 10px;
            left: 0px;
            width: 150px;
            height: auto;
        }

        .table-header {
            background-color: #CCCCCC;
            /* Cambia el color aquí según tus preferencias */
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="images/LOGO_cumi_Mesa-de-trabajo-1.png" class="logo" alt="Logo de la empresa">
        <h1>CLINICA CUMI</h1>
        <p style="text-align: center">Nit: 900740827
            <br>Dirección: Cll 44 #14-232
            <br>Teléfonos: (604) 7848976 - 3174768609
        </p>
    </div>

    <h2>ACTA DE ENTREGA</h2>
    <p>En la ciudad de <strong>Montería</strong>, a los <strong>{{ $deliverDate->format('d') }}</strong> días del mes <strong>{{ $deliverDate->format('m') }}</strong> del
        año <strong>{{ $deliverDate->format('Y') }}</strong>, se lleva a cabo la entrega de la dotación correspondiente al periodo de <strong>{{ $period }}</strong> 
        del año <strong>{{ $deliverDate->format('Y') }}</strong> al empleado <strong>{{$employeeName}}</strong>, identificado con C.C <strong>{{$employeeDni}}</strong> y desempeñándose en el cargo de <strong>{{$employeeWork}}</strong>, con el
        fin de cumplir con las disposiciones legales y
        garantizar las condiciones laborales adecuadas para el desarrollo de sus funciones.</p>

    <p>La dotación entregada al empleado se detalla a continuación:</p>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th>CÓDIGO</th>
                <th>DESCRIPCION</th>
                <th>SERVICIO</th>
                <th>PERIODO</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center">{{ $id }}</td>
                <td style="text-align: center">
                    @php
                    $items = json_decode($item);
                    if (is_array($items)) {
                    echo implode(', ', $items);
                    } else {
                    echo $items;
                    }
                    @endphp
                </td>
                <td style="text-align: center">{{ $employeeService }}</td>
                <td style="text-align: center">{{ $period }} {{ $deliverDate->format('Y') }}</td>
            </tr>
        </tbody>
    </table>

    <p>El empleado confirma la recepción de los elementos mencionados y se compromete a hacer uso adecuado de ellos,
        destinándolos exclusivamente para el desarrollo de sus labores dentro de la empresa.</p>


    <div class="container">
        <div class="signature-section float-left">
            <h2 class="signature-title">Entrega:</h2>
            <img src="images/firma-superior.jpg" alt="Entrega" class="signature-image">
            <h3 class="signature-title">Marcela Garcia Gonzalez</h3>
            <h3 class="signature-title">Directora de talento humano</h3>
        </div>        <div class="signature-section float-right">
            <h2 class="signature-title">Recibe:</h2>
            <img src="{{ $signature }}" alt="Recibe" class="signature-image">
            <h3 class="signature-title">{{ $employeeName }}</h3>
            <h3 class="signature-title">C.C {{ $employeeDni }}</h3>
        </div>
    </div>
</body>

</html>