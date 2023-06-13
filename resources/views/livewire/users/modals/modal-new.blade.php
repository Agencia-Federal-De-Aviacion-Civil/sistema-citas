    <div>
        <div
            class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-0 sm:my-0 sm:align-middle sm:max-w-2xl sm:w-full sm:p-6">
            <div>
                <div class="p-0 text-center">
                    {{ $this->title }}
                </div>
                <div class="mt-4 text-center">
                    <h3 class="text-xl font-semibold leading-6 text-gray-800 capitalize dark:text-white" id="modal-title">
                    </h3>
                    <div class="grid xl:grid-cols-2 xl:gap-6">
                        <div class="mt-1 relative w-full group">
                            <x-input wire:model="name" label="NOMBRE" placeholder="ESCRIBE..." />
                        </div>
                        <div class="mt-1 relative w-full group">
                            <x-input wire:model="apParental" label="APELLIDO PATERNO" placeholder="ESCRIBE..." />
                        </div>
                    </div>
                    <div class="grid xl:grid-cols-2 xl:gap-6">
                        <div class="mt-1 relative w-full group">
                            <x-input wire:model="apMaternal" label="APELLIDO MATERNO" placeholder="ESCRIBE..." />
                        </div>
                        <div class="mt-1 relative w-full group">
                            <x-input wire:model="email" label="CORREO" placeholder="ESCRIBE..." />
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
                    <div class="mt-4 relative w-full group">
                            <x-select wire:model="privileges" label="ROL" placeholder="Seleccione...">
                                @foreach ($roles as $role)
                                <x-select.option label="{{ $role->name }}" value="{{ $role->name }}" />
                                @endforeach
                            </x-select>
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
