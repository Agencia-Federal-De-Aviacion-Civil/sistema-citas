<x-app-layout>
    <x-banner-component :title="'Administración de Roles y Permisos'" />
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-8 py-8 uppercase">
                <div x-data="{ activeTab: 'roles' }">
                    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 ">
                        <li class="mr-2">
                            <a href="#" class="inline-block p-4 bg-white rounded-t-lg active"
                                x-on:click.prevent="activeTab = 'roles'"
                                :class="{ 'text-blue-600 font-semibold': activeTab === 'roles' }">
                                ROLES
                            </a>
                        </li>
                        <li class="mr-2">
                            <a href="#" class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50"
                                x-on:click.prevent="activeTab = 'permissions'"
                                :class="{ 'text-blue-600 font-semibold': activeTab === 'permissions' }">
                                PERMISOS
                            </a>
                        </li>
                    </ul>
                    <div class="mt-6">
                        <div x-show="activeTab === 'roles'">
                            <a type="button" href="{{ route('afac.roles.create') }}"
                                class="text-white bg-indigo-500 hover:bg-indigo-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">AÑADIR
                            </a>
                            @livewire('permissions.tables.role-table')
                        </div>
                        <div x-show="activeTab === 'permissions'">
                            @livewire('permissions.index')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
