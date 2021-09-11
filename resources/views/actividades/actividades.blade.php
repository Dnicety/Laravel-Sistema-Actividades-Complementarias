<x-auth-validation-errors :errors="$errors"/>
<x-auth-validation-success/>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Actividades del departamento: {{Auth::user()->departamento}}  
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                  @switch(Auth::user()->tipo)
                      @case('JEFEDEPTO')
                          <div class="grid grid-cols-4 gap-2 mb-10">
                            @if (Auth::user()->departamento == "Actividades Extraescolares")
                            <div class="col-start-3 self-center justify-self-center w-full">
                              <button id="importar" class="botonn modal-open group flex items-center shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500 w-full justify-center" type="button">
                                <img src="{{asset('images/plus.svg')}}" height="15" width="15" class="mr-2" alt="Agregar actividad">
                                Importar actividades
                              </button>
                            </div>
                            @endif
                            <div class="col-start-4 self-center justify-self-center w-full">
                              <button id="create" class="botonn modal-open group flex items-center shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500 w-full justify-center" type="button">
                                <img src="{{asset('images/plus.svg')}}" height="15" width="15" class="mr-2" alt="Agregar actividad">
                                Nueva actividad
                              </button>
                            </div>
                          </div>
                          @break
                      @case('PRESTADOR')
                          <h1 class="mb-4">Listado de mis actividades</h1>
                          @break
                      @default
                  @endswitch
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <table id="myTable">
                                    <!-- Encabezado de tabla -->
                                    <thead>
                                      <tr>
                                        <th>
                                          Actividad
                                        </th>
                                        <th>
                                          Periodo
                                        </th>
                                        <th>
                                          Departamento encargado
                                        </th>
                                        <th>
                                          Acciones
                                        </th>
                                      </tr>
                                    </thead>
                                    <!-- Cuerpo de tabla -->
                                    <tbody>
                                      <!-- Inicia el ciclo de enlistado -->
                                      @foreach ($actividades as $actividad)
                                      <tr>
                                        <td>
                                          <div class="flex items-center">
                                            <div class="ml-4">
                                              <div class="text-sm font-medium text-gray-900">
                                                {{$actividad->nombre}}
                                              </div>
                                              <div class="text-sm text-gray-500">
                                                {{$actividad->categoria}}
                                              </div>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                            <div class="text-sm text-gray-900">{{$actividad->periodo}}, {{$actividad->year}}</div>
                                        </td>
                                        <td>
                                            <div class="text-sm text-gray-900">{{$actividad->departamento}}</div>
                                        </td>
                                        <td>
                                          @switch(Auth::user()->tipo)
                                              @case('JEFEDEPTO')
                                                  <div class="grid grid-cols-3 items-center">
                                                    <div class="justify-self-center">
                                                      <a href=" {{ route('actividades.show', $actividad->idAct)}}">
                                                        <img src="{{asset('images/view-show.svg')}}" width="15" height="15" alt="Ver actividad">
                                                      </a>
                                                    </div>
                                                    <div class="justify-self-center">
                                                      <a href="{{ route('actividades.edit', $actividad->idAct) }}">
                                                        <img src="{{asset('images/edit-pencil.svg')}}" width="15" height="15" alt="Editar actividad">
                                                      </a>
                                                    </div>
                                                    <div class="justify-self-center">
                                                      <form action="{{route('actividades.destroy', $actividad->idAct)}}" method="POST">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                        <button onclick="return confirm('Quieres borrar?')" class="pt-2" type="submit">
                                                          <img src="{{asset('images/delete.svg')}}" width="15" height="15" alt="Eliminar actividad">
                                                        </button>
                                                      </form>
                                                    </div>
                                                  </div>
                                                  @break
                                              @case('PRESTADOR')
                                                  <div class="grid grid-cols-2 items-center">
                                                    <div class="justify-self-center">
                                                      <a href=" {{ route('actividades.show', $actividad->idAct)}}">
                                                        <img src="{{asset('images/view-show.svg')}}" width="15" height="15" alt="Ver actividad">
                                                      </a>
                                                    </div>
                                                    <div class="justify-self-center">
                                                      <a href="{{ route('actividades.edit', $actividad->idAct) }}">
                                                        <img src="{{asset('images/edit-pencil.svg')}}" width="15" height="15" alt="Editar actividad">
                                                      </a>
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
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<div class="modal-create opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
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
        <p class="text-2xl font-bold">Crear actividad</p>
        <div class="modal-close cursor-pointer z-50">
          <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
          </svg>
        </div>
      </div>
      <div class="flex items-center mb-6">
        <p class="text-sm text-gray-400 text-justify">Indicar año y periodo</p>
      </div>
      <!--Body-->
      <form class="m-3.5" action="{{ route('actividades.create') }}" method="GET">
        @csrf        
        <x-label class="mt-4" for="year" :value="_('Año')"/>
        <x-input class="block mt-1 w-full" type="text" name="year" autofocus required maxlength="4" pattern="[0-9]{4}"/>
        <x-label class="mt-4" for="periodo" :value="_('Periodo')"/>
        <select name="periodo" class="form-select block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" required>
          <option value=""> -- Selecciona periodo -- </option>
          <option value="Enero-Junio">Enero - Junio</option>
          <option value="Agosto-Diciembre">Agosto - Diciembre</option>
        </select>
        <button type="submit" class="shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500 p-2 w-full mt-10">Continuar</button>
      </form>
    </div>
  </div>
</div>

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
        <p class="text-2xl font-bold">Importar documento de semestre</p>
        <div class="modal-close cursor-pointer z-50">
          <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
          </svg>
        </div>
      </div>
      <div class="flex items-center mb-6">
        <img src="{{asset('images/teams.png')}}" width="40" height="40" class="mr-4" alt="teams">
        <p class="text-sm text-gray-400 text-justify">Documento con formato proporcionado por Microsoft Teams.</p>
      </div>
      <!--Body-->
      <form class="m-3.5" action="{{ route('importSemestre') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required/>
        <p class="text-sm text-gray-400">Indicar Año y periodo al que pertenece el documento.</p>
        <x-label class="mt-4" for="year" :value="_('Año')"/>
        <x-input class="block mt-1 w-full" type="text" name="year" autofocus required/>
        <x-label class="mt-4" for="periodo" :value="_('Periodo')"/>
        <select name="periodo" class="form-select block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" required>
          <option value=""> -- Selecciona periodo -- </option>
          <option value="Enero-Junio">Enero - Junio</option>
          <option value="Agosto-Diciembre">Agosto - Diciembre</option>
        </select>
        <button type="submit" class="shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500 p-2 mt-10 w-full">Importar... </button>
      </form>
    </div>
  </div>
</div>

<script>
  var modal;
  // Deteccion de boton pulsado
  var botones = document.getElementsByClassName("botonn");
  for(var i = 0; i < botones.length; i++) {
      botones[i].addEventListener('click', comprueba, false);
  }
  function comprueba(){
    switch(this.id){
      case "importar":
        modal = document.querySelector('.modal-import')
        break;
      case "create":
        modal = document.querySelector('.modal-create')
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

  // Carga de DataTable
  $(document).ready( function () {
      $('#myTable').DataTable({
        processing: true,
        "language": {
          "emptyTable": "No hay actividades disponibles",
          "infoEmpty": "Mostrando 0 a 0 de 0 resultados",
          "zeroRecords" : "No se encontraron coincidencias",
          "infoFiltered":   "(Filtrado de _MAX_ total de entradas)",
          "loadingRecords": "Cargando actividades...",
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
</script>