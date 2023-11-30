<div>
    <x-banner-component :title="'Bienvenido al Sistema de citas AFAC'" />
    <div class="py-2">
        <div x-data="{ 'showModal': false }" @keydown.escape="showModal = false">
            <div class="container px-6 p-y-1 mx-auto">
                <section class="text-gray-600 body-font">
                    <div class="container px-6 py-1 mx-auto">
                        <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-12 md:grid-cols-2 xl:grid-cols-3">
                            <a @click="showModal = true">
                                <div
                                    class="group bg-white h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden transition duration-100 transform hover:scale-105 hover:cursor-pointer">
                                    <div class="overflow-hidden bg-cover cursor-pointer lg:h-48 md:h-36 w-full object-cover object-center group"
                                        style="background-image:url('{{ asset('images/medicina-aviacion.jpg') }}')">
                                        <div
                                            class="flex flex-col justify-center w-full h-full px-8 py-4 transition-opacity duration-700 opacity-0 backdrop-blur-sm bg-gray-800 group-hover:opacity-70">
                                            <h2 class="mt-4 text-2xl font-semibold text-white capitalize">NUEVA CITA
                                            </h2>
                                            <p class="mt-2 text-lg tracking-wider text-blue-300 uppercase ">MEDICINA
                                                DE
                                                AVIACIÓN</p>
                                        </div>
                                    </div>
                                    <div class="p-6">
                                        <h1 class="title-font text-lg font-medium text-gray-900 mb-3">
                                            MEDICINA DE AVIACIÓN
                                        </h1>
                                        <div class="flex items-center flex-wrap ">
                                            <p
                                                class="group-hover:animate-pulse text-sky-700 inline-flex items-center md:mb-2 lg:mb-0">
                                                GENERAR CITA
                                                <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M5 12h14"></path>
                                                    <path d="M12 5l7 7-7 7"></path>
                                                </svg>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div x-cloak x-show="showModal" x-transition:enter="transition duration-300 ease-out"
                        x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
                        x-transition:leave="transition duration-150 ease-in"
                        x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
                        x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
                        class="fixed inset-0 z-20 overflow-y-auto overflow-auto bg-black bg-opacity-50"
                        aria-labelledby="modal-title" role="dialog" aria-modal="true">

                        <div tabindex="-1"
                            class="flex justify-center z-40 h-full w-full fixed top-0 left-0 items-center md:inset-0 h-[calc(100%-1rem)]">
                            <div class="relative w-full max-w-3xl max-h-full overflow-auto">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <div class="p-6 text-center">
                                        <svg class="mx-auto mb-4 text-gray-400 w-8 h-8 dark:text-gray-200"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 16 20">
                                            <path
                                                d="M8 0a7.992 7.992 0 0 0-6.583 12.535 1 1 0 0 0 .12.183l.12.146c.112.145.227.285.326.4l5.245 6.374a1 1 0 0 0 1.545-.003l5.092-6.205c.206-.222.4-.455.578-.7l.127-.155a.934.934 0 0 0 .122-.192A8.001 8.001 0 0 0 8 0Zm0 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                                        </svg>
                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                            ¿EN DONDE REALIZARAS TU CITA?</h3>
                                        {{-- <x-select label="SELECCIONA LA SEDE" placeholder="SELECCIONA..."
                                            wire:model.defer="selectedHeadquarter">
                                            @foreach ($headquartersAfac as $headquarterAfac)
                                                <x-select.option label="{{ $headquarterAfac->name_headquarter }}"
                                                    value="{{ $headquarterAfac->id . '-' . $headquarterAfac->is_external }}" />
                                            @endforeach
                                        </x-select> --}}
                                        {{-- <div class="grid grid-cols-1 gap-4 mt-4 xl:mt-4 md:grid-cols-2 xl:grid-cols-2">
                                            <button class="hover:animate-pulse" wire:click.prevent='goAfac(false)'>
                                                <div
                                                    class="flex flex-col items-center p-3 transition-colors duration-300 transform border cursor-pointer rounded-xl hover:border-transparent group hover:bg-gray-100 dark:border-gray-700 dark:hover:border-transparent">
                                                    <img class="object-cover w-24" src="{{ asset('images/AFAC1.png') }}"
                                                        alt="">
                                                    <p
                                                        class="mt-2 text-gray-500 capitalize dark:text-gray-300 group-hover:text-gray-600">
                                                        Agencia Federal de Aviación Civil</p>
                                                </div>
                                            </button>
                                            <button class="hover:animate-pulse" wire:click.prevent='goAfac(true)'>
                                                <div
                                                    class="flex flex-col items-center p-3 transition-colors duration-300 transform border cursor-pointer rounded-xl hover:border-transparent group hover:bg-gray-100 dark:border-gray-700 dark:hover:border-transparent">
                                                    <img class="object-cover w-20"
                                                        src="{{ asset('images/saludlogo.png') }}" alt="">
                                                    <p
                                                        class="mt-2 text-gray-500 capitalize dark:text-gray-300 group-hover:text-gray-600">
                                                        Instituciones para terceros</p>
                                                </div>
                                            </button>
                                        </div> --}}
                                        <button
                                            class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 focus:bg-gray-100 w-full p-4 rounded bg-gray-100 text-sm font-medium leading-none text-gray-800 flex items-center justify-between cursor-pointer"
                                            onclick="dropdownHandler()">
                                            Selecciona la sede
                                            <div>
                                                <div class="hidden" id="close">
                                                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M5.00016 0.666664L9.66683 5.33333L0.333496 5.33333L5.00016 0.666664Z"
                                                            fill="#1F2937" />
                                                    </svg>
                                                </div>
                                                <div id="open">
                                                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M5.00016 5.33333L0.333496 0.666664H9.66683L5.00016 5.33333Z"
                                                            fill="#1F2937" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </button>
                                        <div class="w-full mt-2 p-0 bg-gray-50 shadow rounded" id="dropdown">
                                            <div class="bg-white max-w-full mx-auto border border-gray-200">
                                                <ul class="shadow-box">
                                                    @foreach ($stategrup as $stategrups)
                                                        <li class="relative border-b border-gray-200"
                                                            x-data="{ selected: null }">

                                                            <button type="button" class="w-full px-8 py-6 text-left"
                                                                @click="selected !== 1 ? selected = 1 : selected = null">
                                                                <div class="flex items-center justify-between">
                                                                    <span>
                                                                        {{ $stategrups[0]->state }} </span>
                                                                    <span class="text-white bg-blue-500 rounded-full">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            class="w-6 h-6" fill="none"
                                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                                        </svg>
                                                                    </span>
                                                                </div>
                                                            </button>

                                                            <div class="relative overflow-hidden transition-all max-h-0 duration-700"
                                                                style="" x-ref="container1"
                                                                x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1
                                                                    .scrollHeight + 'px' : ''">
                                                                <div class="p-6">
                                                                    <section class="container px-4 mx-auto">
                                                                        {{-- <div class="flex items-center gap-x-3">
                                                                        <h2 class="text-lg font-medium text-gray-800 dark:text-white">Team members</h2>
                                                                
                                                                        <span class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">100 users</span>
                                                                    </div> --}}

                                                                        <div class="flex flex-col">
                                                                            <div
                                                                                class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                                                <div
                                                                                    class="inline-block min-w-full py-0 align-middle md:px-2 lg:px-2">
                                                                                    <div
                                                                                        class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">

                                                                                        <table
                                                                                            class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-left">
                                                                                            <thead
                                                                                                class="bg-gray-50 dark:bg-gray-800">
                                                                                                <tr>
                                                                                                    <th scope="col"
                                                                                                        class="py-3.5 px-4 text-sm font-normal text-left  text-gray-500 dark:text-gray-400">
                                                                                                        <div
                                                                                                            class="flex gap-x-3">
                                                                                                            {{-- <input type="checkbox" class="text-blue-500 border-gray-300 rounded dark:bg-gray-900 dark:ring-offset-gray-900 dark:border-gray-700"> --}}
                                                                                                            <span>Nombre</span>
                                                                                                        </div>
                                                                                                    </th>

                                                                                                    <th scope="col"
                                                                                                        class="px-12 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                                                                                                        <button
                                                                                                            class="flex gap-x-2">
                                                                                                            <span>Domicilio</span>
                                                                                                        </button>
                                                                                                    </th>

                                                                                                    <th scope="col"
                                                                                                        class="px-4 py-3.5 text-sm font-normal text-left  text-gray-500 dark:text-gray-400">
                                                                                                        <button
                                                                                                            class="flex gap-x-2">
                                                                                                            <span>Costo</span>

                                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                                fill="none"
                                                                                                                viewBox="0 0 24 24"
                                                                                                                stroke-width="1.5"
                                                                                                                stroke="currentColor"
                                                                                                                class="w-6 h-6">
                                                                                                                <path
                                                                                                                    stroke-linecap="round"
                                                                                                                    stroke-linejoin="round"
                                                                                                                    d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                                                            </svg>
                                                                                                        </button>
                                                                                                    </th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody
                                                                                                class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                                                                                @foreach ($headquartersAfac->where('state', $stategrups[0]->state) as $headquarterAfac)
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            class="px-4 py-4 text-sm font-medium text-gray-700">
                                                                                                            <div
                                                                                                                class="inline-flex gap-x-3">
                                                                                                                <input x-model="option"
                                                                                                                    type="radio"
                                                                                                                    name="sede"
                                                                                                                    wire:model.defer="selectedHeadquarter"
                                                                                                                    value="{{ $headquarterAfac->id . '-' . $headquarterAfac->is_external }}"
                                                                                                                    class="text-blue-500 border-gray-300 rounded dark:bg-gray-900 dark:ring-offset-gray-900 dark:border-gray-700">

                                                                                                                <div
                                                                                                                    class="flex gap-x-2">
                                                                                                                    <img class="object-cover w-10 h-10 rounded-full"
                                                                                                                        src="{{ $headquarterAfac->is_external == 1 ? asset('images/external.png') : asset('images/internal.png') }}"
                                                                                                                        alt="">
                                                                                                                    <div>
                                                                                                                        <h2
                                                                                                                            class="font-medium text-gray-800 dark:text-white ">
                                                                                                                            {{ $headquarterAfac->name_headquarter }}
                                                                                                                        </h2>
                                                                                                                        {{-- <p class="text-sm font-normal text-gray-600 dark:text-gray-400">@authurmelo</p> --}}
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
                                                                                                            {{ $headquarterAfac->direction }}
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="px-12 py-4 text-sm font-medium text-gray-700">

                                                                                                            <p
                                                                                                                class="px-3 py-1 text-xs text-indigo-500 rounded-full dark:bg-gray-800 bg-indigo-100/60">
                                                                                                                {{ $headquarterAfac->price }}
                                                                                                            </p>

                                                                                                        </td>
                                                                                                    </tr>
                                                                                                @endforeach
                                                                                            </tbody>
                                                                                        </table>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </section>
                                                                </div>
                                                            </div>

                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="mt-5 sm:flex sm:items-center sm:justify-between">
                                            <a href="https://www.gob.mx/afac/acciones-y-programas/citas-para-la-evaluacion-medica" class="text-sm text-blue-500 hover:underline">Mayor información</a>

                                            <div class="sm:flex sm:items-center ">
                                                <a href="#" @click="showModal = false" 
                                                    class="w-full px-4 py-2 mt-2 text-sm font-medium tracking-wide text-gray-700 capitalize transition-colors duration-300 transform border border-gray-200 rounded-md sm:mt-0 sm:w-auto sm:mx-2 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40">
                                                    Cancel
                                            </a>

                                                <x-button wire:click.prevent="selected"
                                                    right-icon="arrow-circle-right" primary label="CONTINUAR" />
                                                    <div wire:loading.delay.shortest wire:target="selected">
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
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<script>
    let dropdown = document.getElementById("dropdown");
    let open1 = document.getElementById("open");
    let close1 = document.getElementById("close");
    let flag = false;
    dropdown.classList.add("hidden");
    open1.classList.add("hidden");
    close1.classList.remove("hidden");
    flag = true;
    const dropdownHandler = () => {
        if (!flag) {
            dropdown.classList.add("hidden");
            open1.classList.add("hidden");
            close1.classList.remove("hidden");
            flag = true;
        } else {
            dropdown.classList.remove("hidden");
            close1.classList.add("hidden");
            open1.classList.remove("hidden");
            flag = false;
        }
    };
</script>
