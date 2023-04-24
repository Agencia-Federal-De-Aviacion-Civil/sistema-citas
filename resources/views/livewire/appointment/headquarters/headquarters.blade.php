<div>
    <x-notifications position="top-bottom" />
    <div class="relative py-6 lg:py-4">
        <img class="z-0 w-full h-full absolute inset-0 object-cover" src="{{ asset('images/banner_testing.jpg') }}"
            alt="bg" />
        <div
            class="z-10 relative container px-6 mx-auto flex flex-col md:flex-row items-start md:items-center justify-between">
            <div>
                <h4 tabindex="0" class="focus:outline-none text-2xl font-bold leading-tight text-white">ADMINISTRACIÓN
                    DE SEDES</h4>
                <ul class="flex flex-col md:flex-row items-start md:items-center text-gray-300 text-sm mt-3">
                    <li class="flex items-center mt-4 md:mt-0">
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-6 bg-white shadow-xl sm:rounded-lg">
                <div class="ml-4 py-6 mr-4 uppercase text-sm">
                    <div x-data="{ activeTab: 'headquarter' }">
                        <ul
                            class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 ">
                            <li class="mr-2">
                                <a href="#" class="inline-block p-4 text-gray-800 bg-white rounded-t-lg active"
                                    x-on:click.prevent="activeTab = 'headquarter'"
                                    :class="{ 'active': activeTab === 'headquarter' }">
                                    SEDES
                                </a>
                            </li>
                            <li class="mr-2">
                                <a href="#"
                                    class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50"
                                    x-on:click.prevent="activeTab = 'schedule'"
                                    :class="{ 'active': activeTab === 'schedule' }">
                                    HORARIOS
                                </a>
                            </li>
                        </ul>
                        <div class="mt-8">
                            <div x-show="activeTab === 'headquarter'">
                                <livewire:headquarter-table />
                            </div>
                            <div x-show="activeTab === 'schedule'">
                                <x-input wire:model.lazy="range_appointment" id="disabled-appointment"
                                    label="INHABILITAR CITAS" placeholder="INGRESE..." readonly />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr("#disabled-appointment", {
                mode: "range",
                dateFormat: "Y-m-d",
                disableMobile: "true",
                minDate: "today",
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
