<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @switch(Auth::user()->tipo)
                @case('ADMIN')
                {{ __('Nuevo usuario') }}
                    @break
                @case('JEFEDEPTO')
                {{ __('Nuevo prestador') }}
                    @break            
            @endswitch
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">                    

                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            
                                @switch(Auth::user()->tipo)
                                    @case('ADMIN')
                                    <form action=" {{ route('usuarios.store') }}" method="POST">
                                        @csrf
                                        <div class="grid grid-flow-row grid-rows-6 grid-cols-3 gap-4">
                                            <div class="col-span-2">
                                                <x-label for="name" :value="_('Nombre Completo')"></x-label>
                                                <x-input class="block mt-1 w-full" type="text" name="name" autofocus required placeholder="Nombre completo" maxlength="255" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ. ]{1,255}"/>
                                            </div>
                                            <div>
                                                <x-label for="tipo" :value="_('Tipo de usuario')"/>
                                                <select name="tipo" class="form-select block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" required>
                                                    <option value=""> -- Selecciona tipo de usuario -- </option>
                                                    <option value="PRESTADOR">Prestador</option>
                                                    <option value="Servicios escolares">Servicios escolares</option>
                                                    <option value="JEFEDEPTO">Jefe de departamento</option>
                                                </select>
                                            </div>
                                            <div class="row-start-2 col-start-3">
                                                <x-label for="departamento" :value="_('Departamento')"/>
                                                <select name="departamento" class="form-select block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" required>
                                                    <option value=""> -- Selecciona un departamento -- </option>
                                                    @foreach ($departamentos as $item)
                                                    <option value="{{$item->departamento}}">{{$item->departamento}} ({{$item->abr}})</option>    
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="row-start-3 col-start-1 col-span-2">
                                                <x-label for="telefono" :value="_('Telefono de contacto')"></x-label>
                                                <x-input class="block mt-1 w-full" type="text" name="telefono" maxlength="13" pattern="[A-Za-z0-9. ]{}" required placeholder="878 123 4567"/>
                                            </div>
                                            <div class="row-start-3 col-start-3">
                                                <x-label for="sexo" :value="_('Sexo')"></x-label>
                                                <select name="sexo" class="form-select block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" required>
                                                    <option value=""> -- Seleccionar sexo del usuario -- </option>
                                                    <option value="H">Hombre</option>
                                                    <option value="M">Mujer</option>
                                                </select>
                                            </div>
                                            <div class="row-start-4 col-start-1 flex flex-grow self-center">
                                                <x-label class="mr-4" for="docente" :value="_('¿El prestador es docente?')"></x-label>
                                                <x-label class="mr-2" :value="_('Si')"/><x-input type="checkbox" name="docente" value="SI"/>
                                            </div>
                                            <div class="row-start-5 col-span-2">
                                                <x-label for="email" :value="_('Correo Electronico')"></x-label>
                                                <x-input class="block mt-1 w-full" type="email" name="email" required placeholder="Utilizar correo institucional (@piedrasnegras.tecnm.mx)"/>
                                            </div>
                                            <div class="row-start-5">
                                                <x-label for="password" :value="_('Contraseña')"></x-label>
                                                <x-input class="block mt-1 w-full" type="password" name="password" maxlength="255" required/>
                                            </div>
                                            <div class="row-start-2 col-start-1 col-span-2">
                                                <x-label for="institucion" :value="_('Institucion educativa')"/>
                                                <x-input class="block mt-1 w-full" type="text" name="institucion" required value="Instituto Tecnologico de Piedras Negras" maxlength="255" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ. ]{1,255}"/>
                                            </div>
                                            <div class="row-start-6 col-start-3 flex items-center">
                                                <button type="submit" class="shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500 w-full">Crear usuario</button>
                                            </div>
                                        </div>
                                    </form>
                                        @break
                                    @case('JEFEDEPTO')
                                    <form action=" {{ route('usuarios.store') }}" method="POST">
                                        @csrf
                                        <div class="grid grid-flow-row grid-rows-6 grid-cols-3 gap-4">
                                            <div class="col-span-2">
                                                <x-label for="name" :value="_('Nombre Completo')"></x-label>
                                                <x-input class="block mt-1 w-full" type="text" name="name" autofocus required placeholder="Nombre completo" maxlength="255" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,255}"/>
                                            </div>
                                            <div>
                                                <x-label for="tipo" :value="_('Tipo de usuario')"/>
                                                <select name="tipo" class="form-select block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" required>
                                                    <option value="PRESTADOR" selected>Prestador</option>
                                                </select>
                                            </div>
                                            <div class="row-start-2 col-start-3">
                                                <x-label for="departamento" :value="_('Departamento')"/>
                                                <select name="departamento" class="form-select block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" required>
                                                    <option value="{{Auth::user()->departamento}}">{{Auth::user()->departamento}}</option>    
                                                </select>
                                            </div>
                                            <div class="row-start-3 col-start-1 col-span-2">
                                                <x-label for="telefono" :value="_('Telefono de contacto')"></x-label>
                                                <x-input class="block mt-1 w-full" type="text" name="telefono" maxlength="13" pattern="[A-Za-z0-9. ]{}" required placeholder="878 123 4567"/>
                                            </div>
                                            <div class="row-start-3 col-start-3">
                                                <x-label for="sexo" :value="_('Sexo')"></x-label>
                                                <select name="sexo" class="form-select block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" required>
                                                    <option value=""> -- Seleccionar sexo del usuario -- </option>
                                                    <option value="H">Hombre</option>
                                                    <option value="M">Mujer</option>
                                                </select>
                                            </div>
                                            <div class="row-start-4 col-start-1 flex flex-grow self-center">
                                                <x-label class="mr-4" for="docente" :value="_('¿El prestador es docente?')"></x-label>
                                                <x-label class="mr-2" :value="_('Si')"/><x-input type="checkbox" name="docente" value="SI"/>
                                            </div>
                                            <div class="row-start-5 col-span-2">
                                                <x-label for="email" :value="_('Correo Electronico')"></x-label>
                                                <x-input class="block mt-1 w-full" type="email" name="email" required placeholder="Utilizar correo institucional (@piedrasnegras.tecnm.mx)"/>
                                            </div>
                                            <div class="row-start-5">
                                                <x-label for="password" :value="_('Contraseña')"></x-label>
                                                <x-input class="block mt-1 w-full" type="password" name="password" maxlength="255" required/>
                                            </div>
                                            <div class="row-start-2 col-start-1 col-span-2">
                                                <x-label for="institucion" :value="_('Institucion educativa')"/>
                                                <x-input class="block mt-1 w-full" type="text" name="institucion" required value="Instituto Tecnologico de Piedras Negras" maxlength="255" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,255}"/>
                                            </div>
                                            <div class="row-start-6 col-start-3 flex items-center">
                                                <button type="submit" class="shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500 w-full">Crear usuario</button>
                                            </div>
                                        </div>
                                    </form>
                                        @break
                                    @default
                                        
                                @endswitch         

                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>