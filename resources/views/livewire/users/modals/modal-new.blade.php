<div>

    <div class="container mx-auto px-6 py-6 bg-white shadow-xl sm:rounded-lg">
        <div x-data="{ enabled: @entangle('enabled'), }">
            <div class="mt-8 grid md:grid-cols-2 md:gap-6">
                <div class="relative mb-3 w-full group">
                    <x-input wire:model.blur="curp" label="INGRESA TU CURP" x-mask="##################"
                        x-bind:disabled="enabled" placeholder="ESCRIBE..." class="uppercase" />
                </div>
            </div>
            @if(!$buttonHIden)
                <div class="text-left">
                    <x-button wire:click="searchRenapo" label="CONSULTAR" blue />
                    <x-button wire:click="cleanSearch" secondary label="LIMPIAR" />
                    <x-button wire:click="$emit('closeModal')" secondary label="CERRAR" />

                    <div wire:loading wire:target="searchRenapo">
                        <div
                            class="flex justify-center bg-gray-600 z-40 h-full w-full fixed top-0 left-0 items-center opacity-75">
                            <img src="{{ asset('images/isologo_AFAC_white.png') }}" width="20%"
                                class="opacity-80 animate-pulse mr-2">
                        </div>
                    </div>
                </div>
            @endif
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

        {{-- <x-banner-modal-icon :title="'USUARIO'" :size="'w-16 h-16'" :icon="'user'" :titlesize="'xl'" /> --}}
        <div class="grid xl:grid-cols-3 xl:gap-9 py-4">
            <div class="mt-1 relative w-full group">
                <x-input wire:model="name" label="NOMBRE" placeholder="ESCRIBE..." class="uppercase" />
            </div>
            <div class="mt-1 relative w-full group">
                <x-input wire:model="apParental" label="APELLIDO PATERNO" placeholder="ESCRIBE..." class="uppercase" />
            </div>
            <div class="mt-1 relative w-full group">
                <x-input wire:model="apMaternal" label="APELLIDO MATERNO" placeholder="ESCRIBE..." class="uppercase" />
            </div>
        </div>
        <div class="grid xl:grid-cols-1 xl:gap-6">
            <div class="mt-4 relative w-full group">
                <x-input wire:model="email" label="CORREO" placeholder="ESCRIBE..." class="lowercase" />
            </div>
        </div>
        <div class="grid xl:grid-cols-2 xl:gap-6">
            <div class="mt-4 relative w-full group">
                <x-inputs.password wire:model="password" label="CONTRASEÑA" />
            </div>
            <div class="mt-4 relative w-full group">
                <x-inputs.password wire:model="passwordConfirmation" label="CONFIRMAR CONTRASEÑA" />
            </div>
        </div>
        @empty($userPrivileges)
        @else
            <div class="grid xl:grid-cols-0 xl:gap-6 text-center">
                <div class="mt-4 relative w-full group">
                    @if (!$isVerified)
                        <x-button outline wire:click.prevent="verified({{ $id_save }})" primary
                            label="VERIFICAR CORREO" right-icon="mail" />
                    @else
                        <x-badge flat lg positive label="VERIFICADO" right-icon="mail-open" />
                    @endif
                </div>
            </div>
        @endempty
        @canany(['super_admin.see.tabs.navigation'])
            <div x-data="{ roleuser: @entangle('privileges') }">
                <div class="mt-4 relative w-full group">
                    <label for="systems" class="block text-sm font-medium text-gray-900 dark:text-white">ROL</label>
                    <select x-ref="roleuser" x-model="roleuser" wire:model.lazy="privileges"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Selecciona...</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" {{ $privileges == $role->name ? 'selected' : '' }}>
                                {{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('privileges')
                        <span class="text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-4"
                    x-show="roleuser === 'headquarters' || roleuser === 'sub_headquarters'||roleuser === 'headquarters_authorized'">
                    <label for="systems" class="block text-sm font-medium text-gray-900 dark:text-white">RESPONSABLE DE
                        LA
                        SEDE:</label>
                    <select wire:model.lazy="headquarter_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Selecciona...</option>
                        @foreach ($headquarters as $headquarter)
                            <option value="{{ $headquarter->id }}"
                                {{ $headquarter_id == $headquarter->id ? 'selected' : '' }}>
                                {{ $headquarter->name_headquarter . ' ' . ($headquarter->is_external == true ? 'TERCEROS' : 'AFAC') }}
                            </option>
                        @endforeach
                    </select>
                    @error('headquarter_id')
                        <span class="text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        @endcanany
        <div class="grid xl:grid-cols-3 xl:gap-6">
            <div class="mt-4 relative w-full group">
                <label class="font-semibold text-blue-800">Status</label>
                <select wire:model.lazy="userstatus"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="">Selecciona...</option>
                    <option selected value="0">ACTIVO</option>
                    <option selected value="2">SUSPENDIDO</option>
                </select>
            </div>
        </div>

        @if ($userstatus === '2' || $userstatus === 2)
            <div class="grid xl:grid-cols-2 xl:gap-4 grid-cols-1 py-2 space-x-4">
                <div class="flex flex-col">
                    <div class="mt-1 relative z-auto w-full group">
                        <x-datetime-picker wire:model.lazy="start_date" label="FECHA DE INICIAL" without-time="false"
                            placeholder="INGRESAR..." display-format="DD-MM-YYYY" />
                    </div>
                </div>

                <div class="flex flex-col">
                    <x-datetime-picker wire:model.lazy="end_date" label="FECHA DE FINAL" without-time="false"
                        placeholder="INGRESAR..." display-format="DD-MM-YYYY" />
                </div>
            </div>
            <div class="py-4">
                <x-textarea wire:model="reason" label="MOTIVO" placeholder="ESCRIBE..." class="uppercase" />
            </div>
        @endif
        {{-- </div> --}}
        <div x-data="{ open: false }">
            <div class="mt-6 text-center">
                <x-button x-on:click="open = ! open" label="DATOS" silver icon="document" />
            </div>
            {{-- <button x-on:click="open = ! open" blue right-icon="save-as">DATOS</button> --}}

            <ul x-show="open" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90">

                <div class="grid xl:grid-cols-3 xl:gap-6">
                    <div class="mt-4 relative w-full group">
                        <x-select label="GENERO" placeholder="SELECCIONE..." wire:model.defer="genre" >
                            <x-select.option label="FEMENINO" value="FEMENINO" />
                            <x-select.option label="MASCULINO" value="MASCULINO" />
                        </x-select>
                    </div>
                    {{-- <div class="mt-4 relative w-full group">
                        <x-input class="uppercase" wire:model.lazy="curp" label="CURP" placeholder="INGRESE..." />
                    </div> --}}
                    <div class="mt-4 relative w-full group">
                        <x-datetime-picker label="NACIMIENTO" placeholder="SELECCIONE FECHA..."
                            parse-format="YYYY-MM-DD" without-time="false" wire:model.defer="birth" />
                    </div>
                    <div class="mt-4 relative w-full group">
                        <x-inputs.maskable label="EDAD" mask="##" placeholder="ESCRIBE..."
                            wire:model.defer="age" />
          wire:model.defer="age" readonly/>
                   <label for="systems"
                            class="block text-sm font-medium text-gray-900 dark:text-white">ESTADO</label>
                        <select wire:model.lazy="state_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="">Selecciona...</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}" {{ $state_id == $state->id ? 'selected' : '' }}>
                                    {{ $state->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-4 relative w-full group">
                        <label for="systems"
                            class="block text-sm font-medium text-gray-900 dark:text-white">MUNICIPIO</label>
                        <select label="MUNICIPIO" wire:model.defer="municipal_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">SELECCIONE...</option>
                            @foreach ($municipals as $municipal)
                                <option value="{{ $municipal->id }}"
                                    {{ $municipal_id == $municipal->id ? 'selected' : '' }}>
                                    {{ $municipal->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid xl:grid-cols-3 xl:gap-6">
                    <div class="mt-4 relative w-full group">
                        <x-input class="uppercase" wire:model.lazy="street" label="INGRESE LA CALLE"
                            placeholder="ESCRIBE..." />
                    </div>
                    <div class="mt-4 relative w-full group">
                        <x-input class="uppercase" wire:model.lazy="nInterior" label="NÚMERO INTERIOR"
                            placeholder="ESCRIBE..." />
                    </div>
                    <div class="mt-4 relative w-full group">
                        <x-input class="uppercase" wire:model.lazy="nExterior" label="NÚMERO EXTERIOR"
                            placeholder="ESCRIBE..." />
                    </div>
                </div>
                <div class="grid xl:grid-cols-3 xl:gap-6">
                    <div class="mt-4 relative w-full group col-span-2">
                        <x-input class="uppercase" wire:model.lazy="suburb" label="COLONIA"
                            placeholder="ESCRIBE..." />
                    </div>
                    <div class="mt-4 relative w-full group">
                        <x-inputs.maskable mask="#####" class="uppercase" wire:model.lazy="postalCode"
                            label="CÓDIGO POSTAL" placeholder="ESCRIBE..." />
                    </div>
                </div>
                <div class="grid xl:grid-cols-2 xl:gap-6">
                    <div class="mt-4 relative w-full group">
                        <x-input class="uppercase" wire:model.lazy="federalEntity" label="ENTIDAD FEDERATIVA"
                            placeholder="ESCRIBE..." />
                    </div>
                    <div class="mt-4 relative w-full group">
                        <x-input class="uppercase" wire:model.lazy="delegation" label="DELEGACIÓN"
                            placeholder="ESCRIBE..." />
                    </div>
                </div>
                <div class="grid xl:grid-cols-3 xl:gap-6">
                    <div class="mt-4 relative w-full group">
                        <x-inputs.maskable label="TELÉFONO MOVIL" wire:model.lazy="mobilePhone" mask="(##)####-####"
                            placeholder="INGRESE..." />
                    </div>
                    <div class="mt-4 relative w-full group">
                        <x-inputs.maskable label="TELÉFONO DE OFICINA" wire:model.lazy="officePhone"
                            mask="(##)####-####" placeholder="INGRESE..." />
                    </div>
                    <div class="mt-4 relative w-full group">
                        <x-inputs.maskable label="EXTENSIÓN" wire:model.lazy="extension" mask="####"
                            placeholder="INGRESE..." />
                    </div>
                </div>
            </ul>
        </div>
        {{-- <div class="float-right mt-6">
            <x-button wire:click.prevent="save()" label="GUARDAR" blue right-icon="save-as" />
        </div>
        <div class="float-left mt-6">
            <x-button wire:click="$emit('closeModal')" label="SALIR" silver />
        </div> --}}
        <!-- Footer -->
        <div class="flex items-center justify-between w-full gap-4 mt-8">
            <button wire:click.prevent="save()"
                class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                GUARDAR
            </button>
            <button wire:click="$emit('closeModal')"
                class="py-2 px-4 bg-gray-100 hover:bg-gray-200 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-indigo-500 w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                CERRAR
            </button>
        </div>
        <!-- End Footer -->

            </div>

        </div>
    </div>
</div>
