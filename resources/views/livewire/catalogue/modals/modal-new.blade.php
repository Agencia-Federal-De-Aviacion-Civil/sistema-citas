    <div>
        <div class="p-4 sm:p-7">
            <div class="text-center">
                <h2 class="block text-lg sm:text-xl font-semibold text-gray-800 dark:text-gray-200 my-2">{{ $this->title }}</h2>
            </div>
            <div class="grid xl:grid-cols-1 xl:gap-9">
                <div class="mt-1 relative w-full group">
                    <x-input wire:model="name" label="INGRESA EL NOMBRE DEL SISTEMA" placeholder="ESCRIBE..." />
                </div>
            </div>
            </div>
            <!-- Footer -->
            <div class="flex justify-end items-center gap-x-2 p-4 sm:px-7 border-t dark:border-gray-700">
                <x-button wire:click.prevent="save()" label="GUARDAR" blue right-icon="save-as" />
                <x-button wire:click="$emit('closeModal')" label="SALIR" silver />
            </div>
            <!-- End Footer -->
        </div>
    </div>
</div>
