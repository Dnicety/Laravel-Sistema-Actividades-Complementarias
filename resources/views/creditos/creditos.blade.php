<x-auth-validation-errors :errors="$errors"/>
<x-auth-validation-success/>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Constancias pendientes de liberar') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class=""> <!--Quitar -->
                              <table id="myTable" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                                <!-- Encabezado de tabla -->
                                <thead>
                                  <tr>
                                    <th>Alumno</th>
                                    <th>Actividad</th>
                                    <th>Carrera</th>
                                    <th>Oficio</th>
                                    <th>Acciones</th>
                                  </tr>
                                </thead>
                                <!-- Cuerpo de tabla -->
                                <tbody>
                                @foreach ($creditos as $credito)
                                  <!-- Inicia el ciclo de enlistado -->
                                  <tr>
                                    <td>
                                      <div class="flex items-center">
                                        <div class="ml-4">
                                          <div class="text-sm font-medium text-gray-900">
                                            {{$credito->nombre}}
                                          </div>
                                          <div class="text-sm text-gray-500">
                                            {{$credito->noControl}}
                                          </div>
                                        </div>
                                      </div>
                                    </td>
                                    <td>
                                      <div class="text-sm text-center text-gray-900">{{$credito->actNombre}}</div>
                                    </td>
                                    <td>
                                      <div class="text-sm text-center text-gray-900">{{$credito->carrera}}</div>
                                    </td>
                                    <td>
                                        <div class="text-sm text-center text-gray-900">{{$credito->oficio}}</div>
                                    </td>
                                    <td>
                                      <div class="grid grid-cols-3 items-center">
                                        <div class="justify-self-center">
                                          <a href="{{route('verConstancia', ['noControl' => $credito->noControl, 'idAct' => $credito->idAct])}}">
                                            <img src="{{asset('images/view-show.svg')}}" width="15" height="15" alt="Ver credito">
                                          </a>
                                        </div>
                                        <div class="justify-self-center">
                                          <a href="{{route('regresarConstancia', ['noControl' => $credito->noControl, 'idAct' => $credito->idAct])}}">
                                            <img src="{{asset('images/close.svg')}}" width="15" height="15" alt="Negar credito">
                                          </a>
                                        </div>
                                        <div class="justify-self-center">
                                          <a href="{{route('liberarConstancia', ['noControl' => $credito->noControl, 'idAct' => $credito->idAct])}}">
                                            <img src="{{asset('images/checkmark.svg')}}" width="15" height="15" alt="Liberar credito">
                                          </a>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                  <!-- Termina el ciclo -->
                                @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // Carga de DataTable
  $(document).ready( function () {
      $('#myTable').DataTable({
        processing: true,
        "language": {
          "emptyTable": "No hay constancias pendientes",
          "infoEmpty": "Mostrando 0 a 0 de 0 resultados",
          "zeroRecords" : "No se encontraron coincidencias",
          "infoFiltered":   "(Filtrado de _MAX_ total de entradas)",
          "loadingRecords": "Cargando pendientes...",
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