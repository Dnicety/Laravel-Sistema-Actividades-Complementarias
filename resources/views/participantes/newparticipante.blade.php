<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar participantes a: ')}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="flex flex-row">
                        <a href="javascript:history.back()">
                            <button class="rounded-md bg-light-blue-100 text-light-blue-600 text-sm font-medium group flex items-center px-4 py-4" type="button">
                              <- Atras
                            </button>
                          </a>
                    </div>

                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            
                                <form action="" method="POST">
                                    @csrf
                                    <div class="grid grid-cols-3 grid-rows-2 gap-4">
                                        
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