<x-guest-layout>
    {{-- <x-jet-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset('images/AFAC1.png') }}" alt="" >
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirma Contraseña') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Resetear Contraseña') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card> --}}
    <section class="min-h-screen bg-cover " style="background-image: url('{{ asset('images/citas_internet.jpg') }}')">
        <div class="flex flex-col min-h-screen bg-black/60">
            <div class="container flex flex-col flex-1 px-6 py-12 mx-auto">
                <div class="flex-1 lg:flex lg:items-center lg:-mx-6">
                    <div class="text-white lg:w-1/2 lg:mx-6">
                        <div class="py-2 flex items-center justify-center opacity-50">
                            <img class="md:w-45 md:h-27 w-27 h-27 mr-2" src="{{ asset('images/AFAC1.png') }}"
                                alt="logo">
                        </div>                
                    </div>
    
                    <div class="mt-8 lg:w-1/2 lg:mx-6">
                        <div class="w-full px-8 py-10 mx-auto overflow-hidden bg-white shadow-2xl rounded-xl dark:bg-gray-900 lg:max-w-xl">
                            <h1 class="text-xl font-medium text-gray-700 dark:text-gray-200">Recuperación de Contraseña</h1>
                            <x-jet-validation-errors class="mb-4" />

                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                    
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    
                                <div class="block">
                                    <x-jet-label for="email" value="{{ __('Email') }}" />
                                    <x-jet-input id="email" class="block w-full px-5 py-3 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" type="email" name="email" :value="old('email', $request->email)" required autofocus />
                                </div>
                    
                                <div class="mt-4">
                                    <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                                    <x-jet-input id="password" class="block w-full px-5 py-3 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" type="password" name="password" required autocomplete="new-password" />
                                </div>
                    
                                <div class="mt-4">
                                    <x-jet-label for="password_confirmation" value="{{ __('Confirma Contraseña') }}" />
                                    <x-jet-input id="password_confirmation" class="block w-full px-5 py-3 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" type="password" name="password_confirmation" required autocomplete="new-password" />
                                </div>
                    
                                <div class="flex items-center justify-end mt-4">
                                    <x-jet-button>
                                        {{ __('Restablecer Contraseña') }}
                                    </x-jet-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
