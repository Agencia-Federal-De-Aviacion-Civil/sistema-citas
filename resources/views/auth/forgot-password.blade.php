<x-guest-layout>
    {{-- <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Email Password Reset Link') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card> --}}
    {{-- nuevo diseño --}}
    {{-- <div class="relative">
        <section class="min-h-screen bg-cover " style="background-image: url('{{ asset('images/AFAC_citas_fondo.jpg') }}')">
            <div class="flex flex-col min-h-screen bg-black/50">
                <div class="container flex flex-col flex-1 px-6 py-12 mx-auto">
                    <div class="flex-1 lg:flex lg:items-center lg:-mx-6">
                        <section class="flex flex-col max-w-5xl mx-auto overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800 md:flex-row md:h-72">
                            <div class="flex-1 lg:flex lg:items-center lg:-mx-6 md:flex md:items-center md:justify-center md:w-2/5 md:bg-gray-700 md:dark:bg-gray-800">
                                <div class="px-6 py-6 md:px-8 md:py-0 text-center">
                                    <h2 class="text-2xl font-bold text-gray-700 dark:text-white md:text-gray-100">Recuperación de <span class="text-blue-600 dark:text-blue-400 md:text-blue-300">Cuenta</span></h2>
                                    <div class="py-2 flex items-center justify-center opacity-80">
                                        <img class="lg:w-36 lg:h-27 w-36 h-27 mr-2" src="{{ asset('images/AFAC1.png') }}"
                                            alt="logo">
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-center pb-2 md:py-0 md:w-3/5">
                                <x-slot name="logo">
                                    <x-jet-authentication-card-logo />
                                </x-slot>
                                <div class="px-6 py-6 md:px-8 md:py-0 text-base text-gray-600">
                                    <div class="mb-4 text-sm text-gray-600">
                                        {{ __('¿Olvidaste tu contraseña? Ingreasa la dirección de correo electrónico y se enviara un enlace de restablecimiento de contraseña que le permitirá elegir una nueva.') }}
                                    </div>
                                    @if (session('status'))
                                    <div class="mb-4 font-medium text-sm text-green-600">
                                        {{ session('status') }}
                                    </div>
                                    @endif
                                <x-jet-validation-errors class="mb-4" />
                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf
                                        <div class="block w-90">
                                            <x-jet-label for="email" value="{{ __('Correo electronico') }}" />
                                            <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                                        </div>
                                        <div class="flex items-center justify-end mt-4">
                                            <x-jet-button>
                                                {{ __('Restablece la cuenta') }}
                                            </x-jet-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div> --}}
    <section class="min-h-screen bg-cover"
        style="background-image: url('{{ asset('images/AFAC_citas_fondo.jpg') }}')">
        <div class="flex flex-col min-h-screen bg-black/40">
            <header
                class="flex flex-wrap sm:justify-start sm:flex-nowrap z-50 w-full text-sm py-3 sm:py-0 dark:bg-gray-800 dark:border-gray-700">
                <nav class="relative max-w-7xl w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8"
                    aria-label="Global">
                    <div class="flex items-center justify-between">
                        <div class="sm:hidden">
                            <div
                                class="flex flex-col gap-y-4 gap-x-0 mt-5 sm:flex-row sm:items-center sm:justify-end sm:gap-y-0 sm:gap-x-7 sm:mt-0 sm:pl-7">
                                <a class="flex items-center gap-x-2 font-medium text-gray-400 hover:text-[#BC955C] sm:border-l sm:border-gray-500 sm:my-6 sm:pl-6"
                                    href="{{ route('login') }}">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path
                                            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                    </svg>
                                    Acceder
                                </a>
                            </div>
                        </div>
                    </div>
                    <div id="navbar-collapse-with-animation"
                        class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:block">
                        <div
                            class="flex flex-col gap-y-4 gap-x-0 mt-5 sm:flex-row sm:items-center sm:justify-end sm:gap-y-0 sm:gap-x-7 sm:mt-0 sm:pl-7">
                            <a class="flex items-center gap-x-2 font-medium text-gray-400 hover:text-[#BC955C] sm:border-l sm:border-gray-500 sm:my-6 sm:pl-6"
                                href="{{ route('login') }}">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" viewBox="0 0 16 16">
                                    <path
                                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                </svg>
                                Acceder
                            </a>
                        </div>
                    </div>
                </nav>
            </header>

            <div class="container flex flex-col flex-1 px-6 lg:py-18 py-6 mx-auto">
                <div class="flex items-center justify-center opacity-70">
                    <img class="w-[25%] lg:w-[20%]  mr-2" src="{{ asset('images/isologo_AFAC_white.png') }}" alt="logo">
                </div>
                <div class="py-4">
                    <section
                        class="flex flex-col max-w-5xl mx-auto overflow-hidden bg-white rounded-lg shadow-lg  md:flex-row md:h-48">
                        <div
                            class="md:flex md:items-center md:justify-center md:w-1/2 bg-gray-700">
                            <div class="px-6 py-6 md:px-8 md:py-0">
                                <h2 class="text-lg font-bold text-gray-100">Recuperación
                                    de <span class="text-sky-600">Cuenta</span>
                                    {{-- Sistema de citas de Medicina Preventiva en el transporte --}}
                                </h2>

                                <p class="mt-2 text-md text-gray-400">¿Olvidaste tu
                                    contraseña? Ingresa la dirección de correo electrónico con la que te registraste y
                                    se enviará
                                    un enlace de
                                    restablecimiento de contraseña que le permitirá elegir una nueva.</p>
                            </div>
                        </div>

                        <div class="flex flex-col px-2 my-auto md:w-1/2">
                            @if (session('status'))
                                <div class="mb-4 font-medium text-sm text-green-600">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <x-jet-validation-errors class="mb-4" />
                                <div class="w-full px-6 py-6 md:px-8 md:py-0">
                                    <label for="email" class="block text-sm text-gray-500 dark:text-gray-300">Ingresa correo electrónico</label>

                                    <div class="relative flex items-center mt-2">
                                        <span class="absolute">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6 mx-3 text-gray-400 dark:text-gray-500">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                            </svg>
                                        </span>
                                        <input id="email"
                                            class="block mt-1 w-full py-2.5 text-gray-700 placeholder-gray-400/70 bg-white border border-gray-200 rounded-lg pl-11 pr-5 rtl:pr-11 rtl:pl-5 focus:border-blue-600 focus:outline-none"
                                            type="email" name="email" :value="old('email')" required autofocus
                                            autocomplete="username" placeholder="ingresar..." />
                                        <button
                                            class="px-4 py-2 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-black rounded-md sm:mx-2 hover:bg-[#264899] focus:outline-none focus:bg-blue-600">
                                            Restablecer
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
