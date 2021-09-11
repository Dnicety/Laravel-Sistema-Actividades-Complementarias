<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Actividad: ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <form action=" {{ route('updateActividad',  $actividades->idAct) }}" method="POST">
                                    @csrf
                                    {{ method_field('PATCH') }}
                                    <div class="grid grid-flow-row grid-cols-4 grid-rows-none gap-4">
                                        <div class="row-start-1 col-start-1 col-span-2">
                                          <x-label for="nombre" :value="_('Nombre actividad')"></x-label>
                                          <x-input class="block mt-1 w-full" type="text" name="nombre" placeholder="Nombre de actividad" value="{{$actividades->nombre}}" autofocus maxlength="100" required/>
                                        </div>
                                        <div class="row-start-1 col-start-3 col-span-2">
                                          <x-label for="categoria" :value="_('Categoria')"/>
                                          <select name="categoria" class="form-select block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" required>
                                                <option value=""> -- Selecciona una categoria -- </option>
                                                <option value="Tutoría" {{ $actividades->categoria == 'Tutoria' ? 'selected' : ''}}>Tutoría</option>
                                                <option value="Conferencia"  {{ $actividades->categoria == 'Conferencia' ? 'selected' : ''}}>Conferencia</option>
                                                <option value="Evento Académico"  {{ $actividades->categoria == 'Evento Académico' ? 'selected' : ''}}>Evento Académico</option>
                                                <option value="Actividad Cultural"  {{ $actividades->categoria == 'Actividad Cultural' ? 'selected' : ''}}>Actividad Cultural</option>
                                                <option value="Actividad Deportiva"  {{ $actividades->categoria == 'Actividad Deportiva' ? 'selected' : ''}}>Actividad Deportiva</option>
                                                <option value="Proyecto de investigación" {{ $actividades->categoria == 'Proyecto de investigación' ? 'selected' : ''}}>Proyecto de investigación</option>
                                                <option value="Promoción de oferta educativa" {{ $actividades->categoria == 'Promoción de oferta educativa' ? 'selected' : ''}}>Promoción de oferta educativa</option>
                                                <option value="Curso masivo abierto en línea (MOOC)" {{ $actividades->categoria == 'Curso masivo abierto en línea (MOOC)' ? 'selected' : ''}}>curso masivo abierto en línea (MOOC)</option>
                                                <option value="Eventos académicos relacionados con la carrera" {{ $actividades->categoria == 'Eventos académicos relacionados con la carrera' ? 'selected' : ''}}>Eventos académicos relacionados con la carrera</option>
                                                <option value="Evento Nacional Estudiantil de Innovación y Tecnología (ENEIT)" {{ $actividades->categoria == 'Evento Nacional Estudiantil de Innovación y Tecnología (ENEIT)' ? 'selected' : ''}}>Evento Nacional Estudiantil de Innovación y Tecnología (ENEIT)</option>
                                          </select>
                                        </div>
                                        <div class="row-start-2 col-start-1 col-span-4 mb-6">
                                          <x-label for="descripcion" :value="_('Descripcion de actividad')"/>
                                          <textarea class="block w-full h-full px-4 py-3 pr-8 leading-tight border-gray-200 rounded appearance-none focus:outline-none focus:border-gray-500" name="descripcion" maxlength="255" required>{{$actividades->descripcion}}</textarea>
                                        </div>
                                        <div class="row-start-3 col-start-1 col-span-2">
                                          <x-label for="lugar" :value="_('Lugar')"></x-label>
                                          <x-input class="block mt-1 w-full text-center" type="text" name="lugar" placeholder="-- Aula --" value="{{$actividades->lugar}}" maxlength="100" required/>
                                        </div>
                                        <div class="row-start-3 col-start-3 col-span-2">
                                          <x-label for="horas" :value="_('Horas semanales')"></x-label>
                                          <x-input class="block mt-1 w-full text-right" type="text" name="horas" value="{{$actividades->horas}}" maxlength="2" required/>
                                        </div>
                                        <div class="row-start-4 col-start-1 col-span-4">
                                          <x-label for="prestador" :value="_('Encargado de actividad')"/>
                                          <select name="prestador" class="form-select block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" required>
                                            <option value="">-- Selecciona encargado de actividad --</option>
                                            @foreach ($prestadores as $item)
                                            <option value="{{$item->id}}" {{$actividades->prestador == $item->id ? 'selected' : ''}} >{{$item->name}} ({{$item->tipo}})</option>  
                                            @endforeach
                                          </select>
                                        </div>
                                        <div class="row-start-5 col-start-4 mt-10">
                                          <button type="submit" class="shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500 p-2 w-full">Editar actividad</button>
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