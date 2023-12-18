<div>
    <x-notifications position="top-center" />
    <x-dialog z-index="z-50" blur="md" align="center" />
    <x-banner-component :title="'Historial de movimientos citas medicas'" />
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-8 py-8 uppercase">
                <div class="ml-4 py-6 mr-4 uppercase text-sm">
                    @livewire('medicine.tables.history-medicie-table')
                </div>
            </div>
        </div>
    </div>
</div>
