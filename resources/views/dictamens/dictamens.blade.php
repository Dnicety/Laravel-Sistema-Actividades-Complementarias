<x-auth-validation-errors :errors="$errors"/>
<x-auth-validation-success/>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Numeros de dictamen
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                  <div class="grid grid-cols-5 mb-10">
                    <div class="col-start-5 self-center justify-self-center w-full">
                      <a href="{{ route('disctamens.create') }}">
                        <button class="group flex items-center shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500 w-full justify-center" type="button">
                          <img src="{{asset('images/plus.svg')}}" height="15" width="15" class="mr-2" alt="Agregar dictamen">
                          Nuevo numero de dictamen
                        </button>
                      </a>
                    </div>
                  </div>

                    <table id="myTable">
                        <thead>
                            <tr>
                                <th># de dictamen</th>
                                <th>Actividad</th>
                                <th>Año / Periodo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dictamens as $item)
                            <tr>
                                <td>{{$item->numDictamen}}</td>
                                <td>{{$item->actividad}}</td>
                                <td>{{$item->year}}, {{$item->periodo}}</td>
                                <td>
                                    <div class="grid grid-cols-3 items-center">
                                        <div class="justify-self-center">
                                          <a href="{{route('disctamens.show', $item->id)}}">
                                            <img src="{{asset('images/view-show.svg')}}" width="15" height="15" alt="Ver dicatmen">
                                          </a>
                                        </div>
                                        <div class="justify-self-center">
                                          <a href="{{route('disctamens.edit', $item->id)}}">
                                            <img src="{{asset('images/edit-pencil.svg')}}" width="15" height="15" alt="Editar dictamen">
                                          </a>
                                        </div>
                                        <div class="justify-self-center">
                                          <form action="{{route('disctamens.destroy', $item->id)}}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button onclick="return confirm('Quieres borrar?')" class="pt-2" type="submit">
                                              <img src="{{asset('images/delete.svg')}}" width="15" height="15" alt="Eliminar dictamen">
                                            </button>
                                          </form>
                                        </div>
                                      </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

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
         "emptyTable": "No hay numeros de dictamen disponibles",
         "infoEmpty": "Mostrando 0 a 0 de 0 resultados",
         "zeroRecords" : "No se encontraron coincidencias",
         "infoFiltered":   "(Filtrado de _MAX_ total de entradas)",
         "loadingRecords": "Cargando numeros de dictamen...",
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