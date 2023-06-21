<div>
    <x-notifications position="top-bottom" />
    <x-dialog z-index="z-50" blur="md" align="center" />
    {{-- @livewire('catalogue.modal.modal-new') --}}
    <div class="relative py-6 lg:py-4">
        <img class="z-0 w-full h-full absolute inset-0 object-cover" src="{{ asset('images/banner_testing.jpg') }}"
            alt="bg" />
        <div
            class="z-10 relative container px-6 mx-auto flex flex-col md:flex-row items-start md:items-center justify-between">
            <div>
                <h4 tabindex="0" class="focus:outline-none text-2xl font-bold leading-tight text-white">Catálogos</h4>
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
            <div class="mt-2 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <section class="bg-white dark:bg-gray-900">
                    <div x-cloak x-data="{content:'system'}" class="container px-6 py-2 mx-auto">
                        <div class="mt-0 xl:mt-16 lg:flex lg:-mx-12 my-2" >
                            <div class="lg:mx-12">
                                <h1 class="text-xl font-semibold text-gray-800 dark:text-white">Tabla de contenido</h1>
                                <div class="mt-4 space-y-4 lg:mt-8 text-lg border-r-2 border-gray-300 text-gray-500">
                                    <a x-on:click="content = 'system'" class="hover:cursor-pointer items-center gap-2 block dark:text-blue-400 hover:underline"
                                    :class="{ 'border-r-[3px] border-blue-500 text-blue-500': content == 'system' }">Sistemas</a>
                                    <a x-on:click="content = 'typelicens'"  class="hover:cursor-pointer items-center gap-2 block dark:text-gray-300 hover:underline"
                                    :class="{ 'border-r-[3px] border-blue-500 text-blue-500': content == 'typelicens' }">Tipo de licencia</a>
                                    <a x-on:click="content = 'typeclases'" class="hover:cursor-pointer items-center gap-2 block dark:text-gray-300 hover:underline"
                                    :class="{ 'border-r-[3px] border-blue-500 text-blue-500': content == 'typeclases' }">Tipo de Clase</a>
                                    <a x-on:click="content = 'classeclasif'" class="hover:cursor-pointer items-center gap-2 block dark:text-gray-300 hover:underline"
                                    :class="{ 'border-r-[3px] border-blue-500 text-blue-500': content == 'classeclasif' }">Clasificación Clases</a>
                                    <a x-on:click="content = 'tyexamen'" class="hover:cursor-pointer items-center gap-2 block dark:text-gray-300 hover:underline"
                                    :class="{ 'border-r-[3px] border-blue-500 text-blue-500': content == 'tyexamen' }">Tipo de Examen</a>                                    
                                </div>
                            </div>
                            <div class="flex-1 mt-4 lg:mx-12 lg:mt-0">
                                <div x-show="content=='system'">
                                    <div class="flex items-center focus:outline-none">
                                        <svg class="flex-shrink-0 w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                        <h1 class="mx-4 text-xl text-gray-700 dark:text-white">Sistemas</h1>
                                      
                                    </div>
                                    <div class="my-2">
                                        @livewire('catalogue.tables.typesystem-table')
                                    </div>
                                    
                                </div>
                                <div x-show="content=='typelicens'">
                                    <div class="flex items-center focus:outline-none">
                                        <svg class="flex-shrink-0 w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                        <h1 class="mx-4 text-xl text-gray-700 dark:text-white">Tipo de licencias</h1>
                                    </div>
                                </div>
                                <div x-show="content=='typeclases'">
                                    <div class="flex items-center focus:outline-none">
                                        <svg class="flex-shrink-0 w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>                
                                        <h1 class="mx-4 text-xl text-gray-700 dark:text-white">Tipo de clases</h1>
                                    </div>
                                </div>
                                <div x-show="content=='classeclasif'">
                                    <div class="flex items-center focus:outline-none">
                                        <svg class="flex-shrink-0 w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>                
                                        <h1 class="mx-4 text-xl text-gray-700 dark:text-white">Clasificación de clases</h1>
                                    </div>
                                </div>
                                <div x-show="content=='tyexamen'">
                                    <div class="flex items-center focus:outline-none">
                                        <svg class="flex-shrink-0 w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                
                                        <h1 class="mx-4 text-xl text-gray-700 dark:text-white">Tipo de Exámen</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
