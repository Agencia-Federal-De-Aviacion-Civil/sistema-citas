<div>
    <x-notifications position="top-bottom" />
    <div class="relative py-6 lg:py-4">
        <img class="z-0 w-full h-full absolute inset-0 object-cover" src="{{ asset('images/banner_testing.jpg') }}"
            alt="bg" />
        <div
            class="z-10 relative container px-6 mx-auto flex flex-col md:flex-row items-start md:items-center justify-between">
            <div>
                <h4 tabindex="0" class="focus:outline-none text-2xl font-bold leading-tight text-white">Pago electrónico
                    de derechos, productos y aprovechamientos</h4>
                <ul class="flex flex-col md:flex-row items-start md:items-center text-gray-300 text-sm mt-3">
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="py-12">
    <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">
        <section class="text-gray-600 body-font">
            <div class="justify-center" x-cloak x-data="{ steps: 1,procedure1:'0' }">
                <div class="container px-5 py-2 mx-auto">
                    <div class="w-full px-2 lg:px-10">
                        <img src="{{ asset('images/e5cinco.jpg') }}" alt="">

                        <h1 class="text-3xl font-semibold text-gray-800 dark:text-gray-100">Formato para generar hoja de
                            ayuda</h1>
                        {{-- <p class="mt-4 text-gray-500 dark:text-gray-400">
                            Let’s get you all set up so you can verify your personal account and begin setting up your profile.
                        </p> --}}
                        {{-- pasos --}}
                        <div class="py-8">
                            <h2 class="sr-only">Steps</h2>
                            <div>
                                <div class="overflow-hidden rounded-full bg-gray-200">
                                    <div class="rounded-full bg-blue-700 text-xs leading-none h-2 text-center text-white"
                                        :style="'width: ' + parseInt((steps / 4) * 100) + '%'"></div>
                                </div>
                                <ol class="mt-4 grid grid-cols-3 text-sm font-medium text-gray-500">
                                    <li class="flex items-center justify-start sm:gap-1.5" :class="{'text-blue-600':  steps > 1}">
                                        <span class="hidden sm:inline"> Verifica tus datos </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>
                                    </li>
                                    <li class="flex items-center justify-center sm:gap-1.5" :class="{'text-blue-600':  steps >= 2}">
                                        <span class="hidden sm:inline"> Datos del pago </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                        </svg>
                                    </li>
                                    <li class="flex items-center justify-end sm:gap-1.5" :class="{'text-blue-600':  steps == 4}">
                                        <span class="hidden sm:inline"> Genera la hoja </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6" :class="{'text-green-600':  steps == 4}">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
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
                                    Verifica tus datos
                                </h1>
                            </div>

                            <form class="grid grid-cols-1 gap-6 mt-8 md:grid-cols-2">
                                <div class="relative z-0 w-full group">
                                    <x-input wire:model.lazy="" label="CURP" placeholder="INGRESE..." />
                                </div>
                                <div class="relative z-0 w-full group">
                                    <x-input wire:model.lazy="" label="RFC" placeholder="INGRESE..." />
                                </div>

                                <div class="relative z-0 w-full group xl:col-span-2">
                                    <x-input wire:model.lazy="" label="Nombre(s):" placeholder="INGRESE..." />
                                </div>
                                <div class="relative z-0 w-full group">
                                    <x-input wire:model.lazy="" label="Apellido Paterno:" placeholder="INGRESE..." />
                                </div>

                                <div class="relative z-0 w-full group">
                                    <x-input wire:model.lazy="" label="Apellido Materno:" placeholder="INGRESE..." />
                                </div>
                                <h1 class="text-xl text-gray-700 capitalize dark:text-white xl:col-span-2">
                                    Dirección
                                </h1>

                                <div class="relative z-0 w-full group ">
                                    <x-input wire:model.lazy="" label="Calle:" placeholder="INGRESE..." />
                                </div>
                                <div class="relative z-0 w-full group ">
                                    <x-input wire:model.lazy="" label="Colonia:" placeholder="INGRESE..." />
                                </div>
                                <div class="relative z-0 w-full group ">
                                    <x-input wire:model.lazy="" label="CP:" placeholder="INGRESE..." />
                                </div>
                                <div class="relative z-0 w-full group ">
                                    <x-input wire:model.lazy="" label="Teléfono:" placeholder="INGRESE..." />
                                </div>
                                <div class="relative z-0 w-full group ">
                                    <x-input wire:model.lazy="" label="Entidad Federativa:" placeholder="INGRESE..." />
                                </div>
                                <div class="relative z-0 w-full group ">
                                    <x-input wire:model.lazy="" label="Municipio:" placeholder="INGRESE..." />
                                </div>

                                <div>
                                    <x-button x-on:click="steps=2" right-icon="arrow-right" blue label="Siguiente" md />
                                </div>
                            </form>
                        </div>
                        <div x-show="steps == 2||steps == 3||steps == 4">
                            <div class="mt-4">
                                <h1
                                    class="text-2xl font-semibold tracking-wider text-gray-800 capitalize dark:text-white">
                                    Datos de pago
                                </h1>
                            </div>
                            <form class="grid grid-cols-1 gap-6 mt-8 md:grid-cols-2">
                                <div class="relative z-0 w-full group">
                                    <x-input wire:model.lazy="" readonly class="font-semibold"
                                        label="Unidad Administrativa" value="AGENCIA FEDERAL DE AVIACIÓN CIVIL"
                                        placeholder="INGRESE..." />
                                </div>
                                <div class="relative z-auto w-full group">
                                    <x-select label="Oficina facturacion" placeholder="Oficina facturacion" :options="[
                                    ['name' => 'PERIFERICO',  'id' => 1],
                                    ['name' => 'AV. FUERZA AEREA', 'id' => 2],
                                    ['name' => 'SALA C MEZANINE AICM',   'id' => 3],
                                    ['name' => 'TERMINAL DE AVIACION GENERAL',    'id' => 4],
                                    ['name' => 'OFICINA DE INGRESOS',    'id' => 5],
                                    ['name' => 'CENTRO INTERNACIONAL DE ADIESTRAMIENTO DE AVIACIÓN CIVIL',    'id' => 6],
                                    ['name' => 'AEROPUERTO INTERNACIONAL FELIPE ANGELES',    'id' => 7],
                                    ]" option-label="name" option-value="id" wire:model.defer="model" />
                                </div>
                                <div class="relative z-auto w-full group">
                                    <x-select label="Categoria" placeholder="Categoria" :options="[
                                    ['name' => 'DERECHOS',  'id' => 1],
                                    ]" option-label="name" option-value="id" wire:model.defer="model" />
                                </div>

                                <div class="relative z-auto w-full group xl:col-span-2">
                                    {{-- <x-select x-model.lazy="procedure1"
                                label="Trámite o Concepto"
                                placeholder="Trámite o Concepto"
                                :options="[
                                    ['procedure' => 'Seleccione...',  'id' => 0],
                                    ['procedure' => '05312244 - POR LA EXPEDICIÓN DE CADA CERTIFICADO DE CAPACIDAD, LICENCIA O PERMISO PARA: (I)',  'id' => 1],
                                    ['procedure' => '05293295 - POR SU MODIFICACION (I.A)',  'id' => 2],
                                    ['procedure' => '05273195 - PAGO POR REALIZAR EL EXAMEN DE COMPETENCIA LINGÜISTIICA',  'id' => 2],
                                    ]"
                                    option-label="procedure"
                                    option-value="id"/> --}}

                                    <select x-model="procedure1" x-on:click="steps=3"
                                        class="block w-full p-2 mb-2 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        label="Trámite o Concepto" placeholder="Trámite o Concepto">
                                        <option value="" selected>Seleccione...</option>
                                        <option value="1">05312244 - POR LA EXPEDICIÓN DE CADA CERTIFICADO DE CAPACIDAD,
                                            LICENCIA O PERMISO PARA: (I) </option>
                                        <option value="2">05293295 - POR SU MODIFICACION (I.A)</option>
                                        <option value="3">05273195 - PAGO POR REALIZAR EL EXAMEN DE COMPETENCIA
                                            LINGÜISTIICA </option>
                                    </select>

                                </div>
                                <div class="relative z-auto w-full group xl:col-span-2">
                                    <label for="">INDICAR PERIODO</label>
                                    <ul class="flex flex-col sm:flex-row">
                                        <li
                                            class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                                            <div class="relative flex items-start w-full">
                                                <x-radio id="not_apply" name="period" left-label="No Aplica Periodo"
                                                    wire:model.defer="" />
                                            </div>
                                        </li>

                                        <li
                                            class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                                            <div class="relative flex items-start w-full">
                                                <x-radio id="month" name="period" left-label="Mensual"
                                                    wire:model.defer="" />
                                            </div>
                                        </li>

                                        <li
                                            class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                                            <div class="relative flex items-start w-full">
                                                <x-radio id="quarterly" name="period" left-label="Trimestral"
                                                    wire:model.defer="" />
                                            </div>
                                        </li>
                                        <li
                                            class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                                            <div class="relative flex items-start w-full">
                                                <x-radio id="quarterly1" name="period" left-label="Cuatrimestral"
                                                    wire:model.defer="" />
                                            </div>
                                        </li>
                                        <li
                                            class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                                            <div class="relative flex items-start w-full">
                                                <x-radio id="exercise" name="period" left-label="exercise"
                                                    wire:model.defer="" />
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                {{-- <x-input icon="dots-circle-horizontal" label="Periodo" placeholder="your name" />  --}}
                                <x-select label="Periodo" placeholder="Selecciona el periodo" :options="[
                                ['period' => 'No aplica',  'id' => 0],
                                ['period' => '1 Enero',  'id' => 1],
                                ['period' => '2 Febrero', 'id' => 2],
                                ['period' => '3 Marzo',   'id' => 3],
                                ['period' => '4 Abril',    'id' => 4],
                                ['period' => '5 Mayo',    'id' => 5],
                                ['period' => '6 Junio',    'id' => 6],
                                ['period' => '7 Julio',    'id' => 7],
                                ['period' => '8 Agosto',    'id' => 8],
                                ['period' => '9 Septiembre',    'id' => 9],
                                ['period' => '10 Octubre',    'id' => 10],
                                ['period' => '11 Noviembre',    'id' => 11],
                                ['period' => '12 Diciembre',    'id' => 12],
                                ]" option-label="period" option-value="id" wire:model.defer="" />
                                <x-input icon="calendar" label="Ejercicio" placeholder="your name" value="2023" />
                                {{-- <label for="" x-text="procedure1">dccdc</label> --}}
                                <x-input icon="chevron-double-down" class="font-bold" label="NÚMERO DE UNIDADES A PAGAR"
                                    placeholder="ingresar..." value="1" />
                                <x-input readonly label="NÚMERO DE UNIDADES A PAGAR" placeholder="ingresar..."
                                    value="UNIDADES" />


                                
                            </form>
                            <div x-show="procedure1 > '0' " class="xl:col-span-2">
                                <div class="lg:w-full w-full lg:pr-10 lg:py-6 mb-6 lg:mb-0">
                                    <div class="flex mb-4">
                                        <h2
                                            class="inline-flex items-center justify-center border-blue-600 px-2 font-semibold tracking-tight text-blue-700 uppercase rounded-lg bg-gray-100 dark:bg-gray-700">
                                            CALCULO DE IMPORTEs
                                        </h2>

                                    </div>
                                    <div
                                        class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">

                                        <table
                                            class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                            <thead class="bg-gray-50 dark:bg-gray-800">
                                                <tr>
                                                    <th scope="col"
                                                        class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">

                                                        <span></span>
                                                    </th>

                                                    <th scope="col"
                                                        class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                        SIN AJUSTE
                                                    </th>

                                                    <th scope="col"
                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                        CON AJUSTE
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody
                                                class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                                <tr>
                                                    <td
                                                        class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                                        <div>
                                                            <h2
                                                                class="font-medium text-gray-800 dark:text-white ">
                                                                TARIFA UNIDAD ó %</h2>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                                                        <div
                                                            class="inline-flex items-center px-3 py-1 text-gray-500 rounded-full gap-x-2 bg-blue-100/60 dark:bg-gray-800">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke-width="1.5"
                                                                stroke="currentColor"
                                                                class="w-6 h-6">
                                                                <path stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>


                                                            <h2 class="text-lg font-semi-bold">
                                                                1833.71</h2>
                                                        </div>
                                                    </td>

                                                    <td
                                                        class="px-4 py-4 text-sm whitespace-nowrap">
                                                        <div
                                                            class="inline-flex items-center px-3 py-1 text-gray-500 rounded-full gap-x-2 bg-blue-100/60 dark:bg-gray-800">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke-width="1.5"
                                                                stroke="currentColor"
                                                                class="w-6 h-6">
                                                                <path stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>

                                                            <h2 class="text-lg font-semi-bold">
                                                                1834</h2>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="flex mb-4">
                                        <a
                                            class="flex-grow text-blue-600 border-b-2 border-blue-600 py-2 text-lg px-1">
                                            <h2
                                                class="inline-flex items-center justify-center border-blue-600 px-2 font-semibold tracking-tight text-blue-700 uppercase rounded-lg bg-gray-100 dark:bg-gray-700">
                                            </h2>
                                        </a>
                                    </div>
                                    <p class="leading-relaxed mb-4">Importe:</p>
                                    <div class="flex border-t border-gray-200 py-2">
                                        <span class="text-gray-500">Importe:</span>
                                        <span class="ml-auto text-gray-900">1834</span>
                                    </div>
                                    <div class="flex border-t border-gray-200 py-2">
                                        <span class="text-gray-500">Recargos:</span>
                                        <span class="ml-auto text-gray-900">0</span>
                                    </div>
                                    <div class="flex border-t border-gray-200 py-2">
                                        <span class="text-gray-500">Total:</span>
                                        <span class="ml-auto text-gray-900">1834</span>
                                    </div>
                                    <div
                                        class="flex border-t border-b mb-6 border-gray-200 py-2">
                                        <span class="text-gray-500">Cantidad a Pagar:</span>
                                        <span class="ml-auto text-gray-900">1834</span>
                                    </div>
                                    <div class="flex">
                                        <span
                                            class="title-font font-medium text-2xl text-gray-900">TOTAL:</span>
                                        <span
                                            class=" flex ml-auto title-font font-medium text-2xl text-gray-900">$1834.00</span>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="flex items-center justify-between mt-6">
                            <div>
                                <x-button x-on:click="steps=1" right-icon="arrow-left" blue label="Regresar" md />
                                <x-button x-on:click="steps=4" href="{{ route('afac.downloadE5') }}" right-icon="chevron-double-down" green label="Generar Hoja" md />
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>