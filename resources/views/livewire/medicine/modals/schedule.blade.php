<div
    class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-0 sm:my-0 sm:align-middle sm:max-w-2xl sm:w-full sm:p-1"
    >
    <div>
        <div class="p-0 text-center">
            {{-- <h1>REAGENDAR CITA</h1> --}}
        </div>
        <div class="mt-4 text-center">
            <h3 class="text-xl font-semibold leading-6 text-gray-800 capitalize dark:text-white" id="modal-title">
                @if ($this->status == 0)
                    CITA
                @elseif ($this->status == 1)
                    CITA ASISTIDA
                @elseif ($this->status == 2)
                    CITA CANCELADA
                @elseif ($this->status == 3)
                    CANCELO CITA
                @elseif ($this->status == 4)
                    CITA REAGENDADA
                @endif

            </h3>
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

            @if ($this->status != 0)

                <div class="grid xl:grid-cols-1 xl:gap-6">
                    <div class="mt-4 relative w-full group">
                        <x-input wire:model="sede" label="SEDE" disabled />
                    </div>
                </div>
                <div class="grid xl:grid-cols-2 xl:gap-6">

                    <div class="mt-1 relative w-full group">
                        <x-datetime-picker label="FECHA" placeholder="Seleccione..." without-time="false"
                            parse-format="YYYY-MM-DD" display-format="DD-MM-YYYY" wire:model="dateReserve" disabled />
                    </div>
                    <div class="mt-1 relative w-full group">
                        <x-input wire:model="hoursReserve" label="HORA" disabled />
                    </div>
                </div>
                @if ($this->status == 2)
                    <div class="grid xl:grid-cols-1 xl:gap-6">
                        <x-textarea wire:model="comment" label="MOTIVO" disabled />
                    </div>
                @endif
                <div class="float-left mt-6">
                    <x-button wire:click="$emit('closeModal')" label="SALIR" silver />
                </div>
            @else
                <div x-data="{ selectedOption: '' }">
                    <div class="grid xl:grid-cols-1 xl:gap-0">
                        {{-- <p class="w-1/2">Select option:</p> --}}
                        <div x-show="selectedOption!='4'">
                            <div class="grid xl:grid-cols-1 xl:gap-6">
                                <div class="mt-4 relative w-full group">
                                    <x-input wire:model="sede" label="SEDE" disabled />
                                </div>
                            </div>

                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="mt-1 relative w-full group">
                                    <x-datetime-picker label="FECHA" placeholder="Seleccione..." without-time="false"
                                        parse-format="YYYY-MM-DD" display-format="DD-MM-YYYY" wire:model="dateReserve"
                                        disabled />
                                </div>
                                <div class="mt-1 relative w-full group">
                                    <x-input wire:model="hoursReserve" label="HORA" disabled />
                                </div>
                            </div>

                        </div>

                        <div x-show="selectedOption=='4'">
                            <div class="grid xl:grid-cols-1 xl:gap-6">
                                <div class="mt-4 relative w-full group">
                                    <x-select label="ELIJA LA SEDE" placeholder="Selecciona" x-ref="selec_sede"
                                        wire:model.lazy="to_user_headquarters">
                                        @foreach ($sedes as $sede)
                                            <x-select.option label="{{ $sede->headquarterUser->name }}"
                                                value="{{ $sede->headquarterUser->id }}" />
                                        @endforeach
                                    </x-select>
                                </div>
                            </div>
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="mt-4 relative w-full group">
                                    <x-datetime-picker label="SELECCIONE FECHA" placeholder="Seleccione..."
                                        without-time="false" parse-format="YYYY-MM-DD" display-format="DD-MM-YYYY"
                                        wire:model="dateReserve" />
                                </div>

                                <div class="mt-4 relative w-full group">
                                    <label>SELECCIONE HORA</label>
                                    <select id="small" label="SELECCIONE HORA" placeholder="seleccione..."
                                        wire:model.lazy="medicine_schedule_id"
                                        class="block w-full p-2 mb-2 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">Seleccione...</option>
                                        @foreach ($scheduleMedicines as $scheduleMedicine)
                                            <option value="{{ $scheduleMedicine->id }}">
                                                {{ $scheduleMedicine->time_start }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div x-show="selectedOption=='2'">
                            <x-textarea wire:model="comment" label="MOTIVO" placeholder="¿motivo de cancelación?" />
                        </div>
                        <div x-show="selectedOption=='1'">

                        </div>
                    </div>

                    <div class="mt-6 relative w-full group">
                        <select name="my_option" label="SELECIONE OPCIÓN" x-model="selectedOption"
                            wire:model="selectedOption" class="">
                            <option value="">SELECIONE OPCION</option>
                            <option value="1">ASISTIO CITA</option>
                            <option value="2">CANCELAR CITA</option>
                            <option value="4">REAGENDAR CITA</option>

                        </select>
                    </div>
                                        
                </div>

                <div class="float-right mt-6">
                    <x-button wire:click="reschedules()" label="ACEPTAR" blue right-icon="save-as" />
                </div>
                <div class="float-left mt-6">
                    <x-button wire:click="$emit('closeModal')" label="SALIR" silver />
                </div>
            @endif
        </div>
    </div>
