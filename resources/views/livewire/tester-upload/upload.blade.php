<div>
    <x-notifications position="top-bottom" />
    <div class="py-12">
        <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">
            <div class="mt-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form wire:submit.prevent="save">
                    <div class="mt-1 relative w-full group xl:col-span-2">
                        <label for="small"
                            class="block text-sm font-medium text-gray-900 dark:text-white">ADJUNTA DOCUMENTO</label>
                        <input type="file" wire:model="document" x-ref="file"
                            accept=".pdf" @change="fileName = $refs.file.files[0].name"
                            class="block w-full border border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 file:bg-transparent file:border-0 file:bg-gray-100 file:mr-4 file:py-2.5 file:px-4 dark:file:bg-gray-700 dark:file:text-gray-400">
                        <div class="float-left">
                            <div wire:loading wire:target="document">
                                Subiendo...
                                <div style="color: #27559b9a" class="la-ball-fall">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        @error('document')
                            <span
                                class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{ $message }}</span>
                        @enderror
                    </div>
                    <button
                    class="px-3 py-2 text-sm font-medium text-center text-white bg-sky-700 rounded-lg hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-sky-300 dark:bg-sky-600 dark:hover:bg-sky-700 dark:focus:ring-sky-800">
                    CARGAR
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
