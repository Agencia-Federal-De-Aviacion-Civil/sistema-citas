<div>
    <div class="p-4 m-auto bg-white shadow-lg rounded-2xl dark:bg-gray-800">
        <div class="w-full h-full text-center">
            <div class="flex flex-col justify-between h-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-20 h-20 m-auto mt-4 text-indigo-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                </svg>
                {{ $id_disabledDays }}
                @if (empty($days))
                    <div class="mt-12 relative w-full group">
                        <label for="sedes" class="px-6 py-2 text-xs text-gray-600 dark:text-gray-400e">SELECCIONE
                            SEDE</label>
                        <x-select placeholder="SELECCIONE UNA SEDE..." wire:model.lazy="user_headquarters_id">
                            @foreach ($headquarters as $headquarter)
                                <x-select.option label="{{ $headquarter->headquarterUser->name }}"
                                    value="{{ $headquarter->headquarterUser->id }}" />
                            @endforeach
                            {{-- <x-select.option label="TODOS" value="0" /> --}}
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
                    <button wire:click="$emit('closeModal')"
                        class="py-2 px-4  bg-white hover:bg-gray-100 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-indigo-500 w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                        CERRAR
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
