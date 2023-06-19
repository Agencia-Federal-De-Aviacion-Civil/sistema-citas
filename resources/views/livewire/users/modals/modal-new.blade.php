    <div>
        <div
            class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-0 sm:my-0 sm:align-middle sm:max-w-4xl sm:w-full sm:p-6">
            <div>
                <div class="p-0 text-center">
                    {{ $this->title }}
                </div>
                <div class="mt-4 text-center">
                    <h3 class="text-xl font-semibold leading-6 text-gray-800 capitalize dark:text-white" id="modal-title">
                    </h3>
                    <div class="grid xl:grid-cols-3 xl:gap-9">
                        <div class="mt-1 relative w-full group">
                            <x-input wire:model="name" label="NOMBRE" placeholder="ESCRIBE..." />
                        </div>
                        <div class="mt-1 relative w-full group">
                            <x-input wire:model="apParental" label="APELLIDO PATERNO" placeholder="ESCRIBE..." />
                        </div>
                        <div class="mt-1 relative w-full group">
                            <x-input wire:model="apMaternal" label="APELLIDO MATERNO" placeholder="ESCRIBE..." />
                        </div>
                    </div>

                    <div class="grid xl:grid-cols-3 xl:gap-6">
                        <div class="mt-4 relative w-full group">
                            <x-input wire:model="email" label="CORREO" placeholder="ESCRIBE..." />
                        </div>
                        <div class="mt-4 relative w-full group">
                            <x-inputs.password wire:model="password" label="CONTRASEÑA" />
                        </div>
                        <div class="mt-4 relative w-full group">
                            <x-inputs.password wire:model="passwordConfirmation" label="CONFIRMAR CONTRASEÑA" />
                        </div>
                    </div>
                    <div class="mt-4 relative w-full group">
                        <x-select wire:model.defer="privileges" label="ROL" placeholder="Seleccione...">
                            @foreach ($roles as $role)
                                <x-select.option label="{{ $role->name }}" value="{{ $role->name }}" />
                            @endforeach
                        </x-select>
                    </div>

                    <div x-data="{ open: false }">

                        <div class="mt-6">
                        <x-button x-on:click="open = ! open" label="DATOS" silver icon="document" />
                        </div>
                        {{-- <button x-on:click="open = ! open" blue right-icon="save-as">DATOS</button> --}}

                        <ul x-show="open"

                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-90"

                        >

                    <div class="grid xl:grid-cols-3 xl:gap-6">
                        <div class="mt-4 relative w-full group">
                            <x-select label="GENERO" placeholder="SELECCIONE..." wire:model.defer="genre">
                                <x-select.option label="SELECCIONE..." value="" />
                                    <x-select.option label="FEMENINO" value="FEMENINO" />
                                    <x-select.option label="MASCULINO" value="MASCULINO" />
                                </x-select>

                            {{-- <ul
                                class="items-center w-full text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <li
                                    class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                    <div class="flex items-center pl-3">
                                        <x-radio id="right-labelF" label="FEMENINO" value="Femenino"
                                            wire:model.defer="genre" />
                                    </div>
                                </li>
                                <li
                                    class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                    <div class="flex items-center pl-3">
                                        <x-radio id="right-labelM" label="MASCULINO" value="Masculino"
                                            wire:model.defer="genre" />
                                    </div>
                                </li>
                            </ul> --}}
                        </div>
                        <div class="mt-4 relative w-full group">
                            <x-input class="uppercase" wire:model.lazy="curp" label="CURP"
                                placeholder="INGRESE..." />
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
                                @foreach ($states as $states)
                                    <option value="{{ $states->id }}" {{ $state_id == $states->id ? 'selected' : '' }}>
                                        {{ $states->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if(!@isset($select))
                        <div class="mt-4 relative w-full group">
                            <x-input class="uppercase" wire:model.defer="municipio" label="MUNICIPIO" disabled/>
                        </div>
                        @else
                        <div class="mt-4 relative w-full group">
                            <label for="systems"
                            class="block text-sm font-medium text-gray-900 dark:text-white">MUNICIPIO</label>
                            <select label="MUNICIPIO" wire:model.defer="municipal_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">SELECCIONE...</option>
                                @foreach ($municipals as $municipal)
                                    <option value="{{ $municipal->id }}" >{{ $municipal->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
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
                        <div class="mt-4 relative w-full group">
                            <x-input class="uppercase" wire:model.lazy="suburb" label="COLONIA"
                                placeholder="ESCRIBE..." />
                        </div>
                        <div class="mt-4 relative w-full group">
                            <x-inputs.maskable mask="#####" class="uppercase" wire:model.lazy="postalCode"
                                label="CÓDIGO POSTAL" placeholder="ESCRIBE..." />
                        </div>
                        <div class="mt-4 relative w-full group">
                            <x-input class="uppercase" wire:model.lazy="federalEntity" label="ENTIDAD FEDERATIVA"
                                placeholder="ESCRIBE..." />
                        </div>
                    </div>
                    <div class="grid xl:grid-cols-4 xl:gap-6">
                        <div class="mt-4 relative w-full group">
                            <x-input class="uppercase" wire:model.lazy="delegation" label="DELEGACIÓN"
                                placeholder="ESCRIBE..." />
                        </div>
                        <div class="mt-4 relative w-full group">
                            <x-inputs.maskable label="TELÉFONO MOVIL" wire:model.lazy="mobilePhone"
                                mask="(##)####-####" placeholder="INGRESE..." />
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

                    <div class="float-right mt-6">
                        <x-button wire:click.prevent="save()" label="GUARDAR" blue right-icon="save-as" />
                    </div>
                    <div class="float-left mt-6">
                        <x-button wire:click="$emit('closeModal')" label="SALIR" silver />
                    </div>

                </div>
            </div>
        </div>

    </div>
