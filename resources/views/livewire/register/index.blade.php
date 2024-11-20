<div>
    <x-notifications position="top-right" />
    <x-dialog z-index="z-50" blur="md" align="center" />
    <section class="lg:flex justify-center min-h-screen">
        <div
            class="relative before:absolute before:w-full before:h-full before:inset-0 before:bg-black before:opacity-0">
            <img src="{{ asset('images/AFAC_citas_fondo.jpg') }}" alt="backimagenAFAC"
                class="absolute inset-0 w-full h-full object-cover" />
            <div
                class="min-h-[300px] relative h-full max-w-6xl mx-auto flex flex-col justify-center items-center text-center text-white p-6">
                <div class="py-4 flex items-center justify-center opacity-80">
                    <img class="lg:w-40 lg:h-30 w-40 h-30 mr-2" src="{{ asset('images/isologo_AFAC_white.png') }}"
                        alt="logo">
                </div>
                <h1 class="text-xl font-semibold capitalize text-white lg:text-xl">SISTEMA GENERAL DE CITAS DE LA AFAC
                </h1>
            </div>
        </div>
        <div class="flex items-center w-full max-w-full p-4 mx-auto lg:px-12 lg:w-4/5">
            <div class="w-full">
                <h1 class="text-3xl text-sky-900 font-semibold tracking-wider capitalize">
                    REGISTRO
                </h1>
                <div class="flex p-4 mb-4 mt-2 text-sm text-sky-900 rounded-lg bg-sky-50" role="alert">
                    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium uppercase"> Verificar cuidadosamente la información antes de
                            proceder con su registro.</span>
                    </div>
                </div>

                <div x-data="{ enabled: @entangle('enabled'), }">
                    <div class="mt-8 grid md:grid-cols-2 md:gap-6">
                        <div class="relative mb-3 w-full group">
                            <x-input wire:model.blur="curp" label="INGRESA TU CURP" x-mask="##################"
                                x-bind:disabled="enabled" placeholder="ESCRIBE..." class="uppercase" />
                        </div>
                    </div>
                    <div class="text-left">
                        <x-button wire:click="searchRenapo" label="CONSULTAR" blue />
                        <x-button wire:click="cleanSearch" secondary label="LIMPIAR" />
                        <div wire:loading wire:target="searchRenapo">
                            <div
                                class="flex justify-center bg-gray-600 z-40 h-full w-full fixed top-0 left-0 items-center opacity-75">
                                <img src="{{ asset('images/isologo_AFAC_white.png') }}" width="20%"
                                    class="opacity-80 animate-pulse mr-2">
                            </div>
                        </div>
                    </div>
                    <div x-show="!enabled">
                        <div class="flex items-center justify-center opacity-80 animate-bounce mt-12">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="100" height="100"
                                viewBox="0 0 1280.000000 1280.000000" preserveAspectRatio="xMidYMid meet">
                                <g transform="translate(0.000000,1280.000000) scale(0.100000,-0.100000)" fill="#616161"
                                    stroke="none">
                                    <path
                                        d="M6010 12789 c-2387 -151 -4498 -1617 -5461 -3794 -567 -1282 -699 -2724 -373 -4085 462 -1931 1818 -3560 3629 -4361 336 -148 748 -288 1087 -368 1613 -384 3265 -148 4693 669 810 464 1532 1126 2072 1900 870 1248 1269 2808 1107 4325 -162 1520 -847 2903 -1964 3970 -737 704 -1647 1223 -2644 1509 -671 193 -1457 279 -2146 235z m970 -593 c1232 -138 2290 -591 3209 -1372 151 -129 482 -458 608 -604 334 -389 593 -781 823 -1245 320 -647 494 -1252 577 -2000 25 -227 25 -909 0 -1140 -107 -979 -411 -1841 -924 -2625 -929 -1416 -2438 -2364 -4113 -2584 -280 -37 -360 -41 -755 -41 -417 0 -487 4 -820 51 -842 117 -1661 425 -2370 889 -1378 901 -2322 2363 -2569 3975 -54 351 -61 456 -61 895 0 418 7 529 51 835 120 841 441 1684 907 2385 770 1155 1910 1992 3249 2384 346 101 778 179 1173 211 176 14 845 5 1015 -14z" />
                                    <path
                                        d="M7440 10035 c-748 -103 -1392 -554 -1740 -1218 -238 -454 -318 -1004 -219 -1515 70 -363 234 -717 463 -1001 l68 -84 -116 -116 -116 -116 -43 43 c-51 50 -98 63 -143 39 -16 -9 -559 -546 -1206 -1194 l-1178 -1178 0 -43 c0 -24 6 -55 14 -70 16 -29 315 -329 356 -356 13 -9 45 -16 70 -16 l45 0 1178 1178 c648 647 1185 1190 1194 1206 24 45 11 92 -39 143 l-43 43 116 116 116 116 84 -68 c331 -267 766 -446 1201 -493 122 -14 365 -14 483 -1 526 59 989 274 1364 635 196 189 343 391 466 640 115 233 176 432 215 692 24 167 27 463 6 623 -67 504 -286 955 -635 1314 -200 204 -396 346 -641 465 -235 114 -465 183 -713 216 -144 18 -471 19 -607 0z m523 -590 c879 -115 1530 -883 1494 -1760 -15 -340 -104 -613 -292 -895 -341 -510 -952 -806 -1554 -751 -432 38 -793 210 -1092 517 -151 157 -229 269 -323 464 -256 536 -209 1172 124 1672 363 545 1000 837 1643 753z" />
                                </g>
                            </svg>
                        </div>
                    </div>
                    <div x-show="enabled">
                        <div class="mt-8 grid md:grid-cols-3 md:gap-6">
                            <div class="relative mb-6 w-full group">
                                <x-input class="uppercase" wire:model.lazy="name" label="NOMBRE (S)"
                                    placeholder="ESCRIBE..." readonly />
                                {{-- <input wire:model.lazy="name" type="text" name="floating_first_name"
                                    id="floating_first_name"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required />
                                <label for="floating_first_name"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre(s)</label>
                                @error('name')
                                <span
                                    class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{
                                    $message }}</span>
                                @enderror --}}
                            </div>
                            <div class="relative mb-6 w-full group">
                                <x-input class="uppercase" wire:model.lazy="apParental" label="APELLIDO PATERNO"
                                    placeholder="ESCRIBE..." readonly />
                                {{-- <input type="text" name="floating_last_name" id="floating_last_name"
                                    wire:model.lazy="apParental"
                                    class="uppercase block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required />
                                <label for="floating_last_name"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Apellido
                                    Paterno</label>
                                @error('apParental')
                                <span
                                    class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{
                                    $message }}</span>
                                @enderror --}}
                            </div>
                            <div class="relative mb-6 w-full group">
                                <x-input class="uppercase" wire:model.lazy="apMaternal" label="APELLIDO MATERNO"
                                    placeholder="ESCRIBE..." readonly />
                                {{-- <input type="text" name="floating_last_name2" id="floating_last_name2"
                                    wire:model.lazy="apMaternal"
                                    class="uppercase block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required />
                                <label for="floating_last_name2"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Apellido
                                    Materno</label>
                                @error('apMaternal')
                                <span
                                    class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{
                                    $message }}</span>
                                @enderror --}}
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 md:gap-6">

                            <ul
                                class="items-center w-full text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <li
                                    class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                    <div class="flex items-center pl-3">
                                        <x-radio id="right-labelF" label="FEMENINO" value="Femenino"
                                            wire:model.defer="genre" readonly />
                                        {{-- <input id="horizontal-list-radio-license" type="radio" value="Femenino"
                                            wire:model.lazy="genre" name="list-radio"
                                            class="uppercase w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="horizontal-list-radio-license"
                                            class="py-3 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Femenino</label>
                                        --}}
                                    </div>
                                </li>
                                <li
                                    class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                    <div class="flex items-center pl-3">
                                        <x-radio id="right-labelM" label="MASCULINO" value="Masculino"
                                            wire:model.defer="genre" readonly />
                                        {{-- <input id="horizontal-list-radio-id" type="radio" value="Masculino"
                                            wire:model.lazy="genre" name="list-radio"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="horizontal-list-radio-id"
                                            class="py-3 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Masculino</label>
                                        --}}
                                    </div>
                                </li>
                            </ul>
                            <div class="relative mb-6 w-full group">
                                <x-input class="uppercase" wire:model.lazy="country_birth_participant"
                                    label="PAÍS DE NACIMIENTO" placeholder="INGRESE..." readonly/>
                            </div>
                        </div>


                        <div class="mt-6 grid md:grid-cols-3 md:gap-6">
                            <div class="relative w-full mb-3 group">
                                <x-input wire:model.live="nationality_participant" label="NACIONALIDAD"
                                    placeholder="INGRESE..." readonly />
                            </div>
                            <div class="relative w-full mb-3 group">
                                <x-input wire:model.live="state_birth_participant" label="ESTADO DE NACIMIENTO"
                                    placeholder="INGRESE..." readonly />
                            </div>

                            <div class="relative mb-6 w-full group">
                                <x-input label="Fecha de nacimiento" placeholder="SELECCIONE FECHA..."
                                    without-time="false" wire:model.live="birth" />
                            </div>
                        </div>

                        <div class="mt-2 grid md:grid-cols-3 md:gap-6">
                            <div class="relative mb-6 w-full group">
                                <x-inputs.maskable label="EDAD" mask="##" placeholder="ESCRIBE..."
                                    wire:model.defer="age" readonly />
                            </div>
                            <div class="relative w-full mb-2 group">
                                <x-input class="uppercase" wire:model.blur="rfc_participant" label="RFC"
                                    hint="INGRESA HOMOCLAVE" x-mask="*************" />
                            </div>
                        </div>
                        <h1 class="text-xl text-sky-900 font-semibold tracking-wider capitalize">
                            DOMICILIO ACTUAL
                        </h1>
                        <div class="h-1 bg-gray-200 rounded overflow-hidden">
                        </div>

                        <div class="mt-6 grid md:grid-cols-3 md:gap-6">
                            <div class="relative mb-6 w-full group">
                                <x-select id="selectCountry" wire:model.change="country_id"
                                    x-bind:disabled="!enabled" placeholder="SELECCIONE..." label="PAÍS">
                                    <x-select.option label="MÉXICO" value="165" />
                                </x-select>
                                {{-- @error('country_id')
                                <span class="text-red-600 text-sm mr-1 px-2.5 py-0.5">{{ $message }}</span>
                                @enderror --}}
                            </div>



                            <div class="relative mb-3 w-full group">
                                <div wire:ignore>
                                    <div class="relative w-full mb-3 group">
                                        <label class="leading-7 text-sm text-gray-600">ESTADO*</label>
                                        <select id="selectState" wire:model.change="state_id"
                                            x-bind:disabled="!enabled">
                                            <option data-placeholder="true">SELECCIONE...
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                @error('state_id')
                                    <span class="text-red-600 text-sm mr-1 px-2.5 py-0.5">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="relative w-full mb-3 group">
                                <div wire:ignore>
                                    <label class="leading-7 text-sm text-gray-600">MUNICIPIO*</label>
                                    <select id="selectMunicipality" wire:model.live="municipal_id"
                                        x-bind:disabled="!enabled">
                                        <option data-placeholder="true">SELECCIONE...</option>
                                    </select>
                                </div>
                                @error('municipal_id')
                                <span class="text-red-600 text-sm mr-1 px-2.5 py-0.5">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="mt-2 grid md:grid-cols-3 md:gap-6">
                            <div class="relative mb-6 w-full group">
                                <x-input class="uppercase" wire:model.lazy="street" label="INGRESE LA CALLE"
                                    placeholder="ESCRIBE..." />
                            </div>
                            <div class="relative mb-6 w-full group">
                                <x-input class="uppercase" wire:model.lazy="nInterior" label="NÚMERO INTERIOR"
                                    placeholder="ESCRIBE..." />
                            </div>
                            <div class="relative mb-6 w-full group">
                                <x-input class="uppercase" wire:model.lazy="nExterior" label="NÚMERO EXTERIOR"
                                    placeholder="ESCRIBE..." />
                            </div>
                        </div>
                        <div class="mt-6 grid md:grid-cols-3 md:gap-6">
                            <div class="relative mb-6 w-full group">
                                <x-inputs.maskable mask="#####" class="uppercase" wire:model.lazy="postalCode"
                                    label="CÓDIGO POSTAL" placeholder="ESCRIBE..." />
                            </div>
                            <div class="relative mb-6 w-full group">
                                <x-input class="uppercase" wire:model.lazy="suburb" label="COLONIA"
                                    placeholder="ESCRIBE..." />
                            </div>
                            <div class="relative mb-6 w-full group">
                                <x-input class="uppercase" wire:model.lazy="delegation" label="LOCALIDAD"
                                    placeholder="ESCRIBE..." />
                            </div>
                        </div>

                        {{-- <div class="mt-2 grid md:grid-cols-3 md:gap-6">
                            <div class="relative mb-6 w-full group">
                                <x-input class="uppercase" wire:model.lazy="federalEntity" label="ENTIDAD FEDERATIVA"
                                    placeholder="ESCRIBE..." />
                            </div>
                        </div> --}}
                        <h1 class="text-xl text-sky-900 font-semibold tracking-wider capitalize">
                            DATOS DE CONTACTO
                        </h1>
                        <div class="h-1 bg-gray-200 rounded overflow-hidden">
                        </div>
                        <div class="mt-6 grid md:grid-cols-3 md:gap-6">
                            <div class="relative mb-6 w-full group">
                                <x-inputs.maskable label="TELÉFONO MOVIL" wire:model.lazy="mobilePhone"
                                    mask="(##)####-####" placeholder="INGRESE..." />
                            </div>
                            <div class="relative mb-6 w-full group">
                                <x-inputs.maskable label="TELÉFONO DE OFICINA" wire:model.lazy="officePhone"
                                    mask="(##)####-####" placeholder="INGRESE..." />
                            </div>
                            <div class="relative mb-6 w-full group">
                                <x-inputs.maskable label="EXTENSIÓN" wire:model.lazy="extension" mask="####"
                                    placeholder="INGRESE..." />
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 mb-6 w-full group">
                                <x-input class="pr-28" label="CORREO ELECTRÓNICO" wire:model.lazy="email"
                                    placeholder="INGRESE..." />
                            </div>
                        </div>


                        <h1 class="text-xl text-sky-900 font-semibold tracking-wider capitalize">
                            DATOS LABORALES
                        </h1>
                        <div class="h-1 bg-gray-200 rounded overflow-hidden">
                        </div>
                        <div class="mt-4 grid md:grid-cols-2 md:gap-6">
                            <div class="relative w-full mb-3 group">
                                <x-input class="uppercase" wire:model.live="rfc_company_participant"
                                    x-mask="*************" x-bind:disabled="!enabled" label="RFC DE LA EMPRESA"
                                    placeholder="INGRESE..." />
                            </div>
                            <div class="relative w-full mb-3 group">
                                <x-input class="uppercase" wire:model.live="name_company_participant"
                                    x-bind:disabled="!enabled" label="NOMBRE DE LA EMPRESA"
                                    placeholder="INGRESE..." />
                            </div>
                        </div>

                        <h1 class="text-xl text-sky-900 font-semibold tracking-wider capitalize">
                            GENERA DATOS DE ACCESO
                        </h1>
                        <div class="h-1 bg-gray-200 rounded overflow-hidden">
                        </div>
                        <div class="flex p-4 mb-4 mt-2 text-sm text-sky-900 rounded-lg bg-sky-50" role="alert">
                            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium uppercase">INTRODUCE UNA CONTRASEÑA PARA ESTE
                                    SISTEMA.
                                    RECUERDA QUE DEBE TENER AL MENOS 8 CARACTERES, INCLUYENDO AL MENOS
                                    UNA
                                    MAYÚSCULA, UNA MINÚSCULA, UN NÚMERO Y UN CARÁCTER ESPECIAL (/, +, -,
                                    ?, ¿, #, *,
                                    !, ¡, <,>, ~, &, $, %)</span>
                            </div>
                        </div>


                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative mb-6 w-full group">
                                <x-input class="pr-28" type="password" label="CONTRASEÑA"
                                    wire:model.lazy="passwordConfirmation" placeholder="INGRESE..." />
                            </div>
                            <div class="relative mb-6 w-full group">
                                <x-input class="pr-28" type="password" label="CONFIRMAR CONTRASEÑA"
                                    wire:model.lazy="password" placeholder="INGRESE..." />
                            </div>
                        </div>

                        {{-- <div class="flex items-center">
                            <div class="flex items-center mb-4">
                                <input type="checkbox" wire:model.blur="confirm_privacity"
                                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />

                                <a target="_blank"
                                    href="{{ url('documents/aviso_de_privacidad_integral_dgpympt.pdf') }}">
                                    <label for="default-checkbox"
                                        class="ml-2 text-sm font-medium text-blue-500 hover:underline cursor-pointer">
                                        Acepto el aviso de privacidad
                                    </label>
                                    @error('confirm_privacity')
                                        <span
                                            class="text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{ $message }}</span>
                                    @enderror
                                </a>
                            </div>
                        </div> --}}


                        <div class="text-right">
                            <button wire:click.prevent="register"
                                class="px-3 py-2 text-sm font-medium text-center text-white bg-sky-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Registrar
                            </button>
                            <div wire:loading.delay.shortest wire:target="register">
                                <div
                                    class="flex justify-center bg-gray-200 z-40 h-full w-full fixed top-0 left-0 items-center opacity-75">
                                    <div style="color: #0061cf" class="la-line-spin-clockwise-fade-rotating la-3x">
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
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // SELECT STATES
            const slimSelectState = new SlimSelect({
                select: '#selectState',
                settings: {
                    allowDeselect: true,
                    hideSelected: true,
                    searchHighlight: true,
                    openPosition: 'up', // 'auto', 'up' or 'down'
                    placeholderText: 'SELECCIONE...',
                    searchText: 'SIN RESULTADOS...',
                },
            });
            Livewire.on('updated-state', (options) => {
                const defaultSelect = [{
                    'placeholder': true,
                    'text': 'SELECCIONE...'
                }];
                const formattedOptions = options.map(option => ({
                    text: option.name_state,
                    value: option.id + ',' + option.name_state
                }));
                const formattedConcatOptions = defaultSelect.concat(formattedOptions);
                slimSelectState.setData(formattedConcatOptions);
            });

            // SELECT MUNICIPALITIES
            const slimSelectMunicipality = new SlimSelect({
                select: '#selectMunicipality',
                settings: {
                    allowDeselect: true,
                    hideSelected: true,
                    searchHighlight: true,
                    openPosition: 'up', // 'auto', 'up' or 'down'
                    placeholderText: 'SELECCIONE...',
                    searchText: 'SIN RESULTADOS...',
                },
            });
            Livewire.on('updated-municipal', (options) => {
                const defaultSelect = [{
                    'placeholder': true,
                    'text': ''
                }];
                const formattedOptions = options.map(option => ({
                    text: option.name_municipal,
                    value: option.id + ',' + option.name_municipal
                }));
                const formattedConcatOptions = defaultSelect.concat(formattedOptions);
                slimSelectMunicipality.setData(formattedConcatOptions);
            });

        });
    </script>
</div>
