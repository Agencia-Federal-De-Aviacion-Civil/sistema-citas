<div x-data="{ isOpen: true }" class="relative flex justify-center">
    <div x-show="isOpen" x-transition:enter="transition duration-300 ease-out"
        x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
        x-transition:leave="transition duration-150 ease-in"
        x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
        x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
        class="fixed inset-0 z-[60] overflow-y-auto bg-black bg-opacity-70" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
            class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-900 sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div class="">
                    <div class="p-3 text-center">
                        <div
                            class="animate-pulse flex-shrink-0 w-24 h-24 bg-green-100 text-green-500 rounded-full inline-flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                    </div>
                    <div class="px-6 text-center">
                        <h2 class="text-2xl font-bold py-4 ">Acuse!</h3>
                        <p class="text-xl text-gray-500 px-4">Se genero la cita de forma exitosa, no olvides descargar el ACUSE y los FORMATOS para la cita.</p>    
                        {{-- <div class="mb-5 mt-6 text-right items-center">
                            <x-button secondary wire:click.prevent="returnDashboard" label="SALIR"  />
                            <a href="{{ route('download') }}" target="_blank"
                                class="w-full px-4 py-2 mt-4 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-sky-600 rounded-md sm:mt-0 sm:w-1/2 sm:mx-2 hover:bg-sky-700 focus:outline-none focus:ring focus:ring-sky-300 focus:ring-opacity-40">
                                DESCARGAR PDF
                            </a>
                        </div> --}}
                    </div>
                    <div class="mt-5 sm:flex sm:items-center sm:-mx-2">    
                        {{-- <button wire:click.prevent="downloadpdf" class="w-full px-4 py-2 mt-4 text-md font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-md sm:mt-0 sm:w-1/2 sm:mx-2 hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                            Descargar Formatos
                        </button> --}}
                        {{-- <a href="{{ route('download') }}" target="_blank" class="text-center w-full px-4 py-2 mt-4 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-sky-600 rounded-md sm:mt-0 sm:w-1/2 sm:mx-2 hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                            Descargar Acuse
                        </a> --}}
                        <a target="_blank" class="sm:mt-0 w-full sm:mx-2 bg-sky-700 w-full px-4 py-2 text-md text-center font-medium tracking-wide text-gray-700 transition-colors duration-300 transform border border-gray-200 rounded-md dark:text-gray-200 dark:border-gray-700 dark:hover:bg-blue-500 hover:bg-blue-500 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40" href="{{ route('download2') }}">
                        <button class="w-full text-md text-center text-white font-medium tracking-wide text-gray-700 transition-colors duration-300 transform rounded-md dark:text-gray-200 dark:border-gray-700">
                            Descargar Acuse
                        </button>
                    </a>
                    </div>
                    
                    <div class="mb-5 mt-6 text-right items-center">
                        <x-button wire:click.prevent="returnDashboard" label="SALIR" class="bg-gray-100 w-full px-3 text-sm text-center font-medium tracking-wide text-gray-700 transition-colors duration-300 transform rounded-md dark:text-gray-200 dark:border-gray-700 sm:mt-0 sm:w-1/1" />
                        {{-- <a href="{{ route('download') }}" target="_blank"
                            class="w-full px-4 py-2 mt-4 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-sky-600 rounded-md sm:mt-0 sm:w-1/2 sm:mx-2 hover:bg-sky-700 focus:outline-none focus:ring focus:ring-sky-300 focus:ring-opacity-40">
                            DESCARGAR PDF
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
