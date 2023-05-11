<div>
    <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">
        <div class="mt-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid xl:grid-cols-2 xl:gap-6">
                <div class="mt-1 relative w-full group">
                    <x-input wire:model.lazy="name" label="NOMBRE" placeholder="ESCRIBE..." />
                </div>
                <div class="mt-1 relative w-full group">
                    <x-input wire:model.lazy="description" label="DESCRIPCIÓN" placeholder="ESCRIBE..." />
                </div>
            </div>
            <div class="mt-6 mb-6">
                <x-button wire:click.prevent="save()" label="GUARDAR" blue right-icon="save-as" />
            </div>
        </div>
    </div>
</div>
