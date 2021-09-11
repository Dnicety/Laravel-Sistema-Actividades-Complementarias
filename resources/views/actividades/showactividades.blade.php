<x-auth-validation-errors :errors="$errors"/>
<x-auth-validation-success/>

<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Actividades') }}</h2>
    </x-slot>

    <div class="py-12 items-center justify-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="max-w-1xl bg-white w-full rounded-lg shadow-xl">
                        <div class="p-4 border-b">
                            <h2 class="text-2xl ">
                                {{$actividades[0]->nombre}}
                            </h2>
                            <p class="text-sm text-gray-500">
                                {{$actividades[0]->categoria}}
                            </p>
                        </div>
                        <div>
                          <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                            <p class="text-gray-600">
                                Encargado de la actividad: 
                            </p>
                            @if ($actividades[0]->prestador)
                              <p>{{$actividades[0]->name}}</p>
                            @else
                              <button id="prestadorr" class="botonn modal-open rounded-md text-sm font-medium group flex items-center bg-gray-400 text-white px-4 py-4 hover:text-blue-600" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="fill-current text-blue-600 mr-2" width="20" height="20" fill="currentColor">
                                  <path fill-rule="evenodd" clip-rule="evenodd" d="M10 12a6 6 0 1 1 0-12 6 6 0 0 1 0 12zm0-3a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm4 2.75V20l-4-4-4 4v-8.25a6.97 6.97 0 0 0 8 0z"/>
                                </svg>
                                Asignar encargado a la actividad
                              </button>
                            @endif
                          </div>
                            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                                <p class="text-gray-600">
                                    Dictamen
                                </p>
                                <p>
                                    {{$actividades[0]->numDictamen}}, {{$actividades[0]->actividad}}
                                </p>
                            </div>
                            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                                <p class="text-gray-600">
                                    Periodo de actividad
                                </p>
                                <p>
                                    {{$actividades[0]->periodo}}, {{$actividades[0]->year}}
                                </p>
                            </div>
                            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                                <p class="text-gray-600">
                                    Departamento encargado
                                </p>
                                <p>
                                    {{$actividades[0]->departamento}}
                                </p>
                            </div>
                            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                                <p class="text-gray-600">
                                    Descripcion
                                </p>
                                <p>
                                    {{$actividades[0]->descripcion}}
                                </p>
                            </div>
                            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4">
                                <p class="text-gray-600">
                                    Criterios y ponderacion
                                </p>
                                <div class="space-y-2">
                                    <div class="border-2 flex items-center p-2 rounded justify-between space-x-2">
                                        <div class="space-x-2 truncate">
                                            <span>
                                                Horas semanales necesarias: {{$actividades[0]->horas}}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="border-2 flex items-center p-2 rounded justify-between space-x-2">
                                        <div class="space-x-2 truncate">
                                            <span>
                                                Creditos a obtener: {{$actividades[0]->creditos}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pb-12 items-center justify-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="grid grid-cols-5 grid-rows-2 gap-2 mb-10">
                      <div class="col-start-1 self-center">
                        <h1>Participantes</h1>
                      </div>
                      <div class="col-start-3 self-center justify-self-center">
                        <button id="agregar" class="botonn modal-open group flex items-center shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500" type="button">
                          <img src="{{asset('images/plus.svg')}}" width="15" height="15" class="mr-2" alt="Agregar participantes">
                          Agregar participante
                        </button>
                      </div>
                      <div class="col-start-4 self-center justify-self-center">
                        <button id="importar" class="botonn modal-open group flex items-center shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500" type="button">
                          <img src="{{asset('images/import.svg')}}" width="15" height="15" class="mr-2" alt="Importar participantes">
                          Importar participantes
                        </button>
                      </div>
                      <div class="col-start-5 self-center justify-self-center w-full">
                        <div class="flex flex-row self-center justify-self-center gap-1">
                          <a href="{{ route('exportParticipantes', ['idAct' => $actividades[0]->idAct]) }}">
                            <button class="group flex items-center shadow-md border border-gray-300 px-4 py-2 justify-center w-full text-sm" type="button">
                              <img src="{{asset('images/pdf.svg')}}" class="mr-2" width="15" height="15" alt="Exportar xlsx">
                              Exportar participantes
                            </button>
                          </a>      
                        </div>
                      </div>
                      <div class="col-start-5 row-start-2 self-center">
                        <h3>Participantes: {{count($participantes)}}</h3>
                      </div>
                    </div>
                    <!-- Listado de participantes -->
                    <table id="myTable">
                        <!-- Encabezado de tabla -->
                        <thead>
                          <tr>
                            <th>Alumno</th>
                            <th>Correo Institucional</th>
                            <th>Evaluacion</th>
                            <th>Carrera</th>
                            <th>Acciones</th>
                          </tr>
                        </thead>
                        <!-- Cuerpo de tabla -->
                        <tbody>
                          <!-- Inicia el ciclo de enlistado -->
                          @foreach ($participantes as $participante)
                          <tr>
                            <td>
                              <div class="flex items-center">
                                <div class="ml-4">
                                  <div class="text-sm font-medium text-gray-900">
                                    {{$participante->nombre}}
                                  </div>
                                  <div class="text-sm text-gray-500">
                                    {{$participante->noControl}}
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td>
                              <div class="text-sm text-center text-gray-900">{{$participante->email}}</div>
                            </td>
                            <td>
                              @if ($participante->status == "NO EVALUADO")
                                <div class="w-full">
                                  <a href="{{ route('evaluaciones.create', ['noControl' => $participante->noControl, 'idAct' => $participante->idAct]) }}">
                                    <button class="shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500 w-full" type="button">Evaluar</button>
                                  </a>
                                </div>
                              @elseif($participante->status == "NO ACREDITA")
                                <div>
                                  <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                      <button class="flex items-center text-sm font-medium shadow-md border border-gray-300 text-gray-600 px-4 py-2 hover:text-blue-500 w-full transition duration-150 ease-in-out">
                                      <div class="w-full text-red-600">{{ __('No acredita') }}</div>
                                        <div>
                                          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                          </svg>
                                        </div>
                                      </button>
                                    </x-slot>
                                    <x-slot name="content">
                                      <p class="m-2">{{$participante->observaciones}}</p>
                                    </x-slot>
                                  </x-dropdown>
                                </div>
                              @elseif($participante->status == "EN REVISION")
                                <div>
                                  <p class="text-center">En revision</p>
                                </div>
                              @elseif($participante->status == "EVALUADO")
                                @if ($participante->cstatus == 'LIBERADO')
                                  <div>
                                    <x-dropdown align="right" width="48">
                                      <x-slot name="trigger">
                                        <button class="flex items-center text-sm font-medium shadow-md border border-gray-300 text-gray-600 px-4 py-2 hover:text-blue-500 w-full transition duration-150 ease-in-out">
                                          <div class="w-full">{{ __('Evaluacion') }}</div>
                                          <div>
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                          </div>
                                        </button>
                                      </x-slot>
                                      <x-slot name="content">
                                        <x-dropdown-link href="{{ route('descargarConstancia', ['noControl' => $participante->noControl, 'idAct' => $participante->idAct]) }}">
                                          <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                            <div class="mr-2">
                                              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" clip-rule="evenodd" />
                                              </svg>
                                            </div>
                                            <div>{{ __('Descargar constancia') }}</div>
                                          </button>
                                        </x-dropdown-link>
                                        <x-dropdown-link href="{{ route('exportConstancia', ['noControl' => $participante->noControl, 'idAct' => $participante->idAct, 'action' => 2]) }}">
                                          <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                            <div class="mr-2">
                                              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M0 0l20 10L0 20V0zm0 8v4l10-2L0 8z" clip-rule="evenodd" />
                                              </svg>
                                            </div>
                                            <div>{{ __('Enviar constancia') }}</div>
                                          </button>
                                        </x-dropdown-link>
                                      </x-slot>
                                    </x-dropdown>
                                  </div>
                                @else
                                  <div>
                                    <p class="text-center">Pendiente de liberar</p>
                                  </div>
                                @endif
                              @endif
                            </td>
                            <td>
                                <div class="text-sm text-center text-gray-900">{{$participante->carrera}}</div>
                            </td>
                            <td>
                              @switch(Auth::user()->tipo)
                                  @case("JEFEDEPTO")
                                    <div class="justify-self-center">
                                      <form action="{{ route('participantes.destroy', $participante->idParticipante) }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button onclick="return confirm('Quieres eliminar participante?')" class="pt-2 w-full" type="submit">
                                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="fill-current text-red-600" width="15" height="15" fill="currentColor">
                                            <path d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z"/>
                                          </svg>
                                        </button>
                                      </form>
                                    </div>
                                      @break
                                  @case("PRESTADOR")
                                  <div class="grid grid-cols-3 items-center">
                                    <div class="justify-self-center">
                                      <form action="{{ route('participantes.destroy', $participante->idParticipante) }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button onclick="return confirm('Quieres eliminar participante?')" class="pt-2 w-full" type="submit">
                                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="fill-current text-red-600" width="15" height="15" fill="currentColor">
                                            <path d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z"/>
                                          </svg>
                                        </button>
                                      </form>
                                    </div>
                                  </div>
                                      @break
                                  @default
                                      
                              @endswitch
                            </td>
                          </tr>
                          @endforeach
                          <!-- Termina el ciclo -->
                        </tbody>
                      </table>
                      <div class="grid grid-cols-4 gap-2 mt-10">
                        <div class="col-start-4 self-center justify-self-center w-full">
                          @if($participantes)
                          <form onclick="return confirm('¿Quieres eliminar todos los participantes de la actividad?')" action="{{route('deleteParticipantes', $participantes[0]->idAct)}}" method="POST">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button class="shadow-md border border-gray-300 bg-red-400 text-white text-sm hover:text-red-600 px-4 py-2 w-full" type="submit">
                              Eliminar participantes
                            </button>
                          </form>
                          @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!--Modal Agregar Participante-->
<div class="modal-add opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
  <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
  
  <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
    
    <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
      <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
      </svg>
      <span class="text-sm">(Esc)</span>
    </div>

    <!-- Add margin if you want to see some of the overlay behind the modal-->
    <div class="modal-content py-4 text-left px-6">
      <!--Title-->
      <div class="flex justify-between items-center pb-3">
        <p class="text-2xl font-bold">Agregar participante</p>
        <div class="modal-close cursor-pointer z-50">
          <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
          </svg>
        </div>
      </div>

      <!--Body-->
      <form class="m-3.5" action="{{ route('crearParticipante', $actividades[0]->idAct) }}" method="POST">
        @csrf
          <x-label for="noControl" :value="_('# de control del estudiante')"></x-label>
          <x-input class="block mt-1 w-full text-right" type="text" name="noControl" autofocus maxlength="8" pattern="[0-9]{8}" required/>
        <button type="submit" class="px-4 py-2 shadow-md border border-gray-300 text-gray-600 text-sm hover:text-blue-500 w-full mt-10">Agregar participante</button>
      </form>
      
    </div>
  </div>
</div>

<!--Modal Importar Documento de Participantes-->
<div class="modal-import opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
  <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
  <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
    <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
      <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
      </svg>
      <span class="text-sm">(Esc)</span>
    </div>
    <!-- Add margin if you want to see some of the overlay behind the modal-->
    <div class="modal-content py-4 text-left px-6">
      <!--Title-->
      <div class="flex justify-between items-center pb-3">
        <p class="text-2xl font-bold">Importar Participantes</p>
        <div class="modal-close cursor-pointer z-50">
          <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
          </svg>
        </div>
      </div>
      <!--Body-->
      <form class="m-3.5" action="{{ route('importParticipantes', $actividades[0]->idAct) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required/>
        <button type="submit" class="px-4 py-2 shadow-md border border-gray-300 text-gray-600 text-sm hover:text-blue-500 w-full mt-10">Importar... </button>
      </form>
    </div>
  </div>
</div>

<!--Modal Asigna Prestador-->
<div class="modal-asignap opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
  <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
  <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
    <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
      <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
      </svg>
      <span class="text-sm">(Esc)</span>
    </div>
    <!-- Add margin if you want to see some of the overlay behind the modal-->
    <div class="modal-content py-4 text-left px-6">
      <!--Title-->
      <div class="flex justify-between items-center pb-3">
        <p class="text-2xl font-bold">Asignar encargado</p>
        <div class="modal-close cursor-pointer z-50">
          <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
          </svg>
        </div>
      </div>
      <!--Body-->
      <form class="m-3.5" action="{{ route('updatePrestador', $actividades[0]->idAct) }}" method="POST">
        @csrf
        {{ method_field('PATCH') }}
        <x-label for="prestador" :value="_('Usuarios disponibles')"/>
        <select name="prestador" required class="form-select block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
          <option value=""> -- Selecciona un usuario -- </option>
          @foreach ($prestadores as $presta)
            <option value="{{ $presta->id }}">{{ $presta->name }}</option>
          @endforeach
          </select>
        <button type="submit" class="shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500 p-2 w-full mt-10">Importar... </button>
      </form>    
    </div>
  </div>
</div>

<script>
   // Carga de DataTable
   $(document).ready( function () {
      $('#myTable').DataTable({
        processing: true,
        "language": {
          "emptyTable": "No hay participantes disponibles",
          "infoEmpty": "Mostrando 0 a 0 de 0 resultados",
          "zeroRecords" : "No se encontraron coincidencias",
          "infoFiltered":   "(Filtrado de _MAX_ total de entradas)",
          "loadingRecords": "Cargando participantes...",
          "processing":     "Procesando...",
          "search": "Buscar: ",
          "lengthMenu": 'Mostrar <select>'+
          '<option value="10">10</option>'+
          '<option value="25">25</option>'+
          '<option value="50">50</option>'+
          '<option value="-1">Todos</option>'+
          '</select> resultados',
          "info": "Mostrando pagina _PAGE_ de _PAGES_",
          "paginate": {
            "previous": "Pagina anterior",
            "next": "Pagina siguiente"
          }
        },
      });      
  } );

  var modal;
  // Deteccion de boton pulsado
  var botones = document.getElementsByClassName("botonn");
  for(var i = 0; i < botones.length; i++) {
      botones[i].addEventListener('click', comprueba, false);
  }
  function comprueba(){
    switch(this.id){
      case "agregar":
        modal = document.querySelector('.modal-add')
        break;
      case "importar":
        modal = document.querySelector('.modal-import')
        break;
      case "prestadorr":
        modal = document.querySelector('.modal-asignap')
        break;
    }
  }

  // Modal
  var openmodal = document.querySelectorAll('.modal-open')
  for (var i = 0; i < openmodal.length; i++) {
    openmodal[i].addEventListener('click', function(event){
    event.preventDefault()
    toggleModal()
    })
  }
  
  const overlay = document.querySelector('.modal-overlay')
  overlay.addEventListener('click', toggleModal)
  
  var closemodal = document.querySelectorAll('.modal-close')
  for (var i = 0; i < closemodal.length; i++) {
    closemodal[i].addEventListener('click', toggleModal)
  }
  
  document.onkeydown = function(evt) {
    evt = evt || window.event
    var isEscape = false
    if ("key" in evt) {
    isEscape = (evt.key === "Escape" || evt.key === "Esc")
    } else {
    isEscape = (evt.keyCode === 27)
    }
    if (isEscape && document.body.classList.contains('modal-active')) {
    toggleModal()
    }
  };
  
  function toggleModal () {
    const body = document.querySelector('body')
    modal.classList.toggle('opacity-0')
    modal.classList.toggle('pointer-events-none')
    body.classList.toggle('modal-active')
  }
</script>
