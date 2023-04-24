<div>
    <x-notifications position="top-bottom" />
    @if ($modal)
        @include('livewire.appointment.headquarters.modals.modal-new')
    @endif
    @if ($modalEdit)
        @include('livewire.appointment.headquarters.modals.modal-edit')
    @endif
    <div class="relative py-6 lg:py-4">
        <img class="z-0 w-full h-full absolute inset-0 object-cover" src="{{ asset('images/banner_testing.jpg') }}"
            alt="bg" />
        <div
            class="z-10 relative container px-6 mx-auto flex flex-col md:flex-row items-start md:items-center justify-between">
            <div>
                <h4 tabindex="0" class="focus:outline-none text-2xl font-bold leading-tight text-white">ADMINISTRACIÓN
                    DE SEDES</h4>
                <ul class="flex flex-col md:flex-row items-start md:items-center text-gray-300 text-sm mt-3">
                    <li class="flex items-center mt-4 md:mt-0">
                        {{-- <div class="mr-1">
                            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/background_with_sub_text-svg3.svg"
                                alt="date">
                        </div> --}}
                        {{-- <span tabindex="0" class="focus:outline-none">Started on 29 Jan 2020</span> --}}
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-6 bg-white shadow-xl sm:rounded-lg">
                <div class="ml-4 py-6 mr-4 uppercase text-sm">
                    <div x-data="{ activeTab: 'headquarter' }">
                        <ul
                            class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 ">
                            <li class="mr-2">
                                <a href="#" class="inline-block p-4 text-gray-800 bg-white rounded-t-lg active"
                                    x-on:click.prevent="activeTab = 'headquarter'"
                                    :class="{ 'active': activeTab === 'headquarter' }">
                                    SEDES
                                </a>
                            </li>
                            <li class="mr-2">
                                <a href="#"
                                    class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50"
                                    x-on:click.prevent="activeTab = 'schedule'"
                                    :class="{ 'active': activeTab === 'schedule' }">
                                    HORARIOS
                                </a>
                            </li>
                        </ul>
                        <div x-show="activeTab === 'headquarter'">
                            <div class="mt-8">
                                <livewire:headquarter-table />
                            </div>
                        </div>
                        <div x-show="activeTab === 'schedule'">
                            OTRO
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
