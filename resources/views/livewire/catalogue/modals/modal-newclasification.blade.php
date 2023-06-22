<div>
    <div class="p-4 sm:p-7">
        <div class="text-center">
            <h2 class="block text-lg sm:text-xl font-semibold text-gray-800 dark:text-gray-200 my-2">{{ $this->title }}</h2>
        </div>
        <div class="grid xl:grid-cols-2 xl:gap-9">
            <div class="mt-1 relative w-full group">
                <x-input wire:model="name" label="NOMBRE DE LA CLASE" placeholder="ESCRIBE..." class="bg-gray-50" />
            </div>
            <div class="mt-1 relative w-full group">
                <label for="systems" class="block text-sm font-medium text-gray-900 dark:text-white">NOMBRE DE LA CLASIFICACIÓN</label>
                <select  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model.lazy="type_class_id">
                    <option label="SELECCIONE.." value=""/>
                    @foreach ($classe as $classes)
                        <option label="{{ $classes->name }}" value="{{ $classes->id }}" />
                    @endforeach
                </select>
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
    <!-- End Modal -->
</div>
