    <div x-transition:enter="transition duration-300 ease-out"
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
                class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-900 sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full sm:p-6">
                <div>
                    <div class="p-3 text-center">
                        <div
                            class="flex-shrink-0 w-24 h-24 bg-red-100 text-red-500 rounded-full inline-flex items-center justify-center">
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-12 h-12">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 008.835-2.535m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 001.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 010 3.46" />
                            </svg> --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        {{-- <h3 class="text-xl font-semibold leading-6 text-gray-800 capitalize dark:text-white"
                            id="modal-title">
                            AÑADIR SEDE
                        </h3> --}}
                        <div class="grid xl:grid-cols-2 xl:gap-6">
                            <div class="mt-1 relative w-full group">
                                <x-input wire:model.lazy="name" label="NOMBRE" placeholder="ESCRIBE..." />
                            </div>
                            <div class="mt-1 relative w-full group">
                                <x-input wire:model.lazy="direction" label="DIRECCIÓN" placeholder="ESCRIBE..." />
                            </div>
                        </div>
                        <div class="grid xl:grid-cols-2 xl:gap-6">
                            <div class="mt-4 relative w-full group">
                                <x-inputs.password wire:model.lazy="passwordConfirmation" label="CONTRASEÑA" />
                            </div>
                            <div class="mt-4 relative w-full group">
                                <x-inputs.password wire:model.lazy="password" label="CONFIRMAR CONTRASEÑA" />
                            </div>
                        </div>
                        <div class="grid xl:grid-cols-2 xl:gap-6">
                            <div class="mt-4 relative w-full group">
                                <x-input wire:model.lazy="email" label="CORREO" placeholder="ESCRIBE..." />
                            </div>
                            <div class="mt-4 relative w-full group">
                                <x-textarea wire:model.lazy="url" label="URL"
                                    placeholder="INGRESA URL DE GOOGLE MAPS..." />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="float-right mt-6">
                    <x-button wire:click.prevent="save()" label="GUARDAR" blue right-icon="save-as" />
                </div>
            </div>
        </div>
    </div>
