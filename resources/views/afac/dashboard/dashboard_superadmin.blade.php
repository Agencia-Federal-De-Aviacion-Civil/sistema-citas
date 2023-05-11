<script src="https://cdn.jsdelivr.net/npm/countup@1.8.2/dist/countUp.min.js"></script>
<div class="relative py-6 lg:py-4">
    <img class="z-0 w-full h-full absolute inset-0 object-cover" src="{{ asset('images/banner_ventanillas.jpg') }}"
        alt="banners" />
    <div
        class="z-10 relative container px-6 mx-auto flex flex-col md:flex-row items-start md:items-center justify-between">
        <div>
            <h4 tabindex="0" class="focus:outline-none text-2xl font-bold leading-tight text-white">DASHBOARD</h4>
            <ul class="flex flex-col md:flex-row items-start md:items-center text-gray-300 text-sm mt-3">
                <li class="flex items-center mt-4 md:mt-0">
                    <div class="mr-1">
                        {{-- <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/background_with_sub_text-svg3.svg" alt="date"> --}}
                    </div>
                    {{-- <span tabindex="0" class="focus:outline-none">Started on 29 Jan 2020</span> --}}
                </li>
            </ul>
        </div>
    </div>
</div>
<div>
    <div class="py-12">
        <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">
            <div class="bg-gray-100 text-gray-500 rounded shadow-xl py-5 px-4 w-full sm:w-full md:w-full lg:w-full">
                <h2 class="mb-4 text-2xl font-bold">TOTAL DE CITAS {{ $registradas }}</h2>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                    <!-- 1 card -->
                    <div class="relative bg-white py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                        <div
                            class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-blue-500 left-4 -top-6">
                            <!-- svg  -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                            </svg>
                        </div>
                        <div class="mt-8">
                            <p class="text-xl font-semibold my-2">Citas Medicina</p>

                            <div class="border-t-2"></div>

                            <div class="flex justify-between">
                                <div class="my-2">
                                    <p class="font-semibold text-base mb-2">Total de citas</p>
                                    <div class="flex space-x-2">
                                        <p>{{ $registradas }}</p>
                                    </div>
                                </div>
                                <div class="my-2">
                                    <p class="font-semibold text-base mb-2">Progress</p>
                                    <div class="text-base text-gray-400 font-semibold">
                                        <p>{{ $medicine }}%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2 card -->
                    <div class="relative bg-white py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                        <div
                            class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-sky-600 left-4 -top-6">
                            <!-- svg  -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                            </svg>
                        </div>
                        <div class="mt-8">
                            <p class="text-xl font-semibold my-2">Citas Lingüistica</p>
                            <div class="border-t-2 "></div>

                            <div class="flex justify-between">
                                <div class="my-2">
                                    <p class="font-semibold text-base mb-2">Total de citas</p>

                                    <p>0</p>

                                </div>
                                <div class="my-2">
                                    <p class="font-semibold text-base mb-2">Progress</p>
                                    <div class="text-base text-gray-400 font-semibold">
                                        <p>0%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                {{-- <div class="flex w-full">
            <h3 class="text-lg font-semibold leading-tight flex-1">TOTAL DE CITAS</h3>
            <div class="relative h-5 leading-none">
                <button class="text-xl text-gray-500 hover:text-gray-300 h-6 focus:outline-none" @click.prevent="cardOpen=!cardOpen">
                        <i class="mdi" :class="'mdi-chevron-'+(cardOpen?'up':'down')"></i>
                    </button>
            </div>
        </div>
        <div class="relative overflow-hidden transition-all duration-500" x-ref="card" x-bind:style="`max-height:${cardOpen?$refs.card.scrollHeight:0}px; opacity:${cardOpen?1:0}`">
            <div>
                <div class="pb-4 lg:pb-6">
                    <h4 class="text-2xl lg:text-3xl text-black font-semibold leading-tight inline-block" x-ref="total">0</h4>
                </div>
                <div class="pb-4 lg:pb-6">
                    <div class="overflow-hidden rounded-full h-3 bg-gray-800 flex transition-all duration-500" :class="cardOpen?'w-full':'w-0'">
                        <template x-for="(item,index) in cardData.sessions">
                                <div class="h-full" :class="`bg-${item.color}`" :style="`width:${item.size}%`"></div>
                            </template>
                    </div>
                </div>
                <div class="-mt-2 grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    <div class="flex items-start p-2">
                      <div class="flex h-12 w-12 items-center justify-center rounded-full border border-blue-100 bg-blue-50">
                        <span href="#blue" class="block w-3 h-3 bg-blue-800 rounded-full"></span>
                      </div>
                
                      <div class="ml-4">
                        <h3 class="font-semibold">Medicina preventiva: {{$registradasall}}</h3>
                        <p class="mt-2 text-sm text-gray-500">{{$medicine}}%</p>
                      </div>
                    </div>
                
                    <div class="flex items-start p-2">
                      <div class="flex h-12 w-12 items-center justify-center rounded-full border border-blue-100 bg-blue-50">
                        <span href="#blue" class="block w-3 h-3 bg-blue-500 rounded-full"></span>
                      </div>
                
                      <div class="ml-4">
                        <h2 class="font-semibold">Lingüistica</h2>
                        <p class="mt-2 text-sm text-gray-500">0</p>
                      </div>
                    </div>
                    
                </div>
            </div>
        </div> --}}
            </div>

            <div class="bg-gray-100 text-gray-500 rounded shadow-xl py-5 px-5 w-full sm:w-full md:w-full lg:w-full"
            x-data="{ cardOpen: false, cardData: cardData() }" x-init="$watch('cardOpen', value => value ? (cardData.countUp($refs.total, 0,  {{ $registradas }}, null, 0.8), cardData.sessions.forEach((el, i) => cardData.countUp($refs[`device${i}`], 0, cardData.sessions[i].size, null, 1.6))) : null);
    setTimeout(() => { cardOpen = true }, 100)">
                <div class="flex w-full">
                    <h3 class="text-lg font-semibold leading-tight flex-1">TOTAL DE CITAS MEDICINA DE AVIACIÓN</h3>
                    <div class="relative h-5 leading-none">
                        <button class="text-xl text-gray-500 hover:text-gray-300 h-6 focus:outline-none"
                            @click.prevent="cardOpen=!cardOpen">
                            <i class="mdi" :class="'mdi-chevron-' + (cardOpen ? 'up' : 'down')"></i>
                        </button>
                    </div>
                </div>
                <div class="relative overflow-hidden transition-all duration-500" x-ref="card"
                    x-bind:style="`max-height:${cardOpen?$refs.card.scrollHeight:0}px; opacity:${cardOpen?1:0}`">
                    <div>
                        <div class="pb-4 lg:pb-6">
                            <h4 class="text-2xl lg:text-3xl text-black font-semibold leading-tight inline-block"
                                x-ref="total">
                                0</h4>
                        </div>
                        <div class="pb-4 lg:pb-6">
                            <div class="overflow-hidden rounded-full h-3 bg-gray-800 flex transition-all duration-500"
                                :class="cardOpen ? 'w-full' : 'w-0'">
                                <template x-for="(item,index) in cardData.sessions">
                                    <div class="h-full" :class="`bg-${item.color}`" :style="`width:${item.size}%`">
                                    </div>
                                </template>
                            </div>
                        </div>
                        <div class="-mt-2 grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                            <div class="flex items-start p-2">
                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-full border border-gray-100 bg-gray-50">
                                    <span href="#blue" class="block w-3 h-3 bg-gray-500 rounded-full"></span>
                                </div>

                                <div class="ml-4">
                                    <h3 class="font-semibold">Pendientes: {{ $pendientes }}</h3>
                                    <p class="mt-2 text-sm text-gray-500">{{ $porpendientes }}%</p>
                                </div>
                            </div>
                            <div class="flex items-start p-2">
                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-full border border-blue-100 bg-blue-50">
                                    <span href="#blue" class="block w-3 h-3 bg-blue-800 rounded-full"></span>
                                </div>

                                <div class="ml-4">
                                    <h3 class="font-semibold">Confirmadas: {{ $validado }}</h3>
                                    <p class="mt-2 text-sm text-gray-500">{{ $porconfir }}%</p>
                                </div>
                            </div>

                            <div class="flex items-start p-2">
                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-full border border-blue-100 bg-blue-50">
                                    <span href="#blue" class="block w-3 h-3 bg-blue-500 rounded-full"></span>
                                </div>
                                <div class="ml-4">
                                    <h2 class="font-semibold">Reagendadas: {{ $reagendado }}</h2>
                                    <p class="mt-2 text-sm text-gray-500">{{ $porreagendado }}%</p>
                                </div>
                            </div>
                            <div class="flex items-start p-2">
                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-full border border-red-100 bg-red-50">
                                    <span href="#blue" class="block w-3 h-3 bg-red-500 rounded-full"></span>
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">Canceladas: {{ $canceladas }}</h2>
                                    <p class="mt-2 text-sm text-gray-500">{{ $porcanceladas }}%</p>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 p-2 gap-4">

                    <!-- Social Traffic -->
                    <div
                        class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
                        <div class="rounded-t mb-0 px-0 border-0">
                            <div class="flex flex-wrap items-center px-4 py-2">
                                <div class="relative w-full max-w-full flex-grow flex-1">
                                    <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Sedes</h3>
                                </div>
                            </div>
                            <div class="block w-full overflow-x-auto">
                                <table class="items-center w-full bg-transparent border-collapse">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                                Nombre</th>
                                            <th
                                                class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                                total de citas</th>
                                            <th
                                                class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">
                                            </th>
                                        </tr>
                                    </thead>
                                    {{-- {{$headquarters}} --}}
                                    <tbody>
                                        @foreach ($headquarters as $headquarter)
                                            <tr class="text-gray-700 dark:text-gray-100">
                                                <th
                                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                    {{ $headquarter->headquarterUser->name }}</th>
                                                <td
                                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                    {{ $headquarter->headquarterUser->userMedicineReserveTo->count() }}
                                                </td>
                                                <td
                                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                    <div class="flex items-center">
                                                        <span
                                                            class="mr-2">{{ round(($headquarter->headquarterUser->userMedicineReserveTo->count() * 100) / $registradas, 1) }}%</span>
                                                        <div class="relative w-full">
                                                            <div
                                                                class="overflow-hidden h-2 text-xs flex rounded bg-blue-200">
                                                                <div style="width:{{ ($headquarter->headquarterUser->userMedicineReserveTo->count() * 100) / $registradas }}%"
                                                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-600">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Recent Activities -->
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
                        <div class="rounded-t mb-0 px-0 border-0">
                            <div class="flex flex-wrap items-center px-4 py-2">
                                <div class="relative w-full max-w-full flex-grow flex-1">
                                    <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Citas Recientes
                                    </h3>
                                </div>
                                <div class="relative w-full max-w-full flex-grow flex-1 text-right">
                                    <a href="{{ route('afac.appointment') }}"
                                        class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                        type="button">VER TODAS</a>
                                </div>
                            </div>
                            <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1">
                                <div class="flex items-start rounded-xl bg-white p-4 shadow-lg">
                                    <div
                                        class="flex h-12 w-12 items-center justify-center rounded-full border border-blue-100 bg-blue-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h2 class="font-semibold">{{ $now }} Citas</h2>
                                        <p class="mt-2 text-sm text-gray-500">hoy {{ $date }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ./Recent Activities -->
                </div>
            </div>
        </div>
    </div>
    <script>
        let cardData = function() {
            return {
                countUp: function(target, startVal, endVal, decimals, duration) {
                    const countUp = new CountUp(target, startVal || 0, endVal, decimals || 0, duration || 2);
                    countUp.start();
                },
                sessions: [{
                    "label": "Pendientes",
                    "size": @json($porpendientes),
                    "color": "gray-500"
                }, {
                    "label": "Validado",
                    "size": @json($porconfir),
                    "color": "blue-800"
                }, {
                    "label": "Reagendado",
                    "size": @json($porreagendado),
                    "color": "blue-500"
                }, {
                    "label": "Cancelado",
                    "size": @json($porcanceladas),
                    "color": "red-500"
                }, ]
            }
        }
    </script>
</div>
