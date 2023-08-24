<x-app-layout>
    <div class="relative py-6 lg:py-4">
        <img class="z-0 w-full h-full absolute inset-0 object-cover" src="{{ asset('images/banner_testing.jpg') }}"
            alt="bg" />
        <div
            class="z-10 relative container px-6 mx-auto flex flex-col md:flex-row items-start md:items-center justify-between">
            <div>
                <h4 tabindex="0" class="focus:outline-none text-2xl font-bold leading-tight text-white">Administración
                    de Roles y Permisos</h4>
                <ul class="flex flex-col md:flex-row items-start md:items-center text-gray-300 text-sm mt-3">
                    <li class="flex items-center mt-4 md:mt-0">
                        <div class="mr-1">
                            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/background_with_sub_text-svg3.svg"
                                alt="date">
                        </div>
                        <span tabindex="0" class="focus:outline-none">
                            {{ $dateNow }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">
            <div class="mt-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div x-data="{ activeTab: 'roles' }">
                    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 ">
                        <li class="mr-2">
                            <a href="#" class="inline-block p-4 bg-white rounded-t-lg active"
                                x-on:click.prevent="activeTab = 'roles'" :class="{ 'text-blue-600 font-semibold': activeTab === 'roles' }">
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
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">AÑADIR
                            </a>
                            {{-- <livewire:role-table /> --}}
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
