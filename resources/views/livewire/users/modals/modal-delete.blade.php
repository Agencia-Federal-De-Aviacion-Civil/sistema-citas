
<div>
    <div
        class="relative inline-block px-0 pt-0 pb-0 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-0 sm:my-0 sm:align-middle sm:max-w-2xl sm:w-full sm:p-6">
        <div>
            <div class="p-0 text-center">
                {{$this->title}}
            </div>
            <div class="mt-4 text-center">
                <h3 class="text-xl font-semibold leading-6 text-gray-800 capitalize dark:text-white" id="modal-title">
                </h3>
                <div class="grid xl:grid-cols-2 xl:gap-6">
                </div>
                <div class="float-right mt-6">
                    <x-button wire:click="delete()" label="SI" blue/>
                    <x-button wire:click="$emit('closeModal')" label="NO" silver />
                </div>

            </div>
        </div>
    </div>

</div>

