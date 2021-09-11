<x-app-layout>
    <x-slot name="header">
      <div class="flex">
        <div class="flex-initial ml-4"><h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Dictamen') }}</h2></div>
      </div>
    </x-slot>

    <div class="py-12 items-center justify-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="max-w-1xl bg-white w-full rounded-lg shadow-xl">
                        <div class="p-4 border-b">
                            <h2 class="text-2xl ">
                                {{$dictamen->numDictamen}}
                            </h2>
                            <p class="text-sm text-gray-500">
                                {{$dictamen->actividad}}
                            </p>
                        </div>
                        <div>
                          <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                            <p class="text-gray-600">
                                Departamento encargado:
                            </p>
                            <p>{{$dictamen->departamento}}</p>
                          </div>
                            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                                <p class="text-gray-600">
                                    Descripcion
                                </p>
                                <p>
                                    {{$dictamen->descripcion}}
                                </p>
                            </div>
                            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                                <p class="text-gray-600">
                                    Periodo y a;o
                                </p>
                                <p>
                                    {{$dictamen->periodo}}, {{$dictamen->year}}
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
                                                Creditos: {{$dictamen->creditos}}
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

</x-app-layout>