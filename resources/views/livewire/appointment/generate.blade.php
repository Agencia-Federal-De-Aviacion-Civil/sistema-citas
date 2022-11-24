<div>
    <form wire:submit.prevent="save">
        <div x-data="{
            tipoExamen: @entangle('type_exam_id'),
            question: @entangle('user_question_id'),
            clasification: @entangle('type_class_id'),
        }">
            {{--  --}}
            <div class="mb-2">
                <label for="small" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">¿QUE TIPO DE
                    EXÁMEN VAS
                    A REALIZAR?</label>
                <select id="small" x-ref="tipoExamen" wire:model.lazy="type_exam_id" placeholder="seleccione..."
                    class="block w-full p-2 mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="">Seleccione...</option>
                    @foreach ($typeExamens as $typeExam)
                        <option value="{{ $typeExam->id }}">{{ $typeExam->name }}</option>
                    @endforeach
                </select>
                @error('type_exam_id')
                    <span
                        class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{ $message }}</span>
                @enderror
            </div>
            {{--  --}}
            {{--  --}}
            <div x-show="tipoExamen ==='1'" class="mt-8">
                <label for="small" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">¿SIGUES
                    ESTUDIANDO?</label>
                <select id="small" x-ref="question" wire:model.lazy="user_question_id"
                    class="block w-full p-2 mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Seleccione...</option>
                    @foreach ($questions as $question)
                        <option value="{{ $question->id }}">{{ $question->name }}</option>
                    @endforeach
                </select>
                @error('user_question_id')
                    <span
                        class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{ $message }}</span>
                @enderror
            </div>
            {{--  --}}
            <div class="grid xl:grid-cols-2 xl:gap-6">
                <div x-show="question === '1' || question === '2'" class="mt-4 relative z-0 w-full group">
                    @if (!is_null($questionClassess))
                        <label for="small" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">TIPO
                            DE
                            CLASE</label>
                        <select id="small" x-ref="clasification" placeholder="seleccione..."
                            wire:model.lazy="type_class_id"
                            class="block w-full p-2 mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="0">Seleccione...</option>
                            @foreach ($questionClassess as $questionClass)
                                <option value="{{ $questionClass->id }}">{{ $questionClass->name }}</option>
                            @endforeach
                        </select>
                        @error('type_class_id')
                            <span
                                class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{ $message }}</span>
                        @enderror
                    @endif
                </div>
                <div x-show="tipoExamen ==='2'">
                    <div class="mt-4 relative z-0 w-full group">
                        @if (!is_null($typeClasses))
                            <label for="small"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">TIPO
                                DE
                                CLASE</label>
                            <select id="small" wire:model.lazy="type_class_id"
                                class="block w-full p-2 mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Seleccione...</option>
                                @foreach ($typeClasses as $typeClass)
                                    <option value="{{ $typeClass->id }}">{{ $typeClass->name }}</option>
                                @endforeach
                            </select>
                            @error('type_class_id')
                                <span
                                    class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{ $message }}</span>
                            @enderror
                        @endif
                    </div>
                </div>
                {{--  --}}
                <div x-show="clasification === '1' || clasification === '2' || clasification === '3' ||  clasification === '4' || clasification === '5'
            || clasification === '6'"
                    class="mt-4 relative z-0 w-full group">
                    @if (!is_null($clasificationClass))
                        <label for="small" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">TIPO
                            DE LICENCIA</label>
                        <select id="small" wire:model.lazy="clasification_class_id"
                            class="block w-full p-2 mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Seleccione...</option>
                            @foreach ($clasificationClass as $clasification)
                                <option value="{{ $clasification->id }}">{{ $clasification->name }}</option>
                            @endforeach
                        </select>
                        @error('clasification_class_id')
                            <span
                                class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{ $message }}</span>
                        @enderror
                    @endif
                </div>
                {{--  --}}
            </div>
            <div x-show="clasification === '1' || clasification === '2' || clasification === '3' ||  clasification === '4' || clasification === '5'
        || clasification === '6'"
                class="grid xl:grid-cols-2 xl:gap-6">
                <div class="relative z-0 w-full mb-2 group">
                    <x-select label="ELIJA LA SEDE" placeholder="Selecciona" wire:model.lazy="sede">
                        @foreach ($sedes as $sede)
                            <x-select.option label="{{ $sede->name }}" value="{{ $sede->id }}" />
                        @endforeach
                    </x-select>
                </div>
                <div class="relative z-10 w-full mb-2 group">
                    <x-datetime-picker id="min-max-times-input" without-timezone label="Elije el dia de tu cita"
                        placeholder="Elije el dia de tu cita" wire:model.defer="date" interval="60" min-time="07:00"
                        max-time="12:00" />
                </div>
            </div>
        </div>
        <div class="text-right">
            <button
                class="px-3 py-2 text-sm font-medium text-center text-white bg-sky-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                GENERAR CITA
            </button>
            <div wire:loading.delay.shortest wire:target="save">
                <div
                    class="flex justify-center bg-gray-200 z-40 h-full w-full fixed top-0 left-0 items-center opacity-75">
                    <div style="color: #0061cf" class="la-line-spin-clockwise-fade-rotating la-3x">
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
            </div>
        </div>
    </form>
</div>
