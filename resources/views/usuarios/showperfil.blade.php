<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12  items-center justify-center">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div class="max-w-1xl bg-white w-full rounded-lg shadow-xl">
              <div class="p-4 border-b">
                <h2 class="text-2xl ">{{Auth::user()->name}}</h2>
                <p class="text-sm text-gray-500">{{Auth::user()->email}}</p>
              </div>
              <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-gray-600">Institucion educativa</p>
                <p>{{ Auth::user()->institucion }}</p>
              </div>
              <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-gray-600">Departamento</p>
                <p>{{ Auth::user()->departamento }}</p>
              </div>
              <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-gray-600">Telefono de contacto</p>
                <p>{{ Auth::user()->telefono }}</p>
              </div>
              <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-gray-600">Tipo de cuenta</p>
                <p>{{ Auth::user()->tipo }}</p>
              </div>
            </div>

            @if (Auth::user()->tipo == "DEPARTAMENTO")
            <div class="max-w-1xl bg-white w-full rounded-lg shadow-xl mt-10">
              <div class="md:grid md:grid-cols-2  hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-gray-600">Firma</p>
                @if (Auth::user()->firma)
                <div class="md:col-start-2 flex justify-center">
                  <img src="{{asset(Auth::user()->firma)}}" alt="" class="w-1/3">
                </div>
                <p class="text-gray-400 text-sm">Firma predeterminada para revision de constancias</p>
                @else
                <div class="md:col-start-2">
                  <form action="{{route('updateFirma', ['id' => Auth::user()->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PATCH') }}
                    <input class="w-full" type="file" name="file" required accept="image/*">
                    <button type="submit" class="shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500 mt-10 w-2/3 p-2">Subir firma</button>
                  </form>
                </div>
                <p class="text-gray-400 text-sm">Asignar firma predeterminada para revision de constancias</p>
                @endif
              </div>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
</x-app-layout>