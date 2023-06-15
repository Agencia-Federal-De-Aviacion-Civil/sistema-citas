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
                                <div x-data="{ open: false }"  x-init="() => setTimeout(() => open = true, 500)" class="fixed bottom-0 right-0 z-[60] sm:max-w-sm w-full mx-auto p-6">
                                    <div x-show="open">
                                    <div class="p-4 bg-gray/[.6] backdrop-blur-lg rounded-xl shadow-2xl dark:bg-slate-900/[.6] dark:shadow-black/[.7]">
                                        <div class="p-2 sm:p-5 text-center overflow-y-auto">
                                            <!-- Icon -->
                                            <span
                                                class="mb-4 inline-flex justify-center items-center w-[46px] h-[46px] rounded-full border-4 border-green-50 bg-green-100 text-green-500 dark:bg-green-700 dark:border-green-600 dark:text-green-100">
                                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                  </svg>
                                            </span>
                                            <!-- End Icon -->
                            
                                            <h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-gray-200">
                                                Listo!
                                            </h3>
                                            <p class="text-gray-500">
                                                El documento ya se encuentra disponible para su descarga.
                                            </p>
                            
                                            <div class="grid w-full mt-2">
                                                <button wire:click="downloadExport" @click="open = false" type="button" class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800">
                                                    Descargar
                                                </button>
                                              </div>
                                        </div>
                                        
                                      </div>
                                  </div>
                                </div>
                        @endif
                    </div>
                    @livewire('medicine.tables.appointment-table')
                </div>
            </div>

        </div>
    </div>
</div>
