<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img class="h-20 w-20" src="https://universidadesdemexico.mx/logos/original/logo-instituto-tecnologico-de-piedras-negras.png"/>
            </a>
        </x-slot>

        
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div x-data="{ isShowing: true }">
            <div class="static">
                <div class="absolute bottom-0 right-0 mb-10 mr-10">
                    <button  x-on:click="isShowing = !isShowing" class="flex shadow-md border border-gray-300 px-4 py-4" type="button">
                        <img src="{{asset('images/user.svg')}}" width="20" height="20" alt="Exportar pdf">
                        <p class="ml-4">Consultar creditos</p>
                    </button>
                </div>
            </div>
            <div x-show="isShowing">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
        
                    <!-- Email Address -->
                    <div>
                        <x-label for="email" :value="__('Correo Electronico')" />
        
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    </div>
        
                    <!-- Password -->
                    <div class="mt-4">
                        <x-label for="password" :value="__('Contraseña')" />
        
                        <x-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />
                    </div>
        
                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Recuerdame') }}</span>
                        </label>
                    </div>
        
                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-3">
                            {{ __('Iniciar Sesion') }}
                        </x-button>
                    </div>
                </form>
            </div>
            <div x-show="!isShowing">
                <form method="POST" action="{{ route('consultaCredito') }}">
                    @csrf
                    <div>
                        <x-label for="noControl" :value="__('Numero de control')" />
                        <x-input id="noControl" class="block mt-1 w-full" type="text" name="noControl" required autofocus />
                    </div>
                    <div class="mt-4">
                        <x-label for="nip" :value="__('Nip')" />
                        <x-input id="nip" class="block mt-1 w-full"
                                        type="password"
                                        name="nip"
                                        required autocomplete="current-password" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-3">
                            {{ __('Consultar creditos') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
        
    </x-auth-card>
</x-guest-layout>
