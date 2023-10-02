<script src="https://cdn.jsdelivr.net/npm/countup@1.8.2/dist/countUp.min.js"></script>
<div class="relative py-6 lg:py-4">
    <img class="z-0 w-full h-full absolute inset-0 object-cover" src="{{ asset('images/banner_ventanillas.jpg') }}"
        alt="banners" />
    <div
        class="z-10 relative container px-6 mx-auto flex flex-col md:flex-row items-start md:items-center justify-between">
        <div>
            <h4 tabindex="0" class="focus:outline-none text-2xl font-bold leading-tight text-white">Dashboard</h4>
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
            </div>
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
                        {{-- @if ($typeappoiment === 1) --}}
                            @livewire('medicine.medicine-afac.home-medicine-afac')
                        {{-- @endif --}}
                    </div>
                    <div x-show="activeTab === 'schedules'">
                        {{-- @if ($typeappoiment === 2) --}}
                            @livewire('medicine.authorized-third.home-medicine-authorized-third')
                        {{-- @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
