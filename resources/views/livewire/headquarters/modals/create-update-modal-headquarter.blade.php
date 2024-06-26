<div>
    <div class="mt-2 p-4 sm:p-7">
        <div class="relative bg-white rounded-3xl">
            <div class="w-full mx-auto">
                <x-banner-modal-icon :title="'SEDE'" :size="'w-16 h-16'" :icon="'sede'" :titlesize="'xl'" />
                {{-- <x-banner-modal :title="'Sedes'" :information="'Verificar la información antes de modificar o crear una Sede.'" :icon="'map'" /> --}}
                <div class="grid xl:grid-cols-1 xl:gap-6 py-2">
                    <div class="mt-1 relative w-full group">
                        <x-input wire:model.lazy="name_headquarter" label="NOMBRE DE LA SEDE" placeholder="ESCRIBE..." />
                    </div>
                    <div class="mt-1 relative w-full group">
                        {{-- <x-input wire:model.lazy="direction" label="DIRECCIÓN" placeholder="ESCRIBE..." /> --}}
                        <x-textarea wire:model.lazy="direction" label="DIRECCIÓN" placeholder="ESCRIBE..." />
                    </div>
                </div>
                <div class="grid xl:grid-cols-2 xl:gap-6">
                    @hasrole(['super_admin', 'super_admin_medicine','admin_medicine_v2'])
                        <div class="mt-4 relative w-full group">
                            <label for="systems"
                                class="block text-sm font-medium text-gray-900 dark:text-white">ESTADO</label>
                            <select wire:model.lazy="state"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option label="SELECCIONAR" value="0" />
                                @foreach ($localizations as $localization)
                                    <option label="{{ $localization->name }}" value="{{ $localization->name }}" />
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-4 relative w-full group">
                            <x-input icon="currency-dollar" label="CUOTA" placeholder="Ingresa la cuota"
                                wire:model.lazy="price" />
                        </div>
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
                            <label for="systems" class="block text-sm font-medium text-gray-900 dark:text-white">TIPO DE
                                CITA</label>
                            <select wire:model.lazy="is_external"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="">Selecciona...</option>
                                <option value="0">AGENCIA FEDERAL DE AVIACIÓN CIVIL</option>
                                <option value="1">TERCEROS AUTORIZADOS</option>
                            </select>
                            @error('is_external')
                                <span class="text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="grid xl:grid-cols-2 xl:gap-6">
                        <div class="mt-4 relative w-full group">
                            <x-inputs.number label="CAPACIDAD CITAS POR DÍA" wire:model.defer="max_schedules" />
                        </div>
                        <div class="mt-4 relative w-full group">
                            <x-time-picker label="HORARIO" placeholder="7:00 AM" interval="60"
                                wire:model.defer="time_start" />
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
                                        <ul class="w-72">
                                            <li class="w-full rounded-lg bg-blue-600 p-1 text-white">
                                                CITAS POR DIA <span
                                                    class="text-lg">{{ $medicineSchedulesException->max_schedules_exception }}</span>
                                            </li>
                                            @foreach ($medicineSchedulesException->maxExceptionMedicineSchedule as $typeExamEach)
                                                <li class="w-full p-2">
                                                    {{ $typeExamEach->medicineSchedulesTypeExam->name }}
                                                    <button class="float-right"
                                                        wire:click.prevent="delete({{ $typeExamEach->id }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-6 h-6 text-red-500">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    </button>
                                                </li>
                                            @endforeach
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
                        <x-textarea wire:model.lazy="url" label="URL"
                            placeholder="INGRESA URL DE GOOGLE MAPS..." />
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
                    <button wire:click.prevent="save()"
                        class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                        GUARDAR
                    </button>
                    <button wire:click="$emit('closeModal')"
                        class="py-2 px-4 bg-gray-100 hover:bg-gray-200 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-indigo-500 w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                        CERRAR
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
