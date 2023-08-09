<div>
    <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">
        <div class="mt-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid xl:grid-cols-2 xl:gap-6">
                <div class="mt-1 relative w-full group">
                    <x-errors></x-errors>
                    <x-input wire:model.lazy="name_headquarter" label="SEDE" placeholder="ESCRIBE..." />
                </div>
                <div class="mt-1 relative w-full group">
                    <x-input wire:model.lazy="direction" label="DIRECCIÓN" placeholder="ESCRIBE..." />
                </div>
            </div>
            <div class="grid xl:grid-cols-2 xl:gap-6">
                @hasrole('super_admin')
                    <div class="mt-4 relative w-full group">
                        <label for="systems"
                            class="block text-sm font-medium text-gray-900 dark:text-white">SISTEMA</label>
                        <select wire:model.lazy="system_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="">Selecciona...</option>
                            @foreach ($qSystems as $qSystem)
                                <option value="{{ $qSystem->id }}" {{ $system_id == $qSystem->id ? 'selected' : '' }}>
                                    {{ $qSystem->name }}</option>
                            @endforeach
                        </select>
                        @error('system_id')
                            <span class="text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-4 relative w-full group">
                        <x-time-picker label="HORARIO" placeholder="7:00 AM" interval="60" wire:model.defer="time_start" />
                    </div>
                </div>
                <div class="grid xl:grid-cols-1 xl:gap-6">
                    <div class="mt-4 relative w-full group">
                        <x-inputs.number label="CAPACIDAD CITAS POR DÍA" wire:model.defer="max_schedules" />
                    </div>
                </div>
                {{-- @if (!empty($sedes)) --}}
                <div class="mt-4" x-data="{ exception: 0 }">
                    <div class="inline-flex items-center justify-center w-full">
                        <span>¿DESEAS REALIZAR UNA EXCEPCIÓN?</span>
                    </div>
                    <div class="mt-4">
                        <ul
                            class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input x-ref="exception" x-model="exception" id="radio-disabled0" type="radio"
                                        value="0" wire:model="questionException"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="radio-disabled0"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NO
                                    </label>
                                </div>
                            </li>
                            <li class="w-full dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input x-ref="exception" x-model="exception" id="radio-enabled0" type="radio"
                                        value="1" wire:model="questionException"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="radio-enabled0"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">SI</label>
                                </div>
                            </li>
                        </ul>
                        @error('questionException')
                            <span class="text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5">{{ $message }}</span>
                        @enderror
                    </div>
                    <div x-show="exception == '1'">
                        <div class="grid xl:grid-cols-2 xl:gap-6">
                            <div class="mt-4 relative w-full group">
                                <x-select label="TIPO DE EXAMEN" placeholder="Selecciona uno o más..."
                                    wire:model.defer="type_exam_id" multiselect>
                                    @foreach ($typeExams as $typeExam)
                                        <x-select.option label="{{ $typeExam->name }}" value="{{ $typeExam->id }}" />
                                    @endforeach
                                </x-select>
                            </div>
                            <div class="mt-4 relative w-full group">
                                <x-inputs.number label="CITAS POR DÍA PARA ESTE EXAMEN"
                                    wire:model.defer="max_schedules_exception" />
                            </div>
                        </div>
                        <div class="mt-6 mb-6">
                            @if ($medicineSchedulesExceptions)
                                @foreach ($medicineSchedulesExceptions as $medicineSchedulesException)
                                    <ul class="space-y-4 text-gray-500 list-disc list-inside dark:text-gray-400">
                                        <li>
                                            CITAS POR DIA {{ $medicineSchedulesException->max_schedules_exception }}
                                            <ol class="pl-5 mt-2 space-y-1 list-decimal list-inside">
                                                @foreach ($medicineSchedulesException->maxExceptionMedicineSchedule as $typeExamEach)
                                                    <li>
                                                        {{ $typeExamEach->medicineSchedulesTypeExam->name }}
                                                    </li>
                                                @endforeach
                                            </ol>
                                        </li>
                                    </ul>
                                @endforeach
                            @else
                            @endif
                        </div>
                    </div>
                </div>
            @else
            @endhasrole
            <div class="grid xl:grid-cols-1 xl:gap-6">
                <div class="mt-4 relative w-full group">
                    <x-textarea wire:model.lazy="url" label="URL" placeholder="INGRESA URL DE GOOGLE MAPS..." />
                </div>
            </div>
            <div class="mt-4">
                <ul
                    class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center pl-3">
                            <input id="radio-disabled" type="radio" value="1" wire:model="status"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="radio-disabled"
                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">DESHABILITAR
                            </label>
                        </div>
                    </li>
                    <li class="w-full dark:border-gray-600">
                        <div class="flex items-center pl-3">
                            <input id="radio-enabled" type="radio" value="0" wire:model="status"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="radio-enabled"
                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">HABILITAR</label>
                        </div>
                    </li>
                </ul>
                @error('status')
                    <span class="text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex items-center justify-between w-full gap-4 mt-8">
                <x-button wire:click.prevent="save()" label="GUARDAR" blue right-icon="save-as" />
                <x-button wire:click.prevent="$emit('closeModal')" label="SALIR" right-icon="login" />
            </div>
        </div>
    </div>
</div>
