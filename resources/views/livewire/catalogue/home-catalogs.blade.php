<div>
    <x-notifications position="top-bottom" />
    <x-dialog z-index="z-50" blur="md" align="center" />
    <x-banner-component :title="'Catálogos'" />
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-8 py-8">
                <section class="bg-white dark:bg-gray-900">
                    <div x-cloak x-data="{content:'system'}" class="container px-6 py-2">
                        <div class="mt-0 xl:mt-16 lg:flex lg:-mx-12 my-2" >
                            <div class="lg:mx-12">
                                <h1 class="text-xl font-semibold text-gray-800 dark:text-white">Tabla de contenido</h1>
                                <div class="mt-4 space-y-4 lg:mt-8 text-lg border-r-2 border-gray-300 text-gray-500">
                                    <a x-on:click="content = 'system'" class="hover:cursor-pointer items-center gap-2 block dark:text-blue-400 hover:underline"
                                    :class="{ 'border-r-[3px] border-blue-500 text-blue-500': content == 'system' }">Sistemas</a>
                                    <a x-on:click="content = 'tyexamen'" class="hover:cursor-pointer items-center gap-2 block dark:text-gray-300 hover:underline"
                                    :class="{ 'border-r-[3px] border-blue-500 text-blue-500': content == 'tyexamen' }">Tipo de Examen</a>
                                    {{-- <a x-on:click="content = 'typelicens'"  class="hover:cursor-pointer items-center gap-2 block dark:text-gray-300 hover:underline"
                                    :class="{ 'border-r-[3px] border-blue-500 text-blue-500': content == 'typelicens' }">Tipo de licencia</a> --}}
                                    <a x-on:click="content = 'typeclases'" class="hover:cursor-pointer items-center gap-2 block dark:text-gray-300 hover:underline"
                                    :class="{ 'border-r-[3px] border-blue-500 text-blue-500': content == 'typeclases' }">Tipo de Clase</a>
                                    <a x-on:click="content = 'classeclasif'" class="hover:cursor-pointer items-center gap-2 block dark:text-gray-300 hover:underline"
                                    :class="{ 'border-r-[3px] border-blue-500 text-blue-500': content == 'classeclasif' }">Clasificación Clases</a>
                                    <a x-on:click="content = 'status'" class="hover:cursor-pointer items-center gap-2 block dark:text-gray-300 hover:underline"
                                    :class="{ 'border-r-[3px] border-blue-500 text-blue-500': content == 'status' }">Estatus</a>
                                </div>
                            </div>
                            <div class="flex-1 mt-4 lg:mx-12 lg:mt-0">
                                <div x-show="content=='system'">
                                    <div class="flex items-center focus:outline-none">
                                        <svg class="flex-shrink-0 w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                        <h1 class="mx-4 text-2xl text-gray-700 dark:text-white">Sistemas</h1>
                                    </div>
                                    <x-button class="my-4"
                                    onclick="Livewire.emit('openModal', 'catalogue.modals.modal-new', {{ json_encode(['catalogsId' => 0]) }})"
                                    right-icon="plus" sm indigo label="AGREGAR" />
                                    <div class="my-2">
                                        <div class="container mx-auto">
                                            <div class="mt-2 max-w-4xl mx-auto">
                                                <div class="ml-4 uppercase text-sm">
                                                    @livewire('catalogue.tables.typesystem-table')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div x-show="content=='typelicens'">
                                    <div class="flex items-center focus:outline-none">
                                        <svg class="flex-shrink-0 w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                        <h1 class="mx-4 text-2xl text-gray-700 dark:text-white">Tipo de licencias</h1>
                                    </div>
                                </div>
                                <div x-show="content=='typeclases'">
                                    <div class="flex items-center focus:outline-none">
                                        <svg class="flex-shrink-0 w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                        <h1 class="mx-4 text-2xl text-gray-700 dark:text-white">Tipo de clases</h1>
                                    </div>
                                    <x-button class="my-4"
                                    onclick="Livewire.emit('openModal', 'catalogue.modals.modal-newclass', {{ json_encode(['classId' => 0]) }})"
                                    right-icon="plus" sm indigo label="AGREGAR" />
                                    <div class="my-2">
                                        <div class="container mx-auto">
                                            <div class="mt-2 max-w-4xl mx-auto">
                                                <div class="ml-4 uppercase text-sm">
                                                    @livewire('catalogue.tables.typeclasses-table')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div x-show="content=='classeclasif'">
                                    <div class="flex items-center focus:outline-none">
                                        <svg class="flex-shrink-0 w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                        <h1 class="mx-4 text-2xl text-gray-700 dark:text-white">Clasificación de clases</h1>
                                    </div>
                                    <x-button class="my-4"
                                    onclick="Livewire.emit('openModal', 'catalogue.modals.modal-newclasification', {{ json_encode(['classificId' => 0]) }})"
                                    right-icon="plus" sm indigo label="AGREGAR" />
                                    <div class="my-2">
                                        <div class="container mx-auto">
                                            <div class="max-w-4xl mx-auto">
                                                <div>
                                                    @livewire('catalogue.tables.clasificationclasses-table')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div x-show="content=='tyexamen'">
                                    <div class="flex items-center focus:outline-none">
                                        <svg class="flex-shrink-0 w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                        <h1 class="mx-4 text-2xl text-gray-700 dark:text-white">Tipo de Exámen</h1>
                                    </div>
                                    <x-button class="my-4"
                                    onclick="Livewire.emit('openModal', 'catalogue.modals.modal-newtypexam', {{ json_encode(['typexamsId' => 0]) }})"
                                    right-icon="plus" sm indigo label="AGREGAR" />
                                    <div class="my-2">
                                        <div class="container mx-auto">
                                            <div class="mt-2">
                                                <div class="ml-4 uppercase text-sm">
                                                    @livewire('catalogue.tables.typeexam-table')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div x-show="content=='status'">
                                    <div class="flex items-center focus:outline-none">
                                        <svg class="flex-shrink-0 w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                        <h1 class="mx-4 text-2xl text-gray-700 dark:text-white">Estatus</h1>
                                    </div>
                                    <x-button class="my-4"
                                    onclick="Livewire.emit('openModal', 'catalogue.modals.modal-newtypexam', {{ json_encode(['typexamsId' => 0]) }})"
                                    right-icon="plus" sm indigo label="AGREGAR" />
                                    <div class="my-2">
                                        <div class="container mx-auto">
                                            <div class="mt-2 max-w-4xl mx-auto">
                                                <div class="ml-4 uppercase text-sm">
                                                    {{-- @livewire('catalogue.tables.typeexam-table') --}}
                                                </div>
                                            </div>
                                        </div>
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
