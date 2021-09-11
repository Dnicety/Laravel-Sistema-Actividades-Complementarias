<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @if (@isset($documento))
    <link href="{{$documento->fonturl}}" rel="stylesheet">
    <style>                
        @page {
            margin: 0cm 0cm;
        }
        /** Defina ahora los márgenes reales de cada página en el PDF **/
        body {
            font-family: {{$documento->font}};
            margin-top: 3cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 3cm;
            background-image: url({{$documento->imgbody}});
        }
        /** Definir las reglas del encabezado **/
        header {
            position: fixed;
            top: 0cm;
            left: 2cm;
            right: 2cm;
            height: 3cm;
            /** Estilos extra personales **/
            background-image: url({{$documento->imgheader}});
            background-size: contain;
            background-repeat: no-repeat;
            color: white;
            line-height: 1.5cm;
        }
        /** Definir las reglas del pie de página **/
        footer {
            position: fixed; 
            bottom: 0cm; 
            left: 2cm; 
            right: 2cm;
            height: 3cm;
            /** Estilos extra personales **/
            background-image: url({{$documento->imgfooter}});
            background-size: contain;
            background-repeat: no-repeat;
            color: white;
            line-height: 1.5cm;
        }
    </style>
    @else
    <style>                
        @page {
            margin: 0cm 0cm;
        }
        /** Defina ahora los márgenes reales de cada página en el PDF **/
        body {
            margin-top: 3cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 3cm;
        }
        /** Definir las reglas del encabezado **/
        header {
            position: fixed;
            top: 0cm;
            left: 2cm;
            right: 2cm;
            height: 3cm;
            /** Estilos extra personales **/
            background-size: contain;
            background-repeat: no-repeat;
            color: white;
            text-align: center;
            line-height: 1.5cm;
        }
        /** Definir las reglas del pie de página **/
        footer {
            position: fixed; 
            bottom: 0cm; 
            left: 2cm; 
            right: 2cm;
            height: 3cm;
            /** Estilos extra personales **/
            background-size: contain;
            background-repeat: no-repeat;
            color: white;
            line-height: 1.5cm;
        }
    </style>
    @endif
</head>
<body>
    @if (@isset($credito))
    <header>
    </header>
    <footer>
    </footer>
    <main>
        <p style="width: 100%; text-align: right; font-size: 8pt;">Instituto Tecnologico de Piedras Negras</p>
        <p style="width: 100%; text-align: center; font-size: 8pt; color: gray;">@if(@isset($documento)) {{$documento->frase}}@endif</p>            
        <p style="margin-top: 4%; text-align: right; font-size: 8pt;">Clave: 05DIT0002V <br> Oficio: {{$credito[0]->oficio}}</p>
        <div style="margin-top: 10%;">
            <p style="font-weight: 800; font-size: 10pt;">{{$jefeescolares[0]->name}}<br> JEFE DEL DEPARTAMENTO DE SERVICIOS ESCOLARES  <br> PRESENTE </p>
        </div>
        <div>            
            <p style="text-align: justify; font-size: 9pt;">{{ $actividad[0]->sexo == "H" ? 'El' : 'La'}} que suscribe <b><ins> {{ $actividad[0]->name }} </ins></b>, por este medio se permite hacer de su conocimiento
                que {{$alumno[0]->sexo == "M" ? 'la' : 'el'}} estudiante <b><ins> {{$alumno[0]->nombre}} </ins></b>, con el numero de control <b><ins> {{$alumno[0]->noControl}} </ins></b> de la
                carrera de <b><ins> {{$alumno[0]->carrera}} </ins></b>, ha cumplido su actividad <b><ins> {{$actividad[0]->nombre}} </ins></b> con el nivel de desempeño
                {{$evaluacion[0]->nivel}} y un valor numerico de {{$evaluacion[0]->promedio}} durante el periodo escolar <b><ins>{{$actividad[0]->periodo}}, {{$actividad[0]->year}}</ins></b>
                con un valor curricular de <b><ins>{{$actividad[0]->creditos}}</ins></b> creditos.
                <br><br>
                Se extiende el presente en la ciudad de Piedras Negras, Coahuila, a los {{now()->day}} dias del mes de {{now()->month}}
                de {{now()->year}}.
            </p>

            <p style="text-align: center; margin-top: 30px; font-weight: 800; font-size: 10pt;">ATENTAMENTE</p>

            <div style="width: 80%; margin: auto; margin-top:20%;">
                <div style="width: 40%; display: inline-block; margin-right: 20%; text-align: center;">
                    @if(($actividad[0]->docente == 'SI'))
                    <hr>
                    <p style="font-size: 8pt;"> {{$actividad[0]->name}} <br> Responsable de la actividad <br>&nbsp;</p>
                    @else
                    <hr>
                    <p style="font-size: 8pt;"> {{$jefedepto[0]->name}} <br> Responsable de la actividad <br>&nbsp;</p>
                    @endif
                </div>
                <div style="width: 40%; display: inline-block; text-align: center;">
                    <hr>
                    <p style="font-size: 8pt;"> {{$jefedepto[0]->name}} <br> {{ $jefedepto[0]->sexo == "H" ? 'Jefe' : 'Jefa'}} de Depto. {{ $jefedepto[0]->departamento}} </p>
                </div>
            </div>
        </div>
        <p style="font-size: 6pt; position: absolute; bottom: 0cm; left: 0cm;" >c.c.p Alumno <br> c.c.p Expediente</p>
    </main>
    @else
        <header>
        </header>
        <footer>
        </footer>
        <main>
            <p style="width: 100%; text-align: right; font-size: 8pt;">Instituto Tecnologico de Piedras Negras</p>
            <p style="width: 100%; text-align: center; font-size: 8pt; color: gray;">@if(@isset($documento)) {{$documento->frase}} @else Frase @endif</p>            
            <p style="margin-top: 4%; text-align: right; font-size: 8pt;">Clave: 05DIT0002V <br> Oficio: isset #NOOFICIO</p>
            <div style="margin-top: 10%;">
                <p style="font-weight: 800; font-size: 10pt;">-Nombre Jefe de departamento- <br> JEFE DEL DEPARTAMENTO DE SERVICIOS ESCOLARES  <br> PRESENTE </p>
            </div>
            <div>            
                <p style="text-align: justify; font-size: 9pt;">(El/La) que suscribe <b><ins> -Encargado actividad- </ins></b>, por este medio se permite hacer de su conocimiento
                    que (El/La) estudiante <b><ins> -Nombre estudiante- </ins></b>, con el numero de control <b><ins> -No de control estudiante- </ins></b> de la
                    carrera de <b><ins> -Carrera- </ins></b>, ha cumplido su actividad <b><ins> -Nombre de actividad- </ins></b> con el nivel de desempeño
                    -Nivel de desempeño- y un valor numerico de -Promedio- durante el periodo escolar <b><ins>-Periodo-, -Año-</ins></b>
                    con un valor curricular de <b><ins>-Ponderacion-</ins></b> creditos.
                    <br><br>
                    Se extiende el presente en la ciudad de Piedras Negras, Coahuila, a los {{now()->day}} dias del mes de {{now()->month}}
                    de {{now()->year}}.
                </p>

                <p style="text-align: center; margin-top: 30px; font-weight: 800; font-size: 10pt;">ATENTAMENTE</p>

                <div style="width: 80%; margin: auto; margin-top:20%;">
                    <div style="width: 40%; display: inline-block; margin-right: 20%; text-align: center;">
                        <hr>
                        <p style="font-size: 8pt;"> -Nombre Encargado actividad- <br> Responsable de la actividad -Nombre responsable- <br>&nbsp;</p>
                    </div>
                    <div style="width: 40%; display: inline-block; text-align: center;">
                        <hr>
                        <p style="font-size: 8pt;"> -Nombre Jefe de departamento- <br> (Jefe/Jefa) de Depto. -Nombre de departamento-<br>&nbsp;</p>
                    </div>
                </div>
            </div>
            <p style="font-size: 6pt; position: absolute; bottom: 0cm; left: 0cm;" >c.c.p Alumno <br> c.c.p Expediente</p>
        </main>
    @endif  
</body>
</html>