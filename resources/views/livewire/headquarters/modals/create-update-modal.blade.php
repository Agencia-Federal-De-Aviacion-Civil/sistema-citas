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
                <div class="mt-4 relative w-full group">
                    <x-select wire:model.lazy="system_id" label="SISTEMA" placeholder="Seleccione...">
                        @foreach ($qSystems as $qSystem)
                            <x-select.option label="{{ $qSystem->name }}" value="{{ $qSystem->id }}" />
                        @endforeach
                    </x-select>
                </div>
            </div>
            <div class="grid xl:grid-cols-1 xl:gap-6">
                <div class="mt-4 relative w-full group">
                    <x-textarea wire:model.lazy="url" label="URL" placeholder="INGRESA URL DE GOOGLE MAPS..." />
                </div>
            </div>
            <div class="mt-6 mb-6">
                <x-button wire:click.prevent="save()" label="GUARDAR" blue right-icon="save-as" />
            </div>
        </div>
    </div>
</div>
