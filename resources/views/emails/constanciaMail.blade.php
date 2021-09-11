<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Mail</title>
</head>
<body>
    <div class="w3-card-4">
        <header class="w3-container w3-light-grey">
          <h3>{{$jefedepto[0]->name}}</h3>
        </header>
        <div class="w3-container">
          <p>{{$jefedepto[0]->email}}</p>
          <hr>
          <p>{{$jefedepto[0]->sexo == 'H' ? 'Jefe' : 'Jefa'}} del departamento, {{$jefedepto[0]->departamento}}</p>
          <p>Instituto Tecnologico de Piedras Negras</p>
          <p>Dirección: Calle Instituto Tecnológico 310, Col. Tecnológico, C.P. 26080, Piedras Negras, Coahuila.</p>
        </div>
    </div>
</body>
</html>