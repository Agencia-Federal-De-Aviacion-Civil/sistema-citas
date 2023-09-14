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
                    @elseif ($this->status == 7)
                    CITA APLAZADA
                    @endif
                </h3>
                <div x-data="{ selectedOption: '' }">
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
                    <div class="mt-4 grid xl:grid-cols-1 xl:gap-6">
                        <div class="mt-1 relative w-full group">
                            @if ($status == 0 || $status == 1 || $status == 2 || $status == 3 || $status == 4 || $status
                            == 5 || $status == 7)

                            <div x-show="selectedOption == '' || selectedOption == 1 || selectedOption == 2">
                                <x-input wire:model="sede" label="SEDE" disabled />
                            </div>

                            @endif
                            @if ($status == 6)
                            <x-select label="ELIJA LA SEDE" placeholder="Selecciona" wire:model.lazy="headquarter_id">
                                <x-select.option label="Seleccione opción" value="" />
                                @foreach ($sedes as $sede)
                                <x-select.option label="{{ $sede->name_headquarter }}" value="{{ $sede->id }}" />
                                @endforeach
                            </x-select>
                            @endif
                            <div x-show="selectedOption == 4">
                                <x-select label="ELIJA LA SEDE" placeholder="Selecciona"
                                    wire:model.lazy="headquarter_id">
                                    <x-select.option label="Seleccione opción" value="" />
                                    @foreach ($sedes as $sede)
                                    <x-select.option label="{{ $sede->name_headquarter }}" value="{{ $sede->id }}" />
                                    @endforeach
                                </x-select>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 grid xl:grid-cols-2 xl:gap-6">
                        @if ($status == 6)
                        <x-input wire:model.lazy="dateReserve" id="fecha-appointment-restored" label="SELECCIONE FECHA"
                            placeholder="INGRESE..." />
                        @else
                        <div class="mt-1 relative w-full group">
                            <div x-show="selectedOption == '' || selectedOption == 1 || selectedOption == 2 || selectedOption == 7">
                                <x-datetime-picker label="FECHA" placeholder="Seleccione..." without-time="false"
                                    parse-format="YYYY-MM-DD" display-format="DD-MM-YYYY" wire:model="dateReserve"
                                    disabled />
                            </div>
                            <div x-show="selectedOption == 4">
                                <x-input wire:model.lazy="dateReserve" id="fecha-appointment" label="SELECCIONE FECHA"
                                    placeholder="INGRESE..." />
                            </div>
                        </div>
                        @endif
                        @if ($status == 6)
                        <div class="relative w-full group">
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
                            <span class="mt-2 text-sm text-negative-600">{{$message}}</span>
                            @enderror
                        </div>
                        @else
                        <div class="mt-1 relative w-full group">
                            <div x-show="selectedOption == '' || selectedOption == 1 || selectedOption == 2 || selectedOption == 7">
                                <x-input wire:model="hoursReserve" label="HORA" disabled />
                            </div>
                            <div x-show="selectedOption == 4">
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
                        @endif
                    </div>

                    @if ($status == 0 || $status == 4 || $status == 7)


                    <div class="mt-6 relative w-full group">
                        <select name="my_option" label="SELECIONE OPCIÓN" x-model="selectedOption"
                            wire:model="selectedOption"
                            class="block w-full p-2 mb-2 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-300 dark:border-gray-300 dark:placeholder-gray-300 dark:text-white">

                                <option value="">SELECCIONE OPCIÓN</option>
                                @hasrole('super_admin|medicine_admin|super_admin_medicine|admin_medicine_v2|sub_headquarters|headquarters|headquarters_authorized')
                                @if ($days > 20 AND $status==7)
                                <option  value="2">CANCELAR CITA</option>
                                @else

                                <option value="1">ASISTIÓ A SU CITA</option>
                                <option value="2">CANCELAR CITA</option>

                                @endif
                                @if ($status != 7 AND $is_external == 1)
                                <option value="7">APLAZAR CITA</option>
                                @endif
                                @endhasrole
                                @hasrole('user|super_admin|medicine_admin|super_admin_medicine|admin_medicine_v2')
                                @if ($status == 0 )
                                <option value="4">REAGENDAR CITA</option>
                                @endif
                                @endhasrole


                        </select>
                        @error('selectedOption')
                        <span class="mt-2 text-sm text-negative-600">{{ $message }}</span>
                        @enderror
                    </div>
                    @endif
                    <div x-show="selectedOption == 2">
                        <div class="mt-4">
                            <x-textarea wire:model="observation" label="MOTIVO" placeholder="ESCRIBE..." />
                        </div>
                    </div>
                    @if ($this->status == 2)
                    <div class="mt-4">
                        <x-textarea wire:model="observation" label="MOTIVO" placeholder="ESCRIBE..." disabled />
                    </div>
                    @endif
                    <div x-show="selectedOption == 4">
                        <div class="mt-4">
                            <x-textarea wire:model="observation" label="MOTIVO" placeholder="ESCRIBE..." />
                        </div>
                    </div>
                    <div x-show="selectedOption != 2">
                        @if ($this->status == 4 || $this->status == 7)
                        <div class="mt-4">
                            <x-textarea wire:model="observation" label="MOTIVO" placeholder="ESCRIBE..." disabled />
                        </div>
                        @endif
                    </div>
                    <div x-show="selectedOption == 7">
                        <div class="mt-4">
                            <x-textarea wire:model="observation" label="MOTIVO" placeholder="ESCRIBE..." />
                        </div>
                    </div>
                </div>
                <div class="flex justify-end items-center gap-x-2 p-5 sm:px-7">
                    @hasrole('super_admin|medicine_admin|super_admin_medicine|admin_medicine_v2|headquarters_authorized')
                    @if ($status == 0 || $status == 4 || $status == 6 || $status == 7)
                    <div class="float-right mt-6">
                        <x-button wire:click="reschedules()" label="ACEPTAR" blue right-icon="save-as" />
                    </div>
                    @endif
                    @endhasrole
                    @hasrole('user')
                    @if ($status == 0)
                    <div class="float-right mt-6">
                    <x-button wire:click="reschedules()" label="ACEPTAR" blue right-icon="save-as" />
                    </div>
                    @endif
                    @endhasrole
                    @hasrole('super_admin|super_admin_medicine')
                    @if ($this->status == 3 || $this->status == 2)
                    <div class="float-right mt-6">
                    <x-button wire:click.prevent="saveActive" spinner="saveActive" loading-delay="short" sm
                            icon="key" positive label="LIBERAR LLAVE DE PAGO" />
                    </div>
                    @endif
                    @endhasrole
                    <div class="float-left mt-6">
                        <x-button wire:click="$emit('closeModal')" label="SALIR" silver />
                    </div>
                </div>
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
            flatpickr("#fecha-appointment-restored", {
                dateFormat: "Y-m-d",
                disableMobile: "true",
                // minDate: "today",
                maxDate: new Date(new Date().getFullYear(), 11, 31),
                disable: [
                function(date) {
                    // Devuelve 'true' si la fecha es un sábado o domingo
                    return date.getDay() === 6 || date.getDay() === 0;
                },
            ],
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
