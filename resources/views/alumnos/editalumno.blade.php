<x-auth-validation-errors :errors="$errors"/>
<x-auth-validation-success/>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar alumno') }}
        </h2>
        <h2 class="text-blue-700 text-lg font-mono"> {{ $alumno->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            
                              
                                <form action=" {{ route('alumnos.update', $alumno->noControl) }}" method="POST">
                                    @csrf
                                    {{ method_field('PATCH') }}
                                    <div class="grid grid-flow-row grid-rows-6 grid-cols-3 gap-4">
                                        <div class="col-span-2 row-start-1">
                                            <x-label for="nombre" :value="_('Nombre Completo')"></x-label>
                                            <x-input class="block mt-1 w-full" type="text" name="nombre" autofocus value="{{$alumno->nombre}}" required/>
                                        </div>
                                        <div class="col-start-3 row-start-1">
                                            <x-label for="sexo" :value="_('Sexo')"></x-label>
                                            <select name="sexo" class="form-select block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" required>
                                                <option value=""> -- Seleccionar sexo del usuario -- </option>
                                                <option value="H" {{$alumno->sexo == 'H' ? 'selected' : ''}}>Hombre</option>
                                                <option value="M" {{$alumno->sexo == 'M' ? 'selected' : ''}}>Mujer</option>
                                            </select>
                                        </div>
                                        <div class="col-start-1 row-start-2 col-span-2">
                                            <x-label for="email" :value="_('Correo Electronico')"></x-label>
                                            <x-input class="block mt-1 w-full" type="email" name="email" value="{{$alumno->email}}" required/>
                                        </div>
                                        <div class="col-start-3 row-start-2">
                                            <x-label for="carrera" :value="_('Carrera')"></x-label>
                                            <select name="carrera" class="form-select block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" required>
                                                <option value=""> -- Selecciona un departamento -- </option>
                                                <option value="ISC" {{$alumno->carrera == 'ISC' ? 'selected' : ''}}>Ingenieria en sistemas computacionales</option>
                                                <option value="ITIC" {{$alumno->carrera == 'ITIC' ? 'selected' : ''}}>Ingenieria en tecnologias de la informacion y comunicacion</option>
                                                <option value="IM" {{$alumno->carrera == 'IM' ? 'selected' : ''}}>Ingenieria en mecatronica</option>
                                                <option value="IME" {{$alumno->carrera == 'IME' ? 'selected' : ''}}>Ingenieria mecanica</option>
                                                <option value="IE" {{$alumno->carrera == 'IE' ? 'selected' : ''}}>Ingenieria en electronica</option>
                                                <option value="II" {{$alumno->carrera == 'II' ? 'selected' : ''}}>Ingenieria industrial</option>
                                                <option value="IGE" {{$alumno->carrera == 'IGE' ? 'selected' : ''}}>Ingenieria en gestion empresarial</option>
                                                <option value="CP" {{$alumno->carrera == 'CP' ? 'selected' : ''}}>Contador publico</option>
                                            </select>
                                        </div>
                                        <div class="col-start-1 row-start-3 col-span-2">
                                            <x-label for="nip" :value="_('NIP')"></x-label>
                                            <x-input class="block mt-1 w-full" type="password" name="nip" value="{{$alumno->nip}}" required pattern="[0-9]{8}"/>
                                        </div>
                                        <div class="row-start-5 col-start-3 flex items-center">
                                            <button type="submit" class="shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500 w-full">Editar usuario</button>
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