<x-auth-validation-errors :errors="$errors"/>
<x-auth-validation-success/>
<x-app-layout>
    <x-slot name="header">
      @switch(Auth::user()->tipo)
                @case('ADMIN')
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                  {{ __('Editar usuario') }}
                </h2>
                    @break
                @case('JEFEDEPTO')
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                  {{ __('Editar prestador') }}
                </h2>
                    @break            
            @endswitch
        <h2 class="text-blue-700 text-lg font-mono"> {{ $usuarios->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            
                              
                                <form action=" {{ route('usuarios.update', $usuarios->id) }}" method="POST">
                                    @csrf
                                    {{ method_field('PATCH') }}

                                    <div class="grid grid-flow-row grid-rows-6 grid-cols-3 gap-4">
                                        <div class="col-span-2">
                                            <x-label for="name" :value="_('Nombre Completo')"></x-label>
                                            <x-input class="block mt-1 w-full" type="text" name="name" autofocus value="{{$usuarios->name}}" required maxlength="255" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ. ]{1,255}"/>
                                        </div>
                                        <div>
                                            <x-label for="tipo" :value="_('Tipo de usuario')"/>
                                            <select name="tipo" class="form-select block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" required>
                                                @switch(Auth::user()->tipo)
                                                    @case('ADMIN')
                                                    <option value=""> -- Selecciona tipo de usuario -- </option>
                                                    <option value="PRESTADOR" {{ $usuarios->tipo == 'PRESTADOR' ? 'selected' : ''}} >Prestador</option>
                                                    <option value="Servicios escolares" {{ $usuarios->tipo == 'Servicios escolares' ? 'selected' : ''}}>Servicios escolares</option>
                                                    <option value="División de estudios" {{ $usuarios->tipo == 'División de estudios' ? 'selected' : ''}}>División de estudios</option>
                                                    <option value="JEFEDEPTO" {{ $usuarios->tipo == 'JEFEDEPTO' ? 'selected' : ''}}>Jefe de departamento</option>
                                                        @break
                                                    @case('JEFEDEPTO')
                                                    <option value="PRESTADOR" {{ $usuarios->tipo == 'PRESTADOR' ? 'selected' : ''}} >Prestador</option>
                                                        @break
                                                @endswitch
                                            </select>
                                        </div>
                                        <div class="row-start-3 col-start-1 col-span-2">
                                            <x-label for="telefono" :value="_('Telefono de contacto')"></x-label>
                                            <x-input class="block mt-1 w-full" type="text" name="telefono" maxlength="13" pattern="[A-Za-z0-9. ]{}" value="{{$usuarios->telefono}}" required/>
                                        </div>
                                        <div class="row-start-3 col-start-3">
                                            <x-label for="sexo" :value="_('Sexo')"></x-label>
                                            <select name="sexo" class="form-select block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" required>
                                                <option value=""> -- Seleccionar sexo del usuario -- </option>
                                                <option value="H" {{$usuarios->sexo == 'H' ? 'selected' : ''}}>Hombre</option>
                                                <option value="M" {{$usuarios->sexo == 'M' ? 'selected' : ''}}>Mujer</option>
                                            </select>
                                        </div>
                                        <div class="row-start-4 col-start-1 flex flex-grow self-center">
                                          <x-label class="mr-4" for="docente" :value="_('¿El prestador es docente?')"></x-label>
                                          <x-label class="mr-2" :value="_('Si')"/><input type="checkbox" {{$usuarios->docente == 'SI' ? 'checked' : ''}} name="docente" value="SI" />
                                        </div>
                                        <div class="row-start-5 col-span-2">
                                            <x-label for="email" :value="_('Correo Electronico')"></x-label>
                                            <x-input class="block mt-1 w-full" type="email" name="email" value="{{$usuarios->email}}" required/>
                                        </div>
                                        
                                        <div class="row-start-2 col-span-2">
                                            <x-label for="institucion" :value="_('Institucion educativa')"/>
                                            <x-input class="block mt-1 w-full" type="text" name="institucion" value="{{$usuarios->institucion}}" required maxlength="255" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,255}"/>
                                        </div>
                                        <div class="row-start-2">
                                            <x-label for="departamento" :value="_('Departamento')"/>
                                            <select name="departamento" class="block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" required>
                                                @switch(Auth::user()->tipo)
                                                    @case('ADMIN')
                                                    <option value=""> -- Selecciona un departamento -- </option>
                                                    @foreach ($departamentos as $item)
                                                    <option value="{{$item->departamento}}" {{ $usuarios->departamento == $item->departamento ? 'selected' : ''}}>{{$item->departamento}} ({{$item->abr}})</option>    
                                                    @endforeach
                                                        @break
                                                    @case('JEFEDEPTO')
                                                    <option value="{{$usuarios->departamento}}" {{ $usuarios->departamento == 'Sistemas computacionales' ? 'selected' : ''}}>{{$usuarios->departamento}}</option>
                                                        @break
                                                @endswitch
                                            </select>
                                        </div>
                                        <div class="row-start-5 col-start-3">
                                            <x-label for="departamento" :value="_('Cambiar contrase;a')"/>
                                            <button id="create" class="botonn modal-open group shadow-md border border-gray-300 bg-red-400 text-gray-600 text-sm px-4 py-2 hover:text-white w-full" type="button">
                                                Cambio de contraseña
                                            </button>
                                        </div>
                                        <div class="row-start-6 col-start-3 flex items-center">
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

<div class="modal-create opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
      <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
        <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
          <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
        </svg>
        <span class="text-sm">(Esc)</span>
      </div>
      <!-- Add margin if you want to see some of the overlay behind the modal-->
      <div class="modal-content py-4 text-left px-6">
        <!--Title-->
        <div class="flex justify-between items-center pb-3">
          <p class="text-2xl font-bold">Cambio de contraseña</p>
          <div class="modal-close cursor-pointer z-50">
            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
              <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
          </div>
        </div>
        <!--Body-->
        <form class="m-3.5" action="{{ route('passwordedit', $usuarios->id) }}" method="POST">
          @csrf
          {{ method_field('PATCH') }}
          <x-label class="mt-4" for="passwordold" :value="_('Contraseña anterior')"/>
          <x-input class="block mt-1 w-full" type="password" name="passwordold" autofocus required maxlength="255"/>
          <x-label class="mt-4" for="passwordnew" :value="_('Contraseña nueva')"/>
          <x-input class="block mt-1 w-full" type="password" name="passwordnew" required maxlength="255"/>
          <button type="submit" class="shadow-md border border-gray-300 text-gray-600 text-sm px-4 py-2 hover:text-blue-500 p-2 w-full mt-10">Cambiar</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    var modal;
    // Deteccion de boton pulsado
    var botones = document.getElementsByClassName("botonn");
    for(var i = 0; i < botones.length; i++) {
        botones[i].addEventListener('click', comprueba, false);
    }
    function comprueba(){
      switch(this.id){
        case "create":
          modal = document.querySelector('.modal-create')
          break;
      }
    }
  
    // Modal
    var openmodal = document.querySelectorAll('.modal-open')
    for (var i = 0; i < openmodal.length; i++) {
      openmodal[i].addEventListener('click', function(event){
      event.preventDefault()
      toggleModal()
      })
    }
    
    const overlay = document.querySelector('.modal-overlay')
    overlay.addEventListener('click', toggleModal)
    
    var closemodal = document.querySelectorAll('.modal-close')
    for (var i = 0; i < closemodal.length; i++) {
      closemodal[i].addEventListener('click', toggleModal)
    }
    
    document.onkeydown = function(evt) {
      evt = evt || window.event
      var isEscape = false
      if ("key" in evt) {
      isEscape = (evt.key === "Escape" || evt.key === "Esc")
      } else {
      isEscape = (evt.keyCode === 27)
      }
      if (isEscape && document.body.classList.contains('modal-active')) {
      toggleModal()
      }
    };
    
    function toggleModal () {
      const body = document.querySelector('body')
      modal.classList.toggle('opacity-0')
      modal.classList.toggle('pointer-events-none')
      body.classList.toggle('modal-active')
    }
  </script>