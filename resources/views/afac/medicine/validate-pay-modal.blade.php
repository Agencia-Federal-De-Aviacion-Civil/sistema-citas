<div>
    <div class="relative flex justify-center">
        <div x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
            x-transition:leave="transition duration-150 ease-in"
            x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
            x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
            class="fixed inset-0 z-20 overflow-y-auto overflow-auto bg-black bg-opacity-50"
            aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div
                    class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-900 sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full sm:p-6">
                    <div>
                        {{-- <x-banner-modal-icon :title="'VALIDACIÓN DE PAGO'" :size="'w-16 h-16 animate-pulse'"
                            :icon="'bell'" :titlesize="'xl'" /> --}}
                        <div class="flex mt-2 bg-gray-100 border border-gray-200 text-sm text-gray-800 rounded-lg p-4 dark:bg-white/10 dark:border-white/20 dark:text-white"
                            role="alert">
                            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3 text-[#269999]"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium uppercase">Debes de validar tu pago para
                                    poder continuar con el proceso de generación de cita. Asegurate que la información
                                    que ingreses sea correcta.</span>
                            </div>
                        </div>
                        <div class="mt-2">
                            {{-- <x-errors /> --}}
                            <div class="mt-6 grid md:grid-cols-3 md:gap-6">
                                <div class="relative w-full mb-6 group">
                                    <x-input label="Nombre(s)*" class="uppercase" wire:model.live="name"
                                        placeholder="INGRESE..." />
                                </div>
                                <div class="relative w-full mb-6 group">
                                    <x-input label="Apellido 1*" class="uppercase" wire:model.live="apParental"
                                        placeholder="INGRESE..." />
                                </div>
                                <div class="relative w-full mb-6 group">
                                    <x-input label="Apellido 2*" class="uppercase" wire:model.live="apMaternal"
                                        placeholder="INGRESE..." />
                                </div>
                            </div>
                            <div class="grid md:grid-cols-3 md:gap-6">
                                {{-- <div class="relative w-full mb-6 group">
                                        <x-input wire:model.live="pay_date" id="fecha-pago" label="FECHA DE PAGO"
                                        placeholder="INGRESE..." />
                                </div> --}}
                                <div class="relative z-auto w-full group">
                                    {{-- {{ $this->payDateForm }} --}}



                                    {{-- <div class="mt-1 relative z-auto w-full group"> --}}
                                        <x-input wire:model.lazy="pay_date" id="fecha-pago"
                                            label="FECHA DE PAGO" placeholder="INGRESE..."
                                            readonly />
                                    {{-- </div> --}}


                                </div>
                                <div class="relative w-full mb-6 group">
                                    <x-input wire:model.live="yearExercise" label="EJERCICIO" class="bg-gray-100"
                                        placeholder="INGRESE..." readonly />
                                </div>
                                <div class="relative w-full mb-6 group">
                                    <x-input wire:model.live="reference_key" label="CLAVE DE REFERENCIA*"
                                        class="bg-gray-100" placeholder="INGRESE..." />
                                </div>
                                {{-- <div class="relative w-full mb-6 group">
                                    <label class="select-none text-gray-700">PAGO REALIZADO POR:</label>
                                    <select wire:model.live="kind_person_id" x-model="kindPersonId"
                                        class="block w-full p-2 mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="" selected>Seleccione...</option>
                                        <option value="1">PERSONA FÍSICA</option>
                                        <option value="2">PERSONA MORAL</option>
                                    </select>
                                </div> --}}
                                {{-- <div x-show="kindPersonId == '1'" class="relative w-full mb-6 group">
                                    <label class="select-none text-gray-700">¿EL PAGO ES A TU
                                        NOMBRE?</label>
                                    <select wire:model.live="own_name" x-model="ownName"
                                        class="block w-full p-2 mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="" selected>Seleccione...</option>
                                        <option value="1">SI</option>
                                        <option value="0">NO</option>
                                    </select>
                                </div> --}}
                                {{-- <div x-show="kindPersonId == '2'" class="relative w-full mb-6 group">
                                    <x-input class="uppercase" wire:model.live="business_name" label="RAZON SOCIAL"
                                        placeholder="INGRESE..." />
                                </div> --}}
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative w-full mb-6 group">
                                    <x-input wire:model.live="operation_number" label="NO. DE OPERACIÓN*"
                                        placeholder="INGRESE..." />
                                </div>
                                <div class="relative w-full mb-6 group">
                                    <x-input wire:model.live="dependency_chain" label="CADENA DE LA DEPENDENCIA"
                                        placeholder="INGRESE..." />
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative w-full mb-6 group">
                                    <x-input wire:model.live="total_paid"
                                        label="TOTAL EFECTIVAMENTE PAGADO*" mask="######" placeholder="INGRESE..." />
                                </div>
                                <div class="relative w-full mb-6 group">
                                    <x-input class="uppercase" wire:model.live="reference_number"
                                        label="LLAVE DE PAGO*" placeholder="INGRESE..."
                                        hint="verifique que la llave de pago de su voucher bancario sea igual a la que está ingresando" />
                                </div>
                            </div>
                            {{-- <div x-show="ownName == '0'">
                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative w-full mb-6 group">
                                        <x-input class="uppercase" wire:model.live="curp_search"
                                            label="INGRESA CURP" x-mask="******************" placeholder="ESCRIBE..." />
                                        <div class="text-right mt-2 mb-2">
                                            <x-filament::link x-on:click="$wire.curp_search = ''" tag="button"
                                                color="gray" icon="heroicon-m-backspace" icon-position="after"
                                                tooltip="LIMPIAR BUSQUEDA">
                                                LIMPIAR
                                            </x-filament::link>
                                            <x-filament::link wire:click="searchRenapo" tag="button" color="info"
                                                icon="heroicon-m-magnifying-glass" icon-position="after"
                                                tooltip="BUSCAR USUARIO">
                                                BUSCAR
                                            </x-filament::link>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div x-show="ownName == '1' || searchSuccess">
                                <div class="grid md:grid-cols-3 md:gap-6">
                                    <div class="relative w-full mb-6 group">
                                        <x-input label="Nombre(s)*" class="uppercase" wire:model.live="name"
                                            placeholder="INGRESE..." />
                                    </div>
                                    <div class="relative w-full mb-6 group">
                                        <x-input label="Apellido 1*" class="uppercase"
                                            wire:model.live="apParental" placeholder="INGRESE..." />
                                    </div>
                                    <div class="relative w-full mb-6 group">
                                        <x-input label="Apellido 2*" class="uppercase"
                                            wire:model.live="apMaternal" placeholder="INGRESE..." />
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div
                                x-show="kindPersonId == '1' && ownName == '1' || searchSuccess || kindPersonId == '2'">
                                <div class="grid md:grid-cols-3 md:gap-6">
                                    <div class="relative w-full mb-6 group">
                                        <x-input wire:model.live="yearExercise" label="EJERCICIO"
                                            class="bg-gray-100" placeholder="INGRESE..." readonly />
                                    </div>
                                    <div class="relative w-full mb-6 group">
                                        <x-input wire:model.live="reference_key" label="CLAVE DE REFERENCIA*"
                                            class="bg-gray-100" placeholder="INGRESE..." readonly />
                                    </div>
                                    <div class="relative w-full mb-6 group">
                                        <x-input wire:model.live="operation_number" label="NO. DE OPERACIÓN*"
                                            placeholder="INGRESE..." />
                                    </div>
                                </div>
                                <div class="grid md:grid-cols-3 md:gap-4">
                                    <div class="relative w-full mb-6 group">
                                        <x-input wire:model.live="dependency_chain"
                                            label="CADENA DE LA DEPENDENCIA" placeholder="INGRESE..." />
                                    </div>
                                    <div class="relative w-full mb-6 group">
                                        <x-inputs.maskable wire:model.live="total_paid"
                                            label="TOTAL EFECTIVAMENTE PAGADO*" mask="######"
                                            placeholder="INGRESE..." />
                                    </div>
                                </div>
                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative w-full mb-6 group">
                                        <x-input class="uppercase" wire:model.live="reference_number"
                                            label="LLAVE DE PAGO*" placeholder="INGRESE..."
                                            hint="verifique que la llave de pago de su voucher bancario sea igual a la que está ingresando" />
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="mt-5 sm:flex sm:items-center sm:-mx-2 w-full">
                        <button wire:click="searchKey"
                            class="w-full px-4 py-2 mt-4 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-black rounded-md sm:mt-0 sm:mx-2 hover:bg-[#269999] focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                            VALIDAR
                        </button>
                    </div>

                </div>
            </div>
        </div>
        {{-- <div wire:loading.delay.shortest wire:target="searchKey">
            <div class="flex justify-center bg-gray-600 z-40 h-full w-full fixed top-0 left-0 items-center opacity-75">
                <img src="{{ asset('images/isologo_AFAC_azul.png') }}" width="30%" class="opacity-80 animate-pulse mr-2">
            </div>
        </div> --}}
    </div>
</div>
