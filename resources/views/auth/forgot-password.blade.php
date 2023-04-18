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
    <div class="relative">
        <section class="min-h-screen bg-cover " style="background-image: url('{{ asset('images/citas_internet.jpg') }}')">
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
    </div>
</x-guest-layout>
