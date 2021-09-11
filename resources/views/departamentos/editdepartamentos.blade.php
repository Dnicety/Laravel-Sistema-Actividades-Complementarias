<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar departamento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <form action="{{ route('departamentos.update', $departamento->id) }}" method="POST">
                                @csrf
                                {{ method_field('PATCH') }}
                                <div class="grid grid-cols-4 grid-rows-none gap-4">
                                    <div class="row-start-1 col-start-1 col-span-2">
                                        <x-label for="departamento" :value="_('Nombre del departamento')"></x-label>
                                        <x-input class="block mt-1 w-full" type="text" name="departamento" placeholder="Nombre del departamento" autofocus required value="{{$departamento->departamento}}"/>
                                    </div>
                                    <div class="row-start-1 col-start-3 col-span-2">
                                        <x-label for="abr" :value="_('Abreviacion del departamento')"></x-label>
                                        <x-input class="block mt-1 w-full" type="text" name="abr" placeholder="Abreviacion del departamento" onkeyup="this.value = this.value.toUpperCase();" required value="{{$departamento->abr}}"/>
                                    </div>
                                    <div class="row-start-2 col-start-4">
                                        <button type="submit" class="shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500 p-2 w-full">Editar departamento</button>
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