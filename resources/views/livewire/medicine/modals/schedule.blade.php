<div>
    <div class="p-4 sm:p-7">
        <div>
            <div class="mt-4 text-center">
                <x-errors></x-errors>
                <h3 class="text-xl font-semibold leading-6 text-gray-800 capitalize dark:text-white" id="modal-title">
                    @if ($this->status == 0)
                        <x-banner-modal-icon :title="'CITA PENDIENTE'" :size="'w-16 h-16'" :icon="'calendar-edit'" :titlesize="'xl'" />
                        {{-- CITA --}}
                    @elseif ($this->status == 1)
                        <x-banner-modal-icon :title="'CITA VALIDADA'" :size="'w-16 h-16'" :icon="'calendar-check'" :titlesize="'xl'" />
                        {{-- CITA VALIDADA --}}
                    @elseif ($this->status == 2)
                        <x-banner-modal-icon :title="'CITA CANCELADA'" :size="'w-16 h-16'" :icon="'calendar-cancel'"
                            :titlesize="'xl'" />
                        {{-- CITA CANCELADA --}}
                    @elseif ($this->status == 3)
                        <x-banner-modal-icon :title="'CANCELÓ CITA'" :size="'w-16 h-16'" :icon="'calendar-cancel'"
                            :titlesize="'xl'" />
                        {{-- CANCELÓ CITA --}}
                    @elseif ($this->status == 4)
                        <x-banner-modal-icon :title="'CITA REAGENDADA'" :size="'w-16 h-16'" :icon="'calendar-edit'"
                            :titlesize="'xl'" />
                        {{-- CITA REAGENDADA --}}
                    @elseif ($this->status == 5)
                        <x-banner-modal-icon :title="'CITA CON LLAVE LIBERADA'" :size="'w-16 h-16'" :icon="'key'"
                            :titlesize="'xl'" />
                        {{-- CITA REAGENDADA --}}
                    @elseif ($this->status == 6)
                        <x-banner-modal-icon :title="'CITA INCOMPLETA'" :size="'w-16 h-16'" :icon="'calendar-edit'"
                            :titlesize="'xl'" />
                        <div class="bg-blue-50 border border-blue-200 rounded-md p-3" role="alert">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-3 w-3 text-blue-600 mt-1" xmlns="http://www.w3.org/2000/svg"
                                        width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path
                                            d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <div class="mt-2 text-sm text-gray-600">
                                        completar la información de la cita
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{-- CITA INCOMPLETA --}}
                    @elseif ($this->status == 7)
                        <x-banner-modal-icon :title="'CITA APLAZADA'" :size="'w-16 h-16'" :icon="'calendar-edit'"
                            :titlesize="'xl'" />
                        {{-- CITA APLAZADA --}}
                    @elseif ($this->status == 10)
                        <x-banner-modal-icon :title="'REAGENDO CITA'" :size="'w-16 h-16'" :icon="'calendar-edit'"
                            :titlesize="'xl'" />
                        {{-- REAGENDO CITA --}}
                    @endif

                </h3>
                <div x-data="{ selectedOption: @entangle('selectedOption') }">
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
                    @isset($this->medicineRextension[0]->id)
                        @if ($status == 8)
                            <label class="mt-4 grid xl:grid-cols-6">EXTENSION: <x-badge class="ml-2" flat positive
                                    label="CONCLUYÓ APTO" /></label>
                        @elseif($status == 9)
                            <label class="mt-4 grid xl:grid-cols-6">EXTENSION: <x-badge class="ml-2" flat negative
                                    label="CONCLUYÓ NO APTO" /></label>
                        @elseif($this->typextension == 'SIN DATOS' && $this->status == 0)
                        @else
                            {{-- <label class="mt-4 grid xl:grid-cols-6">EXTENSION </label> --}}
                            <div class="text-center py-2">
                                <h1 class="mt-4 text-xl font-bold text-gray-500">EXTENSION</h1>
                            </div>
                        @endif

                        @if ($this->typextension == 'SIN DATOS' && $this->status == 0)
                        @else
                            <div class="mt-0 grid xl:grid-cols-2 xl:gap-6">
                                <div class="mt-1 relative w-full group">
                                    <x-input wire:model="typextension" label="TIPO" placeholder="ESCRIBE..." disabled />
                                </div>
                                <div class="mt-1 relative w-full group">
                                    <x-input wire:model="classxtension" label="CLASE" placeholder="ESCRIBE..." disabled />
                                </div>
                            </div>
                            <div class="mt-4 grid xl:grid-cols-1 xl:gap-6">
                                <div class="mt-1 relative w-full group">
                                    <x-input wire:model="typLicensextension" label="TIPO DE LICENCIA" disabled />
                                </div>
                            </div>
                        @endif
                    @endisset
                    <div class="mt-4 grid xl:grid-cols-1 xl:gap-6">
                        <div class="mt-1 relative w-full group">
                            @if (
                                $status == 0 ||
                                    $status == 1 ||
                                    $status == 2 ||
                                    $status == 3 ||
                                    $status == 4 ||
                                    $status == 5 ||
                                    $status == 7 ||
                                    $status == 10)
                                <div
                                    x-show="selectedOption == '' || selectedOption == 1 || selectedOption == 2 || selectedOption == 7||selectedOption == 3">
                                    <x-input wire:model="sede" label="SEDE" disabled />
                                </div>
                            @endif
                            @if ($status == 6)
                                <x-select label="ELIJA LA SEDE" placeholder="Selecciona"
                                    wire:model.lazy="headquarter_id">
                                    <x-select.option label="Seleccione opción" value="" />
                                    @foreach ($sedes as $sede)
                                        <x-select.option label="{{ $sede->name_headquarter }}"
                                            value="{{ $sede->id }}" />
                                    @endforeach
                                </x-select>
                            @endif
                            <div x-show="selectedOption == 4||selectedOption == 10">
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
                    </div>
                    <div class="mt-4 grid xl:grid-cols-2 xl:gap-6">
                        @if ($status == 6)
                            <x-input wire:model.lazy="dateReserve" id="fecha-appointment-restored"
                                label="SELECCIONE FECHA" placeholder="INGRESE..." readonly />
                        @else
                            <div class="mt-1 relative w-full group">
                                <div
                                    x-show="selectedOption == '' || selectedOption == 1 || selectedOption == 2 || selectedOption == 7|| selectedOption == 3">
                                    <x-datetime-picker label="FECHA" placeholder="Seleccione..." without-time="false"
                                        parse-format="YYYY-MM-DD" display-format="DD-MM-YYYY" wire:model="dateReserve"
                                        disabled />
                                </div>
                                <div x-show="selectedOption == 4||selectedOption == 10">
                                    <x-input wire:model.lazy="dateReserve" id="fecha-appointment"
                                        label="SELECCIONE FECHA" placeholder="INGRESE..." readonly />
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
                                    <span class="mt-2 text-sm text-negative-600">{{ $message }}</span>
                                @enderror
                            </div>
                        @else
                            <div class="mt-1 relative w-full group">
                                <div
                                    x-show="selectedOption == '' || selectedOption == 1 || selectedOption == 2 || selectedOption == 7 || selectedOption == 3 ">
                                    <x-input wire:model="hoursReserve" label="HORA" disabled />
                                </div>
                                <div x-show="selectedOption == 4||selectedOption == 10">
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

                    @if ($status == 0 || $status == 4 || $status == 7 || $status == 10)
                        <div class="mt-6 relative w-full group">
                            @hasrole('user')
                                <div class="bg-blue-50 border border-blue-200 rounded-md p-4" role="alert">
                                    <div class="flex text-left">
                                        <div class="flex-shrink-0">
                                            <svg class="h-4 w-4 text-blue-600 mt-1" xmlns="http://www.w3.org/2000/svg"
                                                width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                            </svg>
                                        </div>
                                        <div class="ml-2">
                                            <h3 class="text-gray-800 font-semibold">
                                                Nota importante
                                            </h3>
                                            <div class="mt-1 text-sm text-gray-600">
                                                Solo podras realiza una acción por cita <b>(Reagendar ó cancelar)</b>
                                                verificar antes de aceptar.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <select name="my_option" label="SELECIONE OPCIÓN" x-model="selectedOption"
                                        wire:model="selectedOption"
                                        class="block w-full p-2 mb-2 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-300 dark:border-gray-300 dark:placeholder-gray-300 dark:text-white">
                                        <option value="">SELECCIONE LA ACCIÓN</option>
                                        <option value="3">CANCELAR CITA</option>
                                        <option value="10">REAGENDAR CITA</option>
                                    </select>
                                </div>
                            @else
                                <select name="my_option" label="SELECIONE OPCIÓN" x-model="selectedOption"
                                    wire:model="selectedOption"
                                    class="block w-full p-2 mb-2 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-300 dark:border-gray-300 dark:placeholder-gray-300 dark:text-white">
                                    {{-- @endhasrole --}}
                                    <option value="">SELECCIONE OPCIÓN</option>
                                    @if ($days > 20 and $status == 7)
                                        <option value="2">CANCELAR CITA</option>
                                    @else
                                        <option value="1">ASISTIÓ A SU CITA</option>
                                        <option value="2">CANCELAR CITA</option>
                                    @endif

                                    @if ($status != 7)
                                        <option value="7">APLAZAR CITA</option>
                                    @endif

                                    @hasrole('super_admin|medicine_admin|super_admin_medicine|admin_medicine_v2')
                                        @if ($status == 0)
                                            <option value="4">REAGENDAR CITA</option>
                                        @endif
                                    @endhasrole
                                </select>
                            @endhasrole
                            @error('selectedOption')
                                <span class="mt-2 text-sm text-negative-600">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                    <div x-show="selectedOption == 2|selectedOption == 3">
                        <div class="mt-4">
                            <x-textarea wire:model="observation" label="MOTIVO" placeholder="ESCRIBE..." />
                        </div>
                    </div>
                    @if ($this->status == 2)
                        <div class="mt-4">
                            <x-textarea wire:model="observation" label="MOTIVO" placeholder="ESCRIBE..." disabled />
                        </div>
                    @endif
                    <div x-show="selectedOption == 4|selectedOption == 10">
                        <div class="mt-4">
                            <x-textarea wire:model="observation" label="MOTIVO" placeholder="ESCRIBE..." />
                        </div>
                    </div>
                    <div x-show="selectedOption != 2">
                        @if ($this->status == 4 || $this->status == 7 || $this->status == 10)
                            <div class="mt-4">
                                <x-textarea wire:model="observation" label="MOTIVO" placeholder="ESCRIBE..."
                                    disabled />
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
                    @if ($status == 0 || $status == 4 || $status == 6 || $status == 7 || $status == 10)
                        <div class="float-right mt-6">
                            <x-button wire:click="reschedules()" label="ACEPTAR" blue right-icon="save-as" />
                        </div>
                    @endif
                    @hasrole('super_admin|super_admin_medicine')
                        @if ($this->status == 3 || $this->status == 2)
                            {{-- <div class="float-right mt-6">
                                <x-button wire:click.prevent="saveActive" spinner="saveActive" loading-delay="short" sm
                                    icon="key" positive label="LIBERAR LLAVE DE PAGO" />
                            </div> --}}
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
            // dateMin = event.detail.dateMin;
            // dateMax = event.detail.dateMax;
            flatpickr("#fecha-appointment", {
                // dateFormat: "Y-m-d",
                // disableMobile: "true",
                // minDate: "today",
                // maxDate: new Date(new Date().getFullYear(), 11, 31),
                // disable: event.detail.disabledDaysFilter,
                // enableTime: true,
                // time_24hr: true,
                dateFormat: "Y-m-d",
                // minTime: "07:00",
                // maxTime: "10:59",
                disableMobile: "true",
                // minuteIncrement: 10,
                minDate: "today",
                maxDate: new Date(new Date().getFullYear(), 11, 31),
                // minDate: event.detail.dateMin,
                // maxDate: event.detail.dateMax,
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
        //TODO JANUARY APPOINTMENT
        flatpickr("#date_pay", {
            dateFormat: "Y-m-d",
            disableMobile: "true",
            minDate: "2024-01-01",
            maxDate: "2024-01-31",
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
    </script>
</div>
