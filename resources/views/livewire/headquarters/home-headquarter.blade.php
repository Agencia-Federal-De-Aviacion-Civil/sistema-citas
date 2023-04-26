<div>
    <x-notifications position="top-bottom" />
    <div class="relative py-6 lg:py-4">
        <img class="z-0 w-full h-full absolute inset-0 object-cover" src="{{ asset('images/banner_testing.jpg') }}"
            alt="bg" />
        <div
            class="z-10 relative container px-6 mx-auto flex flex-col md:flex-row items-start md:items-center justify-between">
            <div>
                <h4 tabindex="0" class="focus:outline-none text-2xl font-bold leading-tight text-white">ADMINISTRACIÓN
                    DE SEDES</h4>
                <ul class="flex flex-col md:flex-row items-start md:items-center text-gray-300 text-sm mt-3">
                </ul>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">
            <div class="mt-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div x-data="{ activeTab: 'home' }">
                    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 ">
                        <li class="mr-2">
                            <a href="#" class="inline-block p-4 text-gray-800 bg-white rounded-t-lg active"
                                x-on:click.prevent="activeTab = 'home'" :class="{ 'active': activeTab === 'home' }">
                                SEDES
                            </a>
                        </li>
                        <li class="mr-2">
                            <a href="#" class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50"
                                x-on:click.prevent="activeTab = 'calendar'"
                                :class="{ 'active': activeTab === 'calendar' }">
                                HORARIOS
                            </a>
                        </li>
                    </ul>
                    <div class="mt-6">
                        <div x-show="activeTab === 'home'">
                            <div class="mb-6">
                                <x-button wire:click="$emit('openModal', 'headquarters.modals.create-update-modal')"
                                    icon="pencil" primary label="AÑADIR" />
                            </div>
                            <livewire:headquarter-table>
                        </div>
                        <div x-show="activeTab === 'calendar'">
                            AQUI VAN LOS HORARIOS
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        
    </script>
</div>
