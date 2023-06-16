<div>
    <x-notifications position="top-center" />
    <x-dialog z-index="z-50" blur="md" align="center" />
    @if ($confirmModal)
        @include('livewire.linguistics.modals.confirm')
    @endif
    @if ($modal)
        @include('livewire.linguistics.modals.readyPdf')
    @endif
    @livewire('linguistics.modals.modal-index')
    <div class="relative py-6 lg:py-4">
        <img class="z-0 w-full h-full absolute inset-0 object-cover" src="{{ asset('images/banner_ventanillas.jpg') }}"
            alt="banners" />
        <div
            class="z-10 relative container px-6 mx-auto flex flex-col md:flex-row items-start md:items-center justify-between">
            <div>
                <h4 tabindex="0" class="focus:outline-none text-2xl font-bold leading-tight text-white">Generación de
                    citas para competencia Lingüistica</h4>
                <ul class="flex flex-col md:flex-row items-start md:items-center text-gray-300 text-sm mt-3">
                    <li class="flex items-center mt-4 md:mt-0">
                        <div class="mr-1">
                            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/background_with_sub_text-svg3.svg"
                                alt="date">
                        </div>
                        <span tabindex="0" class="focus:outline-none">
                            {{ $dateNow }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div x-data="{
            licensenumber: @entangle('license_number'),
            reservedate: @entangle('date_reserve'),
            fileName: '',
        }">
            {{-- step's --}}
            <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">
                <div class="mt-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <section class="text-gray-600 body-font">
                        <div class="container md:px-2 lg:px-5 py-0 mx-auto flex flex-wrap">
                            <div class="flex flex-wrap w-full">
                                <div class="lg:w-full md:w-full md:pr-10 md:py-6">
                                    <div class="flex relative pb-6">
                                        <div class="h-full w-10 absolute inset-0 flex items-center justify-center">
                                            <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                                        </div>
                                        <div
                                            class="flex-shrink-0 w-10 h-10 rounded-full bg-sky-700 inline-flex items-center justify-center text-white relative z-10">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M7.5 3.75H6A2.25 2.25 0 003.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0120.25 6v1.5m0 9V18A2.25 2.25 0 0118 20.25h-1.5m-9 0H6A2.25 2.25 0 013.75 18v-1.5M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                        <div class="flex-grow pl-4">
                                            <div class="grid xl:grid-cols-4 xl:gap-6">
                                                <div class="mt-1 relative z-0 w-full group">
                                                    <div class="relative z-0 w-full mb-6 group">
                                                        <x-input x-ref="refnumber" wire:model.lazy="reference_number" label="INGRESA LA LLAVE DE PAGO" placeholder="INGRESE..." />
                                                    </div>
                                                </div>
                                                <div class="mt-1 relative z-auto w-full group">
                                                    <x-input wire:model.lazy="pay_date" id="fecha-pago"
                                                        label="FECHA DE PAGO" placeholder="INGRESE..." readonly />
                                                </div>
                                                <div
                                                    class="mt-1 relative z-auto w-full group grid-cols-2 xl:col-span-2">
                                                    <label for="small"
                                                        class="block text-base font-medium text-gray-900 dark:text-white">ADJUNTA
                                                        EL COMPROBANTE DE PAGO
                                                    </label>
                                                    <input type="file" wire:model="name_document" x-ref="file"
                                                        @change="fileName = $refs.file.files[0].name"
                                                        class="block w-full border border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 file:bg-transparent file:border-0 file:bg-gray-100 file:mr-4 file:py-2.5 file:px-4 dark:file:bg-gray-700 dark:file:text-gray-400">
                                                    <div class="float-left">
                                                        <div wire:loading wire:target="name_document">Subiendo...
                                                            <div style="color: #27559b9a" class="la-ball-fall">
                                                                <div></div>
                                                                <div></div>
                                                                <div></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- paso1 --}}
                                    <div x-show="fileName != ''" class="flex relative pb-6">
                                        <div class="h-full w-10 absolute inset-0 flex items-center justify-center">
                                            <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                                        </div>
                                        <div
                                            class="flex-shrink-0 w-10 h-10 rounded-full bg-sky-700 inline-flex items-center justify-center text-white relative z-10">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z" />
                                            </svg>
                                        </div>
                                        <div class="flex-grow pl-4">
                                            <div class="grid md:grid-cols-3 md:gap-6">
                                                <div class="relative z-auto w-full mb-6 group">
                                                    <x-select wire:model.lazy="type_exam_id" label="TIPO DE EVALUACIÓN"
                                                        placeholder="Seleccione...">
                                                        @foreach ($exams as $exam)
                                                            <x-select.option label="{{ $exam->name }}"
                                                                value="{{ $exam->id }}" />
                                                        @endforeach
                                                    </x-select>
                                                </div>
                                                <div class="relative z-auto w-full mb-6 group">
                                                    <x-select wire:model.lazy="type_license" label="TIPO DE LICENCIA"
                                                        placeholder="Seleccione...">
                                                        <x-select.option label="PILOTO" value="PILOTO" />
                                                        <x-select.option label="CONTROLADOR ÁEREO"
                                                            value="CONTROLADOR ÁEREO" />
                                                    </x-select>
                                                </div>
                                                <div class="relative z-auto w-full mb-6 group">
                                                    <x-input x-ref="licensenumber" wire:model.lazy="license_number"
                                                        label="NÚMERO DE LICENCIA" placeholder="INGRESE..." />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- paso2 --}}
                                    <div x-show="licensenumber > '0'" class="flex relative pb-6">
                                        <div class="h-full w-10 absolute inset-0 flex items-center justify-center">
                                            <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                                        </div>
                                        <div
                                            class="flex-shrink-0 w-10 h-10 rounded-full bg-sky-700 inline-flex items-center justify-center text-white relative z-10">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                            </svg>
                                        </div>
                                        <div class="flex-grow pl-4">
                                            <div class="grid xl:grid-cols-4 xl:gap-6">
                                                <div class="text-base relative z-auto w-full mb-2 group">
                                                    <x-input wire:model.lazy="red_number" label="NÚMERO ROJO"
                                                        placeholder="INGRESE..." />
                                                </div>
                                                <div class="text-base relative z-auto w-full mb-2 group">
                                                    <x-select wire:model.lazy="to_user_headquarters" label="SEDE"
                                                        placeholder="Seleccione...">
                                                        @foreach ($headquartersQueries as $headquartersQuery)
                                                            <x-select.option
                                                                label="{{ $headquartersQuery->headquarterUser->name }}"
                                                                value="{{ $headquartersQuery->headquarterUser->id }}" />
                                                        @endforeach
                                                    </x-select>
                                                </div>
                                                <div class="text-base relative z-auto w-full mb-2 group">
                                                    <x-input x-ref="reservedate" wire:model.lazy="date_reserve"
                                                        id="selector-fecha" label="FECHA" placeholder="INGRESE..."
                                                        readonly />
                                                </div>
                                                <div class="text-base relative z-auto w-full mb-2 group">
                                                    <label for="small"
                                                        class="block text-base font-medium text-gray-900 dark:text-white">SELECCIONE
                                                        HORA</label>
                                                    <select id="small" placeholder="seleccione..."
                                                        wire:model.lazy="schedule_id"
                                                        class="block w-full p-2 mb-2 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                        <option value="">Seleccione...</option>
                                                        @foreach ($schedules as $schedule)
                                                            <option value="{{ $schedule->id }}">
                                                                {{ $schedule->time_start }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- paso3 --}}
                                    <div x-show="reservedate > '0'" class="flex relative">
                                        <div
                                            class="flex-shrink-0 w-10 h-10 rounded-full bg-green-500 inline-flex items-center justify-center text-white relative z-10">
                                            <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2" class="w-5 h-5"
                                                viewBox="0 0 24 24">
                                                <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                                                <path d="M22 4L12 14.01l-3-3"></path>
                                            </svg>
                                        </div>
                                        <div class="flex-grow pl-4">
                                            <div class="">
                                                <x-button wire:click.prevent="save" label="GUARDAR" blue
                                                    right-icon="archive" />
                                                <div wire:loading.delay.shortest wire:target="save">
                                                    <div
                                                        class="flex justify-center bg-gray-200 z-40 h-full w-full fixed top-0 left-0 items-center opacity-75">
                                                        <div style="color: #0061cf"
                                                            class="la-line-spin-clockwise-fade-rotating la-3x">
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr("#fecha-pago", {
            dateFormat: "Y-m-d",
            disableMobile: "true",
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
        // SECOND DATE 
        flatpickr("#selector-fecha", {
            minDate: "today",
            dateFormat: "Y-m-d",
            disableMobile: "true",
            disable: [
                function(date) {
                    // Devuelve 'true' si la fecha es un sábado o domingo
                    return date.getDay() === 6 || date.getDay() === 0 || date <=
                        new Date();
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
