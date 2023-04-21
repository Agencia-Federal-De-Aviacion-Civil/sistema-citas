<div>
    <x-notifications position="top-center" />
    <x-dialog z-index="z-50" blur="md" align="center" />
    @if ($modal)
        @include('livewire.appointment.headquarters.modals.modal-reschedule')
    @endif
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
                                    <span :x-ref="`device${index}`">100</span>%
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
                    <livewire:recordappointment/>
                    {{-- <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    NOMBRE
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    TIPO
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    CLASE
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tipo de Licencia
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    SEDE
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    FECHA Y HORA
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    CORREO
                                </th>
                                <th scope="col" class="px-6 py-3">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($medicineReserves as $medicineReserve)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        {{ $n++ }}
                                    </th>

                                    <td class="px-6 py-4">
                                        {{ $medicineReserve->medicineReserveMedicine->medicineUser->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $medicineReserve->medicineReserveMedicine->medicineTypeExam->name }}
                                    </td>

                                    @if ($medicineReserve->medicineReserveMedicine->medicineTypeExam->id == 1)
                                        <td class="px-6 py-4">
                                            {{ $medicineReserve->medicineReserveMedicine->medicineInitial[0]->medicineInitialTypeClass->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $medicineReserve->medicineReserveMedicine->medicineInitial[0]->medicineInitialClasificationClass->name }}
                                        </td>
                                    @elseif($medicineReserve->medicineReserveMedicine->medicineTypeExam->id == 2)
                                        <td class="px-6 py-4">
                                            {{ $medicineReserve->medicineReserveMedicine->medicineRenovation[0]->renovationTypeClass->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $medicineReserve->medicineReserveMedicine->medicineRenovation[0]->renovationClasificationClass->name }}
                                        </td>
                                    @endif
                                    <td class="px-6 py-4">
                                        {{ $medicineReserve->user->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $medicineReserve->dateReserve }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $medicineReserve->medicineReserveMedicine->medicineUser->email }}
                                        {{-- <x-button wire:click="rescheduleAppointment({{ $medicineReserve->from_user_appointment  }})" label="REAGENDAR" xs blue right-icon="calendar" /> --}}
                                        {{-- <x-button wire:click="rescheduleAppointment()" label="REAGENDAR" xs blue right-icon="calendar" />                                             --}}
                                    {{-- </td>
                                    <td class="px-6 py-4">
                                        {{ $medicineReserve->medicineReserveMedicine->medicineUser->mobilePhone }} --}}
                                        {{-- <x-button wire:click="deletAppointment({{ $medicineReserve->from_user_appointment  }})" label="ELIMINAR" xs red right-icon="trash" /> --}}
                                        {{-- <x-button wire:click="deletAppointment()" label="ELIMINAR" xs red right-icon="trash" /> --}}

                                    {{-- </td>
                                </tr>
                        </tbody> --}}
                        {{-- @endforeach --}}
                    {{-- </table> --}}
                    <div class="mt-6 ml-6 mr-6 mb-6">
                    </div>
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
                "size": 100,
                "color": "blue-800"
            },]
        }
    }
</script>    
