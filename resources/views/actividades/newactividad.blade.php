<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nueva actividad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                  <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                      <div x-data="{ select : 0 }" class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <form action="{{ route('actividades.store') }}" method="POST">
                          @csrf
                          <div class="grid grid-flow-row grid-cols-4 grid-rows-none gap-4">
                            <div class="row-start-1 col-start-1 col-span-4 mb-10">
                              <x-label for="categoria" :value="_('Numero de dictamen')"/>
                              <select x-model="select" name="numDictamen" class="form-select block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-600" required>
                                <option value="0" disabled selected>-- Selecciona numero de dictamen --</option>
                                @foreach ($dictamens as $item)
                                <option value="{{$item->id}}">{{$item->numDictamen}}, {{$item->actividad}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="row-start-2 col-start-1 col-span-2">
                              <x-label for="nombre" :value="_('Nombre actividad')"></x-label>
                              <x-input x-bind:disabled="(select != 0) ? false : true" class="block mt-1 w-full" type="text" name="nombre" placeholder="Nombre de actividad" maxlength="100" autofocus required/>
                            </div>
                            <div class="row-start-2 col-start-3 col-span-2">
                              <x-label for="categoria" :value="_('Categoria')"/>
                              <select x-bind:disabled="(select != 0) ? false : true" name="categoria" class="form-select block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" required>
                                  <option value=""> -- Selecciona una categoria -- </option>
                                  <option value="Tutoria">Tutoria</option>
                                  <option value="Conferencia">Conferencia</option>
                                  <option value="Evento Academico">Evento Académico</option>
                                  <option value="Actividad Cultural">Actividad Cultural</option>
                                  <option value="Actividad Deportiva">Actividad Deportiva</option>
                                  <option value="Proyecto de investigacion">Proyecto de investigación</option>
                                  <option value="Promocion de oferta educativa">Promoción de oferta educativa</option>
                                  <option value="Curso masivo abierto en linea (MOOC)">curso masivo abierto en línea (MOOC)</option>
                                  <option value="Eventos academicos relacionados con la carrera">Eventos académicos relacionados con la carrera</option>
                                  <option value="Evento Nacional Estudiantil de Innovacion y Tecnologia (ENEIT)">Evento Nacional Estudiantil de Innovación y Tecnología (ENEIT)</option>
                              </select>
                            </div>
                            <div class="row-start-3 col-start-1 col-span-4 mb-6">
                              <x-label for="descripcion" :value="_('Descripcion de actividad')"/>
                              <textarea x-bind:disabled="(select != 0) ? false : true" class="block w-full h-full px-4 py-3 pr-8 leading-tight border-gray-200 rounded appearance-none focus:outline-none focus:border-gray-500" name="descripcion" maxlength="255" required></textarea>
                            </div>
                            <div class="row-start-4 col-start-1 col-span-2">
                              <x-label for="lugar" :value="_('Lugar')"></x-label>
                              <x-input x-bind:disabled="(select != 0) ? false : true" class="block mt-1 w-full text-center" type="text" name="lugar" placeholder="-- Aula --" maxlength="100" required/>
                            </div>
                            <div class="row-start-4 col-start-3 col-span-2">
                              <x-label for="horas" :value="_('Horas semanales')"></x-label>
                              <x-input x-bind:disabled="(select != 0) ? false : true" class="block mt-1 w-full text-right" type="text" name="horas" value="2" maxlength="2" required/>
                            </div>
                            <div class="row-start-5 col-start-1 col-span-4">
                              <x-label for="prestador" :value="_('Encargado de actividad')"/>
                              <select x-bind:disabled="(select != 0) ? false : true" name="prestador" class="form-select block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" required>
                                <option value="">-- Selecciona encargado de actividad --</option>
                                @foreach ($prestadores as $item)
                                <option value="{{$item->id}}">{{$item->name}} ({{$item->tipo}})</option>  
                                @endforeach
                              </select>
                            </div>
                            <div class="row-start-6 col-start-4 mt-10">
                              <button x-bind:disabled="(select != 0) ? false : true" type="submit" class="shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500 p-2 w-full">Crear actividad</button>
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