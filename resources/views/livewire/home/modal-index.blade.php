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
                <div>
                    <div class="p-3 text-center">
                        <div
                            class="animate-pulse flex-shrink-0 w-24 h-24 bg-indigo-100 text-indigo-500 rounded-full inline-flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-12 h-12">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>

                        </div>
                    </div>

                    <div class="mt-4 text-center">
                        <h3 class="text-xl font-semibold leading-6 text-gray-800 capitalize dark:text-white"
                            id="modal-title">
                            Toma en cuenta lo siguiente
                        </h3>

                        <p class="mt-2 text-regular text-gray-500 dark:text-gray-400">
                            Antes de realizar tu cita se debe de generar el pago, en caso contrario no se podra
                            agendar su cita
                        </p>
                    </div>
                </div>
                <div class="mt-5 sm:flex sm:items-center sm:-mx-2">
                    <a href="https://www.gob.mx/segob/es/documentos/e5cinco-pago-de-derechos-productos-y-aprovechamientos"
                        class="w-full px-4 py-2 text-sm text-center font-medium tracking-wide text-gray-700 transition-colors duration-300 transform border border-gray-200 rounded-md sm:w-1/2 sm:mx-2 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40">
                        Genera la hoja de pago
                    </a>
                    <button @click="isOpen = false"
                        class="w-full px-4 py-2 mt-4 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-md sm:mt-0 sm:w-1/2 sm:mx-2 hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                        Continuar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>