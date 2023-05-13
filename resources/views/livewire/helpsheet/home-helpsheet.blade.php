<div>
    <x-notifications position="top-bottom" />
    <div class="relative py-6 lg:py-4">
        <img class="z-0 w-full h-full absolute inset-0 object-cover" src="{{ asset('images/banner_testing.jpg') }}"
            alt="bg" />
        <div
            class="z-10 relative container px-6 mx-auto flex flex-col md:flex-row items-start md:items-center justify-between">
            <div>
                <h4 tabindex="0" class="focus:outline-none text-2xl font-bold leading-tight text-white">Pago electrónico de derechos, productos y aprovechamientos</h4>
                <ul class="flex flex-col md:flex-row items-start md:items-center text-gray-300 text-sm mt-3">
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="py-12"> 
    <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">
        <section class="text-gray-600 body-font">
            <div class="justify-center"  x-cloak x-data="{ steps: 1 }">  
                <div class="container px-5 py-2 mx-auto">      
                    <div class="w-full px-2 lg:px-10">
                        <img src="{{ asset('images/e5cinco.jpg') }}" alt="">
                        
                        <h1 class="text-3xl font-semibold text-gray-800 dark:text-gray-100">Formato para generar hoja de ayuda</h1>
                        {{-- <p class="mt-4 text-gray-500 dark:text-gray-400">
                            Let’s get you all set up so you can verify your personal account and begin setting up your profile.
                        </p> --}}
                        {{-- pasos --}}
                        <div class="py-8">
                            <h2 class="sr-only">Steps</h2>
                            <div>
                              <div class="overflow-hidden rounded-full bg-gray-200">
                                <div class="rounded-full bg-blue-700 text-xs leading-none h-2 text-center text-white" :style="'width: ' + parseInt((steps / 4) * 100) + '%'"></div>
                              </div>
                              <ol class="mt-4 grid grid-cols-3 text-sm font-medium text-gray-500">
                                <li class="flex items-center justify-start text-blue-600 sm:gap-1.5">
                                  <span class="hidden sm:inline"> Verifica tus datos </span>
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                  </svg>                                  
                                </li>
                                <li class="flex items-center justify-center sm:gap-1.5">
                                  <span class="hidden sm:inline"> Datos del pago </span>
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                  </svg>
                                </li>
                                <li class="flex items-center justify-end sm:gap-1.5">
                                  <span class="hidden sm:inline"> Genera la hoja </span>
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                  </svg>
                                </li>
                              </ol>
                            </div>
                          </div>
                        {{-- fin pasos  --}}
                    <div x-show="steps == 1">
                        <div class="mt-4">
                            <h1 class="text-2xl font-semibold tracking-wider text-gray-800 capitalize dark:text-white">
                                Verifica tus datos
                            </h1>
                        </div>
        
                        <form class="grid grid-cols-1 gap-6 mt-8 md:grid-cols-2">
                            <div class="relative z-0 w-full group">
                                <x-input  wire:model.lazy=""
                                    label="CURP" placeholder="INGRESE..." />
                            </div>
                            <div class="relative z-0 w-full group">
                                <x-input wire:model.lazy=""
                                    label="RFC" placeholder="INGRESE..." />
                            </div>
                            
                            <div class="relative z-0 w-full group xl:col-span-2">
                                <x-input wire:model.lazy=""
                                    label="Nombre(s):" placeholder="INGRESE..." />
                            </div>
                            <div class="relative z-0 w-full group">
                                <x-input wire:model.lazy=""
                                    label="Apellido Paterno:" placeholder="INGRESE..." />
                            </div>
        
                            <div class="relative z-0 w-full group">
                                <x-input wire:model.lazy=""
                                    label="Apellido Materno:" placeholder="INGRESE..." />
                            </div>
                                <h1 class="text-xl text-gray-700 capitalize dark:text-white xl:col-span-2">
                                    Dirección
                                </h1>

                                <div class="relative z-0 w-full group ">
                                    <x-input wire:model.lazy=""
                                        label="Calle:" placeholder="INGRESE..." />
                                </div>
                                <div class="relative z-0 w-full group ">
                                    <x-input wire:model.lazy=""
                                        label="Colonia:" placeholder="INGRESE..." />
                                </div>
                                <div class="relative z-0 w-full group ">
                                    <x-input wire:model.lazy=""
                                        label="CP:" placeholder="INGRESE..." />
                                </div>
                                <div class="relative z-0 w-full group ">
                                    <x-input wire:model.lazy=""
                                        label="Teléfono:" placeholder="INGRESE..." />
                                </div>
                                <div class="relative z-0 w-full group ">
                                    <x-input wire:model.lazy=""
                                        label="Entidad Federativa:" placeholder="INGRESE..." />
                                </div>
                                <div class="relative z-0 w-full group ">
                                    <x-input wire:model.lazy=""
                                        label="Municipio:" placeholder="INGRESE..." />
                                </div>
    
                                <div>
                                    <x-button x-on:click="steps=2" right-icon="arrow-right" blue label="Siguiente" md />
                                </div>
                        </form>
                    </div>
                    <div x-show="steps == 2">
                        <div class="mt-4">
                            <h1 class="text-2xl font-semibold tracking-wider text-gray-800 capitalize dark:text-white">
                                Datos de pago
                            </h1>
                        </div>
        
                        <form class="grid grid-cols-1 gap-6 mt-8 md:grid-cols-2">
                            <div class="relative z-0 w-full group">
                                <x-input  wire:model.lazy="" readonly class="font-semibold"
                                    label="Unidad Administrativa" value="AGENCIA FEDERAL DE AVIACIÓN CIVIL" placeholder="INGRESE..." />
                            </div>
                            <div class="relative z-auto w-full group">
                                <x-select
                                label="Oficina facturacion"
                                placeholder="Oficina facturacion"
                                :options="[
                                    ['name' => 'PERIFERICO',  'id' => 1],
                                    ['name' => 'AV. FUERZA AEREA', 'id' => 2],
                                    ['name' => 'SALA C MEZANINE AICM',   'id' => 3],
                                    ['name' => 'TERMINAL DE AVIACION GENERAL',    'id' => 4],
                                    ['name' => 'OFICINA DE INGRESOS',    'id' => 5],
                                    ['name' => 'CENTRO INTERNACIONAL DE ADIESTRAMIENTO DE AVIACIÓN CIVIL',    'id' => 6],
                                    ['name' => 'AEROPUERTO INTERNACIONAL FELIPE ANGELES',    'id' => 7],
                                    ]"
                                    option-label="name"
                                    option-value="id"
                                    wire:model.defer="model"/>
                                </div>
                            <div class="relative z-auto w-full group">
                                <x-select
                                label="Categoria"
                                placeholder="Categoria"
                                :options="[
                                    ['name' => 'DERECHOS',  'id' => 1],
                                    ]"
                                    option-label="name"
                                    option-value="id"
                                    wire:model.defer="model"/>
                            </div>
                            
                            <div class="relative z-auto w-full group xl:col-span-2">
                                <x-select
                                label="Trámite o Concepto"
                                placeholder="Trámite o Concepto"
                                :options="[
                                    ['name' => '05312244 - POR LA EXPEDICIÓN DE CADA CERTIFICADO DE CAPACIDAD, LICENCIA O PERMISO PARA: (I)',  'id' => 1],
                                    ['name' => '05293295 - POR SU MODIFICACION (I.A)',  'id' => 2],
                                    ['name' => '05273195 - PAGO POR REALIZAR EL EXAMEN DE COMPETENCIA LINGÜISTIICA',  'id' => 2],
                                    ]"
                                    option-label="name"
                                    option-value="id"
                                    wire:model.defer="model"/>
                                
                            </div>
                            <div class="relative z-auto w-full group xl:col-span-2">
                                <ul class="flex flex-col sm:flex-row">
                                    <li class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                                      <div class="relative flex items-start w-full">
                                        <x-radio id="right-label" left-label="No Aplica Periodo" wire:model.defer="" />
                                      </div>
                                    </li>
                                  
                                    <li class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                                      <div class="relative flex items-start w-full">
                                        <x-radio id="right-label" left-label="Mensual" wire:model.defer="" />
                                      </div>
                                    </li>
                                  
                                    <li class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                                      <div class="relative flex items-start w-full">
                                        <x-radio id="right-label" left-label="Trimestral" wire:model.defer="" />
                                      </div>
                                    </li>
                                  </ul>
                            </div>
                            
                           
    
                                <div>
                                    <x-button x-ref="steps=2" right-icon="arrow-right" blue label="Siguiente" md />
                                </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>