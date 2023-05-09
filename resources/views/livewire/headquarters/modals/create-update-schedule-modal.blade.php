<div>
    <div class="p-4 m-auto bg-white shadow-lg rounded-2xl dark:bg-gray-800">
        <div class="w-full h-full text-center">
            <div class="flex flex-col justify-between h-full">
                <svg width="40" height="40" class="w-12 h-12 m-auto mt-4 text-indigo-500" fill="currentColor"
                    viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M704 1376v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm256 0v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm256 0v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm-544-992h448l-48-117q-7-9-17-11h-317q-10 2-17 11zm928 32v64q0 14-9 23t-23 9h-96v948q0 83-47 143.5t-113 60.5h-832q-66 0-113-58.5t-47-141.5v-952h-96q-14 0-23-9t-9-23v-64q0-14 9-23t23-9h309l70-167q15-37 54-63t79-26h320q40 0 79 26t54 63l70 167h309q14 0 23 9t9 23z">
                    </path>
                </svg>
                @if (empty($days))
                    <p class="mt-4 text-xl font-bold text-gray-800 dark:text-gray-200">
                        DESHABILITAR DÍAS
                    </p>
                    <div class="mt-12 relative w-full group">
                        <label for="sedes" class="px-6 py-2 text-xs text-gray-600 dark:text-gray-400e">SELECCIONE
                            SEDE</label>
                        <x-select placeholder="SELECCIONE UNA SEDE..." wire:model.lazy="user_headquarters_id">
                            @foreach ($headquarters as $headquarter)
                                <x-select.option label="{{ $headquarter->headquarterUser->name }}"
                                    value="{{ $headquarter->headquarterUser->id }}" />
                            @endforeach
                            <x-select.option label="TODOS" value="0" />
                        </x-select>
                    </div>
                    <div class="mt-6 relative z-0 w-full group">
                        <label for="sedes" class="px-6 py-2 text-xs text-gray-600 dark:text-gray-400e">SELECCIONE
                            FECHAS</label>
                        <x-input wire:model.lazy="disabled_days" id="enabled-days" placeholder="INGRESE..." readonly />
                    </div>
                @else
                    <p class="mt-4 text-xl font-bold text-gray-800 dark:text-gray-200">
                        {{ $nameHeadquarter->name }}
                    </p>
                    <div class="mt-6 relative z-0 w-full group">
                        <label for="sedes" class="px-6 py-2 text-xs text-gray-600 dark:text-gray-400e">SELECCIONE
                            FECHAS</label>
                        <x-input wire:model.lazy="disabled_days" id="enabled-days" placeholder="INGRESE..." readonly />
                    </div>
                @endif
                <div class="flex items-center justify-between w-full gap-4 mt-8">
                    <button wire:click.prevent="actionSave()"
                        class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                        ACEPTAR
                    </button>
                    <button type="button"
                        class="py-2 px-4  bg-white hover:bg-gray-100 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-indigo-500 w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">
        <div class="mt-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            SELECCIONA LOS DIAS QUE DESEAS VOLVER A HABILITAR
            <div class="grid xl:grid-cols-2 xl:gap-6">
                @if (empty($days))
                    <div class="mt-1 relative w-full group">
                        <label for="sedes"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SELECCIONE
                            SEDE</label>
                        <select id="sedes" wire:model.lazy="user_headquarters_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected>SELECCIONE UNA OPCIÓN</option>
                            @foreach ($headquarters as $headquarter)
                                <option value="{{ $headquarter->headquarterUser->id }}">
                                    {{ $headquarter->headquarterUser->name }}</option>
                            @endforeach
                            <option value="0">TODOS</option>
                        </select>
                    </div>
                @endif
                <div class="mt-1 relative z-0 w-full group">
                    <x-input wire:model.lazy="disabled_days" id="enabled-days" label="SELECCIONE"
                        placeholder="INGRESE..." readonly />
                </div>
            </div>
            <div class="mt-3 mb-2">
                <x-button sm wire:click.prevent="actionSave()" label="HABILITAR" info right-icon="check" />
            </div>
        </div>
    </div> --}}
    <script>
        flatpickr("#enabled-days", {
            dateFormat: "Y-m-d",
            disableMobile: "true",
            mode: 'multiple',
            minDate: "today",
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
    </script>
</div>
