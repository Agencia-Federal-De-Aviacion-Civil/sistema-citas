   <div>
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
    
            <div class="py-12">
                <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">
        {{-- AQUI METE EL CHINGADO BOTON AMIGO --}}
        {{-- <x-button wire:click.prevent="addPrivileges()" right-icon="user-add" blue
        label="AÑADIR USUARIO" />     --}}
{{-- 
        <x-button
onclick="Livewire.emit('openModal', 'users.modals.modal-new', {{ json_encode(['privilegesId' => 0]) }})"
        right-icon="user-add" blue
        label="AÑADIR USUARIO" /> --}}
        

         {{-- <button onclick="Livewire.emit('openModal', 'users.modals.modal-new')">Open Modal</button> --}}

                    <div class="mt-12 max-w-8xl mx-auto sm:px-6 lg:px-8">
                        <div class="ml-4 py-6 mr-4 uppercase text-sm">
                            {{-- <livewire:recordappointment /> --}}
                            <livewire:user-manager/>
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
                        }, {
                            "label": "Cancelado",
                            "size": 40,
                            "color": "red-500"
                        }, ]
                    }
                }
            </script>
        </div>
        
    </div>
