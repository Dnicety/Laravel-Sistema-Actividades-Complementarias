<x-auth-validation-errors :errors="$errors"/>
<x-auth-validation-success/>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Departamentos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="grid grid-cols-4 gap-2 mb-10">
                        <div class="col-start-4 self-center justify-self-center w-full">
                            <a href="{{route('departamentos.create')}}">
                                <button id="create" class="botonn modal-open group flex items-center shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500 w-full justify-center" type="button">
                                    <img src="{{asset('images/plus.svg')}}" height="15" width="15" class="mr-2" alt="Agregar actividad">
                                    Nuevo departamento
                                </button>
                            </a>
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <table id="myTable">
                                    <!-- Encabezado de tabla -->
                                    <thead>
                                      <tr>
                                        <th>id</th>
                                        <th>Departamento</th>
                                        <th>Abreviacion</th>
                                        <th>Acciones</th>
                                      </tr>
                                    </thead>
                                    <!-- Cuerpo de tabla -->
                                    <tbody>
                                      <!-- Inicia el ciclo de enlistado -->
                                      @foreach ($departamentos as $item)
                                        <tr>
                                            <td>
                                                <div class="text-sm text-center text-gray-900">{{$item->id}}</div>
                                            </td>
                                            <td>
                                                <div class="text-sm text-center text-gray-900">{{$item->departamento}}</div>
                                            </td>
                                            <td>
                                                <div class="text-sm text-center text-gray-900">{{$item->abr}}</div>
                                            </td>
                                            <td>
                                                <div class="grid grid-cols-2 items-center">
                                                    <div class="justify-self-center">
                                                        <a href="{{ route('departamentos.edit', $item->id) }}">
                                                            <img src="{{asset('images/edit-pencil.svg')}}" width="15" height="15" alt="Editar actividad">
                                                        </a>
                                                    </div>
                                                    <div class="justify-self-center">
                                                        <form action="{{route('departamentos.destroy', $item->id)}}" method="POST">
                                                            @csrf
                                                            {{ method_field('DELETE') }}
                                                            <button onclick="return confirm('Quieres borrar?')" class="pt-2" type="submit">
                                                            <img src="{{asset('images/delete.svg')}}" width="15" height="15" alt="Eliminar actividad">
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
            "emptyTable": "No hay departamentos disponibles",
            "infoEmpty": "Mostrando 0 a 0 de 0 resultados",
            "zeroRecords" : "No se encontraron coincidencias",
            "infoFiltered":   "(Filtrado de _MAX_ total de entradas)",
            "loadingRecords": "Cargando departamentos...",
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