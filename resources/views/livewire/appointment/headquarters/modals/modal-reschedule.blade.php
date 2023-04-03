<div>


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
                    {{-- <h1>REAGENDAR CITA</h1> --}}
                    </div>
                    <div class="mt-4 text-center">
                        {{-- <h3 class="text-xl font-semibold leading-6 text-gray-800 capitalize dark:text-white"
                            id="modal-title">
                            AÑADIR SEDE
                        </h3> --}}
                        <div class="grid xl:grid-cols-1 xl:gap-6">
                            <div class="mt-1 relative w-full group">
                                <x-input wire:model="name" label="NOMBRE" placeholder="ESCRIBE..." disabled />
                            </div>
                        </div>
                        <div class="grid xl:grid-cols-2 xl:gap-6">
                        <div class="mt-1 relative w-full group">
                            <x-input wire:model="type" label="TIPO" placeholder="ESCRIBE..." disabled />
                        </div>
                        <div class="mt-1 relative w-full group">
                            <x-input wire:model="class" label="CLASE" placeholder="ESCRIBE..." disabled />
                        </div>
                        </div>
                        <div class="grid xl:grid-cols-1 xl:gap-6">
                            <div class="mt-4 relative w-full group">
                                <x-input wire:model="typLicense" label="TIPO DE LICENCIA" disabled />
                            </div>
                        </div>

                        <div class="grid xl:grid-cols-1 xl:gap-6">
                            <div class="mt-4 relative w-full group">
                                <x-input wire:model="sede" label="SEDE" disabled />
                            </div>
                        </div>

                        <div class="grid xl:grid-cols-2 xl:gap-6">
                            <div class="mt-4 relative w-full group">
                                <x-datetime-picker label="SELECCIONE FECHA" placeholder="Seleccione..."
                                    without-time="false" parse-format="YYYY-MM-DD"
                                    display-format="DD-MM-YYYY" wire:model="date" />
                            </div>

                            <div class="mt-4 relative w-full group">
                                <x-select label="SELECCIONE HORA" placeholder="Seleccione..."
                                    wire:model="time">
                                    <x-select.option label="7:00 AM" value="07:00:00" />
                                    <x-select.option label="8:00 AM" value="08:00:00" />
                                    <x-select.option label="9:00 AM" value="09:00:00" />
                                    <x-select.option label="10:00 AM" value="10:00:00" />
                                </x-select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="float-right mt-6">
                    <x-button wire:click.prevent="reschedule()" label="REAGENDAR" blue right-icon="save-as" />
                </div>
                <div class="float-left mt-6">
                    <x-button wire:click.prevent="salir()" label="SALIR" silver />
                </div>
            </div>
        </div>
    </div>    
</div>

