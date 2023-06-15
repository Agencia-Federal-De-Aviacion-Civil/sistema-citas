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
                                <div x-data="{ open: false }"  x-init="() => setTimeout(() => open = true, 500)">
                                    <div  x-show="open"     
                                          x-transition:enter-start="opacity-0 scale-90" 
                                          x-transition:enter="transition duration-200 transform ease"
                                          x-transition:leave="transition duration-200 transform ease"
                                          x-transition:leave-end="opacity-0 scale-90"
                                           class="max-w-screen-lg mx-auto fixed bg-sky-900 inset-x-5 p-5 bottom-40 rounded-lg drop-shadow-2xl flex gap-4 flex-wrap md:flex-nowrap text-center md:text-left items-center justify-center md:justify-between">
                                      <div class="w-full text-white flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-teal-400 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                            </svg>
                                          </div>
                                          <div class="ml-3">
                                        <span class=""> Listo!</span> El documento ya se encuentra disponible para su descarga.
                                        <a href="#" class="text-indigo-600 whitespace-nowrap  hover:underline"></a></div></div>
                                      <div class="flex gap-4 items-center flex-shrink-0">
                                        <button @click="open = false" class="text-indigo-300 focus:outline-none hover:underline">Cerrar</button>
                                        <button wire:click="downloadExport" @click="open = false" class="bg-indigo-500 px-5 py-2 text-white rounded-md hover:bg-indigo-700 focus:outline-none">Descargar</button>
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
