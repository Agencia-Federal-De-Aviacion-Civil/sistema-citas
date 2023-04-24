<div>
<div>

    <div
    class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-0 sm:my-0 sm:align-middle sm:max-w-2xl sm:w-full sm:p-6">
    <div>
        <div class="p-0 text-center">
            AGREGAR USUARIO
        </div>
        <div class="mt-4 text-center">
            <h3 class="text-xl font-semibold leading-6 text-gray-800 capitalize dark:text-white" id="modal-title">
                {{-- @if ($this->status == 0)
                CITA
            @elseif ($this->status == 1)
                CITA ASISTIDA
            @elseif ($this->status == 2)
                CITA CANCELADA
            @elseif ($this->status == 3)
                CANCELO CITA
            @elseif ($this->status == 4)
                CITA REAGENDADA
            @endif
 --}}
            </h3>
            <div class="grid xl:grid-cols-2 xl:gap-6">
                <div class="mt-1 relative w-full group">
                    <x-input wire:model="name" label="NOMBRE" placeholder="ESCRIBE..."/>
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
                <x-select wire:model="privileges" label="PRIVILEGIO" placeholder="Seleccione...">
                        <x-select.option label="MEDICINA ADMINISTRADOR" value="medicine_admin" />
                        <x-select.option label="LINGÜÍSTICA ADMINISTRADOR" value="linguistic_admin" />
                        <x-select.option label="USUARIO" value="user" />
                        <x-select.option label="SEDE" value="headquarters" />
                </x-select>
            </div>

            {{-- <div class="grid xl:grid-cols-2 xl:gap-6">
                <div class="mt-1 relative w-full group"> --}}
                    {{-- <x-input wire:model="type" label="TIPO" placeholder="ESCRIBE..." disabled /> --}}
                {{-- </div>
                <div class="mt-1 relative w-full group"> --}}
                    {{-- <x-input wire:model="class" label="CLASE" placeholder="ESCRIBE..." disabled /> --}}
                {{-- </div>
            </div>
            <div class="grid xl:grid-cols-1 xl:gap-6">
                <div class="mt-4 relative w-full group"> --}}
                    {{-- <x-input wire:model="typLicense" label="TIPO DE LICENCIA" disabled /> --}}
                {{-- </div>
            </div> --}}

          

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
</div>

{{-- 
<div x-transition:enter="transition duration-300 ease-out"
x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
x-transition:leave="transition duration-150 ease-in"
x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
class="fixed inset-0 z-[60] overflow-y-auto bg-black bg-opacity-70" aria-labelledby="modal-title" role="dialog"
aria-modal="true">
<div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    <div
        class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-900 sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full sm:p-6">
        <div>
            <div class="p-3 text-center">
            </div>
            <div class="mt-4 text-center">
                <h3 class="text-xl font-semibold leading-6 text-gray-800 capitalize dark:text-white"
                    id="modal-title">
                    AGREGAR USUARIO
                </h3>
                <div class="grid xl:grid-cols-2 xl:gap-6">
                    <div class="mt-1 relative w-full group">
                        <x-input wire:model="name_add" label="NOMBRE" placeholder="ESCRIBE..." />
                    </div>
                    <div class="mt-1 relative w-full group">
                        <x-input wire:model="email_add" label="CORREO" placeholder="ESCRIBE..." />
                    </div>
                </div>
                <div class="grid xl:grid-cols-2 xl:gap-6">
                    <div class="mt-4 relative w-full group">
                        <x-inputs.password wire:model="password_add" label="CONTRASEÑA" />
                    </div>
                    <div class="mt-4 relative w-full group">
                        <x-inputs.password wire:model="passwordConfirmation_add" label="CONFIRMAR CONTRASEÑA" />
                    </div>
                </div>

                <div class="mt-4 relative w-full group">
                    <x-select wire:model="privileges_add" label="PRIVILEGIO" placeholder="Seleccione...">
                            <x-select.option label="MEDICINA ADMINISTRADOR" value="medicine_admin" />
                            <x-select.option label="LINGÜÍSTICA ADMINISTRADOR" value="linguistic_admin" />
                            <x-select.option label="USUARIO" value="user" />
                            <x-select.option label="SEDE" value="headquarters" />
                    </x-select>
                </div>

            </div>
        </div>
        <div class="float-right mt-6">
            <x-button wire:click.prevent="save()" label="GUARDAR" blue right-icon="save-as" />
        </div>
        <div class="float-left mt-6">
            <x-button wire:click.prevent="salir()" label="SALIR" silver />
        </div>
    </div>
</div>
</div> --}}
