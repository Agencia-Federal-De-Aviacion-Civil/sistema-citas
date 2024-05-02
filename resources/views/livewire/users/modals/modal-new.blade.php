<div>
    <div class="container mx-auto px-6 py-6 bg-white shadow-xl sm:rounded-lg ">
        <x-banner-modal-icon :title="'USUARIO'" :size="'w-16 h-16'" :icon="'user'" :titlesize="'xl'" />
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

        @if ($userstatus === '2'||$userstatus === 2)
            <div class="grid xl:grid-cols-2 xl:gap-4 grid-cols-1 py-2 space-x-4">
                <div class="flex flex-col">
                    <div class="mt-1 relative z-auto w-full group">
                        <x-datetime-picker wire:model.lazy="start_date" label="FECHA DE INICIAL" without-time="false"
                            placeholder="INGRESAR..." display-format="DD-MM-YYYY" />
                    </div>
                </div>

                <div class="flex flex-col">
                    <x-datetime-picker wire:model.lazy="end_date"  label="FECHA DE FINAL" without-time="false"
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
                        <x-select label="GENERO" placeholder="SELECCIONE..." wire:model.defer="genre">
                            <x-select.option label="FEMENINO" value="FEMENINO" />
                            <x-select.option label="MASCULINO" value="MASCULINO" />
                        </x-select>
                    </div>
                    <div class="mt-4 relative w-full group">
                        <x-input class="uppercase" wire:model.lazy="curp" label="CURP" placeholder="INGRESE..." />
                    </div>
                    <div class="mt-4 relative w-full group">
                        <x-datetime-picker label="NACIMIENTO" placeholder="SELECCIONE FECHA..."
                            parse-format="YYYY-MM-DD" without-time="false" wire:model.defer="birth" />
                    </div>
                </div>
                <div class="grid xl:grid-cols-3 xl:gap-6">
                    <div class="mt-4 relative w-full group">
                        <x-inputs.maskable label="EDAD" mask="##" placeholder="ESCRIBE..."
                            wire:model.defer="age" />
                    </div>
                    <div class="mt-4 relative w-full group">
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
