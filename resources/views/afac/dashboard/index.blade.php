<x-app-layout>
    @can('headquarters.see.dashboard')
        AQUI TIENE QUE IR EL DASHBOARD PARA LAS SEDES
    @endcan
    @can('medicine_admin.see.dashboard')
        @livewire('medicine.history-appointment')
    @endcan
    @can('super_admin.see.dashboard')
        @include('afac.dashboard.dashboard_superadmin')
    @endcan
    {{-- GENERAL USER --}}
    @can('user.see.navigation')
        <div>
            <div class="relative py-6 lg:py-4">
                <img class="z-0 w-full h-full absolute inset-0 object-cover"
                    src="{{ asset('images/banner_ventanillas.jpg') }}" alt="banners" />
                <div
                    class="z-10 relative container px-6 mx-auto flex flex-col md:flex-row items-start md:items-center justify-between">
                    <div>
                        <h4 tabindex="0" class="focus:outline-none text-2xl font-bold leading-tight text-white">Bienvenido
                            al
                            Sistema de citas AFAC</h4>
                        <ul class="flex flex-col md:flex-row items-start md:items-center text-gray-300 text-sm mt-3">
                            <li class="flex items-center mt-4 md:mt-0">
                                <div class="mr-1">
                                    <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/background_with_sub_text-svg3.svg" alt="date">
                                </div>
                                <span tabindex="0" class="focus:outline-none">
                                    <b>{{$date->format('d')}} {{ Str::ucfirst($date->format('F'))}} {{$date->format('Y')}}</b>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="py-2">
                <div class="container px-6 p-y-1 mx-auto">
                    <section class="text-gray-600 body-font">
                        <div class="container px-6 py-1 mx-auto">
                            <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-12 md:grid-cols-2 xl:grid-cols-3">
                                <a href="{{ route('afac.medicine') }}">
                                    <div
                                        class="group bg-white h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden transition duration-100 transform hover:scale-105 hover:cursor-pointer">
                                        <div class="overflow-hidden bg-cover cursor-pointer lg:h-48 md:h-36 w-full object-cover object-center group"
                                            style="background-image:url('{{ asset('images/medicina-aviacion.jpg') }}')">
                                            <div
                                                class="flex flex-col justify-center w-full h-full px-8 py-4 transition-opacity duration-700 opacity-0 backdrop-blur-sm bg-gray-800 group-hover:opacity-70">
                                                <h2 class="mt-4 text-2xl font-semibold text-white capitalize">NUEVA CITA
                                                </h2>
                                                <p class="mt-2 text-lg tracking-wider text-blue-300 uppercase ">MEDICINA DE
                                                    AVIACIÓN</p>
                                            </div>
                                        </div>
                                        <div class="p-6">
                                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">
                                                MEDICINA DE AVIACIÓN
                                            </h1>
                                            <div class="flex items-center flex-wrap ">
                                                <p
                                                    class="group-hover:animate-pulse text-sky-700 inline-flex items-center md:mb-2 lg:mb-0">
                                                    GENERAR CITA
                                                    <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="2" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M5 12h14"></path>
                                                        <path d="M12 5l7 7-7 7"></path>
                                                    </svg>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                {{-- <a href="{{ route('afac.linguistics') }}">
                                    <div
                                        class="group bg-white h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden transition duration-100 transform hover:scale-105 hover:cursor-pointer">
                                        <div class="overflow-hidden bg-cover cursor-pointer lg:h-48 md:h-36 w-full object-cover object-center group"
                                            style="background-image:url('{{ asset('images/competencia.jpg') }}')">
                                            <div
                                                class="flex flex-col justify-center w-full h-full px-8 py-4 transition-opacity duration-700 opacity-0 backdrop-blur-sm bg-gray-800 group-hover:opacity-70">
                                                <h2 class="mt-4 text-2xl font-semibold text-white">NUEVA CITA</h2>
                                                <p class="mt-2 text-lg tracking-wider text-blue-300 uppercase ">COMPETENCIA
                                                    LINGÜISTICA
                                                </p>
                                            </div>
                                        </div>
                                        <div class="p-6">
                                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">COMPETENCIA
                                                LINGÜISTICA</h1>
                                            <div class="flex items-center flex-wrap">
                                                <p
                                                    class="group-hover:animate-pulse text-sky-700 inline-flex items-center md:mb-2 lg:mb-0">
                                                    GENERAR CITA
                                                    <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="2" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M5 12h14"></path>
                                                        <path d="M12 5l7 7-7 7"></path>
                                                    </svg>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a> --}}
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    @endcan
</x-app-layout>
