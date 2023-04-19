<div>
    <x-notifications position="top-center" />
    <x-dialog z-index="z-50" blur="md" align="center" />
    <div class="relative py-6 lg:py-4">
        <img class="z-0 w-full h-full absolute inset-0 object-cover" src="{{ asset('images/banner_testing.jpg') }}"
            alt="bg" />
        <div
            class="z-10 relative container px-6 mx-auto flex flex-col md:flex-row items-start md:items-center justify-between">
            <div>
                <h4 tabindex="0" class="focus:outline-none text-2xl font-bold leading-tight text-white">CITAS AGENDADAS
                </h4>
                <ul class="flex flex-col md:flex-row items-start md:items-center text-gray-300 text-sm mt-3">
                    <li class="flex items-center mt-4 md:mt-0">
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="bg-gray-100 text-gray-500 rounded shadow-xl py-5 px-5 w-full sm:w-full md:w-full lg:w-full" x-data="{cardOpen:false,cardData:cardData()}" x-init="$watch('cardOpen', value => value?(cardData.countUp($refs.total,0,{{$registradas}},null,0.8),cardData.sessions.forEach((el,i) => cardData.countUp($refs[`device${i}`],0,cardData.sessions[i].size,null,1.6))):null);setTimeout(()=>{cardOpen=true},100)">
        <div class="flex w-full">
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
                <div class="flex -mx-4">
                    <template x-for="(item,index) in cardData.sessions">
                            <div class="w-1/3 px-4" :class="{'border-l border-gray-700':index!==0}">
                                <div class="text-sm">
                                    <span class="inline-block w-2 h-2 rounded-full mr-1 align-middle" :class="`bg-${item.color}`">&nbsp;</span>
                                    <span class="align-middle" x-text="item.label">&nbsp;</span>
                                </div>
                                <div class="font-medium text-lg text-gray-500">
                                    <span :x-ref="`device${index}`">0</span>%
                                </div>
                            </div>
                        </template>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">

            <div class="mt-12 max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="ml-4 py-6 mr-4 uppercase text-sm">
                    <livewire:recordappointment />
                </div>
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
                "label": "Validado",
                "size": 60,
                "color": "blue-800"
            }, {
                "label": "Reagendado",
                "size": 40,
                "color": "blue-500"
            },{
                "label": "Cancelado",
                "size": 40,
                "color": "red-500"
            },]
        }
    }
</script>    
