<div>
    <div class="p-4 sm:p-7">
        <div>
            <div class="mt-4 text-center">
                <h3 class="text-xl font-semibold leading-6 text-gray-800 capitalize dark:text-white" id="modal-title">
                    @if ($this->status == 0)
                        CITA
                    @elseif ($this->status == 1)
                        CITA VALIDADA
                    @elseif ($this->status == 2)
                        CITA CANCELADA
                    @elseif ($this->status == 3)
                        CANCELÓ CITA
                    @elseif ($this->status == 4)
                        CITA REAGENDADA
                    @endif

                </h3>
                <div class="grid xl:grid-cols-1 xl:gap-6">
                    <div class="mt-1 relative w-full group">
                        <x-input wire:model="name" label="NOMBRE" placeholder="ESCRIBE..." disabled />
                    </div>
                </div>
                <div class="mt-4 grid xl:grid-cols-2 xl:gap-6">
                    <div class="mt-1 relative w-full group">
                        <x-input wire:model="type" label="TIPO" placeholder="ESCRIBE..." disabled />
                    </div>
                    <div class="mt-1 relative w-full group">
                        <x-input wire:model="class" label="CLASE" placeholder="ESCRIBE..." disabled />
                    </div>
                </div>
                <div class="mt-4 grid xl:grid-cols-1 xl:gap-6">
                    <div class="mt-1 relative w-full group">
                        <x-input wire:model="typLicense" label="TIPO DE LICENCIA" disabled />
                    </div>
                </div>
                @if ($this->status != 0)
                    <div class="mt-4 grid xl:grid-cols-1 xl:gap-6">
                        <div class="mt-1 relative w-full group">
                            <x-input wire:model="sede" label="SEDE" disabled />
                        </div>
                    </div>
                    <div class="mt-4 grid xl:grid-cols-2 xl:gap-6">
                        <div class="mt-1 relative w-full group">
                            <x-datetime-picker label="FECHA" placeholder="Seleccione..." without-time="false"
                                parse-format="YYYY-MM-DD" display-format="DD-MM-YYYY" wire:model="dateReserve"
                                disabled />
                        </div>
                        <div class="mt-1 relative w-full group">
                            <x-input wire:model="hoursReserve" label="HORA" disabled />
                        </div>
                    </div>
                    @if ($this->status == 2)
                        <div class="mt-4 grid xl:grid-cols-1 xl:gap-6">
                            <x-textarea wire:model="comment" label="MOTIVO" disabled />
                        </div>
                    @elseif($this->status == 4)
                        @if ($this->selectedOption == 2)
                            <div class="mt-4 grid xl:grid-cols-1 xl:gap-6">
                                <x-textarea wire:model="comment_cancelate" label="MOTIVO" />
                            </div>
                        @else
                            <div class="mt-4 grid xl:grid-cols-1 xl:gap-6">
                                <x-textarea wire:model="comment" label="MOTIVO" disabled />
                            </div>
                        @endif
                        @hasrole('super_admin|medicine_admin|super_admin_medicine|admin_medicine_v2')
                            <div class="mt-6 relative w-full group">
                                <select name="my_option" label="SELECIONE OPCIÓN" x-model="selectedOption"
                                    wire:model="selectedOption"
                                    class="block w-full p-2 mb-2 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-300 dark:border-gray-300 dark:placeholder-gray-300 dark:text-white">
                                    <option value="">SELECCIONE OPCIÓN</option>
                                    <option value="1">ASISTIÓ A SU CITA</option>
                                    <option value="2">CANCELAR CITA</option>
                                </select>
                            </div>
                            @error('selectedOption')
                                <span class="mt-2 text-sm text-negative-600">{{ $message }}</span>
                            @enderror
                            <div class="float-right mt-6">
                                <x-button wire:click="reschedules()" label="ACEPTAR" blue right-icon="save-as" />
                            </div>
                        @endhasrole
                    @endif
                    <div class="mt-6 float-right mb-6">
                        <x-button sm icone="exit" wire:click="$emit('closeModal')" label="SALIR" silver />
                    </div>
                    @hasrole('super_admin|super_admin_medicine')
                        @if ($this->status == 3 || $this->status == 2)
                            <div class="float-right mt-6">
                                <x-button wire:click.prevent="saveActive" spinner="saveActive" loading-delay="short" sm
                                    icon="key" positive label="LIBERAR LLAVE DE PAGO" />
                            </div>
                        @endif
                    @endhasrole
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

                                <div class="mt-4 grid xl:grid-cols-2 xl:gap-6">
                                    <div class="mt-1 relative w-full group">
                                        <x-datetime-picker label="FECHA" placeholder="Seleccione..."
                                            without-time="false" parse-format="YYYY-MM-DD" display-format="DD-MM-YYYY"
                                            wire:model="dateReserve" disabled />
                                    </div>
                                    <div class="mt-1 relative w-full group">
                                        <x-input wire:model="hoursReserve" label="HORA" disabled />
                                    </div>
                                </div>
                            </div>

                            <div x-show="selectedOption=='4'">
                                <div class="grid xl:grid-cols-1 xl:gap-6">
                                    <div class="mt-4 relative w-full group">
                                        <x-select label="ELIJA LA SEDE" placeholder="Selecciona"
                                            wire:model.lazy="headquarter_id">
                                            <x-select.option label="Seleccione opción" value="" />
                                            @foreach ($sedes as $sede)
                                                <x-select.option label="{{ $sede->name_headquarter }}"
                                                    value="{{ $sede->id }}" />
                                            @endforeach
                                        </x-select>
                                    </div>
                                </div>
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="mt-4 relative w-full group">
                                        <x-input wire:model.lazy="dateReserve" id="fecha-appointment"
                                            label="SELECCIONE FECHA" placeholder="INGRESE..." />
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
                                        @error('medicine_schedule_id')
                                            <span class="mt-2 text-sm text-negative-600">Seleccione opción</span>
                                        @enderror

                                    </div>
                                </div>
                                <x-textarea wire:model="comment" label="MOTIVO"
                                    placeholder="¿motivo de reagendar?" />
                            </div>
                            <div class="mt-4" x-show="selectedOption=='2'">
                                <x-textarea wire:model="comment_cancelate" label="MOTIVO"
                                    placeholder="¿motivo de cancelación?" />
                            </div>

                            <div x-show="selectedOption=='1'">
                                {{-- <x-checkbox label="¿EL USUARIO ASISTIÓ A SU CITA?" id="checkbox" wire:model="attended" /> --}}
                            </div>
                        </div>

                        @hasrole('super_admin|medicine_admin|super_admin_medicine|admin_medicine_v2')
                            <div class="mt-6 relative w-full group">
                                <select name="my_option" label="SELECIONE OPCIÓN" x-model="selectedOption"
                                    wire:model="selectedOption"
                                    class="block w-full p-2 mb-2 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-300 dark:border-gray-300 dark:placeholder-gray-300 dark:text-white">
                                    <option value="">SELECCIONE OPCIÓN</option>
                                    <option value="1">ASISTIÓ A SU CITA</option>
                                    <option value="2">CANCELAR CITA</option>
                                    <option value="4">REAGENDAR CITA</option>
                                </select>
                            </div>
                        @endhasrole
                        @hasrole('headquarters|sub_headquarters')
                            <div class="mt-6 relative w-full group">
                                <select name="my_option" label="SELECIONE OPCIÓN" x-model="selectedOption"
                                    wire:model="selectedOption"
                                    class="block w-full p-2 mb-2 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-300 dark:border-gray-300 dark:placeholder-gray-300 dark:text-white">
                                    <option value="">SELECCIONE OPCIÓN</option>
                                    <option value="1">ASISTIÓ A SU CITA</option>
                                    <option value="2">CANCELAR CITA</option>
                                </select>
                            </div>
                        @endhasrole
                        @error('selectedOption')
                            <span class="mt-2 text-sm text-negative-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end items-center gap-x-2 p-5 sm:px-7 border-t dark:border-gray-700">
                        <div class="float-right mt-6">
                            <x-button wire:click="reschedules()" label="ACEPTAR" blue right-icon="save-as" />
                        </div>
                        <div class="float-left mt-6">
                            <x-button wire:click="$emit('closeModal')" label="SALIR" silver />
                        </div>
                    </div>

                @endif
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('headquartersUpdated', event => {
            flatpickr("#fecha-appointment", {
                dateFormat: "Y-m-d",
                disableMobile: "true",
                minDate: "today",
                maxDate: new Date(new Date().getFullYear(), 11, 31),
                disable: event.detail.disabledDaysFilter,
                onDayCreate: function(dObj, dStr, fp, dayElem) {
                    if (dayElem.dateObj.getDay() === 0 || dayElem.dateObj.getDay() === 6) {
                        dayElem.className +=
                            " flatpickr-disabled nextMonthDayflatpickr-disabled";
                    }
                },
                locale: {
                    weekdays: {
                        shorthand: ['Dom', 'Lun', 'Mar', 'Mier', 'Jue', 'Vie', 'Sab'],
                        longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes',
                            'Sábado'
                        ],
                    },
                    months: {
                        shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct',
                            'Nov', 'Dic'
                        ],
                        longhand: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                            'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                        ],
                    },
                },
            });
        });
    </script>
</div>
