<div>
    <div>
        <x-notifications position="top-center" />
        <x-dialog z-index="z-50" blur="md" align="center" />
        <x-banner-component :title="'Personas Registradas'" />
        {{-- <p>Estado de la conexión: <span id="connection-status"></span></p> --}}
        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-8 py-8 uppercase">
                    <div class="ml-4 py-0 mr-4 uppercase text-sm">
                        <div class="mb-6">
                            <x-button class="mb-2" wire:click="$emit('openModal', 'users.modals.modal-new')"
                                right-icon="user-add" sm indigo label="AGREGAR" />
                        </div>
                        @livewire('medicine.tables.user-roles-table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
