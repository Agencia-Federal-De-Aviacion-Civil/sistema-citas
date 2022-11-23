<x-guest-layout>
    <section class="min-h-screen bg-cover "
        style="background-image: url('{{ asset('images/medicina.jpg') }}')">
        <div class="flex flex-col min-h-screen bg-black/40">
            <div class="container flex flex-col flex-1 px-6 py-12 mx-auto">
                <div class="flex-1 lg:flex lg:items-center lg:-mx-6">
                    <div class="text-white lg:w-1/2 lg:mx-6">
                        <h1 class="text-blue-400 dark:text-gray-300 md:text-4xl">Bienvenido</h1>
                        <h1 class="text-3xl font-semibold capitalize lg:text-5xl">Medicina de Aviación</h1>
                        <p class="max-w-xl mt-6">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem quo
                            aliquid molestiae hic incidunt beatae.
                        </p>
                        <div class="py-2 flex items-center justify-center opacity-50">
                            <img class="lg:w-52 lg:h-40 w-40 h-30 mr-2" src="{{ asset('images/AFAC1.png') }}"
                                alt="logo">
                        </div>
                    </div>
                    <div class="w-full max-w-xl xl:px-8 xl:w-5/12 xs:px-2">
                        <div class="bg-white rounded-2xl shadow-2xl p-7 sm:p-10">
                            <h3 class="mb-4 text-xl font-semibold sm:text-center sm:mb-6 sm:text-2xl">
                                Ingresar
                            </h3>
                            <x-jet-validation-errors class="mb-4" />
                            @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                            @endif
                            <form method="POST" action="{{ route('login') }}" class="flex flex-col pt-1 md:pt-1">
                                @csrf
                                <div class="flex flex-col pt-4">
                                    <x-jet-label class="inline-block mb-1 font-medium text-base" for="email"
                                        value="{{ __('CURP') }}" />
                                    <x-jet-input id="curp"
                                        class="flex-grow w-full h-12 px-4 mb-2 transition duration-200 bg-white border border-gray-300 rounded shadow-sm appearance-none focus:border-deep-purple-accent-400 focus:outline-none focus:shadow-outline"
                                        type="text" name="curp" :value="old('curp')" required autofocus />
                                </div>
                                <div class="flex flex-col pt-4" x-data="{ show: false }">
                                    <div class="mb-6">
                                        <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                                        <div class="relative">
                                            <input :type="show ? 'text' : 'password'"
                                                class="flex-grow w-full h-12 px-4 mb-2 transition duration-200 bg-white border border-gray-300 rounded shadow-sm appearance-none focus:border-deep-purple-accent-400 focus:outline-none focus:shadow-outline"
                                                type="password" id="password" name="password" required
                                                autocomplete="current-password" />
                                            <div
                                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                                <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                                                    :class="{'hidden': !show, 'block':show }"
                                                    xmlns="http://www.w3.org/2000/svg" viewbox="0 0 576 512">
                                                    <path fill="currentColor"
                                                        d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                                    </path>
                                                </svg>
                                                <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                                                    :class="{'block': !show, 'hidden':show }"
                                                    xmlns="http://www.w3.org/2000/svg" viewbox="0 0 640 512">
                                                    <path fill="currentColor"
                                                        d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="py-2 flex items-center justify-between">
                                    <div class="flex items-center">
                                        <x-jet-checkbox id="remember_me" name="remember"
                                            class="h-4 w-4 focus:ring-blue-400 border-gray-300 rounded" />
                                        <span class="ml-2 text-sm text-gray-600">{{ __('Recuerdame') }}</span>
                                    </div>
                                    <div class="text-sm">
                                        @if (Route::has('password.request'))
                                        <a class="text-gray-400 hover:text-gray-500"
                                            href="{{ route('password.request') }}">
                                            {{ __('¿Olvidaste tu contraseña?') }}
                                        </a>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <x-jet-button
                                        class="w-full flex justify-center bg-blue-800  hover:bg-blue-900 text-gray-100 p-3  rounded-full tracking-wide font-semibold  shadow-lg cursor-pointer transition ease-in duration-500">
                                        {{ __('Iniciar Sesión') }}
                                    </x-jet-button>
                                    <div class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-300">
                                    </div>
                                    <a class="py-3 w-full flex justify-center text-sm text-gray-400 hover:text-gray-500"
                                        href="{{ route('register') }}">
                                        {{ __('¿No tienes cuenta? Registrate.') }}
                                    </a>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>