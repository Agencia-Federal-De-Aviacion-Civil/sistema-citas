<div>
    <x-notifications position="top-right" />
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
        <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">
            <div class="mt-12 max-w-8xl mx-auto sm:px-6 lg:px-8">
                <x-button wire:click.prevent="addHeadquarter()" right-icon="view-grid-add" blue
                label="AÑADIR SEDE" />
                <div class="ml-4 py-6 mr-4 uppercase text-sm">
                            <livewire:recordheadquarters/>
                            {{-- @if ($usuarios->count()) --}}
                            {{-- <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            ID
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            NOMBRE COMPLETO
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            CORREO
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            DIRECCIÓN
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            URL
                                        </th>
                                        <th scope="col" class="px-6 py-3">

                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($headquarters as $headquarter)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">

                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $headquarter->headquarterUser->name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $headquarter->headquarterUser->email }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $headquarter->direction }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <a target="_blank"
                                                    class="text-blue-600 dark:text-blue-500 hover:underline"
                                                    href="{{ $headquarter->url }}">
                                                    {{ $headquarter->url }}</a>
                                            </td>
                                            <td class="px-6 py-4">

                                                <button wire:click="editModal({{ $headquarter->id }})"
                                                    class="px-3 py-2 text-xs font-medium text-center text-white bg-sky-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    Editar
                                                </button>
                                                <button wire:click=""
                                                    class="px-3 py-2 text-xs font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-blue-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                    Eliminar
                                                </button>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table> --}}
                            <div class="mt-6 ml-6 mr-6 mb-6">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
