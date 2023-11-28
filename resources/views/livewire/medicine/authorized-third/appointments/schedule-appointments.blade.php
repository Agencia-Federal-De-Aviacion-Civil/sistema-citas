<div>
    <x-notifications position="top-bottom" />
    <div class="relative py-6 lg:py-4">
        <img class="z-0 w-full h-full absolute inset-0 object-cover" src="{{ asset('images/banner_testing.jpg') }}"
            alt="bg" />
        <div
            class="z-10 relative container px-6 mx-auto flex flex-col md:flex-row items-start md:items-center justify-between">
            <div>
                <h4 tabindex="0" class="focus:outline-none text-2xl font-bold leading-tight text-white">Generar Citas
                </h4>
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
        <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">
            <div class="mt-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div x-cloak x-data="{
                    searchcurp: @entangle('curp_search'),
                    steps: @entangle('stepsprogress'),
                }">
                    <div class="bg-blue-50 border border-blue-200 rounded-md p-3" role="alert">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-4 w-4 text-blue-600 mt-1" xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path
                                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-800 font-semibold">
                                    Verifique la información
                                </h3>
                                <div class="mt-2 text-sm text-gray-600">
                                    Por favor verifique la información ingresada antes de guardar
                                </div>
                            </div>

                        </div>
                    </div>
                    <section class="bg-white dark:bg-gray-900">
                        <div class="container flex flex-col px-4 py-12 mx-auto text-center">
                            <div class="grid xl:grid-cols-6 xl:gap-6 py-2">
                                <div class="col-span-2">
                                    <x-input class="uppercase" x-ref="searchcurp" wire:model.lazy="curp_search"
                                        label="INGRESA EL CURP" placeholder="INGRESE..." />
                                </div>
                                <div class="inline-flex w-full mt-6 sm:w-auto">
                                    <x-button wire:click.prevent="searchcurp()" label="VALIDAR" blue
                                        x-on:click="steps=1" right-icon="search" />
                                    <div wire:loading.delay.shortest wire:target="searchcurp">
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
                    </section>
                    @if ($status > 0)
                        <div>
                            <section class="text-gray-600 body-font">
                                <div class="justify-center">
                                    <div class="container mx-auto">
                                        <div class="w-full lg:px-3">
                                            <div class="py-2">
                                                <h2 class="sr-only">Steps</h2>
                                                <div>
                                                    <div class="overflow-hidden rounded-full bg-gray-200">
                                                        <div class="rounded-full bg-blue-700 text-xs leading-none h-2 text-center text-white"
                                                            :style="'width: ' + parseInt((steps / 2) * 100) + '%'">
                                                        </div>
                                                    </div>
                                                    <ol class="mt-4 grid grid-cols-2 text-sm font-medium text-gray-500">
                                                        <li class="flex items-center justify-start sm:gap-1.5"
                                                            :class="{ 'text-blue-600': steps > 1 }">
                                                            <span class="hidden sm:inline"> {{ $title }} </span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                                            </svg>
                                                        </li>
                                                        <li class="flex items-center justify-center sm:gap-1.5"
                                                            :class="{ 'text-blue-600': steps >= 2 }">
                                                            <span class="hidden sm:inline"> Agendar cita </span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                                            </svg>
                                                        </li>
                                                    </ol>
                                                </div>
                                            </div>
                                            {{-- fin pasos  --}}

                                            <div x-show="steps == 1">
                                                <div class="mt-4">
                                                    <h1
                                                        class="text-2xl font-semibold tracking-wider text-gray-800 capitalize dark:text-white">
                                                        {{ $title }}
                                                    </h1>
                                                </div>
                                                @if ($status == 1)
                                                    <div class="mt-8 grid md:grid-cols-3 md:gap-6">
                                                        <div class="relative mb-6 w-full group">
                                                            <x-input readonly class="uppercase bg-gray-100"
                                                                wire:model.lazy="name_search" label="NOMBRE (S)"
                                                                placeholder="ESCRIBE..." />
                                                        </div>
                                                        <div class="relative mb-6 w-full group">
                                                            <x-input readonly class="uppercase bg-gray-100"
                                                                wire:model.lazy="apParental_search"
                                                                label="APELLIDO PATERNO" placeholder="ESCRIBE..." />
                                                        </div>
                                                        <div class="relative mb-6 w-full group">
                                                            <x-input readonly class="uppercase bg-gray-100"
                                                                wire:model.lazy="apMaternal_search"
                                                                label="APELLIDO MATERNO" placeholder="ESCRIBE..." />
                                                        </div>
                                                    </div>
                                                    <div class="mt-2 grid md:grid-cols-2 md:gap-6">
                                                        <div class="relative mb-6 w-full group">
                                                            <x-input readonly class="uppercase bg-gray-100"
                                                                wire:model.lazy="curp_searchs" label="CURP"
                                                                placeholder="INGRESE..." />
                                                        </div>
                                                        <div class="relative z-0 mb-6 w-full group">
                                                            <x-input readonly class="pr-28 bg-gray-100"
                                                                label="CORREO ELECTRÓNICO"
                                                                wire:model.lazy="email_search"
                                                                placeholder="INGRESE..." />
                                                        </div>
                                                    </div>
                                                    <div class="flow-root">
                                                        <x-button x-on:click="steps=2" class="float-right"
                                                            right-icon="arrow-right" blue label="Siguiente" md />
                                                    </div>
                                                @else
                                                    <div>
                                                        {{-- si no se encuentra registrado --}}
                                                        <div class="mt-8 grid md:grid-cols-3 md:gap-6">
                                                            <div class="relative mb-6 w-full group">
                                                                <x-input class="uppercase" wire:model.lazy="name"
                                                                    label="NOMBRE (S)" placeholder="ESCRIBE..." />
                                                            </div>
                                                            <div class="relative mb-6 w-full group">
                                                                <x-input class="uppercase"
                                                                    wire:model.lazy="apParental"
                                                                    label="APELLIDO PATERNO"
                                                                    placeholder="ESCRIBE..." />
                                                            </div>
                                                            <div class="relative mb-6 w-full group">
                                                                <x-input class="uppercase"
                                                                    wire:model.lazy="apMaternal"
                                                                    label="APELLIDO MATERNO"
                                                                    placeholder="ESCRIBE..." />
                                                            </div>
                                                        </div>
                                                        <div class="grid md:grid-cols-2 md:gap-6">
                                                            <ul
                                                                class="items-center w-full text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                                <li
                                                                    class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                                                    <div class="flex items-center pl-3">
                                                                        <x-radio id="right-labelF" label="FEMENINO"
                                                                            value="FEMENINO"
                                                                            wire:model.defer="genre" />
                                                                    </div>
                                                                </li>
                                                                <li
                                                                    class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                                                    <div class="flex items-center pl-3">
                                                                        <x-radio id="right-labelM" label="MASCULINO"
                                                                            value="MASCULINO"
                                                                            wire:model.defer="genre" />
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                            <div class="relative mb-6 w-full group">
                                                                {{-- <x-inputs.maskable class="uppercase" wire:model.defer="curp"
                                                        mask="AAAA######AAAAAA##" label="CURP" placeholder="INGRESE..." /> --}}
                                                                <x-input class="uppercase" wire:model.lazy="curp"
                                                                    label="CURP" placeholder="INGRESE..." />
                                                            </div>
                                                        </div>
                                                        <div class="mt-6 grid md:grid-cols-3 md:gap-6">
                                                            <div class="relative mb-6 w-full group">
                                                                <x-datetime-picker label="Fecha de nacimiento"
                                                                    placeholder="SELECCIONE FECHA..."
                                                                    parse-format="YYYY-MM-DD" without-time="false"
                                                                    wire:model.defer="birth"/>
                                                            </div>
                                                            <div class="relative mb-6 w-full group">
                                                                <x-inputs.maskable label="EDAD" mask="##"
                                                                    placeholder="ESCRIBE..."
                                                                    wire:model.defer="age" />
                                                            </div>
                                                            <div class="relative mb-6 w-full group">
                                                                <x-select label="ESTADO" placeholder="SELECCIONE..."
                                                                    wire:model.lazy="state_id">
                                                                    @foreach ($states as $state)
                                                                        <x-select.option label="{{ $state->name }}"
                                                                            value="{{ $state->id }}" />
                                                                    @endforeach
                                                                </x-select>
                                                            </div>
                                                        </div>
                                                        <div class="mt-2 grid md:grid-cols-3 md:gap-6">
                                                            <div class="relative mb-6 w-full group">
                                                                <x-select label="MUNICIPIO"
                                                                    placeholder="SELECCIONE..."
                                                                    wire:model.defer="municipal_id">
                                                                    <x-select.option label="SELECCIONE..."
                                                                        value="" />
                                                                    @foreach ($municipals as $municipal)
                                                                        <x-select.option label="{{ $municipal->name }}"
                                                                            value="{{ $municipal->id }}" />
                                                                    @endforeach
                                                                </x-select>
                                                            </div>
                                                            <div class="relative mb-6 w-full group">
                                                                <x-input class="uppercase" wire:model.lazy="street"
                                                                    label="INGRESE LA CALLE"
                                                                    placeholder="ESCRIBE..." />
                                                            </div>
                                                            <div class="relative mb-6 w-full group">
                                                                <x-input class="uppercase" wire:model.lazy="nInterior"
                                                                    label="NÚMERO INTERIOR"
                                                                    placeholder="ESCRIBE..." />
                                                            </div>
                                                        </div>
                                                        <div class="mt-2 grid md:grid-cols-2 md:gap-6">
                                                            <div class="relative mb-6 w-full group">
                                                                <x-input class="uppercase" wire:model.lazy="nExterior"
                                                                    label="NÚMERO EXTERIOR"
                                                                    placeholder="ESCRIBE..." />
                                                            </div>
                                                            <div class="relative mb-6 w-full group">
                                                                <x-input class="uppercase" wire:model.lazy="suburb"
                                                                    label="COLONIA" placeholder="ESCRIBE..." />
                                                            </div>
                                                        </div>
                                                        <div class="mt-2 grid md:grid-cols-3 md:gap-6">
                                                            <div class="relative mb-6 w-full group">
                                                                <x-inputs.maskable mask="#####" class="uppercase"
                                                                    wire:model.lazy="postalCode" label="CÓDIGO POSTAL"
                                                                    placeholder="ESCRIBE..." />
                                                            </div>
                                                            <div class="relative mb-6 w-full group">
                                                                <x-input class="uppercase"
                                                                    wire:model.lazy="federalEntity"
                                                                    label="ENTIDAD FEDERATIVA"
                                                                    placeholder="ESCRIBE..." />
                                                            </div>
                                                            <div class="relative mb-6 w-full group">
                                                                <x-input class="uppercase"
                                                                    wire:model.lazy="delegation" label="DELEGACIÓN"
                                                                    placeholder="ESCRIBE..." />
                                                            </div>
                                                        </div>
                                                        <div class="grid md:grid-cols-2 md:gap-6">
                                                            <div class="relative mb-6 w-full group">
                                                                <x-inputs.maskable label="TELÉFONO MOVIL"
                                                                    wire:model.lazy="mobilePhone" mask="(##)####-####"
                                                                    placeholder="INGRESE..." />
                                                            </div>
                                                            <div class="relative mb-6 w-full group">
                                                                <x-inputs.maskable label="TELÉFONO DE OFICINA"
                                                                    wire:model.lazy="officePhone" mask="(##)####-####"
                                                                    placeholder="INGRESE..." />
                                                            </div>
                                                        </div>
                                                        <div class="grid md:grid-cols-2 md:gap-6">
                                                            <div class="relative mb-6 w-full group">
                                                                <x-inputs.maskable label="EXTENSIÓN"
                                                                    wire:model.lazy="extension" mask="####"
                                                                    placeholder="INGRESE..." />
                                                            </div>
                                                            <div class="relative z-0 mb-6 w-full group">
                                                                <x-input class="pr-28" label="CORREO ELECTRÓNICO"
                                                                    wire:model.lazy="email"
                                                                    placeholder="INGRESE..." />
                                                            </div>
                                                        </div>
                                                        <div class="grid md:grid-cols-2 md:gap-6">
                                                            <div class="relative mb-6 w-full group">
                                                                <x-input class="pr-28" type="password"
                                                                    label="CONTRASEÑA"
                                                                    wire:model.lazy="passwordConfirmation"
                                                                    placeholder="INGRESE..." />
                                                            </div>
                                                            <div class="relative mb-6 w-full group">
                                                                <x-input class="pr-28" type="password"
                                                                    label="CONFIRMAR CONTRASEÑA"
                                                                    wire:model.lazy="password"
                                                                    placeholder="INGRESE..." />
                                                            </div>
                                                        </div>
                                                        <div class="text-right">
                                                            <x-button wire:click.prevent="register()"
                                                                label="REGISTRAR" blue right-icon="plus-sm" />
                                                            <div wire:loading.delay.shortest wire:target="register">
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
                                                    <br>
                                                @endif
                                            </div>
                                            <div x-show="steps == 2">
                                                @livewire('medicine.home-medicine')
                                                <div class="flow-root">
                                                    <x-button x-on:click="steps=1" class="float-left"
                                                        icon="arrow-left" blue label="Anterior" md />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    @endif
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
        // CITAS MEDICAS
        window.addEventListener('headquartersUpdated', event => {
            flatpickr("#fecha-appointment", {
                // enableTime: true,
                // time_24hr: true,
                dateFormat: "Y-m-d",
                // minTime: "07:00",
                // maxTime: "10:59",
                disableMobile: "true",
                // minuteIncrement: 10,
                minDate: "today",
                //minDate: new Date(new Date().getFullYear(), 0, 1),
                maxDate: new Date(new Date().getFullYear(), 11, 31),
                disable: event.detail.disabledDaysFilter,
                onDayCreate: function(dObj, dStr, fp, dayElem) {
                    /* if (dayElem.dateObj.getDay() === 0 || dayElem.dateObj.getDay() === 6 || dayElem
                         .dateObj <= new Date()) {
                         dayElem.className += " flatpickr-disabled nextMonthDayflatpickr-disabled";
                     }*/
                    if (dayElem.dateObj.getDay() === 0 || dayElem.dateObj.getDay() === 6) {
                        dayElem.className +=
                            " flatpickr-disabled nextMonthDayflatpickr-disabled";
                    }
                },
                locale: {
                    weekdays: {
                        shorthand: ['Dom', 'Lun', 'Mar', 'Mier', 'Jue', 'Vie', 'Sab'],
                        longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves',
                            'Viernes',
                            'Sábado'
                        ],
                    },
                    months: {
                        shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago',
                            'Sep', 'Oct',
                            'Nov', 'Dic'
                        ],
                        longhand: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                            'Julio', 'Agosto',
                            'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                        ],
                    },
                },
            });
        });
    });
</script>
