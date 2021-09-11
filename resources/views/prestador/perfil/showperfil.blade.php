<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <div class="h-full">
                        <div class="border-b-2 block md:flex">
                          <div class="w-full md:w-2/5 p-4 sm:p-6 lg:p-8 bg-white shadow-md">
                            <div class="flex justify-between">
                              <span class="text-xl font-semibold block">Perfil: {{Auth::user()->tipo}}</span>
                              <a href="#" class="-mt-2 text-md font-bold text-white bg-gray-700 rounded-full px-5 py-2 hover:bg-gray-800">Edit</a>
                            </div>
                            <span class="text-gray-600">This information is secret so be careful</span>
                          </div>
                          <div class="w-full md:w-3/5 p-8 bg-white lg:ml-4 shadow-md">
                            <div class="rounded  shadow p-6">
                              <div class="pb-6">
                                <label for="name" class="font-semibold text-gray-700 block pb-1">Nombre Completo</label>
                                <div class="flex">
                                  <input disabled id="username" class="border-1  rounded-r px-4 py-2 w-full" type="text" value="{{Auth::user()->name}}" />
                                </div>
                              </div>
                              <div class="pb-4">
                                <label for="about" class="font-semibold text-gray-700 block pb-1">Departamento</label>
                                <input disabled id="email" class="border-1  rounded-r px-4 py-2 w-full" type="email" value="{{Auth::user()->departamento}}" />
                              </div>
                              <div class="pb-4">
                                <label for="about" class="font-semibold text-gray-700 block pb-1">Correo Electronico</label>
                                <input disabled id="email" class="border-1  rounded-r px-4 py-2 w-full" type="email" value="{{Auth::user()->email}}" />
                              </div>
                              <div class="pb-4">
                                <label for="about" class="font-semibold text-gray-700 block pb-1">Telefono</label>
                                <input disabled id="email" class="border-1  rounded-r px-4 py-2 w-full" type="email" value="{{Auth::user()->telefono}}" />
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