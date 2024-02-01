<div>
    <div class="bg-gray-100 text-gray-500 rounded shadow-xl py-5 px-5 w-full sm:w-full md:w-full lg:w-full">
        <div class="flex w-full">
            <h3 class="text-lg font-semibold leading-tight flex-1">TOTAL DE CITAS MEDICINA DE
                AVIACIÓN {{ $id_dashboard == 0 ? 'AFAC' : 'TERCEROS' }}</h3>
        </div>
        <div class="relative overflow-hidden transition-all duration-500" x-ref="card"
            x-bind:style="`max-height:${cardOpen?$refs.card.scrollHeight:0}px; opacity:${cardOpen?1:0}`">
            <div>
                <div class="pb-4 lg:pb-6">
                    <h4 class="text-2xl lg:text-3xl text-black font-semibold leading-tight inline-block" x-ref="total">
                        {{ $registerCount }}</h4>
                </div>
                <div class="pb-4 lg:pb-6">
                    <div class="relative pt-1 mx-5">
                        <div class="overflow-hidden h-3 mb-4 text-xs flex rounded bg-gray-500">
                            @unless ($id_dashboard == 0)
                                <div style="width: {{ $porConfirDashboard }} %"
                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-800">
                                </div>
                                <div style="width: {{ $porReagDashboard }}%"
                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500">
                                </div>
                                <div style="width: {{ $porApto }}%"
                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-500">
                                </div>
                                <div style="width: {{ $porNoApto }}%"
                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-red-500">
                                </div>
                                <div style="width: {{ $porAplazada }}%"
                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-purple-500">
                                </div>
                                <div style="width: {{ $porCancelDashboard }}%"
                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-orange-500">
                                </div>
                            @else
                                <div style="width: {{ $porConfirDashboard }} %"
                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-800">
                                </div>
                                <div style="width: {{ $porReagDashboard }}%"
                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500">
                                </div>
                                <div style="width: {{ $porCancelDashboard }}%"
                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-red-500">
                                </div>
                            @endunless
                        </div>
                    </div>
                </div>
                <div
                    class="{{ $id_dashboard === 0 ? '-mt-2 grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4' : '-mt-2 grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-7 xl:grid-cols-7' }}">
                    <div class="flex items-start p-2">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full border border-gray-100 bg-gray-50">
                            <span href="#blue" class="block w-3 h-3 bg-gray-500 rounded-full"></span>
                        </div>
                        <div class="ml-4">
                            <h3 class="{{ $id_dashboard === 0 ? 'font-semibold' : 'font-semibold text-sm' }}">
                                Pendientes:
                                {{ $penDashboard }}</h3>
                            <p class="mt-2 text-sm text-gray-500">
                                {!! $id_dashboard === 0 ? $porPenDashboard . '%' : '<b>{{ $penDashboard }}</b>/' . $porPenDashboard . '%' !!}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start p-2">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full border border-blue-100 bg-blue-50">
                            <span href="#blue" class="block w-3 h-3 bg-blue-800 rounded-full"></span>
                        </div>

                        <div class="ml-4">
                            <h3 class="font-semibold">Asistió: {{ $validateDashboard }}</h3>
                            <p class="mt-2 text-sm text-gray-500">{{ $porConfirDashboard }}%</p>
                        </div>
                    </div>

                    <div class="flex items-start p-2">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full border border-blue-100 bg-blue-50">
                            <span href="#blue" class="block w-3 h-3 bg-blue-500 rounded-full"></span>
                        </div>
                        <div class="ml-4">
                            <h2 class="font-semibold">Reagendadas: {{ $reagDashboard }}</h2>
                            <p class="mt-2 text-sm text-gray-500">{{ $porReagDashboard }}%</p>
                        </div>
                    </div>
                    @unless ($id_dashboard == 0)
                        <div class="flex items-start p-2">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-full border border-green-100 bg-green-50">
                                <span href="#blue" class="block w-3 h-3 bg-green-500 rounded-full"></span>
                            </div>
                            <div class="ml-4">
                                <h2 class="font-semibold text-sm">Apto</h2>
                                <p class="mt-2 text-sm text-gray-500"><b>{{ $apto }}</b> /
                                    {{ $porApto }}%
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start p-2">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-full border border-red-100 bg-red-50">
                                <span href="#blue" class="block w-3 h-3 bg-red-500 rounded-full"></span>
                            </div>

                            <div class="ml-4">
                                <h2 class="font-semibold text-sm">No Apto</h2>
                                <p class="mt-2 text-sm text-gray-500"><b>{{ $noApto }}</b> /
                                    {{ $porNoApto }}%
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start p-2">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-full border border-purple-100 bg-purple-50">
                                <span href="#blue" class="block w-3 h-3 bg-purple-500 rounded-full"></span>
                            </div>

                            <div class="ml-4">
                                <h2 class="font-semibold text-sm">Aplazadas</h2>
                                <p class="mt-2 text-sm text-gray-500"> <b>{{ $aplazadas }}</b> /
                                    {{ $porAplazada }}%</p>
                            </div>
                        </div>
                    @endunless
                    <div class="flex items-start p-2">
                        <div
                            class="{{ $id_dashboard === 0 ? 'flex h-12 w-12 items-center justify-center rounded-full border border-red-100 bg-red-50' : 'flex h-12 w-12 items-center justify-center rounded-full border border-orange-100 bg-orange-50' }}">
                            <span href="#blue"
                                class="{{ $id_dashboard === 0 ? 'block w-3 h-3 bg-red-500 rounded-full' : 'block w-3 h-3 bg-orange-500 rounded-full' }}"></span>
                        </div>

                        <div class="ml-4">
                            <h2 class="font-semibold">Canceladas: {{ $cancelDashboard }}</h2>
                            <p class="mt-2 text-sm text-gray-500">{{ $porCancelDashboard }}%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-1 p-2 gap-4">
            <div
                class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
                <div class="rounded-t mb-0 px-0 border-0">
                    <div class="flex flex-wrap items-center px-4 py-2">
                        <div class="relative w-full max-w-full flex-grow flex-1">
                            <div class="flex items-start rounded-xl p-4">
                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-full border border-blue-100 bg-blue-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $nowDate }} Citas</h2>
                                    <p class="mt-2 text-sm text-gray-500">hoy {{ $date2 }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block w-full overflow-x-auto">
                        <table class="items-center w-full bg-transparent border-collapse">
                            <thead>
                                <tr>
                                    <th
                                        class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Sede</th>
                                    <th
                                        class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Citas para hoy
                                    </th>
                                    <th
                                        class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Citas para mañana
                                    </th>
                                    <th
                                        class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        total de citas
                                    </th>
                                    <th
                                        class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                {{-- @foreach ($headquarters_afac as $headquarter_afac)
                                    <tr class="text-gray-700 dark:text-gray-100">
                                        <th
                                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                            {{ $headquarter_afac->name_headquarter }}
                                            @unless ($headquarter_afac->is_external == 0)
                                                <span
                                                    class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">TERCEROS</span>
                                            @endunless
                                        </th>
                                        <td
                                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            {{ $headquarter_afac->headquarterMedicineReserve->where('dateReserve', $date1_afac)->whereIn('status', ['0', '1', '4'])->count() }}
                                        </td>
                                        <td
                                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            {{ $headquarter_afac->headquarterMedicineReserve->where('dateReserve', $tomorrow_afac)->whereIn('status', ['0', '1', '4'])->count() }}
                                        </td>
                                        <td
                                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            {{ $headquarter_afac->headquarterMedicineReserve->count() }}
                                        </td>
                                        <td
                                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            <div class="flex items-center">
                                                <span
                                                    class="mr-2">{{ $headquarter_afac->headquarterMedicineReserve->count() > 0 ? round(($headquarter_afac->headquarterMedicineReserve->count() * 100) / $registradas_afac, 1) : '0' }}%</span>
                                                <div class="relative w-full">
                                                    <div class="overflow-hidden h-2 text-xs flex rounded bg-blue-200">
                                                        <div style="width:{{ $headquarter_afac->headquarterMedicineReserve->count() > 0 ? ($headquarter_afac->headquarterMedicineReserve->count() * 100) / $registradas_afac : '0' }}%"
                                                            class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-600">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-12">
            <div class="container mx-auto px-4 py-4 bg-white sm:rounded-lg">
                <div class="mt-12 md:max-w-8xl  xs:max-w-4xl  mx-auto sm:px-6 lg:px-8">
                    <div class="ml-4 py-6 mr-4 uppercase md:text-sm xs:text-xs">
                        @livewire('medicine.medicine-afac.calendar')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
