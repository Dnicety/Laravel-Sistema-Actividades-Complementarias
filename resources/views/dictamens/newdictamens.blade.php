<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nuevo numero de dictamen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <form action=" {{ route('disctamens.store') }}" method="POST">
                                    @csrf

                                    <div class="grid grid-flow-row grid-rows-none grid-cols-4 gap-4">
                                        <div class="col-start-1 row-start-1 col-span-2">
                                            <x-label for="departamento" :value="_('Departamento encargado')"></x-label>
                                            <x-input class="block mt-1 w-full bg-gray-500 text-white" type="text" name="departamento" required readonly value="{{Auth::user()->departamento}}"/>
                                        </div>
                                        <div class="row-start-3">
                                            <x-label for="numDictamen" :value="_('Numero de dictamen')"></x-label>
                                            <x-input class="block mt-1 w-full" type="text" name="numDictamen" maxlength="255" autofocus required/>
                                        </div>
                                        <div class="row-start-3 col-start-2 col-span-3">
                                            <x-label for="actividad" :value="_('Actividad')"></x-label>
                                            <x-input class="block mt-1 w-full" type="text" name="actividad" maxlength="255" placeholder="Asistencia a congreso" required/>
                                        </div>
                                        <div class="row-start-4 col-span-4 mb-10">
                                            <x-label for="descripcion" :value="_('Descripcion de actividad')"/>
                                            <textarea class="block w-full h-full px-4 py-3 pr-8 leading-tight border-gray-200 rounded appearance-none focus:outline-none focus:border-gray-500" name="descripcion" maxlength="255" required></textarea>
                                        </div>
                                        <div class="row-start-5 col-start-1">
                                            <x-label for="creditos" :value="_('Creditos')"></x-label>
                                            <x-input class="block mt-1 w-full text-right" type="text" name="creditos" value="1" required/>
                                        </div>
                                        <div class="row-start-5 col-start-2">
                                            <x-label for="periodo" :value="_('Periodo')"/>
                                            <label><input type="radio" name="periodo" value="Enero-Junio" checked>  Enero - Junio</label>
                                            <br>
                                            <label><input type="radio" name="periodo" value="Agosto-Diciembre">  Agosto - Diciembre</label>
                                        </div>
                                        <div class="row-start-5 col-start-3 col-span-2">
                                            <x-label for="year" :value="_('Año')"></x-label>
                                            <x-input class="block mt-1 w-full text-center" type="text" name="year" placeholder="AAAA" maxlength="4" pattern="[0-9]{4}" value="{{ now()->year }}"/>
                                        </div>
                                        <div class="row-start-6 col-start-4 flex items-center mt-10">
                                            <button type="submit" class="shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500 p-2 w-full">Crear numero de dictamen</button>
                                        </div>
                                    </div>
                                </form>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>