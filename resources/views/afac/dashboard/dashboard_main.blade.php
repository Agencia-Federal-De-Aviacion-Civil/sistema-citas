<div>
    <x-banner-component :title="$nameHeadquarter" />
    <div class="py-12">
        <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">
            <div class="bg-gray-100 text-gray-500 py-5 px-4 w-full sm:w-full md:w-full lg:w-full">
                {{-- @livewire('medicine.dashboard.dashboard-main', [
                'id_dashboard' => '',
                'date1' => $date1,
                'date2' => $date2,
                ]) --}}
                @hasrole(['super_admin_medicine', 'admin_medicine_v2'])
                    <div class="py-6" x-data="{ activeTab: 'headquarters' }">
                        <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 ">
                            <li class="mr-2">
                                <a href="#" class="inline-block p-4 bg-white rounded-t-lg active"
                                    x-on:click.prevent="activeTab = 'headquarters'"
                                    :class="{ 'text-blue-600 border-b-2 border-blue-500': activeTab === 'headquarters' }">
                                    CITAS AFAC
                                </a>
                            </li>
                            <li class="mr-2">
                                <a href="#" class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50"
                                    x-on:click.prevent="activeTab = 'schedules'"
                                    :class="{ 'text-blue-600 border-b-2 border-blue-500': activeTab === 'schedules' }">
                                    TERCEROS AUTORIZADOS
                                </a>
                            </li>
                        </ul>
                        <div class="mt-6">
                            <div x-show="activeTab === 'headquarters'">
                                @livewire('medicine.dashboard.dashboard-main', [
                                    'id_dashboard' => 0,
                                    'date1' => $date1,
                                    'date2' => $date2,
                                ])
                            </div>
                            <div x-show="activeTab === 'schedules'">
                                @livewire('medicine.dashboard.dashboard-main', [
                                    'id_dashboard' => 1,
                                    'date1' => $date1,
                                    'date2' => $date2,
                                ])
                            </div>
                        </div>
                    </div>
                @else
                    @livewire('medicine.dashboard.dashboard-main', [
                        'id_dashboard' => '',
                        'date1' => $date1,
                        'date2' => $date2,
                    ])
                @endhasrole
            </div>
        </div>
    </div>
</div>
