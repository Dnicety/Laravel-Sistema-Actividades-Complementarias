<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Configurar formato de constancia') }}
        </h2>
    </x-slot>

    <div class="bg-gray-50 h-screen sm:p-5">
        <div class="bg-white border border-gray-200 rounded flex h-full">
          <!-- Left -->
          <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 h-full">
            <div  class="p-6">
              <ul class="flex border-b">
                <li class="mr-1">
                  <button :class="openTab === 2 ? 'border-l border-t border-r rounded-t text-blue-700' : 'text-blue-500 hover:text-blue-800'" class="bg-white inline-block py-2 px-4 font-semibold">Elementos del documento</button>
                </li>
              </ul>
              <div class="w-full pt-4">
                <div>
                  @if (isset($documento))
                    <form action="{{route('documento.update', 1)}}" method="POST">
                      @csrf
                      {{ method_field('PATCH') }}
                      <x-label class="mt-4" for="header" :value="_('Encabezado')"></x-label>
                      <x-input class="block mt-1 w-full" type="text" name="header" placeholder="URL del encabezado" autofocus value="{{$documento->imgheader}}"/>
                      <x-label class="mt-4" for="frase" :value="_('Frase de encabezado')"></x-label>
                      <x-input class="block mt-1 w-full" type="text" name="frase" placeholder="Ej: 2020 año de Leona Vicario" autofocus value="{{$documento->frase}}"/>
                      <x-label class="mt-4" for="body" :value="_('Cuerpo')"></x-label>
                      <x-input class="block mt-1 w-full" type="text" name="body" placeholder="URL del cuerpo" autofocus value="{{$documento->imgbody}}"/>
                      <x-label class="mt-4" for="footer" :value="_('Pie de pagina')"></x-label>
                      <x-input class="block mt-1 w-full" type="text" name="footer" placeholder="URL del pie de pagina" autofocus value="{{$documento->imgfooter}}"/>
                      <x-label class="mt-4" for="fonturl" :value="_('URL de la Fuente')"></x-label>
                      <x-input class="block mt-1 w-full" type="text" name="fonturl" placeholder="URL de la fuente" autofocus value="{{$documento->fonturl}}"/>
                      <x-label class="mt-4" for="font" :value="_('Fuente')"></x-label>
                      <x-input class="block mt-1 w-full" type="text" name="font" placeholder="Fuente" autofocus value="{{$documento->font}}"/>
                      <button type="submit" class="shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500 w-full mt-10">Realizar cambios a formato </button>
                    </form>
                  @else
                    <form  action="{{route('documento.store')}}" method="POST">
                      @csrf
                      <x-label class="mt-4" for="head" :value="_('Encabezado')"></x-label>
                      <x-input class="block mt-1 w-full" type="text" name="header" placeholder="URL del encabezado" autofocus/>
                      <x-label class="mt-4" for="frase" :value="_('Frase de encabezado')"></x-label>
                      <x-input class="block mt-1 w-full" type="text" name="frase" placeholder="Ej: 2020 año de Leona Vicario" autofocus/>
                      <x-label class="mt-4" for="body" :value="_('Cuerpo')"></x-label>
                      <x-input class="block mt-1 w-full" type="text" name="body" placeholder="URL del cuerpo" autofocus/>
                      <x-label class="mt-4" for="footer" :value="_('Pie de pagina')"></x-label>
                      <x-input class="block mt-1 w-full" type="text" name="footer" placeholder="URL del pie de pagina" autofocus/>
                      <x-label class="mt-4" for="fonturl" :value="_('URL de la Fuente')"></x-label>
                      <x-input class="block mt-1 w-full" type="text" name="fonturl" placeholder="URL de la fuente" autofocus/>
                      <x-label class="mt-4" for="font" :value="_('Fuente')"></x-label>
                      <x-input class="block mt-1 w-full" type="text" name="font" placeholder="Fuente" autofocus/>
                      <button type="submit" class="shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500 w-full mt-10">Realizar cambios a formato</button>
                    </form>
                  @endif
                </div>
              </div>
            </div>
          </div>
          <!-- Right -->
          <div class="hidden sm:w-1/2 md:w-2/3 lg:w-3/4 border-l border-gray-200 sm:flex justify-center text-center">
            <div class="space-y-5 w-5/6 h-full">
              <iframe class="w-full h-full py-6" src="{{ route('showFormato') }}"></iframe>
            </div>
          </div>
        </div>
      </div>

</x-app-layout>