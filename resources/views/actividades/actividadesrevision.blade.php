<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pendientes de firma') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-4 gap-2 mb-10">
                      <div class="col-start-4 self-center justify-self-center w-full">
                        <button id="create" class="botonn modal-open group flex item-center shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500 w-full justify-center" type="button">
                          <img src="{{asset('images/download.svg')}}" height="15" width="15" class="mr-2" alt="Agregar actividad">
                          Descargar constancias
                        </button>
                      </div>
                    </div>
                    <table id="myTable">
                        <!-- Encabezado de tabla -->
                        <thead>
                          <tr>
                            <th>
                              Actividad
                            </th>
                            <th>
                              Alumno
                            </th>
                            <th>
                              stauts
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
                                    {{$actividad->actname}}
                                  </div>
                                  <div class="text-sm text-gray-500">
                                    {{$actividad->periodo}}, {{$actividad->year}}
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td>
                              <div class="flex items-center">
                                <div class="ml-4">
                                  <div class="text-sm font-medium text-gray-900">
                                    {{$actividad->alumnoname}}
                                  </div>
                                  <div class="text-sm text-gray-500">
                                    {{$actividad->noControl}}
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td class="text-center">
                                <div class="text-sm text-gray-900">{{$actividad->status}}</div>
                            </td>
                            <td class="text-center">
                                <a href=" {{ route('evaluacionrevision', ['noControl' => $actividad->noControl, 'idAct' => $actividad->idAct])}}">
                                  <button class="shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500 w-full">
                                    Ver constancia
                                  </button>
                                </a>
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
        <p class="text-2xl font-bold">Descargar constancias por actividad</p>
        <div class="modal-close cursor-pointer z-50">
          <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
          </svg>
        </div>
      </div>
      <div class="flex items-center mb-6">
        <p class="text-sm text-gray-400 text-justify">Seleccionar actividad para descargar constancias pendientes de revision</p>
      </div>
      <!--Body-->
      <form class="m-3.5" action="{{ route('descargarDocumentos') }}" method="GET">
        @csrf        
        <x-label class="mt-4" for="actividad" :value="_('Actividad')"/>
        <select name="actividad" class="form-select block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" required>
          @if ($actividades)
          <option value=""> -- Selecciona actividad -- </option>
          @foreach ($listAct as $item)
          <option value="{{$item->idAct}}">{{$item->actname}}</option>
          @endforeach
          @else
          <option value="" selected disabled> -- No hay actividades que requieran revision -- </option>    
          @endif
        </select>
        <button type="submit" class="shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500 p-2 w-full mt-10">Continuar</button>
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
          "emptyTable": "No hay actividades que requieran revision",
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