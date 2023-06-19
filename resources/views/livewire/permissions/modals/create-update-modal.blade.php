<div>
    <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">
        <div class="text-center">
            <h2 class="block text-xl sm:text-2xl font-semibold text-gray-800 dark:text-gray-200">Permiso</h2>
        </div>
        <div class="mt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid xl:grid-cols-1 xl:gap-6">
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
