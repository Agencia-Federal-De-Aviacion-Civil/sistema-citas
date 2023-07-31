<x-guest-layout>
    <div class="relative bg-gray-900">
        <div class="absolute inset-x-0 bottom-0">
            <svg viewBox="0 0 224 12" fill="currentColor" class="w-full -mb-1 text-white" preserveAspectRatio="none">
                <path
                    d="M0,0 C48.8902582,6.27314026 86.2235915,9.40971039 112,9.40971039 C137.776408,9.40971039 175.109742,6.27314026 224,0 L224,12.0441132 L0,12.0441132 L0,0 Z">
                </path>
            </svg>
        </div>
        <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
            <div class="relative max-w-2xl sm:mx-auto sm:max-w-xl md:max-w-2xl sm:text-center">
                <h2
                    class="animate-pulse mb-6 font-sans text-3xl font-bold tracking-tight text-white sm:text-4xl sm:leading-none">
                    Confirmación de <span class="text-blue-600 dark:text-blue-400 md:text-blue-300">Cuenta</span>
                    <br class="hidden md:block" />

                </h2>
                <p class="mb-6 text-base font-thin tracking-wide text-gray-200 md:text-xl">
                    Antes de continuar, ¿Verificar su dirección de correo electrónico haciendo clic en el enlace que le
                    acabamos de enviar? Si no recibiste el correo electrónico, con gusto te enviaremos otro.
                </p>
                <div class="animate-pulse">
                    <form class="flex flex-col items-center w-full mb-4 md:flex-row md:px-16">
                        <img src="{{ asset('images/AFAC1.png') }}" width="50%" height="50%"
                            class="max-w-xs md:max-w-xl m-auto" />
                    </form>

                </div>
                <div class="px-6 py-6 md:px-8 md:py-0 text-base text-gray-600">
                    @if (session('status') == 'verification-link-sent')
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ __('Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionó en la configuración de su perfil.') }}
                        </div>
                    @endif
                    <div class="text-center items-center justify-center">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <div>
                                <button type="submit"
                                    class="flex items-center justify-center px-3 py-2 mx-auto text-sm rounded-full font-medium text-center text-white bg-sky-900 rounded-lg hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    REENVIAR VERIFICACIÓN
                                </button>
                            </div>
                        </form>
                        <div class="mt-4">
                            <label class="text-sm text-white">¿Sigues sin recibir el correo de verificación?. Verifica que lo has escrito correctamente,</label>
                                <a href="{{ route('profile.show') }}"
                                    class="underline text-sm text-white hover:text-gray-500">
                                    aqui</a>
                        </div>
                        <div class="mt-4">
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit"
                                    class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">SALIR</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
        </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-jet-button type="submit">
                        {{ __('Resend Verification Email') }}
                    </x-jet-button>
                </div>
            </form>

            <div>
                <a href="{{ route('profile.show') }}" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Edit Profile') }}</a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf

                    <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 ml-2">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </x-jet-authentication-card> --}}
</x-guest-layout>
