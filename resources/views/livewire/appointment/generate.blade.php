<div>
    <div x-data="{ tipoExamen: @entangle('type_exam_id') }">
        <div class="mt-5 grid xl:grid-cols-2 xl:gap-6">
            <div class="relative z-0 w-full mb-2 group">
                <label for="small" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">¿QUE TIPO DE
                    EXÁMEN VAS
                    A REALIZAR?</label>
                <select id="small" x-ref="tipoExamen" wire:model.lazy="type_exam_id"
                    class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="">Seleccione...</option>
                    @foreach ($typeExamens as $typeExam)
                        <option value="{{ $typeExam->id }}">{{ $typeExam->name }}</option>
                    @endforeach
                </select>
            </div>
            <div x-show="tipoExamen ==='1'">
                <div class="relative z-0 w-full mb-2 group">
                    <label for="small" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">¿SIGUES
                        ESTUDIANDO?</label>
                    <ul
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input id="horizontal-list-radio-license" type="radio" value="SI"
                                    name="list-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="horizontal-list-radio-license"
                                    class="py-3 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">SI</label>
                            </div>
                        </li>
                        <li class="w-full dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input id="horizontal-list-radio-passport" type="radio" value="NO"
                                    name="list-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="horizontal-list-radio-passport"
                                    class="py-3 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">NO</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="grid xl:grid-cols-2 xl:gap-6">
                <div class="relative z-0 w-full mb-2 group">
                    @if (!is_null($typeClasses))
                        <label for="small" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">TIPO
                            DE
                            CLASE</label>
                        <select id="small" wire:model.lazy="type_class_id"
                            class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="">Seleccione...</option>
                            @foreach ($typeClasses as $typeClass)
                                <option value="{{ $typeClass->id }}">{{ $typeClass->name }}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
