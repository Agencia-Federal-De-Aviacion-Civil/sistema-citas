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
                        <x-input wire:model.lazy="referenceNumber" label="REFERENCIA DE PAGO"
                            placeholder="INGRESE..." />
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <x-input wire:model.lazy="headquarters" label="SEDE" placeholder="INGRESE..." />
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
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Livewire.on("fechaSeleccionada", (dateReserve) => {
            console.log("Fecha seleccionada: " + dateReserve);
        });
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
            onChange: function(selectedDates) {
                Livewire.emit(
                    "fechaSeleccionada",
                    selectedDates[0].toISOString().slice(0, 10)
                );
            },
        });
    });
</script>
