<div>
    <x-banner-component :title="$nameHeadquarter" />
    <div class="py-12">
        <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">
            <div class="bg-gray-100 text-gray-500 py-5 px-4 w-full sm:w-full md:w-full lg:w-full">
                @livewire('medicine.dashboard.dashboard-main', [
                'id_dashboard' => '',
                'date1' => $date1,
                'date2' => $date2,
                ])
            </div>
        </div>
    </div>
</div>
