@if (Auth::check())

@else
<x-guest-layout>
  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-gray-200 border-b border-gray-200">
              
                  <div class="flex-initial mb-6"><a class="px-4 py-2 shadow-md bg-white border border-gray-300 text-gray-600 text-sm hover:text-blue-500" href="{{route('login')}}"><- Volver</a></div>

                  <div class="bg-white w-full rounded-lg shadow-xl mb-10">
                      <div class="p-4 border-b">
                          <h2 class="text-2xl ">
                              {{$alumno->nombre}} ({{$alumno->sexo}})
                          </h2>
                      </div>
                      <div>
                          <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                              <p class="text-gray-600">Numero de control</p>
                              <p>{{$alumno->noControl}}</p>
                          </div>
                          <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                              <p class="text-gray-600">Correo electronico institucional</p>
                              <p>{{$alumno->email}}</p>
                          </div>
                          <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                              <p class="text-gray-600">Carrera</p>
                              <p>{{$alumno->carrera}}</p>
                          </div>
                      </div>
                  </div>
              

                      <div class="bg-white" x-data="{selected:null}">
                          <ul class="shadow-box">          
                              <li class="relative border-b border-gray-200">
                                  <button type="button" class="w-full px-8 py-6 text-left" @click="selected !== 1 ? selected = 1 : selected = null">
                                      <div class="flex items-center justify-between">
                                          <span>Credito por tutoria</span>
                                          <span class="ico-plus"></span>
                                      </div>
                                  </button>
                                  <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                                      <div class="p-6">
                                          @if($cTutoria)
                                          <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                              <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                  Actividad
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                  # de oficio
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                  Fecha de emision
                                                </th>
                                                <th scope="col" class="relative px-6 py-3">
                                                  <span class="sr-only">Edit</span>
                                                </th>
                                              </tr>
                                            </thead>
                                            @if($cTutoria)
                                            <tbody class="bg-white divide-y divide-gray-200">
                                              <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                  <div class="text-sm text-gray-900">{{$cTutoria[0]->nombre}}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                  <div class="text-sm text-gray-900">{{$cTutoria[0]->oficio}}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                  {{$cTutoria[0]->created_at}}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                  <a href="{{route('descargarDocumento', $cTutoria[0]->idCredito)}}" class="text-indigo-600 hover:text-indigo-900">Descargar constancia</a>
                                                </td>
                                              </tr>
                                            </tbody>
                                            @endif
                                        </table>
                                          @else
                                              <p class="w-full text-center">Aun no tienes credito por la actividad de tutorias</p>
                                          @endif
                                      </div>
                                  </div>
                              </li>
                              <li class="relative border-b border-gray-200">
                                  <button type="button" class="w-full px-8 py-6 text-left" @click="selected !== 2 ? selected = 2 : selected = null">
                                      <div class="flex items-center justify-between">
                                          <span>Credito por actividades academicas</span>
                                          <span class="ico-plus"></span>
                                      </div>
                                  </button>
                                  <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container2" x-bind:style="selected == 2 ? 'max-height: ' + $refs.container2.scrollHeight + 'px' : ''">
                                      <div class="p-6">
                                          @if($cActAca1 || $cActAca2)
                                          <table class="min-w-full divide-y divide-gray-200">
                                              <thead class="bg-gray-50">
                                                <tr>
                                                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Actividad
                                                  </th>
                                                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    # de oficio
                                                  </th>
                                                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Fecha de emision
                                                  </th>
                                                  <th scope="col" class="relative px-6 py-3">
                                                    <span class="sr-only">Edit</span>
                                                  </th>
                                                </tr>
                                              </thead>
                                              @if($cActAca1)
                                              <tbody class="bg-white divide-y divide-gray-200">
                                                <tr>
                                                  <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{$cActAca1[0]->nombre}}</div>
                                                  </td>
                                                  <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{$cActAca1[0]->oficio}}</div>
                                                  </td>
                                                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{$cActAca1[0]->created_at}}
                                                  </td>
                                                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{route('descargarDocumento', $cActAca1[0]->idCredito)}}" class="text-indigo-600 hover:text-indigo-900">Descargar constancia</a>
                                                  </td>
                                                </tr>
                                              </tbody>
                                              @endif
                                              @if($cActAca2)
                                              <tbody class="bg-white divide-y divide-gray-200">
                                                <tr>
                                                  <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{$cActAca2[0]->nombre}}</div>
                                                  </td>
                                                  <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{$cActAca2[0]->oficio}}</div>
                                                  </td>
                                                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{$cActAca2[0]->created_at}}
                                                  </td>
                                                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{route('descargarDocumento', $cActAca2[0]->idCredito)}}" class="text-indigo-600 hover:text-indigo-900">Descargar constancia</a>
                                                  </td>
                                                </tr>
                                              </tbody>
                                              @endif
                                          </table>
                                          @else
                                              <p class="w-full text-center">Aun no tienes creditos por actividades academicas</p>
                                          @endif
                                      </div>
                                  </div>
                              </li>
                              <li class="relative border-b border-gray-200">
                                  <button type="button" class="w-full px-8 py-6 text-left" @click="selected !== 3 ? selected = 3 : selected = null">
                                      <div class="flex items-center justify-between">
                                          <span>Credito por actividades extraescolares</span>
                                          <span class="ico-plus"></span>
                                      </div>
                                  </button>
                                  <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container3" x-bind:style="selected == 3 ? 'max-height: ' + $refs.container3.scrollHeight + 'px' : ''">
                                      <div class="p-6">
                                          @if($cActExt1 || $cActExt2)
                                          <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                              <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                  Actividad
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                  # de oficio
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                  Fecha de emision
                                                </th>
                                                <th scope="col" class="relative px-6 py-3">
                                                  <span class="sr-only">Edit</span>
                                                </th>
                                              </tr>
                                            </thead>
                                            @if($cActExt1)
                                            <tbody class="bg-white divide-y divide-gray-200">
                                              <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                  <div class="text-sm text-gray-900">{{$cActExt1[0]->nombre}}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                  <div class="text-sm text-gray-900">{{$cActExt1[0]->oficio}}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                  {{$cActExt1[0]->created_at}}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                  <a href="{{route('descargarDocumento', $cActExt1[0]->idCredito)}}" class="text-indigo-600 hover:text-indigo-900">Descargar constancia</a>
                                                </td>
                                              </tr>
                                            </tbody>
                                            @endif
                                            @if($cActExt2)
                                            <tbody class="bg-white divide-y divide-gray-200">
                                              <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                  <div class="text-sm text-gray-900">{{$cActExt2[0]->nombre}}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                  <div class="text-sm text-gray-900">{{$cActExt2[0]->oficio}}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                  {{$cActExt2[0]->created_at}}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                  <a href="{{route('descargarDocumento', $cActExt2[0]->idCredito)}}" class="text-indigo-600 hover:text-indigo-900">Descargar constancia</a>
                                                </td>
                                              </tr>
                                            </tbody>
                                            @endif
                                        </table>
                                          @else
                                              <p class="w-full text-center">Aun no tienes creditos por actividades extraescolares</p>
                                          @endif
                                      </div>
                                  </div>                        
                              </li>                   
                          </ul>
                      </div>

              </div>
          </div>
      </div>
  </div>
</x-guest-layout>
@endif

<script>
    // Carga de DataTable
  $(document).ready( function () {
      $('#myTable').DataTable({
        processing: true,
        "language": {
          "emptyTable": "No hay creditos registrados",
          "infoEmpty": "Mostrando 0 a 0 de 0 resultados",
          "zeroRecords" : "No se encontraron coincidencias",
          "infoFiltered":   "(Filtrado de _MAX_ total de entradas)",
          "loadingRecords": "Cargando creditos...",
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