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
                                        <div class="flex justify-between items-center gap-x-5 sm:gap-x-10">
                                          <div class="flex-shrink-0">
                                              <svg class="h-5 w-5 text-teal-400 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                              </svg>
                                            </div>
                                          <h2 class="font-semibold text-gray-800 dark:text-white">
                                            Listo !
                                          </h2>
                                          <button @click="open = false" type="button" class="inline-flex rounded-full p-2 text-gray-500 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-gray-600 dark:hover:bg-gray-600 dark:text-gray-300" data-hs-remove-element="#cookies-with-stacked-buttons">
                                            <span class="sr-only">Dismiss</span>
                                            <svg class="h-3 w-3" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                              <path d="M0.92524 0.687069C1.126 0.486219 1.39823 0.373377 1.68209 0.373377C1.96597 0.373377 2.2382 0.486219 2.43894 0.687069L8.10514 6.35813L13.7714 0.687069C13.8701 0.584748 13.9882 0.503105 14.1188 0.446962C14.2494 0.39082 14.3899 0.361248 14.5321 0.360026C14.6742 0.358783 14.8151 0.38589 14.9468 0.439762C15.0782 0.493633 15.1977 0.573197 15.2983 0.673783C15.3987 0.774389 15.4784 0.894026 15.5321 1.02568C15.5859 1.15736 15.6131 1.29845 15.6118 1.44071C15.6105 1.58297 15.5809 1.72357 15.5248 1.85428C15.4688 1.98499 15.3872 2.10324 15.2851 2.20206L9.61883 7.87312L15.2851 13.5441C15.4801 13.7462 15.588 14.0168 15.5854 14.2977C15.5831 14.5787 15.4705 14.8474 15.272 15.046C15.0735 15.2449 14.805 15.3574 14.5244 15.3599C14.2437 15.3623 13.9733 15.2543 13.7714 15.0591L8.10514 9.38812L2.43894 15.0591C2.23704 15.2543 1.96663 15.3623 1.68594 15.3599C1.40526 15.3574 1.13677 15.2449 0.938279 15.046C0.739807 14.8474 0.627232 14.5787 0.624791 14.2977C0.62235 14.0168 0.730236 13.7462 0.92524 13.5441L6.59144 7.87312L0.92524 2.20206C0.724562 2.00115 0.611816 1.72867 0.611816 1.44457C0.611816 1.16047 0.724562 0.887983 0.92524 0.687069Z" fill="currentColor"/>
                                            </svg>
                                          </button>
                                        </div>
                                        <p class="mt-2 text-md text-center text-gray-800 dark:text-gray-200">
                                          El documento ya se encuentra disponible para su descarga.
                                        </p>
                                        <div class="grid w-full mt-4">
                                          <button wire:click="downloadExport" @click="open = false" type="button" class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800">
                                              Descargar
                                          </button>
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
