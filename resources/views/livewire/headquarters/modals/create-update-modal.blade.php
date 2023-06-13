<div>
    <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">
        <div class="mt-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid xl:grid-cols-2 xl:gap-6">
                <div class="mt-1 relative w-full group">
                    <x-input wire:model.lazy="name" label="NOMBRE" placeholder="ESCRIBE..." />
                </div>
                <div class="mt-1 relative w-full group">
                    <x-input wire:model.lazy="direction" label="DIRECCIÓN" placeholder="ESCRIBE..." />
                </div>
            </div>
            @if (empty($sedes))
                <div class="grid xl:grid-cols-2 xl:gap-6">
                    <div class="mt-4 relative w-full group">
                        <x-inputs.password wire:model.lazy="passwordConfirmation" label="CONTRASEÑA" />
                    </div>
                    <div class="mt-4 relative w-full group">
                        <x-inputs.password wire:model.lazy="password" label="CONFIRMAR CONTRASEÑA" />
                    </div>
                </div>
            @else
            @endif
            <div class="grid xl:grid-cols-2 xl:gap-6">
                <div class="mt-4 relative w-full group">
                    <x-input wire:model.lazy="email" label="CORREO" placeholder="ESCRIBE..." />
                </div>
                @hasrole('super_admin')
                    <div class="mt-4 relative w-full group">
                        <label for="systems"
                            class="block text-sm font-medium text-gray-900 dark:text-white">SISTEMA</label>
                        <select wire:model.lazy="system_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="">Selecciona...</option>
                            @foreach ($qSystems as $qSystem)
                                <option value="{{ $qSystem->id }}" {{ $system_id == $qSystem->id ? 'selected' : '' }}>
                                    {{ $qSystem->name }}</option>
                            @endforeach
                        </select>
                        @error('system_id')
                            <span class="text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            @else
            @endhasrole
            <div class="grid xl:grid-cols-1 xl:gap-6">
                <div class="mt-4 relative w-full group">
                    <x-textarea wire:model.lazy="url" label="URL" placeholder="INGRESA URL DE GOOGLE MAPS..." />
                </div>
            </div>
            <div class="mt-4">
                <ul
                    class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center pl-3">
                            <input id="radio-disabled" type="radio" value="1" wire:model="status"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="radio-disabled"
                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">DESHABILITAR
                            </label>
                        </div>
                    </li>
                    <li class="w-full dark:border-gray-600">
                        <div class="flex items-center pl-3">
                            <input id="radio-enabled" type="radio" value="0" wire:model="status"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="radio-enabled"
                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">HABILITAR</label>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="flex items-center justify-between w-full gap-4 mt-8">
                <x-button wire:click.prevent="save()" label="GUARDAR" blue right-icon="save-as" />
                <x-button wire:click.prevent="$emit('closeModal')" label="SALIR" right-icon="login" />
            </div>
        </div>
    </div>
</div>
