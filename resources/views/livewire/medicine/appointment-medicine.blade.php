<div>
    <x-notifications position="top-bottom" />
    <x-dialog z-index="z-50" blur="md" align="center" />
    <div class="relative py-6 lg:py-4">
        <img class="z-0 w-full h-full absolute inset-0 object-cover" src="{{ asset('images/banner_testing.jpg') }}"
            alt="bg" />
        <div
            class="z-10 relative container px-6 mx-auto flex flex-col md:flex-row items-start md:items-center justify-between">
            <div>
                <h4 tabindex="0" class="focus:outline-none text-2xl font-bold leading-tight text-white">Citas
                    Agendadas
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
            <div class="mt-12 max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="ml-4 py-6 mr-4 uppercase text-sm">
                    <div class="text-center">
                        @if ($exporting && !$exportFinished)
                            <div class="flex flex-col items-center" wire:poll="updateExportProgress">
                                <div class="mt-20">
                                    <div style="color: #0061cf" class="la-line-spin-clockwise-fade-rotating la-2x">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                                <div
                                    class="mb-5 text-lg font-semibold text-gray-500 text-center p-0.5 leading-none rounded-full px-2 dark:bg-blue-900 dark:text-blue-200 absolute -translate-y-1/2 -translate-x-1/2 top-2/4 left-1/2">
                                    SE ESTA GENERANDO EL DOCUMENTO...POR FAVOR ESPERE</div>
                            </div>
                        @endif
                        @if ($exportFinished)
                            Listo. Descarga el documento <button class="hover:underline"
                                wire:click="downloadExport">AQUI.</button>
                        @endif
                    </div>
                    @livewire('medicine.tables.appointment-table')
                </div>
            </div>

        </div>
    </div>
</div>
