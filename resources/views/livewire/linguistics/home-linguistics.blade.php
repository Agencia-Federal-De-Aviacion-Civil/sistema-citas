<div>
    <div class="relative py-6 lg:py-4">
        <img class="z-0 w-full h-full absolute inset-0 object-cover" src="{{ asset('images/banner_ventanillas.jpg') }}"
            alt="banners" />
        <div
            class="z-10 relative container px-6 mx-auto flex flex-col md:flex-row items-start md:items-center justify-between">
            <div>
                <h4 tabindex="0" class="focus:outline-none text-2xl font-bold leading-tight text-white">GENERACIÓN DE
                    CITAS PARA COMPETENCIA LINGÜISTICA</h4>
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
    <div class="py-12">
        <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">
            <div class="mt-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-3 md:gap-6">
                    <div class="relative z-0 w-full mb-6 group">
                        <x-input wire:model.lazy="reference_number" label="REFERENCIA DE PAGO"
                            placeholder="INGRESE..." />
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <x-input wire:model.lazy="pay_date" id="fecha-pago" label="FECHA DE PAGO"
                            placeholder="INGRESE..." readonly />
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <label for="small" class="block text-base font-medium text-gray-900 dark:text-white">ADJUNTA
                            EL COMPROBANTE DE PAGO</label>
                        <input type="file" wire:model="name_document"
                            class="block w-full border border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 file:bg-transparent file:border-0 file:bg-gray-100 file:mr-4 file:py-2.5 file:px-4 dark:file:bg-gray-700 dark:file:text-gray-400">
                        <div class="float-left">
                            <div wire:loading wire:target="">Subiendo...
                                <div style="color: #27559b9a" class="la-ball-fall">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid md:grid-cols-3 md:gap-6">
                    <div class="relative z-0 w-full mb-6 group">
                        <x-select wire:model.lazy="type_exam_id" label="TIPO DE EVALUACIÓN" placeholder="Seleccione...">
                            @foreach ($exams as $exam)
                                <x-select.option label="{{ $exam->name }}" value="{{ $exam->id }}" />
                            @endforeach
                        </x-select>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <x-select wire:model.lazy="type_license" label="TIPO DE LICENCIA" placeholder="Seleccione...">
                            <x-select.option label="PILOTO" value="PILOTO" />
                            <x-select.option label="CONTROLADOR ÁEREO" value="CONTROLADOR ÁEREO" />
                        </x-select>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <x-input wire:model.lazy="license_number" label="NÚMERO DE LICENCIA" placeholder="INGRESE..." />
                    </div>
                </div>
                <div class="grid md:grid-cols-3 md:gap-6">
                    <div class="relative z-0 w-full mb-6 group">
                        <x-input wire:model.lazy="red_number" label="NÚMERO ROJO" placeholder="INGRESE..." />
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <x-select wire:model.lazy="headquarters_id" label="SEDE" placeholder="Seleccione...">
                            @foreach ($headquartersQueries as $headquartersQuery)
                                <x-select.option label="{{ $headquartersQuery->name }}"
                                    value="{{ $headquartersQuery->id }}" />
                            @endforeach
                        </x-select>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <x-input wire:model.lazy="dateReserve" id="selector-fecha" label="FECHA DE CITA"
                            placeholder="INGRESE..." readonly />
                    </div>
                </div>
                <div class="text-right">
                    <x-button wire:click.prevent="save" label="GUARDAR" cyan right-icon="archive" />
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr("#fecha-pago", {
                dateFormat: "Y-m-d",
                disableMobile: "true",
            });

            // SECOND DATE 
            flatpickr("#selector-fecha", {
                enableTime: true,
                time_24hr: true,
                dateFormat: "Y-m-d H:i",
                minTime: "10:00",
                maxTime: "17:00",
                disableMobile: "true",
                minuteIncrement: 30,
                disable: [
                    function(date) {
                        // Devuelve 'true' si la fecha es un sábado o domingo
                        return date.getDay() === 6 || date.getDay() === 0;
                    },
                ],
            });
        });
    </script>
</div>
