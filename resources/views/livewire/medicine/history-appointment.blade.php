<script src="https://cdn.jsdelivr.net/npm/countup@1.8.2/dist/countUp.min.js"></script>
<div>
    <x-notifications position="top-bottom" />
    <x-dialog z-index="z-50" blur="md" align="center" />
    <div class="relative py-6 lg:py-4">
        <img class="z-0 w-full h-full absolute inset-0 object-cover" src="{{ asset('images/banner_testing.jpg') }}" alt="bg" />
        <div class="z-10 relative container px-6 mx-auto flex flex-col md:flex-row items-start md:items-center justify-between">
            <div>
                <h4 tabindex="0" class="focus:outline-none text-2xl font-bold leading-tight text-white">Citas Agendadas
                </h4>
                <ul class="flex flex-col md:flex-row items-start md:items-center text-gray-300 text-sm mt-3">
                    <li class="flex items-center mt-4 md:mt-0">
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="py-12">

        <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">
@hasrole('super_admin|medicine_admin')
    {{-- <div class="bg-gray-100 text-gray-500 rounded shadow-xl py-5 px-5 w-full sm:w-full md:w-full lg:w-full" x-data="{ cardOpen: false, cardData: cardData() }" x-init="$watch('cardOpen', value => value ? (cardData.countUp($refs.total, 0,  {{ $this->registradas }}, null, 0.8), cardData.sessions.forEach((el, i) => cardData.countUp($refs[`device${i}`], 0, cardData.sessions[i].size, null, 1.6))) : null);
            setTimeout(() => { cardOpen = true }, 100)">
        <div class="flex w-full">
            <h3 class="text-lg font-semibold leading-tight flex-1">TOTAL DE CITAS</h3>
            <div class="relative h-5 leading-none">
                <button class="text-xl text-gray-500 hover:text-gray-300 h-6 focus:outline-none" @click.prevent="cardOpen=!cardOpen">
                        <i class="mdi" :class="'mdi-chevron-' + (cardOpen ? 'up' : 'down')"></i>
                    </button>
            </div>
        </div>
        <div class="relative overflow-hidden transition-all duration-500" x-ref="card" x-bind:style="`max-height:${cardOpen?$refs.card.scrollHeight:0}px; opacity:${cardOpen?1:0}`">
            <div>
                <div class="pb-4 lg:pb-6">
                    <h4 class="text-2xl lg:text-3xl text-black font-semibold leading-tight inline-block" x-ref="total">
                        0</h4>
                </div>
                <div class="pb-4 lg:pb-6">
                    <div class="overflow-hidden rounded-full h-3 bg-gray-800 flex transition-all duration-500" :class="cardOpen ? 'w-full' : 'w-0'">
                        <template x-for="(item,index) in cardData.sessions">
                                <div class="h-full" :class="`bg-${item.color}`" :style="`width:${item.size}%`"></div>
                            </template>
                    </div>
                </div>
                <div class="-mt-2 grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    <div class="flex items-start p-2">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full border border-gray-100 bg-gray-50">
                            <span href="#blue" class="block w-3 h-3 bg-gray-500 rounded-full"></span>
                        </div>

                        <div class="ml-4">
                            <h3 class="font-semibold">Pendientes: {{ $this->pendientes }}</h3>
                            <p class="mt-2 text-sm text-gray-500">{{ $this->porpendientes }}%</p>
                        </div>
                    </div>
                    <div class="flex items-start p-2">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full border border-blue-100 bg-blue-50">
                            <span href="#blue" class="block w-3 h-3 bg-blue-800 rounded-full"></span>
                        </div>

                        <div class="ml-4">
                            <h3 class="font-semibold">Confirmadas: {{ $this->validado }}</h3>
                            <p class="mt-2 text-sm text-gray-500">{{ $this->porconfir }}%</p>
                        </div>
                    </div>

                    <div class="flex items-start p-2">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full border border-blue-100 bg-blue-50">
                            <span href="#blue" class="block w-3 h-3 bg-blue-500 rounded-full"></span>
                        </div>
                        <div class="ml-4">
                            <h2 class="font-semibold">Reagendadas: {{ $this->reagendado }}</h2>
                            <p class="mt-2 text-sm text-gray-500">{{ $this->porreagendado }}%</p>
                        </div>
                    </div>
                    <div class="flex items-start p-2">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full border border-red-100 bg-red-50">
                            <span href="#blue" class="block w-3 h-3 bg-red-500 rounded-full"></span>
                        </div>

                        <div class="ml-4">
                            <h2 class="font-semibold">Canceladas: {{ $this->canceladas }}</h2>
                            <p class="mt-2 text-sm text-gray-500">{{ $this->porcanceladas }}%</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div> --}}
    @else @endhasrole

            <div class="mt-12 max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="ml-4 py-6 mr-4 uppercase text-sm">
                    <livewire:recordappointment />
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
