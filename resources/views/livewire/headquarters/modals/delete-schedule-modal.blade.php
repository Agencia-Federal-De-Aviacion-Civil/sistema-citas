<div>
    <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">
        <div class="mt-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        ¿Estas seguro de habilitar este dia?
            <div class="text-right mt-6 mb-6">
                <x-button sm wire:click.prevent="delete()" label="HABILITAR" info right-icon="check" />
            </div>
        </div>
    </div>
</div>
