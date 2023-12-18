<div>
    <x-notifications position="top-bottom" />
    <x-banner-component :title="'Administración de Sedes'" />
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-8 py-8 uppercase">
                {{-- BUSCAR X-DATA CON CONDICION POR PERMISOS --}}
                    @canany(['medicine_admin.see.tabs.navigation','super_admin.see.tabs.navigation'])
                    <div x-data="{ activeTab: 'headquarters' }">
                    @endcanany
                    @can('headquarters_authorized.see.schedules.table')
                    <div x-data="{ activeTab: 'schedules' }">
                    @endcan
                    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 ">
                        @canany(['medicine_admin.see.tabs.navigation','super_admin.see.tabs.navigation'])
                        <li class="mr-2">
                            <a href="#" class="inline-block p-4 bg-white rounded-t-lg active"
                                x-on:click.prevent="activeTab = 'headquarters'"
                                :class="{ 'text-blue-600 border-b-2 border-blue-500': activeTab === 'headquarters'}">
                                SEDES
                            </a>
                        </li>
                        @endcanany
                        @canany(['medicine_admin.see.tabs.navigation','headquarters_authorized.see.schedules.table','super_admin.see.tabs.navigation'])
                        <li class="mr-2">
                            <a href="#" class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50"
                                x-on:click.prevent="activeTab = 'schedules'"
                                :class="{ 'text-blue-600 border-b-2 border-blue-500': activeTab === 'schedules' }">
                                HORARIOS
                            </a>
                        </li>
                        @endcanany
                    </ul>
                    <div class="mt-6">
                        @canany(['medicine_admin.see.tabs.navigation','super_admin.see.tabs.navigation'])
                        <div x-show="activeTab === 'headquarters'">
                            <div class="mb-6">
                                <x-button wire:click="$emit('openModal', 'headquarters.modals.create-update-modal-headquarter')"
                                    icon="pencil" primary label="AÑADIR" />
                            </div>
                            @livewire('headquarters.tables.headquarters-table')
                            {{-- <livewire:headquarter-table> --}}
                        </div>
                        @endcanany
                        @canany(['medicine_admin.see.tabs.navigation','headquarters_authorized.see.schedules.table','super_admin.see.tabs.navigation'])
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
                                @livewire('headquarters.tables.disabled-day-table')
                                {{-- <livewire:disabled-day-table /> --}}
                            </div>
                        </div>
                        @endcanany
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
