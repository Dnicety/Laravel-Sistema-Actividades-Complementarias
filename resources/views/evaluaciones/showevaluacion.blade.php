<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ver evaluacion') }}
        </h2>
    </x-slot>

    <div class="bg-gray-50 max-h-screen sm:p-5">
        <div class="bg-white border border-gray-200 rounded flex h-full">
          <!-- Left -->
          <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 h-full">
            <div class="border-b border-gray-200 p-3 relative">
              <p class="text-sm text-gray-500">Evaluacion de</p>
              <p> {{$alumno->nombre}}</p>
            </div>
            <ul class="py-3 px-3 overflow-auto">
              <li>
                <p class="text-md">Actividad: {{$actividad[0]->nombre}}</p>
                <p class="text-sm text-gray-500">{{$actividad[0]->periodo}}, {{$actividad[0]->year}}</p>
              </li>
            </ul>
            <div  class="p-6">
              <ul class="flex border-b">
                <li class="mr-1">
                  <button :class="openTab === 2 ? 'border-l border-t border-r rounded-t text-blue-700' : 'text-blue-500 hover:text-blue-800'" class="bg-white inline-block py-2 px-4 font-semibold">Escaneo de documento</button>
                </li>
              </ul>
              <div class="w-full pt-4">
                <div>
                  <h1>Pasos a seguir: </h1>
                  <ul>
                    <li>1) Descargar constancia de actividad</li>
                    <li>2) Imprimir constancia de actividad</li>
                    <li>3) Escanear constancia firmada y sellada correctamente</li>
                    <li class="text-sm text-red-400">Nota: Si se esacanea con dispositivo movil, la imagen debera ser legible</li>
                  </ul>
                  <a href="{{ route('exportConstancia', ['noControl' => $evaluacion[0]->noControl, 'idAct' => $evaluacion[0]->idAct, 'action' => 1]) }}"><button class="shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500 mt-4 w-full justify-center" type="button">Descargar constancia con formato</button></a>
                  <a href="{{ route('exportConstancia', ['noControl' => $evaluacion[0]->noControl, 'idAct' => $evaluacion[0]->idAct, 'action' => 4]) }}"><button class="shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500 mt-4 w-full justify-center" type="button">Descargar constancia sin formato</button></a>
                  <form class="mt-10 bg-gray-300 p-4 rounded-md" action="{{route('updateConstancia', ['idAct' => $evaluacion[0]->idAct, 'idEva' => $evaluacion[0]->idEvaluacion, 'noControl' => $evaluacion[0]->noControl])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PATCH') }}
                    <x-label class="mt-2" for="file" :value="_('Documento firmado')"></x-label>
                    <x-input class="block mt-1 w-full" type="file" name="file" required accept="image/*"/>
                    <button type="submit" class="shadow-md border border-gray-300 text-gray-600 text-sm bg-white hover:text-blue-500 mt-10 w-full p-2">Subir documento firmado </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Right -->
          <div class="hidden sm:w-1/2 md:w-2/3 lg:w-3/4 border-l border-gray-200 sm:flex justify-center text-center">
            <div class="space-y-5 w-5/6 h-full">
              <iframe class="w-full h-full py-6" src="{{ route('exportConstancia', ['noControl' => $alumno->noControl, 'idAct' => $evaluacion[0]->idAct, 'action' => 0]) }}"></iframe>
            </div>
          </div>
        </div>
      </div>

</x-app-layout>