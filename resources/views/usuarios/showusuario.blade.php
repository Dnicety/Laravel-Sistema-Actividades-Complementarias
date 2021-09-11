<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12  items-center justify-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="max-w-1xl bg-white w-full rounded-lg shadow-xl">
                        <div class="p-4 border-b">
                            <h2 class="text-2xl ">
                                {{$usuarios->name}}
                            </h2>
                            <p class="text-sm text-gray-500">
                                {{$usuarios->email}}
                            </p>
                        </div>
                        <div>
                            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                                <p class="text-gray-600">
                                    Institucion educativa
                                </p>
                                <p>
                                    {{ $usuarios->institucion }}
                                </p>
                            </div>
                            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                                <p class="text-gray-600">
                                    Departamento
                                </p>
                                <p>
                                    {{ $usuarios->departamento }}
                                </p>
                            </div>
                            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                                <p class="text-gray-600">
                                    Telefono de contacto
                                </p>
                                <p>
                                    {{ $usuarios->telefono }}
                                </p>
                            </div>
                            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                                <p class="text-gray-600">
                                    Tipo de cuenta
                                </p>
                                <p>
                                    {{ $usuarios->tipo }}
                                </p>
                            </div>
                            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4">
                                <p class="text-gray-600">
                                    Encargado de las actividades:
                                </p>
                                <div class="space-y-2">
                                @foreach ($actividades as $actividad)
                                    @if ($actividad->prestador==$usuarios->id)
                                        <div class="border-2 flex items-center p-2 rounded justify-between space-x-2">
                                            <div class="space-x-2 truncate">
                                                <span>
                                                    {{$actividad->nombre}}
                                                </span>
                                            </div>
                                            <a href="{{route('actividades.show', $actividad->idAct)}}" class="text-purple-700 hover:underline">
                                                Ver actividad
                                            </a>
                                        </div>
                                    @endif
                               @endforeach         
                               </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>