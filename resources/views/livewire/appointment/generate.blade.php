<div>
    <x-notifications position="top-center" />
    @if ($confirmModal)
    @include('livewire.appointment.confirm')
    @endif
    @livewire('home.modal-index')
    <div class="container px-6 py-10 mx-auto">
        <h1 class="text-2xl font-semibold text-gray-800 capitalize lg:text-3xl dark:text-white">Generación de cita</h1>
        <div class="flex mx-auto mt-2">
            <span class="inline-block w-40 h-1 bg-sky-700 rounded-full"></span>
            <span class="inline-block w-3 h-1 mx-1 bg-sky-700 rounded-full"></span>
            <span class="inline-block w-1 h-1 bg-sky-700 rounded-full"></span>
        </div>
    </div>
    <form wire:submit.prevent="openConfirm">
        <div x-data="{
            tipoExamen: @entangle('type_exam_id'),
            question: @entangle('user_question_id'),
            clasification: @entangle('type_class_id'), pruebas:1,
        }">
            {{--estep--}}
            <section class="text-gray-600 body-font">
                <div class="container px-5 py-0 mx-auto flex flex-wrap">
                    <div class="flex flex-wrap w-full">
                        <div class="lg:w-full md:w-full md:pr-10 md:py-6">
                            <div class="flex relative pb-6">
                                <div class="h-full w-10 absolute inset-0 flex items-center justify-center">
                                    <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                                </div>
                                <div
                                    class="flex-shrink-0 w-10 h-10 rounded-full bg-sky-700 inline-flex items-center justify-center text-white relative z-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                                    </svg>

                                </div>
                                <div class="flex-grow pl-4">
                                    <label for="small"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">¿QUE TIPO
                                        DE
                                        EXÁMEN VAS
                                        A REALIZAR?</label>
                                    <select id="small" x-ref="tipoExamen" wire:model.lazy="type_exam_id"
                                        placeholder="seleccione..."
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
                            </div>
                            {{--paso2--}}
                            <div x-show="tipoExamen ==='1'" class="flex relative pb-6">
                                <div class="h-full w-10 absolute inset-0 flex items-center justify-center">
                                    <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                                </div>
                                <div
                                    class="flex-shrink-0 w-10 h-10 rounded-full bg-sky-700 inline-flex items-center justify-center text-white relative z-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                    </svg>
                                </div>
                                <div class="flex-grow pl-4">
                                    <label for="small"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">¿SIGUES
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
                            </div>
                            {{--paso3--}}
                            <div x-show="question === '1' || question === '2'||tipoExamen ==='2'"
                                class="flex relative pb-6">
                                <div class="h-full w-10 absolute inset-0 flex items-center justify-center">
                                    <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                                </div>
                                <div
                                    class="flex-shrink-0 w-10 h-10 rounded-full bg-sky-700 inline-flex items-center justify-center text-white relative z-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z" />
                                    </svg>
                                </div>
                                <div class="flex-grow pl-4">
                                    <div class="grid xl:grid-cols-2 xl:gap-6">
                                        <div x-show="question === '1' || question === '2'"
                                            class="mt-2 relative z-0 w-full group">
                                            @if (!is_null($questionClassess))
                                            <label for="small"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">TIPO
                                                DE
                                                CLASE</label>
                                            <select id="small" x-ref="clasification" placeholder="seleccione..."
                                                wire:model.lazy="type_class_id"
                                                class="block w-full p-2 mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option value="0">Seleccione...</option>
                                                @foreach ($questionClassess as $questionClass)
                                                <option value="{{ $questionClass->id }}">{{ $questionClass->name }}
                                                </option>
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
                                        {{--paso4  --}}
                                        <div x-show="clasification === '1' || clasification === '2' || clasification === '3' ||  clasification === '4' || clasification === '5'
            || clasification === '6'" class="mt-4 relative z-0 w-full group">
                                            @if (!is_null($clasificationClass))
                                            <label for="small"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">TIPO
                                                DE LICENCIA</label>
                                            <select id="small" wire:model.lazy="clasification_class_id"
                                                class="block w-full p-2 mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option selected>Seleccione...</option>
                                                @foreach ($clasificationClass as $clasification)
                                                <option value="{{ $clasification->id }}">{{ $clasification->name }}
                                                </option>
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
                                </div>
                            </div>
                            {{--paso5--}}
                            <div x-show="clasification === '1' || clasification === '2' || clasification === '3' ||  clasification === '4' || clasification === '5'
        || clasification === '6'" class="flex relative pb-6">
                                <div class="h-full w-10 absolute inset-0 flex items-center justify-center">
                                    <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                                </div>
                                <div
                                    class="flex-shrink-0 w-10 h-10 rounded-full bg-sky-700 inline-flex items-center justify-center text-white relative z-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                    </svg>
                                </div>
                                <div class="flex-grow pl-4">
                                    <div class="grid xl:grid-cols-2 xl:gap-6">
                                        <div class="relative z-0 w-full mb-2 group">
                                            <x-select label="ELIJA LA SEDE" placeholder="Selecciona"
                                                wire:model.lazy="sede">
                                                @foreach ($sedes as $sede)
                                                <x-select.option label="{{ $sede->name }}" value="{{ $sede->id }}" />
                                                @endforeach
                                            </x-select>
                                        </div>
                                        <div class="relative z-10 w-full mb-2 group">
                                            <x-datetime-picker id="min-max-times-input" without-timezone
                                                x-ref="prueba=0" label="Elije el dia de tu cita"
                                                placeholder="Elije el dia de tu cita" wire:model.defer="date"
                                                interval="60" min-time="07:00" max-time="12:00" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--paso6--}}
                            <div class="flex relative">
                                <div
                                    class="flex-shrink-0 w-10 h-10 rounded-full bg-green-500 inline-flex items-center justify-center text-white relative z-10">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                        <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                                        <path d="M22 4L12 14.01l-3-3"></path>
                                    </svg>
                                </div>
                                <div class="flex-grow pl-4">
                                    <div class="">
                                        <button
                                            class="px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            GENERAR CITA
                                        </button>
                                        <div wire:loading.delay.shortest wire:target="openConfirm">
                                            <div
                                                class="flex justify-center bg-gray-200 z-40 h-full w-full fixed top-0 left-0 items-center opacity-75">
                                                <div style="color: #0061cf"
                                                    class="la-line-spin-clockwise-fade-rotating la-3x">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            {{--estep--}}
        </div>
    </form>
</div>