<div>
    <x-dialog z-index="z-50" blur="md" align="center" />
    <div class="relative py-6 lg:py-4">
        <img class="z-0 w-full h-full absolute inset-0 object-cover" src="{{ asset('images/banner_testing.jpg') }}"
            alt="bg" />
        <div
            class="z-10 relative container px-6 mx-auto flex flex-col md:flex-row items-start md:items-center justify-between">
            <div>
                <h4 tabindex="0" class="focus:outline-none text-2xl font-bold leading-tight text-white">Validación de
                    Licencias</h4>
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
                <div class="grid xl:grid-cols-2 xl:gap-6">
                    <div class="mt-1 relative z-0 w-full group">
                        <x-input right-icon="user" wire:model.lazy="search" label="CURP"
                            placeholder="INGRESE CURP PARA BUSCAR" />
                        <button wire:click="$emitSelf('searchUsers')"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg ml-2">Search</button>
                    </div>
                </div>
                @if ($userDetails)
                    <div class="grid xl:grid-cols-3 xl:gap-6">
                        <div class="mt-1 relative z-0 w-full group">
                            <x-input right-icon="user"
                                value="{{ $userDetails->medicineReserveFromUser->name . ' ' . $userDetails->medicineReserveFromUser->UserParticipant[0]->apParental . ' ' . $userDetails->medicineReserveFromUser->UserParticipant[0]->apMaternal }}"
                                label="NOMBRE COMPLETO" placeholder="" readonly />
                        </div>
                        <div class="mt-1 relative z-0 w-full group">
                            <x-select label="NACIONALIDAD" placeholder="Seleccione..." wire:model.defer="">
                                @foreach ($nationalities as $nationality)
                                    <x-select.option label="{{ $nationality->name }}" value="{{ $nationality->id }}" />
                                @endforeach
                            </x-select>
                        </div>
                        <div class="mt-1 relative z-0 w-full group">
                            <x-input right-icon="user" value="{{$userDetails->medicineReserveFromUser->UserParticipant[0]->age}}" label="EDAD" placeholder="" readonly />
                        </div>
                    </div>
                    <div class="mt-4 grid xl:grid-cols-3 xl:gap-6">
                        <div class="mt-1 relative z-0 w-full group">
                            <x-input wire:model.lazy="" id="fecha-pago" label="FECHA DE EVALUACIÓN"
                                placeholder="INGRESE..." />
                        </div>
                        <div class="mt-1 relative z-0 w-full group">
                            <x-input right-icon="user" value="{{$userDetails->medicineReserveHeadquarter->name_headquarter}}" label="LUGAR DEL EXAMEN" placeholder=""
                                readonly />
                        </div>
                        <div class="mt-1 relative z-0 w-full group">

                        </div>
                    </div>
                    <button wire:click="save" class="px-4 py-2 bg-blue-500 text-white rounded-lg ml-2">Guardar</button>
                @endif
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr("#fecha-pago", {
                dateFormat: "Y-m-d",
                disableMobile: "true",
                locale: {
                    weekdays: {
                        shorthand: ['Dom', 'Lun', 'Mar', 'Mier', 'Jue', 'Vie', 'Sab'],
                        longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes',
                            'Sábado'
                        ],
                    },
                    months: {
                        shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct',
                            'Nov', 'Dic'
                        ],
                        longhand: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                            'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                        ],
                    },
                },
            });
        });
    </script>
</div>
