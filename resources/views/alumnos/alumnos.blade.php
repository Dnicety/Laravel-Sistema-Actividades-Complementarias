<x-auth-validation-errors :errors="$errors"/>
<x-auth-validation-success/>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Alumnos') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                  <div class="grid grid-cols-4 mb-10 gap-2">
                    <div class="col-start-4 self-center justify-self-center w-full">
                      <button class="modal-open group flex items-center shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500 w-full justify-center" type="button">
                        <img src="{{asset('images/import.svg')}}" class="mr-2" width="15" height="15" alt="">
                        Importar documento
                      </button>
                    </div>
                  </div>
                  <div class="flex flex-wrap">
                    <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                      <div class="bg-white border rounded shadow p-2">
                        <div class="flex flex-row- itmes-center">
                          <div class="flex-shrink pr-4">
                            <div class="rounded p-3 bg-blue-600">
                              <svg xmlns="http://www.w3.org/2000/svg" class="fill-current text-white text-center" width="20" height="20" fill="currentColor">
                                <path d="M7 8a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0 1c2.15 0 4.2.4 6.1 1.09L12 16h-1.25L10 20H4l-.75-4H2L.9 10.09A17.93 17.93 0 0 1 7 9zm8.31.17c1.32.18 2.59.48 3.8.92L18 16h-1.25L16 20h-3.96l.37-2h1.25l1.65-8.83zM13 0a4 4 0 1 1-1.33 7.76 5.96 5.96 0 0 0 0-7.52C12.1.1 12.53 0 13 0z"/>
                              </svg>
                            </div>
                          </div>
                          <div class="flex-1 text-right md:text-center">
                            <h5 class="font-bold uppercase text-gray-500">Alumnos inscritos</h5>
                            <h3 class="font-bold text-3xl">{{$countAlumnos}} <span class="text-green-500"></h3>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <h1 class="ml-4 mb-2">Listado de alumnos</h1>
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class=""> <!--Quitar -->
                              <table id="myTable" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                                <!-- Encabezado de tabla -->
                                <thead>
                                  <tr>
                                    <th>Alumno</th>
                                    <th>Sexo</th>
                                    <th>Correo Electronico</th>
                                    <th>Carrera</th>
                                    <th>Acciones</th>
                                  </tr>
                                </thead>
                                <!-- Cuerpo de tabla -->
                                <tbody>
                                  <!-- Inicia el ciclo de enlistado -->
                                  @foreach ($alumnos as $alumno)
                                  <tr>
                                    <td>
                                      <div class="flex items-center">
                                        <div class="ml-4">
                                          <div class="text-sm font-medium text-gray-900">
                                            {{$alumno->nombre}}
                                          </div>
                                          <div class="text-sm text-gray-500">
                                            {{$alumno->noControl}}
                                          </div>
                                        </div>
                                      </div>
                                    </td>
                                    <td>
                                      <div class="text-sm text-center text-gray-900">{{$alumno->sexo}}</div>
                                    </td>
                                    <td>
                                      <div class="text-sm text-center text-gray-900">{{$alumno->email}}</div>
                                    </td>
                                    <td>
                                        <div class="text-sm text-center text-gray-900">{{$alumno->carrera}}</div>
                                    </td>
                                    <td>
                                      <div class="grid grid-cols-2 items-center">
                                        <div class="justify-self-center">
                                          <a href="{{ route('alumnos.edit', $alumno->noControl) }}">
                                            <img src="{{asset('images/edit-pencil.svg')}}" height="15" width="15" alt="Editar alumno">
                                          </a>
                                        </div>
                                        <div class="justify-self-center">
                                          <form action="{{route('alumnos.destroy', $alumno->noControl)}}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button onclick="return confirm('Quieres borrar?')"  class="pt-4" type="submit">
                                              <img src="{{asset('images/delete.svg')}}" height="15" width="15" alt="Eliminar alumno">
                                            </button>
                                          </form>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                  @endforeach
                                  <!-- Termina el ciclo -->
                                </tbody>
                              </table>
                              <div class="grid grid-cols-4 gap-2 mt-10">
                                <div class="col-start-4 self-center justify-self-center w-full">
                                  @if($countAlumnos > 0)
                                  <form onclick="return confirm('¿Quieres eliminar todos los alumnos del registro?')" action="{{route('destroyAll')}}" method="POST">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button class="shadow-md border border-gray-300 bg-red-400 text-white text-sm hover:text-red-600 px-4 py-2 w-full" type="submit">
                                      Eliminar alumnos
                                    </button>
                                  </form>
                                  @endif
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
</x-app-layout>

<!--Modal-->
<div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
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
        <p class="text-2xl font-bold">Importar desde documento</p>
        <div class="modal-close cursor-pointer z-50">
          <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
          </svg>
        </div>
      </div>

      <img class="rounded-sm mt-4" src="{{asset('images/formatoAlumnos.png')}}" alt="">
      <p class="text-sm text-justify text-gray-400 mb-6">El formato del documento xslx debera ser el ilustrado en la imagen</p>
 
      <!--Body-->
      <form class="m-3.5" action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file"/>
        <button type="submit" class="shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500 p-2 mt-10 w-full">Importar</button>
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
          "emptyTable": "No hay alumnos registrados",
          "infoEmpty": "Mostrando 0 a 0 de 0 resultados",
          "zeroRecords" : "No se encontraron coincidencias",
          "infoFiltered":   "(Filtrado de _MAX_ total de entradas)",
          "loadingRecords": "Cargando alumnos...",
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
    const modal = document.querySelector('.modal')
    modal.classList.toggle('opacity-0')
    modal.classList.toggle('pointer-events-none')
    body.classList.toggle('modal-active')
  }
</script>
