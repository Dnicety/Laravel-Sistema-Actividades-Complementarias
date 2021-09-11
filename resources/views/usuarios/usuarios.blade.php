<x-auth-validation-errors :errors="$errors"/>
<x-auth-validation-success/>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-4 mb-10 gap-2">
                      <div class="col-start-3 self-center justify-self-center">
                        <a href="{{ route('usuarios.create') }}">
                          <button class="group flex items-center shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500" type="button">
                            <img src="{{asset('images/plus.svg')}}" class="mr-2" width="15" height="15" alt="Agregar usuario">
                            @switch(Auth::user()->tipo)
                                @case('ADMIN')
                                    Nuevo Usuario
                                    @break
                                @case('JEFEDEPTO')
                                    Nuevo Prestador
                                    @break
                            @endswitch
                          </button>
                        </a>
                      </div>
                      <div class="col-start-4 self-center justify-self-center w-full">
                        <a href="{{ route('exportUsuarios') }}">
                          <button class="group flex items-center shadow-md border border-gray-300 px-4 py-2 justify-center w-full text-sm" type="button">
                            <img src="{{asset('images/excel.svg')}}" class="mr-2" width="15" height="15" alt="Exportar xlsx">
                            Exportar lista de usuarios
                          </button>
                        </a>                        
                      </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                              <table id="myTable" class="min-w-full divide-y divide-gray-200">
                                <!-- Encabezado de tabla -->
                                <thead>
                                  <tr>
                                    <th>Nombre</th>
                                    <th>Sexo</th>
                                    <th>Institucion</th>
                                    <th>Telefono</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                  </tr>
                                </thead>
                                <!-- Cuerpo de tabla -->
                                <tbody>
                                  <!-- Inicia el ciclo de enlistado -->
                                  @foreach ($usuarios as $usuario)
                                  <tr>
                                    <td>
                                      <div class="flex items-center">
                                        <div class="ml-4">
                                          <div class="text-sm font-medium text-gray-900">
                                            {{$usuario->name}}
                                          </div>
                                          <div class="text-sm text-gray-500">
                                            {{$usuario->email}}
                                          </div>
                                        </div>
                                      </div>
                                    </td>
                                    <td>
                                      <div class="text-sm text-center text-gray-900">{{$usuario->sexo}}</div>
                                    </td>
                                    <td>
                                        <div class="text-sm text-gray-900">{{$usuario->institucion}}</div>
                                        <div class="text-sm text-gray-500">{{$usuario->departamento}}</div>
                                    </td>
                                    <td>
                                        <div class="text-sm text-center text-gray-900">{{$usuario->telefono}}</div>
                                    </td>
                                    <td>
                                      <div class="text-sm text-center text-gray-900">{{$usuario->tipo}}</div>
                                    </td>
                                    <td>
                                      <div class="grid grid-cols-3 items-center">
                                        <div class="justify-self-center">
                                          <a href=" {{ route('usuarios.show', $usuario->id)}}">
                                            <img src="{{asset('images/view-show.svg')}}" height="15" width="15" alt="Ver usuario">
                                          </a>
                                        </div>
                                        <div class="justify-self-center">
                                          <a href="{{ route('usuarios.edit', $usuario->id) }}">
                                            <img src="{{asset('images/edit-pencil.svg')}}" height="15" width="15" alt="Editar usuario">
                                          </a>
                                        </div>
                                        <div class="justify-self-center">
                                          <form action="{{route('usuarios.destroy', $usuario->id)}}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button onclick="return confirm('Quieres borrar?')" class="pt-2" type="submit">
                                              <img src="{{asset('images/delete.svg')}}" height="15" width="15" alt="Eliminar usuario">
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
          "emptyTable": "No hay usuarios disponibles",
          "infoEmpty": "Mostrando 0 a 0 de 0 resultados",
          "zeroRecords" : "No se encontraron coincidencias",
          "infoFiltered":   "(Filtrado de _MAX_ total de entradas)",
          "loadingRecords": "Cargando usuarios...",
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
