<x-guest-layout>
    <div class="relative">
        <section class="min-h-screen bg-cover " style="background-image: url('{{ asset('images/airport-terminal3.jpg') }}')">
            <div class="flex flex-col min-h-screen bg-black/50">
                <div class="container flex flex-col flex-1 px-6 py-12 mx-auto">
                    <div class="flex-1 lg:flex lg:items-center lg:-mx-6">
                        <section class="flex flex-col max-w-5xl mx-auto overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800 md:flex-row md:h-60">
                            <div class="flex-1 lg:flex lg:items-center lg:-mx-6 md:flex md:items-center md:justify-center md:w-2/5 md:bg-gray-700 md:dark:bg-gray-800">
                                <div class="px-6 py-6 md:px-8 md:py-0 text-center">
                                    <h2 class="text-2xl font-bold text-gray-700 dark:text-white md:text-gray-100">Confirmación de <span class="text-blue-600 dark:text-blue-400 md:text-blue-300">Cuenta</span></h2>
                                    {{-- <p class="text-center mt-2 text-sm text-gray-600 dark:text-gray-400 md:text-gray-400">Mayor información al 55-57-23-93-00 ext. 18019 y 18095</p> --}}
                                    <div class="py-2 flex items-center justify-center opacity-80">
                                        <img class="lg:w-36 lg:h-27 w-36 h-27 mr-2" src="{{ asset('images/AFAC1.png') }}"
                                            alt="logo">
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-center pb-2 md:py-0 md:w-3/5">
                                <div class="px-6 py-6 md:px-8 md:py-0 text-base text-gray-600">
                                    <div class="px-2 py-2 text-lg mb-4 text-gray-60">
                                        {{ __('Antes de continuar, ¿podría verificar su dirección de correo electrónico haciendo clic en el enlace que le acabamos de enviar? Si no recibiste el correo electrónico, con gusto te enviaremos otro.') }}
                                    </div>
                                    @if (session('status') == 'verification-link-sent')
                                    <div class="mb-4 font-medium text-sm text-green-600">
                                        {{ __('Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionó en la configuración de su perfil.') }}
                                    </div>
                                    @endif
                                    <div class="text-right">
                                        <form method="POST" action="{{ route('verification.send') }}">
                                            @csrf
                                            <div>
                                                <button type="submit" class="px-3 py-2 text-sm font-medium text-center text-white bg-sky-900 rounded-lg hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                               REENVIAR VERIFICACIÓN
                                            </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
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