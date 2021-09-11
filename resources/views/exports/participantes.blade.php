<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        .titulo{
            text-align: center;
            font: 2rem;
            color: black;
        }
        table {
        font-family: arial, sans-serif;
        font-size: 14px;
        border-collapse: collapse;
        width: 100%;
        }

        td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        }

        tr:nth-child(even) {
        background-color: #dddddd;
        }
    </style>
</head>
<body>
    <h2 class="titulo">Instituto Tecnologico de Piedras Negras
    <p class="titulo" style="margin-top: -10px; margin-bottom: 40px;">Sistema de control de actividades complementarias</p>
    <p>Actividad: {{ $actividades[0]->nombre }}, {{ $actividades[0]->categoria }}</p>
    @foreach ($prestador as $pitem)
        <p>Encargado de la actividad: {{$pitem->name}}</p>
    @endforeach
    <p>Periodo: {{ $actividades[0]->periodo }}, {{ $actividades[0]->year }}</p>

    <h3 style="margin-top: 5%;">Listatdo de participantes:
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>No Control</th>
                    <th>Carrera</th>
                    <th>Evaluacion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($participantes as $item)
                <tr>
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->noControl }}</td>
                    <td>{{ $item->carrera }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
                @endforeach
            </tbody>
            
        </table>

</body>
</html>
