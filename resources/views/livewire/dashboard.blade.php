<div>
    <x-banner-component :title="'Bienvenido al Sistema de citas AFAC'" />
    <div class="py-2">
        <div x-data="{ 'showModal': false }" @keydown.escape="showModal = false">
            <div class="container px-6 p-y-1 mx-auto">
                <section class="text-gray-600 body-font">
                    <div class="container px-6 py-1 mx-auto">
                        <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-12 md:grid-cols-2 xl:grid-cols-3">
                            <a @click="showModal = true">
                                <div
                                    class="group bg-white h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden transition duration-100 transform hover:scale-105 hover:cursor-pointer">
                                    <div class="overflow-hidden bg-cover cursor-pointer lg:h-48 md:h-36 w-full object-cover object-center group"
                                        style="background-image:url('{{ asset('images/medicina-aviacion.jpg') }}')">
                                        <div
                                            class="flex flex-col justify-center w-full h-full px-8 py-4 transition-opacity duration-700 opacity-0 backdrop-blur-sm bg-gray-800 group-hover:opacity-70">
                                            <h2 class="mt-4 text-2xl font-semibold text-white capitalize">NUEVA CITA
                                            </h2>
                                            <p class="mt-2 text-lg tracking-wider text-blue-300 uppercase ">MEDICINA
                                                DE
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
                        </div>
                    </div>
                    <div x-cloak x-show="showModal" x-transition:enter="transition duration-300 ease-out"
                        x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
                        x-transition:leave="transition duration-150 ease-in"
                        x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
                        x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
                        class="fixed inset-0 z-20 overflow-y-auto overflow-auto bg-black bg-opacity-50"
                        aria-labelledby="modal-title" role="dialog" aria-modal="true">

                        <div tabindex="-1"
                            class="flex justify-center z-40 h-full w-full fixed top-0 left-0 items-center md:inset-0 h-[calc(100%-1rem)]">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <div class="p-6 text-center">
                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                            ¿EN DONDE REALIZARAS TU CITA?</h3>
                                        <x-select label="SELECCIONA LA SEDE" placeholder="SELECCIONA..."
                                            wire:model.defer="selectedHeadquarter">
                                            @foreach ($headquartersAfac as $headquarterAfac)
                                                <x-select.option label="{{ $headquarterAfac->name_headquarter }}"
                                                    value="{{ $headquarterAfac->id . '-' . $headquarterAfac->is_external }}" />
                                            @endforeach
                                        </x-select>
                                        {{-- <div class="grid grid-cols-1 gap-4 mt-4 xl:mt-4 md:grid-cols-2 xl:grid-cols-2">
                                            <button class="hover:animate-pulse" wire:click.prevent='goAfac(false)'>
                                                <div
                                                    class="flex flex-col items-center p-3 transition-colors duration-300 transform border cursor-pointer rounded-xl hover:border-transparent group hover:bg-gray-100 dark:border-gray-700 dark:hover:border-transparent">
                                                    <img class="object-cover w-24" src="{{ asset('images/AFAC1.png') }}"
                                                        alt="">
                                                    <p
                                                        class="mt-2 text-gray-500 capitalize dark:text-gray-300 group-hover:text-gray-600">
                                                        Agencia Federal de Aviación Civil</p>
                                                </div>
                                            </button>
                                            <button class="hover:animate-pulse" wire:click.prevent='goAfac(true)'>
                                                <div
                                                    class="flex flex-col items-center p-3 transition-colors duration-300 transform border cursor-pointer rounded-xl hover:border-transparent group hover:bg-gray-100 dark:border-gray-700 dark:hover:border-transparent">
                                                    <img class="object-cover w-20"
                                                        src="{{ asset('images/saludlogo.png') }}" alt="">
                                                    <p
                                                        class="mt-2 text-gray-500 capitalize dark:text-gray-300 group-hover:text-gray-600">
                                                        Instituciones para terceros</p>
                                                </div>
                                            </button>
                                        </div> --}}
                                        <div class="mt-6 mb-6">
                                            <x-button wire:click.prevent="selected" right-icon="arrow-circle-right"
                                                primary label="CONTINUAR" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>