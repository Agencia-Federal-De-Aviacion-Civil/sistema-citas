<div>
    <x-notifications position="top-bottom" />
    <div class="relative py-6 lg:py-4">
        <img class="z-0 w-full h-full absolute inset-0 object-cover" src="{{ asset('images/banner_testing.jpg') }}"
            alt="bg" />
        <div
            class="z-10 relative container px-6 mx-auto flex flex-col md:flex-row items-start md:items-center justify-between">
            <div>
                <h4 tabindex="0" class="focus:outline-none text-2xl font-bold leading-tight text-white">Administración
                    de Sedes</h4>
                <ul class="flex flex-col md:flex-row items-start md:items-center text-gray-300 text-sm mt-3">
                    <li class="flex items-center mt-4 md:mt-0">
                        <div class="mr-1">
                            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/background_with_sub_text-svg3.svg"
                                alt="date">
                        </div>
                        <span tabindex="0" class="focus:outline-none">
                            {{ $dateNow }}
                        </span>
                        {{-- <p>Estado de la conexión: <span id="connection-status"></span></p> --}}
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">
            <div class="mt-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div x-data="{ activeTab: 'headquarters' }">
                    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 ">
                        <li class="mr-2">
                            <a href="#" class="inline-block p-4 bg-white rounded-t-lg active"
                                x-on:click.prevent="activeTab = 'headquarters'"
                                :class="{ 'text-blue-600 border-b-2 border-blue-500': activeTab === 'headquarters'}">
                                SEDES
                            </a>
                        </li>
                        <li class="mr-2">
                            <a href="#" class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50"
                                x-on:click.prevent="activeTab = 'schedules'"
                                :class="{ 'text-blue-600 border-b-2 border-blue-500': activeTab === 'schedules' }">
                                HORARIOS
                            </a>
                        </li>
                    </ul>
                    <div class="mt-6">
                        <div x-show="activeTab === 'headquarters'">
                            <div class="mb-6">
                                <x-button wire:click="$emit('openModal', 'headquarters.modals.create-update-modal')"
                                    icon="pencil" primary label="AÑADIR" />
                            </div>
                            <livewire:headquarter-table>
                        </div>
                        <div x-show="activeTab === 'schedules'">
                            {{-- <div class="flex-grow pl-4"> --}}
                            <div class="mb-6">
                                <x-button
                                    wire:click="$emit('openModal', 'headquarters.modals.create-update-schedule-modal')"
                                    icon="calendar" primary label="DESHABILITAR FECHAS" />
                            </div>
                            {{-- <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="mt-1 relative w-full group">
                                        <x-select label="SELECCIONE..." placeholder="SELECCIONE UNA SEDE..."
                                            wire:model.lazy="user_headquarters_id">
                                            @foreach ($headquarters as $headquarter)
                                                <x-select.option label="{{ $headquarter->headquarterUser->name }}"
                                                    value="{{ $headquarter->headquarterUser->id }}" />
                                            @endforeach
                                            <x-select.option label="TODOS" value="0" />
                                        </x-select>
                                    </div>
                                    <div class="mt-1 relative z-0 w-full group">
                                        <x-input wire:model.lazy="disabled_days" id="fecha-appointment"
                                            label="DESHABILITAR CITAS" placeholder="INGRESE..." readonly />
                                    </div>
                                </div> --}}
                            {{-- </div> --}}
                            {{-- <div class="mt-8">
                                <x-button wire:click.prevent="save" icon="home" label="GUARDAR" />
                            </div> --}}
                            <div class="mt-2">
                                <livewire:disabled-day-table />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                flatpickr("#fecha-appointment", {
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
            });
        </script>
    </div>
