<x-app-layout>
    <x-slot name="header">
      <div class="flex">
        <div class="flex-initial"><a class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-white hover:border-gray-500 hover:text-gray-500" href="javascript:history.back()"><- Volver</a></div>
        <div class="flex-initial ml-4"><h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Evaluacion') }}</h2></div>
      </div>
    </x-slot>

    <div class="py-12 items-center justify-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="grid grid-cols-3 grid-row-2">
                        <div class="col-start-2 pb-2">
                            <h1 class="text-lg text-center">Instituto Tecnologico de Piedras Negras</h1>
                            <h3 class="text-sm text-center">Subdireccion de planeacion y vinculacion</h3>
                        </div>
                        <div class="col-start-2 row-start-2">
                            <h1 class="text-md text-center">Departamento de actividades extraescolares</h1>
                            <h3 class="text-sm text-center">Oficina de Promocion Cultural o Deportiva</h3>
                        </div>
                    </div>

                    <Form id="myForm" action=" {{ route('evaluaciones.store') }}" method="POST">
                        @foreach ($alumno as $al)                        
                        @csrf
                        <div class="flex pt-4">
                            <div class="flex-initial self-center w-2/6"><p>Nombre del estudiante(1): </p></div>
                            <div class="flex-initial w-4/6"><x-input class="block mt-1 w-full" type="text" name="noControl" autofocus value="{{ $al->noControl }}" readonly/></div>
                        </div>
                        <div class="flex pt-4">
                            <div class="flex-initial self-center w-2/12"><p>Actividad Cultural y/o Deportiva(2): </p></div>
                            <div class="flex-initial w-8/12"><x-input class="block mt-1 w-full" type="text" name="nombre" value="{{ $al->nombre }}" readonly/></div>
                                <div class="flex-initial self-center w-1/12 text-right pr-4"><p>Id: </p></div>
                            <div class="flex-initial w-1/12"><x-input class="block mt-1 w-full" type="text" name="idAct" value="{{ $al->idAct }}" readonly/></div>
                        </div>
                        <div class="flex pt-4">
                            <div class="flex-initial self-center w-2/12"><p>Periodo de realizacion(3): </p></div>
                            <div class="flex-initial w-4/12"><x-input class="block mt-1 w-full" type="text" name="periodo" value="{{ $al->periodo }}" readonly/></div>
                            <div class="flex-initial self-center w-2/12 text-right pr-4"><p>Año de realizacion: </p></div>
                            <div class="flex-initial w-4/12"><x-input class="block mt-1 w-full" type="text" name="year" value="{{$al->year }}" readonly/></div>
                        </div>
                        
                        <div class="flex mt-10">
                            <div class="flex-initial w-1/12"><p>No.</p></div>
                            <div class="flex-initial w-4/12"><p>Criterios a evaluar</p></div>
                            <div class="flex-initial w-7/12">
                                <div class="flex justify-between text-center">
                                    <div class="flex-1">Insuficiente</div>
                                    <div class="flex-1">Suficiente</div>
                                    <div class="flex-1">Bueno</div>
                                    <div class="flex-1">Notable</div>
                                    <div class="flex-1">Excelente</div>
                                </div>
                            </div>
                        </div>
                        <div class="flex my-6">
                            <div class="flex-initial w-1/12"><p>1</p></div>
                            <div class="flex-initial w-4/12"><p>Cumple en tiempo y forma con las actividades encomendadas alcanzando los objetivos.</p></div>
                            <div class="flex-initial w-7/12">
                                <div class="flex justify-between text-center">
                                    <div class="flex-1"><input id="criterio1" name="criterio1" type="radio" class="form-radio h-5 w-5 text-gray-600" value="0" required></div>
                                    <div class="flex-1"><input id="criterio1" name="criterio1" type="radio" class="form-radio h-5 w-5 text-gray-600" value="1"></div>
                                    <div class="flex-1"><input id="criterio1" name="criterio1" type="radio" class="form-radio h-5 w-5 text-gray-600" value="2"></div>
                                    <div class="flex-1"><input id="criterio1" name="criterio1" type="radio" class="form-radio h-5 w-5 text-gray-600" value="3"></div>
                                    <div class="flex-1"><input id="criterio1" name="criterio1" type="radio" class="form-radio h-5 w-5 text-gray-600" value="4"></div>
                                </div>
                            </div>
                        </div>
                        <div class="flex my-6">
                            <div class="flex-initial w-1/12"><p>2</p></div>
                            <div class="flex-initial w-4/12"><p>Trabaja en equipo y se adapta a nuevas situaciones.</p></div>
                            <div class="flex-initial w-7/12">
                                <div class="flex justify-between text-center">
                                    <div class="flex-1"><input name="criterio2" type="radio" class="form-radio h-5 w-5 text-gray-600" value="0" required></div>
                                    <div class="flex-1"><input name="criterio2" type="radio" class="form-radio h-5 w-5 text-gray-600" value="1"></div>
                                    <div class="flex-1"><input name="criterio2" type="radio" class="form-radio h-5 w-5 text-gray-600" value="2"></div>
                                    <div class="flex-1"><input name="criterio2" type="radio" class="form-radio h-5 w-5 text-gray-600" value="3"></div>
                                    <div class="flex-1"><input name="criterio2" type="radio" class="form-radio h-5 w-5 text-gray-600" value="4"></div>
                                </div>
                            </div>
                        </div>
                        <div class="flex my-6">
                            <div class="flex-initial w-1/12"><p>3</p></div>
                            <div class="flex-initial w-4/12"><p>Muestra liderazgo en las actividades encomendadas.</p></div>
                            <div class="flex-initial w-7/12">
                                <div class="flex justify-between text-center">
                                    <div class="flex-1"><input name="criterio3" type="radio" class="form-radio h-5 w-5 text-gray-600" value="0" required></div>
                                    <div class="flex-1"><input name="criterio3" type="radio" class="form-radio h-5 w-5 text-gray-600" value="1"></div>
                                    <div class="flex-1"><input name="criterio3" type="radio" class="form-radio h-5 w-5 text-gray-600" value="2"></div>
                                    <div class="flex-1"><input name="criterio3" type="radio" class="form-radio h-5 w-5 text-gray-600" value="3"></div>
                                    <div class="flex-1"><input name="criterio3" type="radio" class="form-radio h-5 w-5 text-gray-600" value="4"></div>
                                </div>
                            </div>
                        </div>
                        <div class="flex my-6">
                            <div class="flex-initial w-1/12"><p>4</p></div>
                            <div class="flex-initial w-4/12"><p>Organiza su tiempo y trabaja de manera proactiva.</p></div>
                            <div class="flex-initial w-7/12">
                                <div class="flex justify-between text-center">
                                    <div class="flex-1"><input name="criterio4" type="radio" class="form-radio h-5 w-5 text-gray-600" value="0" required></div>
                                    <div class="flex-1"><input name="criterio4" type="radio" class="form-radio h-5 w-5 text-gray-600" value="1"></div>
                                    <div class="flex-1"><input name="criterio4" type="radio" class="form-radio h-5 w-5 text-gray-600" value="2"></div>
                                    <div class="flex-1"><input name="criterio4" type="radio" class="form-radio h-5 w-5 text-gray-600" value="3"></div>
                                    <div class="flex-1"><input name="criterio4" type="radio" class="form-radio h-5 w-5 text-gray-600" value="4"></div>
                                </div>
                            </div>
                        </div>
                        <div class="flex my-6">
                            <div class="flex-initial w-1/12"><p>5</p></div>
                            <div class="flex-initial w-4/12"><p>Interpreta la realidad y se sensibiliza aportando soluciones a la problematica con la actividad Cultural y/o Deportiva.</p></div>
                            <div class="flex-initial w-7/12">
                                <div class="flex justify-between text-center">
                                    <div class="flex-1"><input name="criterio5" type="radio" class="form-radio h-5 w-5 text-gray-600" value="0" required></div>
                                    <div class="flex-1"><input name="criterio5" type="radio" class="form-radio h-5 w-5 text-gray-600" value="1"></div>
                                    <div class="flex-1"><input name="criterio5" type="radio" class="form-radio h-5 w-5 text-gray-600" value="2"></div>
                                    <div class="flex-1"><input name="criterio5" type="radio" class="form-radio h-5 w-5 text-gray-600" value="3"></div>
                                    <div class="flex-1"><input name="criterio5" type="radio" class="form-radio h-5 w-5 text-gray-600" value="4"></div>
                                </div>
                            </div>
                        </div>
                        <div class="flex my-6">
                            <div class="flex-initial w-1/12"><p>6</p></div>
                            <div class="flex-initial w-4/12"><p>Realiza sugerencias innovadoras para beneficio o mejora del programa en el que participa.</p></div>
                            <div class="flex-initial w-7/12">
                                <div class="flex justify-between text-center">
                                    <div class="flex-1"><input name="criterio6" type="radio" class="form-radio h-5 w-5 text-gray-600" value="0" required></div>
                                    <div class="flex-1"><input name="criterio6" type="radio" class="form-radio h-5 w-5 text-gray-600" value="1"></div>
                                    <div class="flex-1"><input name="criterio6" type="radio" class="form-radio h-5 w-5 text-gray-600" value="2"></div>
                                    <div class="flex-1"><input name="criterio6" type="radio" class="form-radio h-5 w-5 text-gray-600" value="3"></div>
                                    <div class="flex-1"><input name="criterio6" type="radio" class="form-radio h-5 w-5 text-gray-600" value="4"></div>
                                </div>
                            </div>
                        </div>
                        <div class="flex my-6">
                            <div class="flex-initial w-1/12"><p>7</p></div>
                            <div class="flex-initial w-4/12"><p>Tiene iniciativa para ayudar en las actividades encomendadas y muestra espiritu de servicio.</p></div>
                            <div class="flex-initial w-7/12">
                                <div class="flex justify-between text-center">
                                    <div class="flex-1"><input name="criterio7" type="radio" class="form-radio h-5 w-5 text-gray-600" value="0" required></div>
                                    <div class="flex-1"><input name="criterio7" type="radio" class="form-radio h-5 w-5 text-gray-600" value="1"></div>
                                    <div class="flex-1"><input name="criterio7" type="radio" class="form-radio h-5 w-5 text-gray-600" value="2"></div>
                                    <div class="flex-1"><input name="criterio7" type="radio" class="form-radio h-5 w-5 text-gray-600" value="3"></div>
                                    <div class="flex-1"><input name="criterio7" type="radio" class="form-radio h-5 w-5 text-gray-600" value="4"></div>
                                </div>
                            </div>
                        </div>
                        <div class="flex pt-4">
                            <div class="flex-initial self-center w-2/6"><p>Observaciones: </p></div>
                            <div class="flex-initial w-4/6">
                                <textarea class="block w-full h-full leading-tight border-gray-200 rounded appearance-none focus:outline-none focus:border-gray-500" name="observaciones" required></textarea>
                            </div>
                        </div>
                        <div class="flex pt-8">
                            <button type="submit" class="shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500 p-2 w-full">Realizar Evaluacion</button>
                        </div>
                    @endforeach
                    </Form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>