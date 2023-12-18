<div>
    <div class="container mx-auto px-6 py-6 bg-white shadow-xl sm:rounded-lg">
        <x-banner-modal-icon :title="'TIPO DE EXÁMEN'" :size="'w-16 h-16'" :icon="'file-clone'" :titlesize="'xl'" />
        <div class="grid xl:grid-cols-1 xl:gap-9 py-2">
            <div class="mt-1 relative w-full group">
                <x-input wire:model="name" label="NOMBRE DEL EXAMEN" placeholder="ESCRIBE..."
                    class="bg-gray-50 uppercase" />
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
    <!-- End Modal -->
</div>
