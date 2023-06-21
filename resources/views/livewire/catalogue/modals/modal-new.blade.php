    <div>
        <div
            class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-0 sm:my-0 sm:align-middle sm:max-w-4xl sm:w-full sm:p-6">
            <div>
                <h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-gray-200">
                    {{ $this->title }}
                </h3>
                <div class="mt-4 text-center">
                    <h3 class="text-xl font-semibold leading-6 text-gray-800 capitalize dark:text-white" id="modal-title">
                    </h3>
                    <div class="grid xl:grid-cols-1 xl:gap-9">
                        <div class="mt-1 relative w-full group">
                            <x-input wire:model="name" label="INGRESA EL NOMBRE DEL SISTEMA" placeholder="ESCRIBE..." />
                        </div>
                    </div>
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
