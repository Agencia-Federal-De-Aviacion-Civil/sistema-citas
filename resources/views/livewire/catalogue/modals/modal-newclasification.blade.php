<div>
    <div class="container mx-auto px-6 py-6 bg-white shadow-xl sm:rounded-lg">
        <x-banner-modal-icon :title="'CLASIFICACIÓN DE LAS CLASES'" :size="'w-16 h-16'" :icon="'node'" :titlesize="'xl'" />
        <div class="grid xl:grid-cols-1 xl:gap-9 py-2">
            <div class="mt-1 relative w-full group">
                <x-input wire:model="name" label="NOMBRE DE LA CLASIFICACIÓN" placeholder="ESCRIBE..."
                    class="bg-gray-50 uppercase" />
            </div>
            <div class="mt-1 relative w-full group">
                <label for="systems" class="block text-sm font-medium text-gray-900 dark:text-white">CLASE</label>
                <select
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    wire:model.lazy="type_class_id">
                    <option label="SELECCIONE.." value="" />
                    @foreach ($classe as $classes)
                        <option label="{{ $classes->name." - ".$classes->typeClassTypeExam->name }}" value="{{ $classes->id }}" />
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Footer -->
        <div class="flex items-center justify-between w-full gap-4 mt-8">
            <button wire:click.prevent="save()"
                class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                ACEPTAR
            </button>
            <button wire:click="$emit('closeModal')"
                class="py-2 px-4 bg-gray-100 hover:bg-gray-200 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-indigo-500 w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                CERRAR
            </button>
        </div>
        <!-- End Footer -->
    </div>
</div>
<!-- End Modal -->
