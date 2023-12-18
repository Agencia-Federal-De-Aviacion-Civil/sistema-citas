<div>
    <div class="container mx-auto px-6 py-6 bg-white shadow-xl sm:rounded-lg">
        <x-banner-modal-icon :title="'PERMISOS'" :size="'w-20 h-20'" :icon="'lock'" :titlesize="'xl'" />
        <div class="grid xl:grid-cols-1 xl:gap-6">
            <div class="mt-1 relative w-full group">
                <x-input wire:model.lazy="name" label="NOMBRE" placeholder="ESCRIBE..." />
            </div>
            <div class="mt-1 relative w-full group">
                <x-input wire:model.lazy="description" label="DESCRIPCIÓN" placeholder="ESCRIBE..." />
            </div>
            <div class="mt-1 relative w-full group">
                <x-input wire:model.lazy="guard_name" label="GUARD NAME" placeholder="web" />
            </div>
        </div>
        {{-- <div class="mt-6 mb-6">
            <x-button wire:click.prevent="save()" label="GUARDAR" blue right-icon="save-as" />
        </div> --}}
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
    </div>
</div>
